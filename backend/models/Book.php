<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%Book}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property BookChapters[] $bookChapters
 * @property Chapters[] $chapters
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Book}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookChapters()
    {
        return $this->hasMany(BookChapters::className(), ['Book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChapters()
    {
        return $this->hasMany(Chapters::className(), ['id' => 'Chapters_id'])->viaTable('{{%book_chapters}}', ['Book_id' => 'id']);
    }
}
