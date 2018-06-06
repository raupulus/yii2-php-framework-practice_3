<?php

namespace app\models;

use DateInterval;
use DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reservas;

/**
 * ReservasSearch represents the model behind the search form of `app\models\Reservas`.
 */
class ReservasSearch extends Reservas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['fecha'], 'safe'],
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
        $hoy = new DateTime('now');
        $hoy->setTime('00', '00', '00');

        $semana = new DateTime('now');
        $semana->add(new DateInterval('P7D'));

        $query = Reservas::find();

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

        // Fecha superior a hoy
        $query->where([
            '>=', 'fecha', $hoy->format('Y-m-d H:i:s')
        ]);

        // Fecha inferior a 7 días
        $query->andwhere([
            '<=', 'fecha', $semana->format('Y-m-d H:i:s')
        ]);


        // grid filtering conditions
        /*$query->andFilterWhere([
            'usuario_id' => $this->usuario_id,
            'fecha' => $this->fecha,
        ]);*/

        return $dataProvider;
    }
}
