<?php
/**
 * File: _form.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:37
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model board\forms\AdvertCreateForm */
?>


<div class="type-form">

    <?php $form = ActiveForm::begin( [
        'options' => [ 'enctype' => 'multipart/form-data' ]
    ] ); ?>

    <?= $form->field( $model, 'cat_id' )->dropDownList( $model->categoryList(), [ 'prompt' => 'Выберите раздел' ] ) ?>

    <?= $form->field( $model, 'subcat_id' )->dropDownList( $model->subcategoryList(),
        [ 'prompt' => 'Выберите подраздел' ] ) ?>

    <?= $form->field( $model, 'type' )->dropDownList( $model->typeList(), [ 'prompt' => 'Выберите тип' ] ) ?>

    <?= $form->field( $model, 'period' )->dropDownList( $model->periodList(), [ 'prompt' => 'Выберите период' ] ) ?>

    <?= $form->field( $model, 'header' )->textInput() ?>

    <?= $form->field( $model, 'description' )->textarea( [ 'rows' => 4 ] ) ?>

    <?= $form->field( $model->price, 'price' )->textInput( [ 'maxlength' => true ] ) ?>

    <?= $form->field( $model->price, 'negotiable' )->checkboxList( ['Меркурий', 'Венера',] ) ?>


	<div class="form-group">
      <?= Html::submitButton( 'Create', [ 'class' => 'btn btn-success' ] ) ?>
	</div>

    <?php ActiveForm::end(); ?>

</div>