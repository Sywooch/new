<?php
/**
 * File: _form.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:37
 */
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use backend\models\Currencies;
use yii\captcha\Captcha;
use dosamigos\fileupload\FileUploadUI;
use frontend\assets\ImagesAsset;
use frontend\assets\PhonesAsset;

//ImagesAsset::register( $this );
PhonesAsset::register( $this );

/* @var $model /view/create.php */
/* @var $category /view/create.php */
/* @var $type /view/create.php */
/* @var $period /view/create.php */
/* @var $price /view/create.php */
/* @var $currency /view/create.php */
/* @var $phones /view/create.php */
/* @var $country /view/create.php */
/* @var $images /view/create.php */

//\common\models\Helpers::p( $images ); die;
?>
<div class="type-form">

    <?php $form = ActiveForm::begin( [
        'options'     => [ 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', ],
        //        'enableAjaxValidation' => true,
        'fieldConfig' => [
            'template'     => '{label}<div class="col-sm-6 col-xs-12">{input}</div><div class="col-sm-offset-2 col-sm-6 col-xs-10">{error}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 col-xs-12 control-label' ],
        ],
    ] ); ?>

    <?= $form->field( $model, 'marker' )->hiddenInput( [
        'id'    => 'marker',
        'value' => random_int( 11111111, 99999999 )
    ] )->label( false ) ?>

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

    <?= $form->field( $price, 'price', [
        'template' => '{label} <div class="col-sm-4 col-xs-8">{input}{error}{hint}</div><div class="col-sm-2 col-xs-4">' . Html::activeDropDownList( new Currencies(),
                'short_name', $currency, [ 'class' => 'form-control', 'label' => false ] ) . '</div>'
    ] ) ?>

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
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">

        <?= FileUploadUI::widget( [
            'model'         => $images,
            'attribute'     => 'images',
            'url'           => [ 'images/image-upload', ],
            'gallery'       => false,
            'uploadTemplateId' => null,
            'downloadTemplateId' => null,
            'downloadTemplateView' => '@frontend/views/uploads/download',
            'fieldOptions'  => [
                'accept' => 'image/*'
            ],
            'clientOptions' => [
//            		'acceptFileTypes' => '/(\.|\/)(gif|jpe?g|png)$/i',
                'maxFileSize'      => 2000000,
                'minFileSize'      => 100,
                'maxNumberOfFiles' => 4,
								'autoUpload' => true,
            ],
            'clientEvents'  => [
                'fileuploadsubmit' => 'function(e, data) {
							var input = $("#marker");
							data.formData = { marker: input.val() };
//							if (!data.formData.marker) {
//									data.context.find("button").prop("disabled", false);
//									input.focus();
//									return false;
//							}
						}',
            ],
        ] );

        ?>
		</div>
	</div>

	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<h4>Контактная информация
				<!-- --><?php
          /*          if ( Yii::$app->user->isGuest ) {
                        echo '<a id="sec-lk-enter" href="' . Url::to( "/user/login" ) . '" title="Войти под своим именем">
                      <i class="fa fa-user"></i>Я зарегистрирован</a>';
                    } */ ?>
			</h4>
		</div>
	</div>

    <?= $form->field( $model, 'country' )->dropDownList( $country, [ 'prompt' => 'Выберите' ] ) ?>

    <?= $form->field( $model, 'author' )->textInput( [
        'placeholder' => 'Иванов Иван',
        'value'       => \Yii::$app->user->identity->username
    ] ) ?>

    <?= $form->field( $model, 'email' )->input( 'email',
        [ 'placeholder' => 'someone@mail.ru', 'value' => \Yii::$app->user->identity->email ] ) ?>

	<div id="form-phones-create">

      <?= $form->field( $phones, 'phone[]', [
          'template' => '{label}<div class="col-sm-5 col-xs-9">{input}</div><div class="col-sm-1 col-xs-2"><button class="btn btn-default add-phone-btn" type="button" title="Добавить телефон"><i class="fa fa-plus" aria-hidden="true"></i></button></div><div class="col-sm-offset-2 col-sm-5">{error}</div>'
      ] )->textInput( [ 'placeholder' => '8 xxx xxx xx xx', ] ) ?>

	</div>

    <? /*= $form->field($model, 'verifyCode')->widget(Captcha::className()) */ ?>

	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
        <?= Html::submitButton( 'Сохранить и перейти >>', [ 'class' => 'btn btn-primary' ] ) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>