<?php

namespace frontend\models\adverts;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use board\entities\Adverts;
use yii\data\Sort;
use common\models\Helpers;

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
            [['id', 'old_id', 'cat_id', 'subcat_id', 'type', 'country', 'period', 'active', 'selected', 'selected_old', 'special', 'special_old', 'images_old', 'ip', 'created_at', 'updated_at', 'draft'], 'integer'],
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
            'country' => $this->country,
            'period' => $this->period,
            'active' => $this->active,
            'selected' => $this->selected,
            'selected_old' => $this->selected_old,
            'special' => $this->special,
            'special_old' => $this->special_old,
            'images_old' => $this->images_old,
            'ip' => $this->ip,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'draft' => $this->draft,
        ]);

        $query->andFilterWhere(['like', 'sid', $this->sid])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    public function whereCountry()
    {
        $countryPost = yii::$app->request->post('city_sort');
        return ($countryPost) ? $country = "countries.id=$countryPost" : $country = 'countries.id is not null';
    }

    public function homeAdvertsPage(){

        $post = yii::$app->request->post('city_sort');
        Helpers::p($post); die;

        $sort = new Sort( [
            'attributes' => [
                'header'       => [
                    'asc'     => [ 'header' => SORT_ASC, ],
                    'desc'    => [ 'header' => SORT_DESC, ],
                    'default' => SORT_DESC,
                ],
                'price'        => [
                    'asc'     => [ 'pricies.price' => SORT_ASC, ],
                    'desc'    => [ 'pricies.price' => SORT_DESC, ],
                    'default' => SORT_DESC,
                ],
                'subcat'       => [
                    'asc'     => [ 'subcategory.subcat_name' => SORT_ASC, ],
                    'desc'    => [ 'subcategory.subcat_name' => SORT_DESC, ],
                    'default' => SORT_DESC,
                ],
                'type'         => [
                    'asc'     => [ 'types.name' => SORT_ASC, ],
                    'desc'    => [ 'types.name' => SORT_DESC, ],
                    'default' => SORT_DESC,
                ],
                'defaultOrder' => [ 'id' => SORT_DESC ],
            ],
        ] );

        $query = Adverts::find()
            ->joinWith( [ 'category', 'subcategory', 'types', 'periods', 'countries', 'pricies' ] )
            ->joinWith( [
                'pricies p' => function ( $q ){
                    $q->joinWith( 'currencies c' );
                }
            ] )
            ->andWhere( $this->whereCountry() )
            ->orderBy( $sort->orders );

        $pageSize = self::_setPageSize();

        $dataProvider = new ActiveDataProvider( [
            'query'      => $query,
            'pagination'   => [
                'defaultPageSize' => 25,
                'pageSize' => $pageSize,
                'pageSizeLimit' => [ 15, 100 ],
            ],
        ] );

        $dataProvider->sort->enableMultiSort = true;

        return $dataProvider;
    }

    /**
     * @return array|mixed|null|string
     */
    private function _setPageSize()
    {
        $pageSize = null;

        if ( Yii::$app->request->get( 'per-page' ) !== null ) {
            $cookies = Yii::$app->response->cookies;
            $cookies->remove( 'per-page' );
            $cookies->add( new \yii\web\Cookie( [
                'name'  => 'per-page',
                'value' => Yii::$app->request->get( 'per-page' ),
            ] ) );

            return $pageSize = Yii::$app->request->get( 'per-page' );
        }

        $cookies = Yii::$app->request->cookies;
        if ( ( $cookie = $cookies->get( 'per-page' ) ) !== null ) {
            $pageSize = $cookie->value;
        }

        return $pageSize;
    }
}
