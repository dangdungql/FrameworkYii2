<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $parent
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    private $_cats;
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'created_at', 'updated_at'], 'required'],
            [['parent', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ten danh muc',
            'slug' => 'Duong dan tinh',
            'parent' => 'danh muc cha',
            'status' => 'trang thi',
            'created_at' => 'Ngay tao',
            'updated_at' => 'Ngay Cap nhật',
        ];

    }

    public function getParent($parent=0,$leval=''){
        $data=Category::find()->where(['parent'=>$parent])->all();
        $leval .='-- ';
        if($data):
            foreach ($data as $item):
                if($item->parent==0){
                    $leval='';
                }
                $this->_cats[$item->id]=$leval.$item->name;
                $this->getParent($item->id,$leval);
            endforeach;
        endif;

        return $this->_cats;    
            
    }
}
