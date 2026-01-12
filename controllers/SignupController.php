<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\SignUpForm; // ДОБАВЬТЕ!

class SignupController extends Controller
{
public function actionIndex()
{
// Если нужно специальное layout
// $this->layout = 'anon';

$model = new SignUpForm(); // Используйте форму, а не User!

if ($model->load(Yii::$app->request->post()) && $model->validate()) {
$user = new User();
$user->name = $model->name;
$user->email = $model->email;
$user->location = $model->location;
$user->password = Yii::$app->security
->generatePasswordHash($model->password);
$user->role = $model->willRespond ? 'worker' : 'employer';
$user->failed_tasks = 0;
$user->show_contacts = false;

if ($user->save()) { // БЕЗ false!
return $this->redirect(['site/login']); // или goHome()
}
}

return $this->render('index', ['model' => $model]);
}
}
