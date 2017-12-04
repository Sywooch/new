<?php
/**
 * File: _form.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:37
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\depdrop\DepDrop;
use backend\models\Currencies;
use yii\captcha\Captcha;

/* @var $model /view/create.php */
/* @var $category /view/create.php */
/* @var $type /view/create.php */
/* @var $period /view/create.php */
/* @var $price /view/create.php */
/* @var $currency /view/create.php */
/* @var $phones /view/create.php */
/* @var $country /view/create.php */
//\common\models\Helpers::p( \Yii::$app->user->identity->username); die;
?>
<div class="type-form">

    <?php $form = ActiveForm::begin( [
        'options'     => [ 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', ],
//        'enableAjaxValidation' => true,
        'fieldConfig' => [
            'template'     => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-offset-2 col-sm-6">{error}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ],
        ],
    ] ); ?>

    <?= $form->field( $model, 'cat_id' )->dropDownList( $category,
        [ 'id' => 'cat-id', 'prompt' => 'Выберите раздел' ] ) ?>

    <?= $form->field( $model, 'subcat_id' )->widget( DepDrop::classname(), [
        'options'       => [ 'prompt' => 'Выберите подраздел', ],
        'pluginOptions' => [
            'depends'     => [ 'cat-id' ],
            'placeholder' => 'Выберите подраздел',
            'url'         => Url::to( [ '/site/subcat' ] )
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
        <?= Html::activeDropDownList( new Currencies(), 'short_name', $currency,
            [ 'class' => 'form-control', 'label' => false ] ) ?>
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
    <?/*= $form->errorSummary( $price ); */?>
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

    <?= $form->field( $model, 'country' )->dropDownList( $country, [ 'prompt' => 'Выберите' ] ) ?>

    <?= $form->field( $model, 'author' )->textInput( [ 'placeholder' => 'Иванов Иван', 'value' => \Yii::$app->user->identity->username ] ) ?>

    <?= $form->field( $model, 'email' )->textInput( [ 'placeholder' => 'someone@mail.ru', 'value' => \Yii::$app->user->identity->email ] ) ?>

	<div id="form-phones-create">
		<div class="form-group">
			<label for="" class="col-sm-2 control-label">Телефон</label>
			<div class="col-sm-5">
          <?= Html::activeInput( 'text', $phones, 'phone[]',
              [ 'class' => 'form-control', 'placeholder' => '8 xxx xxx xx xx', 'label' => false ] ) ?>
			</div>
			<div class="col-sm-1">
				<button class="btn btn-default add-phone-btn" type="button" title="Добавить телефон">+</button>
			</div>
		</div>

		<div class="form-group hidden">
			<div class="col-sm-offset-2 col-sm-5">
          <?= Html::activeInput( 'text', $phones, 'phone[]',
              [ 'class' => 'form-control', 'placeholder' => '8 xxx xxx xx xx', 'label' => false ] ) ?>
			</div>
			<div class="col-sm-1">
				<button class="btn btn-default add-phone-btn" type="button" title="Добавить телефон">+</button>
			</div>
		</div>

		<div class="form-group hidden">
			<div class="col-sm-offset-2 col-sm-5">
          <?= Html::activeInput( 'text', $phones, 'phone[]',
              [ 'class' => 'form-control', 'placeholder' => '8 xxx xxx xx xx', 'label' => false ] ) ?>
			</div>
		</div>
	</div>
    <?/*= $form->errorSummary( $phones ); */?>
    <?php
    // TODO:
    $addPhone = <<< JS
    var formPhonesCreate = $('#form-phones-create');
		var addPhoneBtn = formPhonesCreate.find('.add-phone-btn');
		$( addPhoneBtn ).click(function(e){
			e.preventDefault();
			$(this).addClass('hidden');
			$(this).parent().parent().next().removeClass('hidden').addClass('show');
		});
JS;
    $this->registerJs( $addPhone, yii\web\View::POS_READY );
    ?>

    <?/*= $form->field($model, 'verifyCode')->widget(Captcha::className()) */?>

	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
        <?= Html::submitButton( 'Сохранить и перейти >>', [ 'class' => 'btn btn-primary' ] ) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>