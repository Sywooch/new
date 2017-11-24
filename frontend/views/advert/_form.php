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
use kartik\file\FileInput;

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

    <?= $form->field( $model->priceForm, 'price' )->textInput( [ 'maxlength' => true ] ) ?>

    <?= $form->field( $model->priceForm, 'negotiable' )->checkboxList( [ 'Торг уместен' ] )->label( false ) ?>

    <?= $form->field( $model, 'country' )->dropDownList( $model->cityList(), [ 'prompt' => 'Выберите' ] ) ?>

	<hr>
	<h4>Добавить фотографии</h4>
    <?= $form->field( $model->imagesForm, 'files[]' )->widget( FileInput::class, [
        'options'       => [
            'accept'   => 'image/*',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowedFileExtensions' => [
                'jpg',
                'gif',
                'png'
            ],
            'showUpload'            => false,
        ],

    ] ) ?>

	<!--	<div class="file-loading">-->
	<!--      --><? //= $form->field( $model->images, 'files[]' )->widget( FileInput::class, [
    //          'options'       => [
    //              'accept' => 'image/*',
    ////                          'multiple' => true,
    //              						'uploadUrl' => Url::to(['/uploads']),
    ////              						'uploadUrl' => '/uploads',
    //          ],
    //          'pluginOptions' => [
    //          		'allowedFileExtensions' => [
    //          				'jpg', 'gif', 'png'
    //							],
    //							'showUpload' => false,
    //							],
    //					]
    //			) ?>


	<!--		<input id="input-700" name="kartik-input-700[]" type="file" multiple>-->

	<!--	</div>-->
    <?php
    /*$script = <<< JS*/
				// $("#input-700").fileinput({
				// 		uploadUrl: '/uploads',
				// 		maxFileCount: 6
				// });
/*JS;*/
    //$this->registerJs( $script, yii\web\View::POS_READY );
    ?>
	<hr>
	<h4>Контактная информация<a id="sec-lk-enter" href="<?= Url::to( '/user/login' ) ?>" title="Войти под своим именем"><i
					class="fa fa-user"></i>Я зарегистрирован</a></h4>

    <?= $form->field( $model, 'username' )->textInput( [ 'placeholder' => 'Иванов Иван', ] ) ?>

    <?= $form->field( $model, 'useremail' )->textInput( [ 'placeholder' => 'someone@mail.ru', ] ) ?>

    <?= $form->field( $model, 'userphone' )->textInput( [ 'placeholder' => '8 xxx xxx xx xx', ] ) ?>

	<div class="form-group">
      <?= Html::submitButton( 'Сохранить и перейти >>', [ 'class' => 'btn btn-primary' ] ) ?>
	</div>

    <?php ActiveForm::end(); ?>

</div>