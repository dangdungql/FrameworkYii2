<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <div class="panel panel-primary">
          <div class="panel-heading"><?= Html::encode($this->title); ?></div>
          <div class="panel-body">
              <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            <?php
              $cat=new Category; 
            ?>
            <?= $form->field($model, 'parent')->dropDownList(
              $cat->getParent(),
              [
                'prompt'=>'Chọn cha'
              ]
            ) ?>

            <?= $form->field($model, 'status')->dropDownList(
              [
                1=>'kích hoạt',
                2=>'không kích hoạt'
              ],
              [
                'prompt'=>'Chọn trạng thái'
              ]


            ) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
          </div>
    </div>



</div>
