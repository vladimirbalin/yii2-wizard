<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TextBlock;

/**
 * TextBlockSearch represents the model behind the search form of `backend\models\TextBlock`.
 */
class TextBlockSearch extends TextBlock
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shortcut', 'text'], 'safe'],
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
        $query = TextBlock::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'shortcut', $this->shortcut])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
