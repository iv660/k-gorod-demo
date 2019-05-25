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
            ['id' => 1, 'name' => 'Колобок', ],
            ['id' => 2, 'name' => 'Теремок'],
            ['id' => 3, 'name' => 'Репка'],
        ];
        $chaptersData = [
            ['id' => 1, 'name' => 'Испекла баба колобок', 'page_from' => 2, 'page_to' => 3],
            ['id' => 2, 'name' => 'От зайца ушел', 'page_from' => 4, 'page_to' => 5],
            ['id' => 3, 'name' => 'От волка ушел', 'page_from' => 6, 'page_to' => 7],
            ['id' => 4, 'name' => 'От медведя ушел', 'page_from' => 8, 'page_to' => 9],
            ['id' => 5, 'name' => 'Стоит в поле теремок', 'page_from' => 2, 'page_to' => 3],
            ['id' => 6, 'name' => 'Он ни низок, ни высок', 'page_from' => 4, 'page_to' => 5],
            ['id' => 7, 'name' => 'Посадил дед репку', 'page_from' => 2, 'page_to' => 3],
            ['id' => 8, 'name' => 'Выросла репка большая-пребольшая', 'page_from' => 4, 'page_to' => 5],
            ['id' => 9, 'name' => 'Стал дед репку тянуть', 'page_from' => 6, 'page_to' => 7],
        ];
        $bookChaptersData = [
            ['Book_id' => 1, 'Chapters_id' => 1],
            ['Book_id' => 1, 'Chapters_id' => 2],
            ['Book_id' => 1, 'Chapters_id' => 3],
            ['Book_id' => 1, 'Chapters_id' => 4],
            ['Book_id' => 2, 'Chapters_id' => 5],
            ['Book_id' => 2, 'Chapters_id' => 6],
            ['Book_id' => 3, 'Chapters_id' => 7],
            ['Book_id' => 3, 'Chapters_id' => 8],
            ['Book_id' => 3, 'Chapters_id' => 9],
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
        $this->delete('{{%book_chapters}}', 'Book_id IN (1, 2, 3)');
        $this->delete('{{%Chapters}}', 'id IN (1, 2, 3, 4, 5, 6, 7, 8, 9)');
        $this->delete('{{%Book}}', 'id IN (1, 2, 3)');
    }
}
