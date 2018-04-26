<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form about `backend\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'old_id', 'sort'], 'integer'],
            [['category_name', 'class_name', 'icon'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Categories::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'old_id' => $this->old_id,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'category_name', $this->category_name])
            ->andFilterWhere(['like', 'class_name', $this->class_name])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
