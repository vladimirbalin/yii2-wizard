<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $status
 * @property int $event_id
 * @property int $customer_id
 * @property string $event_date
 * @property string|null $transaction_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $customer
 * @property Event $event
 * @property OrderItem[] $orderItems
 * @property Table $table
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_PAYMENT_PENDING = 0;
    const STATUS_PAYMENT_VERIFICATION_PENDING = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETE = 3;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => date("Y-m-d H:i:s"),
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'event_id', 'customer_id', 'event_date'], 'required'],
            [['status', 'event_id', 'customer_id'], 'integer'],
            [['transaction_id'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'event_id' => 'Event ID',
            'customer_id' => 'Customer ID',
            'event_date' => 'Event Date',
            'transaction_id' => 'Transaction ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemExtraItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id'])->where(['not' , ['extra_item_id' => null]]);
    }
    public function getTable()
    {
        return $this->hasOne(Table::class, ['id' => 'table_id'])->viaTable('order_item',['order_id' => 'id']);
    }
    public function getEventName()
    {
        return $this->event->name;
    }
    public function getTotalPrice()
    {
        $price = 0;
        foreach ($this->orderItemExtraItems as $item) {
            $price += $item->price * $item->quantity;
        }
        $price += $this->table->price;
        return $price;
    }
    public function getTotalPriceLabel()
    {
        return Yii::$app->formatter->asCurrency($this->totalPrice);
    }
    public function getEventDate()
    {
        return date('M j, Y', strtotime($this->event_date));
    }
    public function getCreatedAt()
    {
        return date('M j, Y', strtotime($this->created_at));
    }
    public function getTableId()
    {
        $table = array_filter($this->orderItemExtraItems, function ($item) {
            return $item->table_id !== null;
        });
        return array_values($table)[0]->table_id;
    }
    public function getItemsCount()
    {
        return $this->orderItemExtraItems ? count($this->orderItemExtraItems) : null;
    }
    public function getList()
    {
        $str = '';
        if (!$this->orderItemExtraItems) return null;
        $items = array_values($this->orderItemExtraItems);
        $lastItem = $items[array_key_last($items)];
        if (count($items) <= 2) {
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
        foreach ($this->orderItemExtraItems as $value) {
            $price += $value->price * $value->quantity;
        }
        return $price;
    }
    public function getTransactionId()
    {
        return $this->transaction_id ?? 'Not enter yet';
    }
    public function getStatusList()
    {
        return [
            0 => 'Payment Pending',
            1 => 'Payment Verification Pending',
            2 => 'Payment Processing',
            3 => 'Complete'
        ];
    }
}
