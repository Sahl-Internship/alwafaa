<?php

namespace backend\models\search;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    public $fullName;
    public $phone;
    public $country;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'logged_at'], 'default', 'value' => null],
            [['username', 'auth_key', 'password_hash', 'email'], 'safe'],
            [['fullName','phone','country'], 'safe']
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
     * @return ActiveDataProvider
     */
    public function search($params, $qry = null)
    {
        if ($qry == "student") {
            if(\Yii::$app->user->can('administrator')){
                $query = User::find()->getStudent();
            }elseif(\Yii::$app->user->can('manager')){
                $query = User::find()->getStudent();
            }else{
                $ids = User::find()->getTeacherPortfolio(Yii::$app->user->id);
                $query = User::findBySql("SELECT * FROM user WHERE id IN (" . implode(',', array_map('intval', $ids['students'])) . ")");
            }
        } elseif ($qry == "teacher") {
            $query = User::find()->getTeacher();
        } elseif($qry == "manager") {
            $query = User::find()->getManager();
        }else{
            $query = User::find();
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        if ($this->created_at !== null) {
            $query->andFilterWhere(['between', 'created_at', strtotime($this->created_at), strtotime($this->created_at) + 3600 * 24]);
        }

        if ($this->updated_at !== null) {
            $query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_at), strtotime($this->updated_at) + 3600 * 24]);
        }

        if ($this->logged_at !== null) {
            $query->andFilterWhere(['between', 'logged_at', strtotime($this->logged_at), strtotime($this->logged_at) + 3600 * 24]);
        }

        $query->joinWith(['userProfile' => function ($q) {
            $q->andFilterWhere([
                'or',
                ['like', 'lastname', $this->fullName],
                ['like', 'firstname', $this->fullName],
            ]);
        }]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
