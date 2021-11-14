<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;
use yii\helpers\ArrayHelper;

/**
 * OrderSearch represents the model behind the search form of `backend\models\Order`.
 */
class OrderSearch extends Order
{

    /**
     * @var string $eventDateRange
     */
    public $eventDateRange;
    /**
     * @var string $eventDateStart
     */
    public $eventDateStart;
    /**
     * @var string $eventDateEnd
     */
    public $eventDateEnd;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'event_id', 'customer_id'], 'integer'],
            [['event_date', 'transaction_id', 'created_at', 'updated_at', 'eventDateEnd', 'eventDateStart', 'eventDateRange'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find()->with('customer','table', 'orderItemExtraItems');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'sort' => [
            //     'defaultOrder' => [
            //         'created_at' => SORT_DESC,
            //     ]
            // ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'event_id' => $this->event_id,
            'customer_id' => $this->customer_id,
            'event_date' => $this->event_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id]);
        $query->andFilterCompare('event_date', $this->eventDateStart, '>=');
        $query->andFilterCompare('event_date', $this->eventDateEnd, '<=');
        return $dataProvider;
    }
    public function getCustomerList()
    {
        return ArrayHelper::map(User::find()->all(), 'id', 'fullName');
    }
}
