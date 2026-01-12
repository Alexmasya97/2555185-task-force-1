<?php
namespace app\models;

use yii\base\Model;

class SignUpForm extends Model
{
public $name;
public $email;
public $location;
public $password;
public $password_retype; // Исправьте опечатку!
public $willRespond;

public function rules()
{
return [
[['name', 'email', 'location', 'password', 'password_retype'], 'required'],

[['name'], 'string', 'max' => 128],

[['email'], 'email'],
[['email'], 'string', 'max' => 128],
[['email'], 'unique',
'targetClass' => User::class,
'message' => 'Этот адрес электронной почты уже используется'
],

[['location'], 'string', 'max' => 128],

[['password'], 'string', 'min' => 8],
[['password_retype'], 'compare',
'compareAttribute' => 'password',
'message' => 'Пароли не совпадают'
],

[['willRespond'], 'boolean']
];
}

public function attributeLabels()
{
return [
'email' => 'Электронная почта',
'name' => 'Ваше имя',
'location' => 'Город', // Исправьте с location_id на location!
'password' => 'Пароль',
'password_retype' => 'Повтор пароля',
'willRespond' => 'Я собираюсь откликаться на заказы'
];
}
}
