<?php

use yii\helpers\Html;
use yii\grid\GridView;
use  backend\models\Category;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

        <div class="panel panel-primary">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <p class = "pull-right">
                <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn',
                    //     'header'=>'STT',
                    //     'headerOptions'=>[
                    //         'style'=>'width:15px;text-align:center'
                    //     ],
                    //     'contentOptions'=>[
                    //         'style'=>'width:15px;text-align:center'
                    //     ],
                    // ],

                    ['class' => 'yii\grid\CheckBoxColumn'],
                    [    
                        'attribute'=>'id',
                        'label'=>'ID',
                        
                        'headerOptions'=>[
                            'style'=>'width:15px;text-align:center'
                        ],
                        'contentOptions'=>[
                            'style'=>'width:15px;text-align:center'
                        ],
                    ],

                    // [
                    //     'attribute'=>'id',
                    //     'header'=>'ID',
                    //     'headerOptions'=>[
                    //         'style'=>'width:15px;text-align:center'
                    //     ],
                    //     'contentOptions'=>[
                    //         'style'=>'width:15px;text-align:center'
                    //     ],
                    // ],

                    'name',
                    'slug',
                    [    
                        'attribute'=>'parent',
                        'content'=>function($model){
                            if($model->parent==0){
                                return 'Root';
                            }else{
                                $parent=Category::find()->where(['id'=>$model->parent])->one();
                                if($parent){
                                    return $parent->name;
                                }else{
                                    return 'không rõ';
                                }
                            }
                        },

                        'headerOptions'=>[
                            'style'=>'width:150px;text-align:center'
                        ],
                        'contentOptions'=>[
                            'style'=>'width:150px;text-align:center'
                        ],
                    ],
                    //'status',
                    [    
                        'attribute'=>'status',
                        'content'=>function($model){
                            if($model->status==0){
                                return '<span class="label label-danger">Ko kích hoạt</span>';
                            }else{
                                return '<span class="label label-success">kích hoạt</span>';
                            }
                        },

                        'headerOptions'=>[
                            'style'=>'width:150px;text-align:center'
                        ],
                        'contentOptions'=>[
                            'style'=>'width:150px;text-align:center'
                        ],
                    ],
                    //'created_at',
                    [
                        'attribute'=>'created_at',
                        'content'=>function($model){
                            return date('d-m-Y',$model->created_at);
                        }
                    ],
                    //'updated_at',

                    ['class' => 'yii\grid\ActionColumn',
                        'buttons'=>[
                            'view'=>function($url,$model){
                                return Html::a('View',$url,['class'=>'btn btn-xs btn-primary']);
                            },

                            'update'=>function($url,$model){
                                return Html::a('Edite',$url,['class'=>'btn btn-xs btn-success']);
                            },

                            'delete'=>function($url,$model){
                                return Html::a('<span class="glyphicon glyphicon-remove"></soan> Delete',$url,
                                    [
                                        'class'=>'btn btn-xs btn-danger',
                                        'data-confirm'=>'Bạn có chắc chắn muốn xóa'.$model->name,
                                        'data-method'=>'post'
                                    ]

                                );
                            },

                        ]
                    ],


                ],
            ]); ?>
        </div>
        </div>

    
</div>
