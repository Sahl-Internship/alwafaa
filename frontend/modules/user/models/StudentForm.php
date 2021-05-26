<?php


namespace frontend\modules\user\models;


use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserToken;
use frontend\modules\user\Module;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Url;

class StudentForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $middlename;
    public $lastname;
    public $phone;
    public $phone_key;
    public $sub_title;
    public $locale;
    public $gender;
    public $country;
    public $city;
    public $birthdate;

    public $profile;

    public function rules()
    {
        return [
            [['firstname','lastname','email','password','phone','gender'],'required'],
//            [['username'],'required'],

            [['firstname','middlename','lastname','sub_title'],'string','min'=>2,'max'=>15],

            ['email','filter','filter'=>'trim'],
            ['email', 'email'],
            ['email','unique',
                'targetClass'=>'\common\models\User',
                'message'=>Yii::t('frontend','This email address has already been taken.')
            ],

            ['password', 'string', 'min' => 6],

            [['country','city'], 'string'],

//            ['phone', 'match', 'pattern' => '/^(01)[0-9]{9}$/'],
            [['phone','phone_key'], 'number'],

            ['birthdate', 'integer'],

        ];

    }
    public function attributeLabels()
    {
        return [
//            'username' => Yii::t('frontend', 'Username'),
            'email' => Yii::t('frontend', 'E-mail'),
            'password' => Yii::t('frontend', 'Password'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'phone' => Yii::t('common', 'Mobile'),
            'phone_key' => Yii::t('common', 'Country Code'),
            'sub_title' => Yii::t('common', 'Job Title'),
            'country' => Yii::t('common', 'Country'),
            'gender' => Yii::t('common', 'Gender'),
            'birthdate' => Yii::t('common', 'Birth Date'),
            'city' => Yii::t('common', 'City'),
        ];
    }

    public function signup($type=User::ROLE_STUDENT)
    {

        if ($this->validate()) {
            $shouldBeActivated = $this->shouldBeActivated();
            $user = new User();
            $user->username = $this->username ?? strstr($this->email, '@', true);
            $user->email = $this->email;
            $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            if (!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };

            $user->afterSignup();
            //fill profile data
            //todo check signup cycle =>the following code is duplicated
            $user->userProfile->firstname = $this->firstname;
            $user->userProfile->middlename = $this->middlename ?? "";
            $user->userProfile->lastname = $this->lastname;
            $user->userProfile->phone_key = $this->phone_key;
            $user->userProfile->phone = $this->phone;
            $user->userProfile->sub_title = $this->sub_title;
            $user->userProfile->locale = 'ar-AR';
            $user->userProfile->gender = $this->gender;
            $user->userProfile->country = $this->country;
//            $user->userProfile->city = $this->city;
            $user->userProfile->birthdate = $this->birthdate;
            $user->userProfile->save(false);

            if ($shouldBeActivated) {
                $token = UserToken::create(
                    $user->id,
                    UserToken::TYPE_ACTIVATION,
                    Time::SECONDS_IN_A_DAY
                );
                Yii::$app->commandBus->handle(new SendEmailCommand([
                    'subject' => Yii::t('frontend', 'Activation email'),
                    'view' => 'activation',
                    'to' => 'tvvunion@gmail.com',
                    'params' => [
                        'url' => Url::to(['@frontendUrl/user/sign-in/activation', 'token' => $token->token], true)
                    ]
                ]));
            }
            return $user;
        }
        return null;
    }
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */

    public function shouldBeActivated()
    {
        return true;
//        /** @var Module $userModule */
//        $userModule = Yii::$app->getModule('user');
//        if (!$userModule) {
//            return false;
//        } elseif ($userModule->shouldBeActivated) {
//            return true;
//        } else {
//            return false;
//        }
    }


}