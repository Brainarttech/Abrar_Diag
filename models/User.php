<?php

namespace app\models;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use kartik\password\StrengthValidator;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $assign_department
 * @property  string $role
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */

    public $password;
    public $repeat_password;
    public $old_password;
    public $file;
	//public $assign_department_string;


    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;


    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name','username','password','role', 'email', 'designation_id', 'assign_department'], 'required','on'=>'create'],
            [['first_name','username', 'email', 'assign_department'], 'required','on'=>'update'],
            [['password','repeat_password'], 'required','on'=>'changepassword'],
            [['designation_id', 'status', 'created_by', 'updated_by'], 'integer'],
			[['basic_salary', 'overtime_salary'], 'number'],
			[['payment_type'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name','image','last_name'], 'string', 'max' => 255],
            [['phone_no'], 'string', 'max' => 50],
            [['about'], 'string', 'max' => 2000],
            [['email'], 'unique'],
            [['created_on', 'updated_on','assign_department'], 'safe'],
            [['password_reset_token'/*, 'assign_department'*/], 'unique'],
            ['password', 'string', 'min' => 6],
            [['first_name','phone_no','username', 'email'], 'required','on'=>'profile'],
            [['email','username'], 'unique','on'=>'profile'],
            [['old_password','password','repeat_password'], 'required','on'=>'profile_changepassword'],
            [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'username','on'=>'changepassword'],
            ['repeat_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
            ['username', 'unique','on'=>'create'],
            [['username'], 'unique', 'on'=>'update', 'when' => function($model){
                return $model->isAttributeChanged('username');
            }],
            [['file'], 'file'],
            //[['assign_department'], 'string', 'max' => 100],
            [['role'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name'=>'First Name',
            'image'=>'Profile Image',
            'about'=>'About',
            'last_name'=>'Last Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'assign_department'=>'Assign Department',
			'designation_id' => 'Designation',
			'payment_type' => 'Payment Type',
            'basic_salary' => 'Basic Salary',
            'overtime_salary' => 'Overtime Salary',
            'role'=>'Role',
			'phone_no' => 'Phone No',
            'email' => 'Email',
            'status' => 'Status',
            'password'=>'Password',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }


    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

     public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->first_name= $this->first_name;
        $user->last_name= $this->last_name;
        $user->password = $this->password;
        $user->about = $this->about;
		$user->assign_department = $this->assign_department;
        $user->username = $this->username;
        $user->email = $this->email;
		$user->designation_id = $this->designation_id;
        $user->image = 'nophoto.jpg';
        $user->created_on  = date("Y-m-d H:i:s");
        $user->created_by = Yii::$app->user->id;
        $user->role = $this->role;
		$user->status = $this->status;
        $user->phone_no = $this->phone_no;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($user->save())
        {
            return $user->id;
        }
        else
        {
            echo "<pre>";
            print_r($user);
            echo "</pre>";
        }

    }
	public function getDesignation()
    {
        return $this->hasOne(Designation::className(), ['id' => 'designation_id']);
    }
    


}
