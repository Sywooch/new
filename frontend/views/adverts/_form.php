<?php
/**
 * File: _form.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:37
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use yii\captcha\Captcha;
use dosamigos\fileupload\FileUploadUI;
use board\repositories\AdvertsRepository;

use frontend\assets\ImagesAsset;
use frontend\assets\PhonesAsset;

//ImagesAsset::register( $this );
//PhonesAsset::register( $this );

/* @var $model /view/create.php */
/* @var $category /view/create.php */
/* @var $type /view/create.php */
/* @var $period /view/create.php */
/* @var $price /view/create.php */
/* @var $currency /view/create.php */
/* @var $phones /view/create.php */
/* @var $country /view/create.php */
/* @var $images /view/create.php */
/* @var $phonesArray /view/update.php */

?>
<div class="type-form">

    <?php $form = ActiveForm::begin( [
        'options'     => [
            'id'      => 'create-adv-form',
            'class'   => 'form-horizontal',
            'enctype' => 'multipart/form-data'
        ],
        //        'enableAjaxValidation' => true,
        'fieldConfig' => [
            'template'     => '{label}<div class="col-sm-6 col-xs-12">{input}</div><div class="col-sm-offset-2 col-sm-6 col-xs-10">{error}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 col-xs-12 control-label' ],
        ],
    ] )
    ?>
    <?= Html::hiddenInput( 'marker', $model->isNewRecord ? mt_rand( 11111111, 99999999 ) : $model->id,
        [ 'id' => 'marker' ] ); ?>
    <?= $form->field( $model, 'cat_id' )->dropDownList( AdvertsRepository::categoryList(),
        [ 'id' => 'cat-id', 'prompt' => 'Выберите раздел' ] ) ?>

    <?= $form->field( $model, 'subcat_id' )->widget( DepDrop::classname(), [
        'options'       => [ 'id' => 'subcat-id', 'prompt' => 'Выберите подраздел', ],
        'data'          => AdvertsRepository::subcategoryListUpdate( $model->cat_id ),
        'pluginOptions' => [
            'depends'     => [ 'cat-id' ],
            'placeholder' => 'Выберите подраздел',
            'url'         => Url::to( [ '/site/subcat' ] )
        ]
    ] )
    ?>

    <?= $form->field( $model, 'type_id' )->dropDownList( AdvertsRepository::typeList(),
        [ 'prompt' => 'Выберите тип' ] ) ?>

    <?= $form->field( $model, 'period_id' )->dropDownList( AdvertsRepository::periodList(),
        [ 'prompt' => 'Выберите период' ] ) ?>

    <?= $form->field( $model, 'header' )->textInput() ?>

    <?= $form->field( $model, 'description' )->textarea( [ 'rows' => 4 ] ) ?>

    <?= $form->field( $model->isNewRecord ? $price : $model->price, 'price_value', [
        'template' => '{label}<div class="col-sm-4 col-xs-8">{input}{error}{hint}</div>' .
            $form->field( $model->isNewRecord ? $price : $model->price, 'currency_id', [
                'template' => '<div class="col-sm-2 col-xs-3">{input}</div>'
            ] )->dropDownList( AdvertsRepository::currencyList() )->label( false )
    ] )->textInput( [ 'maxlength' => true, ] ) ?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">

			<div class="checkbox">
				<label>
            <?= Html::activeCheckbox( $model->isNewRecord ? $price : $model->price, 'negotiable',
                [ 'label' => false ] ) ?>
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
		<div id="file-upload" class="col-sm-offset-2 col-sm-6">

        <?= FileUploadUI::widget( [
            'model'                => $images,
            'attribute'            => 'images',
            'url'                  => [ 'images/image-upload', ],
            'gallery'              => false,
            'uploadTemplateId'     => null,
            'downloadTemplateId'   => null,
            'downloadTemplateView' => '@frontend/views/uploads/download',
            'uploadTemplateView'   => '@frontend/views/uploads/upload',
            'formView'             => '@frontend/views/uploads/form',
            'fieldOptions'         => [
                    'accept' => 'image/*'
                ],
            'clientOptions'        => [
                'maxNumberOfFiles' => 6,
                'maxFileSize'      => 2000000,
                'minFileSize'      => 100,
                'autoUpload'       => true,
                'previewMaxWidth'  => 151,
                'previewMaxHeight' => 113,
                //            		'acceptFileTypes' => '/(\.|\/)(gif|jpe?g|png)$/i',
                ],
            'clientEvents'         => [
                    'fileuploadsubmit' => 'function(e, data) {
							     	var input = $("#marker");
							     data.formData = { marker: input.val() };
//							   if (!data.formData.marker) {
//									 data.context.find("button").prop("disabled", false);
//									 input.focus();
//									 return false;
//							   }
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

    <?= $form->field( $model, 'country_id' )->dropDownList( AdvertsRepository::countryList(),
        [ 'prompt' => 'Выберите' ] ) ?>

    <?= $form->field( $model, 'author' )->textInput( [
        'placeholder' => 'Иванов Иван',
        'value'       => \Yii::$app->user->identity->username
    ] ) ?>

    <?= $form->field( $model, 'email' )->input( 'email',
        [ 'placeholder' => 'someone@mail.ru', 'value' => \Yii::$app->user->identity->email ] ) ?>

	<div id="form-phones">
      <?php
      if ( !$model->isNewRecord ) {
          $phonesArray = $model->phones;
      }
      foreach ( $phonesArray as $key => $phones ) {
          echo $form->field( $phones, "[$key]phone", [
              'template' => '{label}<div class="phone-input-block"><div class="col-sm-5">{input}</div>
							<div class="col-sm-1">
								<button class="btn btn-default add-phone-btn" type="button" title="Добавить телефон">
									<i class="fa fa-plus" aria-hidden="true"></i></button></div>
							<div class="col-sm-offset-2 col-sm-5">{error}</div></div>'
          ] )->textInput( [ 'placeholder' => '+7(xxx) xxx xx xx', 'maxlength' => true ] );
      } ?>
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