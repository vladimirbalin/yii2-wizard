<?php 
namespace console\controllers;

use common\models\User;
use Faker\Factory;
use yii\console\Controller;

class HelloController extends Controller
{
    public function actionUserCreate(){
        $factory = Factory::create();
        $user = new User();
        $user->first_name = $factory->firstName('male');
        $user->last_name = $factory->lastName();
        $user->username = $factory->name('male');
        $user->city = $factory->city;
        $user->email = $factory->email;
        $user->address = $factory->address;
        $user->phone = $factory->phoneNumber;
        $user->setPassword('123');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();
    }
}
?>