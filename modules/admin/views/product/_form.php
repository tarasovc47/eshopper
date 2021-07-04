<?php

use app\models\Brand;
use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textInput() ?>

    <?= $form->field($model, 'gender')->dropDownList([
        'М' => 'Мужское',
        'Ж' => 'Женское',
    ]) ?>

    <?= $form->field($model, 'brand_id')->dropDownList(ArrayHelper::map(Brand::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'hidden')->dropDownList([
        '1' => 'Скрыт',
        '0' => 'В продаже',
    ]) ?>

    <?= $form->field($model, 'new')->dropDownList([
        '1' => 'Новинка',
        '0' => 'Не новинка',
    ]) ?>

    <?= $form->field($model, 'sale')->dropDownList([
        '1' => 'участвует в распродаже',
        '0' => 'не участвует в распродаже',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
