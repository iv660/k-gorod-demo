<?php

use yii\db\Migration;
use common\models\User;

/**
 * Class m190524_191356_add_default_admin.
 * 
 * Adds the default administrator username/password: admin/admin.
 * 
 * @author Ilya Vikharev
 */
class m190524_191356_add_default_admin extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $user = new User();
        
        $user->username = 'admin';
        $user->setPassword('admin');
        $user->status = User::STATUS_ACTIVE;
        if (!$user->save()) {
            echo Yii::t('app', 'Cannot create an admin user account.');
            echo "\n";
            return false;
        }
    }

    public function down()
    {
        $user = User::findOne(['username' => 'admin']);
        if (is_null($user)){
            echo Yii::t('app', 'Cannot find the admin user account.');
            echo "\n";
            return false;
        }
        
        if ($user->delete() === false) {
            echo Yii::t('app', 'Cannot delete the admin user account.');
            echo "\n";
            return false;
        }
    }
}
