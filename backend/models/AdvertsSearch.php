<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Adverts;

/**
 * AdvertsSearch represents the model behind the search form about `backend\models\Adverts`.
 */
class AdvertsSearch extends Adverts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'old_id', 'cat_id', 'subcat_id', 'type', 'city', 'period', 'active', 'selected_old', 'special_old', 'images_old', 'ip', 'created_at', 'updated_at'], 'integer'],
            [['sid', 'header', 'description', 'author', 'email'], 'safe'],
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
        $query = Adverts::find();

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
            'cat_id' => $this->cat_id,
            'subcat_id' => $this->subcat_id,
            'type' => $this->type,
            'city' => $this->city,
            'period' => $this->period,
            'active' => $this->active,
            'selected_old' => $this->selected_old,
            'special_old' => $this->special_old,
            'images_old' => $this->images_old,
            'ip' => $this->ip,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sid', $this->sid])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
