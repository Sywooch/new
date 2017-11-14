<?php
/**
 * File: _form.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:37
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\FontAwesomeAsset;
use yii\helpers\Url;

FontAwesomeAsset::register( $this );

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

    <?= $form->field( $model->price, 'negotiable' )->checkboxList( [ 'Торг уместен' ] )->label( false ) ?>

    <?= $form->field( $model, 'city' )->dropDownList( $model->cityList(), [ 'prompt' => 'Выберите' ] ) ?>

	<hr>
	<h4>Добавить фотографии</h4>
    <?= $form->field( $model->images, 'files[]' )->widget( FileInput::class, [
        'options' => [
            'accept'   => 'image/*',
            'multiple' => true,
        ]
    ] ) ?>
	<hr>
	<h4>Контактная информация<a id="sec-lk-enter" href="<?= Url::to( '/user/login' ) ?>" title="Войти под своим именем"><i
					class="fa fa-user"></i>Я зарегистрирован</a></h4>

    <?= $form->field( $model->contactInfo, 'username' )->textInput( [ 'placeholder' => "Иванов Иван" ] ) ?>

    <?= $form->field( $model->contactInfo, 'useremail' )->textInput( [ 'placeholder' => "someone@mail.ru" ] ) ?>

    <?= $form->field( $model->contactInfo, 'userphone' )->textInput( [ 'placeholder' => "8 888 8888888", ] ) ?>

	<div class="form-group">
      <?= Html::submitButton( 'Create', [ 'class' => 'btn btn-success' ] ) ?>
	</div>

    <?php ActiveForm::end(); ?>

</div>