<?php

use yii\db\Migration;

/**
 * Class m190527_200824_add_dummy_books
 */
class m190527_200824_add_dummy_books extends Migration
{
    const PREFIX = '##DUMMY## ';
    const COUNT = 130;
    const TABLE = '{{%Book}}';
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        for ($curIndex = 1; $curIndex <= self::COUNT; $curIndex++) {
            
            $this->insert(self::TABLE, ['name' => self::PREFIX . Yii::t('app', 'Dummy Book #{number} (no chapters!)', ['number' => $curIndex])]);
        }
    }

    public function down()
    {
        $this->delete(self::TABLE, 'name LIKE ' . $this->db->quoteValue(self::PREFIX));
    }
}
