<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%Chapters}}".
 *
 * @property int $id
 * @property string $name
 * @property int $page_from
 * @property int $page_to
 *
 * @property BookChapter[] $bookChapters
 * @property Book[] $books
 */
class Chapter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Chapters}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'page_from', 'page_to'], 'required'],
            [['name'], 'string'],
            [['page_from', 'page_to'], 'integer'],
            [
                ['page_from'], 
                'compare', 
                'compareAttribute' => 'page_to', 
                'operator' => '<=', 
                'type' => 'number', 
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Title'),
            'page_from' => Yii::t('app', 'Page From'),
            'page_to' => Yii::t('app', 'Page To'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookChapters()
    {
        return $this->hasMany(BookChapter::className(), ['Chapters_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'Book_id'])->viaTable('{{%book_chapters}}', ['Chapters_id' => 'id']);
    }
}
