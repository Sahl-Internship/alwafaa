<?php

namespace backend\models\search;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentRequest;

/**
 * StudentRequestSearch represents the model behind the search form about `common\models\StudentRequest`.
 */
class StudentRequestSearch extends StudentRequest
{
    public $fullName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'course_id', 'gender', 'status', 'is_parent', 'created_by'], 'integer'],
            [['firstname', 'lastname', 'email', 'sub_title', 'country', 'phone_key', 'phone'], 'safe'],
            [['fullName'], 'safe']

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

        if(Yii::$app->user->can('administrator')){
            $query = StudentRequest::find();
        }elseif(Yii::$app->user->can('manager')){
            $courses_ids = User::find()->getOwnCoursesIds();
            $query = StudentRequest::findBySql("SELECT * FROM student_requests WHERE course_id IN (" . implode(',', array_map('intval', $courses_ids)) . ")");

        }else{
            $courses_ids = User::find()->getOwnCoursesIds();
            $query = StudentRequest::findBySql("SELECT * FROM student_requests WHERE course_id IN (" . implode(',', array_map('intval', $courses_ids)) . ")");

        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'course_id' => $this->course_id,
            'gender' => $this->gender,
            'status' => $this->status,
            'is_parent' => $this->is_parent,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere([
            'or',
            ['like', 'lastname', $this->fullName],
            ['like', 'firstname', $this->fullName],
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'phone_key', $this->phone_key])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
