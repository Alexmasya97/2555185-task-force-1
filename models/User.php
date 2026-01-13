<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string|null $birthday
 * @property string|null $avatar
 * @property string|null $phone
 * @property string|null $telegram
 * @property string $location
 * @property string|null $about
 * @property int|null $specialization_id
 * @property int|null $show_contacts
 * @property int|null $failed_tasks
 *
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Review[] $reviews0
 * @property Specialization $specialization
 * @property Task[] $tasks
 * @property Task[] $tasks0
 */
class User extends \yii\db\ActiveRecord
{
    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthday', 'avatar', 'phone', 'telegram', 'about', 'specialization_id'], 'default', 'value' => null],
            [['failed_tasks'], 'default', 'value' => 0],
            [['name', 'email', 'password', 'role', 'location'], 'required'],
            [['birthday'], 'safe'],
            [['specialization_id', 'show_contacts', 'failed_tasks'], 'integer'],
            [['name', 'email', 'role', 'telegram', 'location'], 'string', 'max' => 128],
            [['avatar', 'about'], 'string', 'max' => 255],
            ['password', 'string', 'min' => 8],
            ['phone', 'match', 'pattern' => '/^[\d]{11}/i',
                'message' => 'Номер телефона должен состоять из 11 цифр'],
            [['email'], 'unique'],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::className(), 'targetAttribute' => ['specialization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'role' => 'Роль',
            'birthday' => 'День рождения',
            'avatar' => 'Аватар',
            'phone' => 'Номер телефона',
            'telegram' => 'Телеграм',
            'location' => 'Местоположение',
            'about' => 'Описание',
            'specialization_id' => 'Specialization ID',
            'show_contacts' => 'Show Contacts',
            'failed_tasks' => 'Проваленные задания',
        ];
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['performer_id' => 'user_id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['employer_id' => 'user_id']);
    }

    /**
     * Gets query for [[Reviews0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews0()
    {
        return $this->hasMany(Review::className(), ['performer_id' => 'user_id']);
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specialization_id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['employer_id' => 'user_id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['performer_id' => 'user_id']);
    }

}
