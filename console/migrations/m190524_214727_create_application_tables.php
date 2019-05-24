<?php

use yii\db\Migration;

/**
 * Class m190524_214727_create_application_tables
 */
class m190524_214727_create_application_tables extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Book table
        $this->createTable('{{%Book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull(),
        ], $tableOptions);
        
        // Chapters table
        $this->createTable('{{%Chapters}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->notNull(),
            'page_from' => $this->integer()->notNull(),
            'page_to' => $this->integer()->notNull(),
        ], $tableOptions);

        // book_chapters table
        $this->createTable('{{%book_chapters}}', [
            'Chapters_id' => $this->integer()->notNull(),
            'Book_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('PRIMARY KEY', '{{%book_chapters}}', [
            'Chapters_id', 
            'Book_id',
        ]);
        
        // Add foreign keys
        $this->addForeignKey('{{%FK_book_chapters_Book}}', '{{%book_chapters}}', 
            ['Book_id'], '{{%Book}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('{{%FK_book_chapters_Chapters}}', '{{%book_chapters}}', 
            ['Chapters_id'], '{{%Chapters}}', ['id'], 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%FK_book_chapters_Chapters}}', '{{%book_chapters}}');
        $this->dropForeignKey('{{%FK_book_chapters_Book}}', '{{%book_chapters}}');
        $this->dropTable('{{%Book}}');
        $this->dropTable('{{%Chapters}}');
        $this->dropTable('{{%book_chapters}}');
    }
}
