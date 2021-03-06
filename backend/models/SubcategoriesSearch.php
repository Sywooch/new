<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Subcategories;

/**
 * SubcategoriesSearch represents the model behind the search form about `backend\models\Subcategories`.
 */
class SubcategoriesSearch extends Subcategories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'old_id', 'old_cat_id', 'cat_id', 'sort'], 'integer'],
            [['subcat_name'], 'safe'],
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
        $query = Subcategories::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
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
            'old_cat_id' => $this->old_cat_id,
            'cat_id' => $this->cat_id,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'subcat_name', $this->subcat_name]);

        return $dataProvider;
    }
}
