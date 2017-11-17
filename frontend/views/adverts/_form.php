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
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;

FontAwesomeAsset::register( $this );

/* @var $model frontend\controllers\AdvertsController */
/* @var $category frontend\controllers\AdvertsController */
?>
<div class="type-form">

    <?php $form = ActiveForm::begin( [
        'options'     => [ 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', ],
        'fieldConfig' => [
            'template'     => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-offset-2 col-sm-6">{error}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ],
        ],
    ] ); ?>

    <?= $form->field( $model, 'cat_id' )->dropDownList( $category,
        [ 'id' => 'cat-id', 'prompt' => 'Выберите раздел' ] ) ?>

    <?= $form->field( $model, 'subcat_id' )->widget( DepDrop::classname(), [
        'pluginOptions' => [
            'depends'     => [ 'cat-id' ],
            'placeholder' => 'Выберите подраздел',
            'url'         => Url::to( [ '/adverts/subcat' ] )
        ]
    ] ) ?>

    <?= $form->field( $model, 'type' )->dropDownList( $type, [ 'prompt' => 'Выберите тип' ] ) ?>

    <?= $form->field( $model, 'period' )->dropDownList( $period, [ 'prompt' => 'Выберите период' ] ) ?>

    <?= $form->field( $model, 'header' )->textInput() ?>

    <?= $form->field( $model, 'description' )->textarea( [ 'rows' => 4 ] ) ?>


	<div class="form-group">
		<label for="" class="col-sm-2 control-label">Цена</label>
		<div class="col-sm-4">
        <?= Html::activeInput( 'text', $price, 'price', [ 'class' => 'form-control', 'label' => false ] ) ?>
		</div>
		<div class="col-sm-2">
			<?= Html::activeDropDownList( new \backend\models\Currency(), 'short_name',$currency, ['class' => 'form-control', 'label' => false ]) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<div class="checkbox">
				<label>
            <?= Html::activeCheckbox( $price, 'negotiable', [ 'label' => false ] ) ?>
					Торг уместен
				</label>
			</div>
		</div>
	</div>

	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<h4>Добавить фотографии</h4>
		</div>
	</div>
    <? /*= $form->field( $model->imagesForm, 'files[]' )->widget( FileInput::class, [
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

    ] ) */ ?>

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
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<h4>Контактная информация
          <?php
          if ( Yii::$app->user->isGuest ) {
              echo '<a id="sec-lk-enter" href="' . Url::to( "/user/login" ) . '" title="Войти под своим именем">
			<i class="fa fa-user"></i>Я зарегистрирован</a>';
          } ?>
			</h4>
		</div>
	</div>

    <?= $form->field( $model, 'author' )->textInput( [ 'placeholder' => 'Иванов Иван', ] ) ?>

    <?= $form->field( $model, 'email' )->textInput( [ 'placeholder' => 'someone@mail.ru', ] ) ?>

    <?= $form->field( $phone, 'phone' )->textInput( [ 'placeholder' => '8 xxx xxx xx xx', ] ) ?>

    <?= $form->field( $model, 'city' )->dropDownList( $city, [ 'prompt' => 'Выберите' ] ) ?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
        <?= Html::submitButton( 'Сохранить и перейти >>', [ 'class' => 'btn btn-primary' ] ) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>