<?php

namespace frontend\models;

use common\models\Event;
use common\models\Order;
use common\models\OrderItem;
use common\models\Table;
use LogicException;
use Yii;
use yii\base\Model;

/**
 * Class EventOrderForm
 */
class EventOrderForm extends Model
{
    /**
     * @var int
     */
    public $eventId;

    /**
     * @var int
     */
    public $tableId;

    /**
     * @var string
     */
    public $eventDate;

    /**
     * @var ExtraItemForm[]
     */
    public $extraItemForms;

    const SCENARIO_STEP_1_SELECT_EVENT = 'select-event';
    const SCENARIO_STEP_2_NUMBER_OF_TABLES = 'number-of-tables';
    const SCENARIO_STEP_3_SELECT_DATE = 'select-date';
    const SCENARIO_STEP_4_EXTRA_ITEMS = 'extra-items';
    const SCENARIO_STEP_5_SUBMIT_ORDER = 'submit-order';

    /**
     * {@inheritdoc}
     */
    public function __construct($config = ['scenario' => self::SCENARIO_STEP_1_SELECT_EVENT])
    {
        $this->extraItemForms = ExtraItemForm::find()->all();
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['eventId', 'required', 'message' => 'Please, choose event.'],
            ['eventId', 'integer'],
            [
                'eventId', 'exist', 'skipOnError' => true,
                'targetClass' => Event::class,
                'targetAttribute' => ['eventId' => 'id']
            ],

            ['tableId', 'required', 'message' => 'Please, choose one of the types of tables.'],
            ['tableId', 'integer'],
            [
                'tableId', 'exist', 'skipOnError' => true,
                'targetClass' => Table::class,
                'targetAttribute' => ['tableId' => 'id']
            ],

            ['eventDate', 'required', 'message' => 'Please, choose event date.'],
            ['eventDate', 'date', 'format' => 'php:Y-m-d', 'min' => date('Y-m-d', strtotime('+3 days'))],

        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        return [
            static::SCENARIO_STEP_1_SELECT_EVENT => ['eventId'],
            static::SCENARIO_STEP_2_NUMBER_OF_TABLES => ['eventId', 'tableId'],
            static::SCENARIO_STEP_3_SELECT_DATE => ['eventId', 'tableId', 'eventDate'],
            static::SCENARIO_STEP_4_EXTRA_ITEMS => ['eventId', 'tableId', 'eventDate', 'extraItemForms'],
            static::SCENARIO_STEP_5_SUBMIT_ORDER => ['eventId', 'tableId', 'eventDate', 'extraItemForms'],
        ];
    }

    public function getScenarioStep()
    {
        $result = array_search($this->getScenario(), array_keys($this->scenarios()));
        if (!$result) return 1;
        return $result + 1;
    }

    public function getEventName()
    {
        $name = Event::findOne($this->eventId)->name;
        return $name ?? false;
    }


    public function getTable()
    {
        return Table::findOne($this->tableId) ?? false;
    }
    public function getChosenExtraItemsList()
    {
        return $this->extraItemForms ?
            array_filter($this->extraItemForms, function ($item) {
                return $item->quantity > 0;
            }) :
            null;
    }
    public function getItemsCount()
    {
        return $this->extraItemForms ? count($this->chosenExtraItemsList) : null;
    }

    public function getList()
    {
        $str = '';
        if (!$this->chosenExtraItemsList) return null;

        $items = array_values($this->chosenExtraItemsList);
        $lastItem = $items[array_key_last($items)];
        if ($this->itemsCount <= 2) {
            foreach ($items as $item) {
                if ($item === $lastItem) {
                    $str .= $item->titleWithCount;
                } else {
                    $str .= $item->titleWithCount . ', ';
                }
            }
        } else {
            foreach ($items as $index => $item) {
                if ($index > 2) {
                    $str .= '...';
                    break;
                } else {
                    $str .= $item->titleWithCount . ', ';
                }
            }
        }

        return $str;
    }
    public function getTotalExtraItemsPrice()
    {
        $price = 0;
        if (!$this->chosenExtraItemsList) return 0;
        foreach ($this->chosenExtraItemsList as $item) {
            $price += $item->price * $item->quantity;
        }
        return $price;
    }
    public function getTotalPrice()
    {
        $price = 0;
        foreach ($this->chosenExtraItemsList as $item) {
            $price += $item->price * $item->quantity;
        }
        $price += $this->table->price;
        return $price;
    }
    public function getTotalPriceLabel()
    {
        return Yii::$app->formatter->asCurrency($this->totalPrice);
    }

    public function submit($customerId)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {
            $order = new Order();
            $order->status = Order::STATUS_PAYMENT_PENDING;
            $order->event_id = $this->eventId;
            $order->customer_id = $customerId;
            $order->event_date = $this->eventDate;

            if (!$order->save()) {
                Yii::error($order->getErrors());
                throw new LogicException("Internal error");
            }

            foreach ($this->chosenExtraItemsList as $extraItem) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->title = $extraItem->title;
                $orderItem->price = $extraItem->price;
                $orderItem->quantity = $extraItem->quantity;
                $orderItem->extra_item_id = $extraItem->id;
                if (!$orderItem->save()) {
                    Yii::error($orderItem->getErrors());
                    throw new LogicException("Internal error");
                }
            }

            $orderItem = new OrderItem();
            $orderItem->title = $this->table->fullName;
            $orderItem->order_id = $order->id;
            $orderItem->table_id = $this->table->id;
            $orderItem->price = $this->table->price;
            $orderItem->quantity = 1;
            if (!$orderItem->save()) {
                Yii::error($orderItem->getErrors());
                throw new LogicException("Internal error");
            }
            $transaction->commit();
        } catch (\Throwable $e) {
            Yii::error($e->getMessage());
            $transaction->rollBack();
            throw new LogicException($e->getMessage());
        }
    }
}
