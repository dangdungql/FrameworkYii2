<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property int $cate
 * @property string $slug
 * @property string $image
 * @property string $desc
 * @property string $content
 * @property int $price
 * @property int $quantity
 * @property string $author
 * @property int $page
 * @property int $status
 * @property int $publish_at
 * @property int $created_at
 * @property int $updated_at
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'content', 'page', 'publish_at'], 'required'],
            [['cate', 'price', 'quantity', 'page', 'status', 'publish_at', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['name', 'slug', 'image', 'desc'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 100],
            [['slug'], 'unique'],
            [['file'],'file','extensions'=>'jpg,png,gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cate' => 'Cate',
            'slug' => 'Slug',
            'image' => 'Image',
            'desc' => 'Desc',
            'content' => 'Content',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'author' => 'Author',
            'page' => 'Page',
            'status' => 'Status',
            'publish_at' => 'Publish At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
