<?php


namespace frontend\modules\user\models;


use cheatsheet\Time;
use common\models\User;
use common\models\UserToken;
use frontend\modules\user\Module;
use Yii;
use yii\base\Exception;
use yii\base\Model;

class StudentForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $middlename;
    public $lastname;
    public $phone;
    public $locale;
    public $gender;
    public $country;
    public $birthday;

    public $profile;

    public function rules()
    {
        return [
            [['firstname','lastname','username','email','password','phone','gender'],'required'],

            [['firstname','middlename','lastname'],'string','min'=>2,'max'=>15],

            ['email','filter','filter'=>'trim'],
            ['email', 'email'],
            ['email','unique',
                'targetClass'=>'\common\models\User',
                'message'=>Yii::t('frontend','This email address has already been taken.')
            ],

            ['password', 'string', 'min' => 6],

            ['country', 'string'],

            ['phone', 'match', 'pattern' => '/^(01)[0-9]{9}$/'],

            ['birthday', 'date'],

        ];

    }
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'Username'),
            'email' => Yii::t('frontend', 'E-mail'),
            'password' => Yii::t('frontend', 'Password'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'phone' => Yii::t('common', 'Mobile'),
            'country' => Yii::t('common', 'Country'),
            'gender' => Yii::t('common', 'Gender'),
            'birthday' => Yii::t('common', 'Birthdate'),


        ];
    }

    public function signup($type=User::ROLE_USER)
    {

        if ($this->validate()) {
            $shouldBeActivated = $this->shouldBeActivated();
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            if (!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };

            $user->afterSignup();
            //fill profile data
            $user->userProfile->firstname = $this->firstname;
            $user->userProfile->middlename = $this->middlename ?? "";
            $user->userProfile->lastname = $this->lastname;
            $user->userProfile->phone = $this->phone;
            $user->userProfile->locale = 'ar-AR';
            $user->userProfile->gender = $this->gender;
            $user->userProfile->country = $this->country;
            $user->userProfile->birthday = $this->birthday;
            $user->userProfile->save(false);
            //link to parent account
//            $this->LinkParentAccount($user->userProfile);
            if ($shouldBeActivated) {
                $token = UserToken::create(
                    $user->id,
                    UserToken::TYPE_ACTIVATION,
                    Time::SECONDS_IN_A_DAY
                );
//                Yii::$app->commandBus->handle(new SendEmailCommand([
//                    'subject' => Yii::t('frontend', 'Activation email'),
//                    'view' => 'activation',
//                    'to' => $this->email,
//                    'params' => [
//                        'url' => Url::to(['/user/sign-in/activation', 'token' => $token->token], true)
//                    ]
//                ]));
            }
            return $user;
        }
    }
    public function shouldBeActivated()
    {
        /** @var Module $userModule */
        $userModule = Yii::$app->getModule('user');
        if (!$userModule) {
            return false;
        } elseif ($userModule->shouldBeActivated) {
            return true;
        } else {
            return false;
        }
    }


}