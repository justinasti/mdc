<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reservations;
use app\models\Facilities;
use yii\db\Query;

/**
 * ReservationsSearch represents the model behind the search form of `app\models\Reservations`.
 */
class ReservationsSearch extends Reservations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'no_of_participants', 'facility_id', 'userid', 'status'], 'integer'],
            [['occasion', 'datetime_start', 'datetime_end'], 'safe'],
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
        $query = Reservations::find();

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
            'no_of_participants' => $this->no_of_participants,
            'datetime_start' => $this->datetime_start,
            'datetime_end' => $this->datetime_end,
            'facility_id' => $this->facility_id,
            'userid' => $this->userid,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'occasion', $this->occasion]);
        $query->andFilterWhere(['in', 'facility_id', 
            (new Query())
                ->select('id')
                ->from(Facilities::tableName())
                ->where(['managed_by' => Yii::$app->user->identity->id])
                
        ]);

        return $dataProvider;
    }
}
