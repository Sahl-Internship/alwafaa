<?php

namespace backend\models\search;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Homework;

/**
 * HomeworkSearch represents the model behind the search form about `common\models\Homework`.
 */
class HomeworkSearch extends Homework
{
    public $fullName;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'size', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['path', 'base_url', 'type', 'name','fullName','email'], 'safe'],
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
    public function search($params,$studentsIds=null)
    {
        // show joined students
        $query = User::findBySql("SELECT * FROM user WHERE id IN (" . implode(',', array_map('intval', $studentsIds)) . ")");

        //show all homeworks
//        $query = Homework::find()->andWhere(['event_id'=>$event_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->joinWith(['userProfile' => function ($q) {
            $q->andFilterWhere([
                'or',
                ['like', 'lastname', $this->fullName],
                ['like', 'firstname', $this->fullName],
            ]);
        }]);
        $query->andFilterWhere([
            'id' => $this->id,
            'event_id' => $this->event_id,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'base_url', $this->base_url])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
