<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Advert;

/**
 * AdvertSearch represents the model behind the search form about `backend\models\Advert`.
 */
class AdvertSearch extends Advert
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AdvertID', 'AdvertFolder', 'AdvertType', 'AdvertCity', 'AdvertPrice', 'AdvertCurrency', 'AdvertPeriod', 'AdvertTime', 'AdvertApproved', 'AdvertActive', 'AdvertPlaced', 'AdvertSelected', 'AdvertSelectedStart', 'AdvertSelectedDur', 'AdvertSpecial', 'AdvertSpecialStart', 'AdvertSpecialDur', 'AdvertImage1', 'AdvertImage2', 'AdvertImage3', 'AdvertImage4', 'AdvertImage5', 'AdvertImage6', 'AdvertUserID', 'AdvertRate', 'AdvertViewDay', 'AdvertViewWeek', 'AdvertViewMonth', 'AdvertIPAdress', 'AdvertIPProxyAdress', 'AdvertSendViaEmail', 'AdvertTimeOriginated', 'AdvertSold', 'AdvertResponses', 'AdvertUp', 'AdvertImg', 'exist_adv_id'], 'integer'],
            [['AdvertsID', 'AdvertHeader', 'AdvertComment', 'AdvertUserName', 'AdvertUserEmail', 'AdvertUserPhone', 'AdvertUserICQ', 'AdvertUrl', 'AdvertCustomValues', 'AdvertPass', 'AdvertImgDescription', 'AdvertAdvHash', 'AdvertUserPhone2', 'AdvertAddress', 'AdvertEmailReal'], 'safe'],
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
        $query = Advert::find();

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
            'AdvertID' => $this->AdvertID,
            'AdvertFolder' => $this->AdvertFolder,
            'AdvertType' => $this->AdvertType,
            'AdvertCity' => $this->AdvertCity,
            'AdvertPrice' => $this->AdvertPrice,
            'AdvertCurrency' => $this->AdvertCurrency,
            'AdvertPeriod' => $this->AdvertPeriod,
            'AdvertTime' => $this->AdvertTime,
            'AdvertApproved' => $this->AdvertApproved,
            'AdvertActive' => $this->AdvertActive,
            'AdvertPlaced' => $this->AdvertPlaced,
            'AdvertSelected' => $this->AdvertSelected,
            'AdvertSelectedStart' => $this->AdvertSelectedStart,
            'AdvertSelectedDur' => $this->AdvertSelectedDur,
            'AdvertSpecial' => $this->AdvertSpecial,
            'AdvertSpecialStart' => $this->AdvertSpecialStart,
            'AdvertSpecialDur' => $this->AdvertSpecialDur,
            'AdvertImage1' => $this->AdvertImage1,
            'AdvertImage2' => $this->AdvertImage2,
            'AdvertImage3' => $this->AdvertImage3,
            'AdvertImage4' => $this->AdvertImage4,
            'AdvertImage5' => $this->AdvertImage5,
            'AdvertImage6' => $this->AdvertImage6,
            'AdvertUserID' => $this->AdvertUserID,
            'AdvertRate' => $this->AdvertRate,
            'AdvertViewDay' => $this->AdvertViewDay,
            'AdvertViewWeek' => $this->AdvertViewWeek,
            'AdvertViewMonth' => $this->AdvertViewMonth,
            'AdvertIPAdress' => $this->AdvertIPAdress,
            'AdvertIPProxyAdress' => $this->AdvertIPProxyAdress,
            'AdvertSendViaEmail' => $this->AdvertSendViaEmail,
            'AdvertTimeOriginated' => $this->AdvertTimeOriginated,
            'AdvertSold' => $this->AdvertSold,
            'AdvertResponses' => $this->AdvertResponses,
            'AdvertUp' => $this->AdvertUp,
            'AdvertImg' => $this->AdvertImg,
            'exist_adv_id' => $this->exist_adv_id,
        ]);

        $query->andFilterWhere(['like', 'AdvertsID', $this->AdvertsID])
            ->andFilterWhere(['like', 'AdvertHeader', $this->AdvertHeader])
            ->andFilterWhere(['like', 'AdvertComment', $this->AdvertComment])
            ->andFilterWhere(['like', 'AdvertUserName', $this->AdvertUserName])
            ->andFilterWhere(['like', 'AdvertUserEmail', $this->AdvertUserEmail])
            ->andFilterWhere(['like', 'AdvertUserPhone', $this->AdvertUserPhone])
            ->andFilterWhere(['like', 'AdvertUserICQ', $this->AdvertUserICQ])
            ->andFilterWhere(['like', 'AdvertUrl', $this->AdvertUrl])
            ->andFilterWhere(['like', 'AdvertCustomValues', $this->AdvertCustomValues])
            ->andFilterWhere(['like', 'AdvertPass', $this->AdvertPass])
            ->andFilterWhere(['like', 'AdvertImgDescription', $this->AdvertImgDescription])
            ->andFilterWhere(['like', 'AdvertAdvHash', $this->AdvertAdvHash])
            ->andFilterWhere(['like', 'AdvertUserPhone2', $this->AdvertUserPhone2])
            ->andFilterWhere(['like', 'AdvertAddress', $this->AdvertAddress])
            ->andFilterWhere(['like', 'AdvertEmailReal', $this->AdvertEmailReal]);

        return $dataProvider;
    }
}
