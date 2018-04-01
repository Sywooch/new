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
use backend\models\Currencies;
use yii\captcha\Captcha;
use dosamigos\fileupload\FileUploadUI;
use board\repositories\AdvertsRepository;
use yii\widgets\MaskedInput;

use frontend\assets\ImagesAsset;
use frontend\assets\PhonesAsset;

ImagesAsset::register($this);
PhonesAsset::register($this);

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

    <?php
    if ($model->isNewRecord) {
        $form = ActiveForm::begin([
            'options'     => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal',],
            //        'enableAjaxValidation' => true,
            'fieldConfig' => [
                'template'     => '{label}<div class="col-sm-6 col-xs-12">{input}</div><div class="col-sm-offset-2 col-sm-6 col-xs-10">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-2 col-xs-12 control-label'],
            ],
        ]);
    } else {
        $form = ActiveForm::begin([
            'options'     => [
                'enctype' => 'multipart/form-data',
                'action'  => ['adverts/preview'],
                'id'      => 'update-ad',
                'class'   => 'form-horizontal',
            ],
            'fieldConfig' => [
                'template'     => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-offset-2 col-sm-6">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
            ],
        ]);
    }
    ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'marker')->hiddenInput([
            'id'    => 'marker',
            'value' => random_int(11111111, 99999999)
        ])->label(false);
    } else {
        echo $form->field($model, 'ad_id')->hiddenInput(['id' => 'ad_id', 'value' => $model->id])->label(false);
    } ?>

    <?= $form->field($model, 'cat_id')->dropDownList(AdvertsRepository::categoryList(),
        ['id' => 'cat-id', 'prompt' => 'Выберите раздел']) ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'subcat_id')->widget(DepDrop::classname(), [
            'options'       => ['prompt' => 'Выберите подраздел',],
            'pluginOptions' => [
                'depends'     => ['cat-id'],
                'placeholder' => 'Выберите подраздел',
                'url'         => Url::to(['/site/subcat'])
            ]
        ]);
    } else {
        echo $form->field($model, 'subcat_id')->widget(DepDrop::classname(), [
            'options'       => ['prompt' => 'Выберите подраздел',],
            'data'          => AdvertsRepository::subcategoryListUpdate($model->cat_id),
            'pluginOptions' => [
                'depends'     => ['cat-id'],
                'placeholder' => 'Выберите подраздел',
                'url'         => Url::to(['/site/subcat'])
            ]
        ]);
    } ?>

    <?= $form->field($model, 'type_id')->dropDownList(AdvertsRepository::typeList(),
        ['prompt' => 'Выберите тип']) ?>

    <?= $form->field($model, 'period_id')->dropDownList(AdvertsRepository::periodList(),
        ['prompt' => 'Выберите период']) ?>

    <?= $form->field($model, 'header')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($price, 'price_name', [
        'template' => '{label} <div class="col-sm-4 col-xs-8">{input}{error}{hint}</div>
				<div class="col-sm-3 col-xs-4">' .
            $form->field($price, 'currency_id')->dropDownList(AdvertsRepository::currencyList(),
                ['class' => 'form-control'])->label(false)
            . '</div>'
    ])->textInput(['maxlength' => true,]) ?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<div class="checkbox">
				<label>
            <?= Html::activeCheckbox($price, 'negotiable', ['label' => false]) ?>
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

        <?php
        if ($model->isNewRecord) {
            echo FileUploadUI::widget([
                'model'                => $images,
                'attribute'            => 'images',
                'url'                  => ['images/image-upload',],
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
            ]);
        } else {
            echo FileUploadUI::widget([
                'model'         => $images,
                'attribute'     => 'images',
                'url'           => ['images/image-upload',],
                'gallery'       => false,
                'fieldOptions'  => [
                    'accept' => 'image/*'
                ],
                'clientOptions' => [
                    //    		'acceptFileTypes' => '/(\.|\/)(gif|jpe?g|png)$/i',
                    'maxFileSize'      => 2000000,
                    'minFileSize'      => 100,
                    'maxNumberOfFiles' => 4,
                ],
                'clientEvents'  => [
                    'fileuploadsubmit' => 'function(e, data) {
										var input = $("#ad_id");
										data.formData = {ad_id: input.val()};
//										if (!data.formData.example) {
//												data.context.find("button").prop("disabled", false);
//												input.focus();
//												return false;
//										}
								}',
                ],
            ]);
        }
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

    <?= $form->field($model, 'country_id')->dropDownList(AdvertsRepository::countryList(),
        ['prompt' => 'Выберите']) ?>

    <?= $form->field($model, 'author')->textInput([
        'placeholder' => 'Иванов Иван',
        'value'       => \Yii::$app->user->identity->username
    ]) ?>

    <?= $form->field($model, 'email')->input('email',
        ['placeholder' => 'someone@mail.ru', 'value' => \Yii::$app->user->identity->email]) ?>


	<div id="form-phones">
      <?php
      foreach ($phonesArray as $key => $phones) {
          echo $form->field($phones, "[$key]phone", [
              'template' => '{label}<div class="col-sm-5">{input}</div>
							<div class="col-sm-1">
								<button class="btn btn-default add-phone-btn" type="button" title="Добавить телефон">
									<i class="fa fa-plus" aria-hidden="true"></i></button></div>
							<div class="col-sm-offset-2 col-sm-5">{error}</div>'
          ])->textInput(['placeholder' => '+7(xxx) xxx xx xx']);
      } ?>
	</div>


    <? /*= $form->field($model, 'verifyCode')->widget(Captcha::className()) */ ?>

	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
        <?= Html::submitButton('Сохранить и перейти >>', ['class' => 'btn btn-primary']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>