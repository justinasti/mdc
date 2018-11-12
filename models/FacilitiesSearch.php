<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Facilities;

/**
 * FacilitiesSearch represents the model behind the search form of `app\models\Facilities`.
 */
class FacilitiesSearch extends Facilities
{
    public $facilitySearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'capacity', 'managed_by'], 'integer'],
            [['name', 'description', 'created_at', 'updated_at','facilitySearch'], 'safe'],
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
        $query = Facilities::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->joinWith('managedBy');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'capacity' => $this->capacity,
        //     'managed_by' => $this->managed_by,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ]);

        $query->orFilterWhere(['like', 'facilities.name', $this->facilitySearch])
            ->orFilterWhere(['like', 'description', $this->facilitySearch])
            ->orFilterWhere(['like', 'capacity', $this->facilitySearch])
            ->orFilterWhere(['like', 'user.name', $this->facilitySearch]);

        return $dataProvider;
    }
}
