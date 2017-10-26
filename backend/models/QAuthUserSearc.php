<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\QAuthUser;

/**
 * QAuthUserSearc represents the model behind the search form about `backend\models\QAuthUser`.
 */
class QAuthUserSearc extends QAuthUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['QAuthUserID', 'QAuthUserGroupID', 'QAuthUserStatus', 'QAuthUserCreated', 'QAuthUserLastAuthDate', 'QAuthUserLastIP', 'QAuthUserDOB', 'QAuthUserGender', 'QAuthUserRating', 'rights'], 'integer'],
            [['QAuthUserEmail', 'QAuthUserUserName', 'QAuthUserPassHash', 'QAuthUserActivationHash', 'QAuthUserFullName', 'QAuthUserCompany', 'QAuthUserWebsite', 'QAuthUserPhone', 'QAuthUserCity', 'QAuthUserAddress', 'QAuthUserZip', 'QAuthUserICQ', 'QAuthUserSkype', 'QAuthUserTwitter', 'QAuthUserLJ', 'QAuthUserAbout', 'QAuthUserExtra'], 'safe'],
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
        $query = QAuthUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'QAuthUserID' => $this->QAuthUserID,
            'QAuthUserGroupID' => $this->QAuthUserGroupID,
            'QAuthUserStatus' => $this->QAuthUserStatus,
            'QAuthUserCreated' => $this->QAuthUserCreated,
            'QAuthUserLastAuthDate' => $this->QAuthUserLastAuthDate,
            'QAuthUserLastIP' => $this->QAuthUserLastIP,
            'QAuthUserDOB' => $this->QAuthUserDOB,
            'QAuthUserGender' => $this->QAuthUserGender,
            'QAuthUserRating' => $this->QAuthUserRating,
            'rights' => $this->rights,
        ]);

        $query->andFilterWhere(['like', 'QAuthUserEmail', $this->QAuthUserEmail])
            ->andFilterWhere(['like', 'QAuthUserUserName', $this->QAuthUserUserName])
            ->andFilterWhere(['like', 'QAuthUserPassHash', $this->QAuthUserPassHash])
            ->andFilterWhere(['like', 'QAuthUserActivationHash', $this->QAuthUserActivationHash])
            ->andFilterWhere(['like', 'QAuthUserFullName', $this->QAuthUserFullName])
            ->andFilterWhere(['like', 'QAuthUserCompany', $this->QAuthUserCompany])
            ->andFilterWhere(['like', 'QAuthUserWebsite', $this->QAuthUserWebsite])
            ->andFilterWhere(['like', 'QAuthUserPhone', $this->QAuthUserPhone])
            ->andFilterWhere(['like', 'QAuthUserCity', $this->QAuthUserCity])
            ->andFilterWhere(['like', 'QAuthUserAddress', $this->QAuthUserAddress])
            ->andFilterWhere(['like', 'QAuthUserZip', $this->QAuthUserZip])
            ->andFilterWhere(['like', 'QAuthUserICQ', $this->QAuthUserICQ])
            ->andFilterWhere(['like', 'QAuthUserSkype', $this->QAuthUserSkype])
            ->andFilterWhere(['like', 'QAuthUserTwitter', $this->QAuthUserTwitter])
            ->andFilterWhere(['like', 'QAuthUserLJ', $this->QAuthUserLJ])
            ->andFilterWhere(['like', 'QAuthUserAbout', $this->QAuthUserAbout])
            ->andFilterWhere(['like', 'QAuthUserExtra', $this->QAuthUserExtra]);

        return $dataProvider;
    }
}
