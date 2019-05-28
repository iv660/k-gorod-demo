<?php

use yii\db\Migration;

/**
 * Class m190525_082225_add_demo_data
 */
class m190525_082225_add_demo_data extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $bookData = [
            ['id' => 90001, 'name' => 'Колобок', ],
            ['id' => 90002, 'name' => 'Теремок'],
            ['id' => 90003, 'name' => 'Репка'],
        ];
        $chaptersData = [
            ['id' => 90001, 'name' => 'Испекла баба колобок', 'page_from' => 2, 'page_to' => 3],
            ['id' => 90002, 'name' => 'От зайца ушел', 'page_from' => 4, 'page_to' => 5],
            ['id' => 90003, 'name' => 'От волка ушел', 'page_from' => 6, 'page_to' => 7],
            ['id' => 90004, 'name' => 'От медведя ушел', 'page_from' => 8, 'page_to' => 9],
            ['id' => 90005, 'name' => 'Стоит в поле теремок', 'page_from' => 2, 'page_to' => 3],
            ['id' => 90006, 'name' => 'Он ни низок, ни высок', 'page_from' => 4, 'page_to' => 5],
            ['id' => 90007, 'name' => 'Посадил дед репку', 'page_from' => 2, 'page_to' => 3],
            ['id' => 90008, 'name' => 'Выросла репка большая-пребольшая', 'page_from' => 4, 'page_to' => 5],
            ['id' => 90009, 'name' => 'Стал дед репку тянуть', 'page_from' => 6, 'page_to' => 7],
        ];
        $bookChaptersData = [
            ['Book_id' => 90001, 'Chapters_id' => 90001],
            ['Book_id' => 90001, 'Chapters_id' => 90002],
            ['Book_id' => 90001, 'Chapters_id' => 90003],
            ['Book_id' => 90001, 'Chapters_id' => 90004],
            ['Book_id' => 90002, 'Chapters_id' => 90005],
            ['Book_id' => 90002, 'Chapters_id' => 90006],
            ['Book_id' => 90003, 'Chapters_id' => 90007],
            ['Book_id' => 90003, 'Chapters_id' => 90008],
            ['Book_id' => 90003, 'Chapters_id' => 90009],
        ];
        foreach ($bookData as $curBook) {
            $this->insert('{{%Book}}', $curBook);
        }
        foreach ($chaptersData as $curChapter) {
            $this->insert('{{%Chapters}}', $curChapter);
        }
        foreach ($bookChaptersData as $curBookChapter) {
            $this->insert('{{%book_chapters}}', $curBookChapter);
        }
    }

    public function down()
    {
        $this->delete('{{%book_chapters}}', '[[Book_id]] IN (90001, 90002, 90003)');
        $this->delete('{{%Chapters}}', '[[id]] IN (90001, 90002, 90003, 90004, 90005, 90006, 90007, 90008, 90009)');
        $this->delete('{{%Book}}', '[[id]] IN (90001, 90002, 90003)');
    }
}
