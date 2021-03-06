<?php

namespace frontend\models\adverts;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use board\entities\Adverts;
use yii\data\Sort;

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
        $query->andFilterWhere( [
            'id'           => $this->id,
            'old_id'       => $this->old_id,
            'cat_id'       => $this->cat_id,
            'subcat_id'    => $this->subcat_id,
            'type'         => $this->type,
            'country'      => $this->country,
            'period'       => $this->period,
            'active'       => $this->active,
            'selected'     => $this->selected,
            'selected_old' => $this->selected_old,
            'special'      => $this->special,
            'special_old'  => $this->special_old,
            'images_old'   => $this->images_old,
            'ip'           => $this->ip,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'draft'        => $this->draft,
        ] );

        $query->andFilterWhere( [ 'like', 'sid', $this->sid ] )
            ->andFilterWhere( [ 'like', 'header', $this->header ] )
            ->andFilterWhere( [ 'like', 'description', $this->description ] )
            ->andFilterWhere( [ 'like', 'author', $this->author ] )
            ->andFilterWhere( [ 'like', 'email', $this->email ] );

        return $dataProvider;
    }

    /**
     * @return string
     */
    public function whereCountry()
    {
        $countryPost = yii::$app->request->post( 'city_sort' );
        return ( $countryPost ) ? $country = "countries.id=$countryPost" : $country = 'countries.id is not null';
    }

    /**
     * @return string
     */
    public function whereType()
    {
        $typePost = yii::$app->request->post( 'type_sort' );
        return ( $typePost ) ? $type = "types.id=$typePost" : $type = 'types.id is not null';
    }

    public function whereCat()
    {
        $categoryPost = yii::$app->request->post( 'category_sort' );
        return ( $categoryPost ) ? $category = "categories.id=$categoryPost" : $category = 'categories.id is not null';
    }

    public function whereSubcat()
    {
        $sybcatPost = yii::$app->request->post( 'subcategory_sort' );
        return ( $sybcatPost ) ? $subcategory = "subcategories.id=$sybcatPost" : $subcategory = 'subcategories.id is not null';
    }

    public function whereDate()
    {
        $datePost = yii::$app->request->post( 'date_sort' );
        switch ( $datePost ) {
            case 'desc':
                return [ 'adverts.updated_at' => SORT_DESC ];
                break;
            case 'asc':
                return [ 'adverts.updated_at' => SORT_ASC ];
                break;
        }
        return null;
    }

    public function wherePrice()
    {
        $pricePost = yii::$app->request->post( 'price_sort' );
        switch ( $pricePost ) {
            case 'desc':
                return [ 'pricies.price_value' => SORT_DESC ];
                break;
            case 'asc':
                return [ 'pricies.price_value' => SORT_ASC ];
        }
        return null;
    }

    /**
     * Поиск и сортировка объявлений на главной странице
     *
     * @return ActiveDataProvider
     */
    public function searchHomeAdverts()
    {
        $query = Adverts::find()
            ->joinWith( [ 'category', 'subcategory', 'type', 'period', 'country', 'price' ] )
            ->joinWith( [
                'price p' => function ( $q ){
                    $q->joinWith( 'currency c' );
                }
            ] )
            ->andWhere( $this->whereCountry() )
            ->andWhere( $this->whereType() )
            ->andWhere( $this->whereCat() )
            ->andWhere( $this->whereSubcat() )
            ->andWhere( [ 'draft' => Adverts::STATUS_PUBLISHED ] )
            ->orderBy( $this->whereDate() )
            ->addOrderBy( $this->wherePrice() );

        $dataProvider = new ActiveDataProvider( [
            'query'      => $query,
            'pagination' => [
                'defaultPageSize' => Adverts::DEFAULT_PAGE_SIZE,
                'pageSize'        => self::_setPageSize(),
                'pageSizeLimit'   => [ Adverts::PAGE_SIZE_LIMIT_MIN, Adverts::PAGE_SIZE_LIMIT_MAX ],
            ],
            'sort'       => [
                'defaultOrder' => [ 'id' => SORT_DESC, ],
            ]

        ] );

        $dataProvider->sort->enableMultiSort = true;
        return $dataProvider;
    }

    /**
     * Поиск объявлений по категории
     *
     * @param $params
     * @return ActiveDataProvider
     */
    public function searchCategoryPage( $params )
    {
        $sort = new Sort( [
            'attributes' => [
                'header'       => [
                    'asc'     => [ 'header' => SORT_ASC, ],
                    'desc'    => [ 'header' => SORT_DESC, ],
                    'default' => SORT_DESC,
                ],
                'subcat'       => [
                    'asc'     => [ 'subcategory.subcat_name' => SORT_ASC, ],
                    'desc'    => [ 'subcategory.subcat_name' => SORT_DESC, ],
                    'default' => SORT_DESC,
                ],
                'price'        => [
                    'asc'     => [ 'pricies.price_value' => SORT_ASC, ],
                    'desc'    => [ 'pricies.price_value' => SORT_DESC, ],
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
            ->where( [ 'adverts.cat_id' => $params['id'] ] )
            ->joinWith( [ 'category', 'subcategory', 'type', 'period', 'country', 'price' ] )
            ->joinWith( [
                'price p' => function ( $q ){
                    $q->joinWith( 'currency c' );
                }
            ] )
            ->orderBy( $sort->orders );

        $dataProvider = new ActiveDataProvider( [
            'query'      => $query,
            'pagination' => [
                'defaultPageSize' => Adverts::DEFAULT_PAGE_SIZE,
                'pageSizeLimit'   => [ Adverts::PAGE_SIZE_LIMIT_MIN, Adverts::PAGE_SIZE_LIMIT_MAX ],
            ],
            'sort'       => $sort,
        ] );

        $dataProvider->sort->enableMultiSort = true;
        return $dataProvider;
    }

    /**
     * Поиск объявлений по подкатегории
     *
     * @param $params
     * @return ActiveDataProvider
     */
    public function searchSubcategoryPage( $params )
    {
        /**
         * TODO: сортировка по типу не работает как надо
         * TODO: добавить сортировку по городам
         */
        $sort = new Sort( [
            'attributes' => [
                'header'       => [
                    'asc'     => [ 'header' => SORT_ASC, ],
                    'desc'    => [ 'header' => SORT_DESC, ],
                    'default' => SORT_DESC,
                ],
                'price'        => [
                    'asc'     => [ 'pricies.price_value' => SORT_ASC, ],
                    'desc'    => [ 'pricies.price_value' => SORT_DESC, ],
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
            ->where( [ 'adverts.cat_id' => $params ['catid'] ] )
            ->andWhere( [ 'adverts.subcat_id' => $params ['id'] ] )
            ->joinWith( [ 'category', 'subcategory', 'type', 'period', 'country', 'price' ] )
            ->joinWith( [
                'price p' => function ( $q ){
                    $q->joinWith( 'currency c' );
                }
            ] )
            ->orderBy( $sort->orders );

        $dataProvider = new ActiveDataProvider( [
            'query'      => $query,
            'pagination' => [
                'defaultPageSize' => Adverts::DEFAULT_PAGE_SIZE,
                'pageSizeLimit'   => [ Adverts::PAGE_SIZE_LIMIT_MIN, Adverts::PAGE_SIZE_LIMIT_MAX ],
            ],
            'sort'       => $sort,
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
