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
use dosamigos\fileupload\FileUploadUI;
use kartik\depdrop\DepDrop;
use common\models\Helpers;
use frontend\assets\ImagesAsset;
use frontend\assets\PhonesAsset;

FontAwesomeAsset::register( $this );
ImagesAsset::register( $this );
PhonesAsset::register( $this );

/* @var $model /view/create.php */
/* @var $categoryList /view/create.php */
/* @var $categorySelected /view/create.php */
/* @var $type /view/create.php */
/* @var $period /view/create.php */
/* @var $price /view/create.php */
/* @var $currency /view/create.php */
/* @var $phones /view/create.php */
/* @var $country /view/create.php */

$this->title = 'Создать объявление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-form">

    <?php $form = ActiveForm::begin( [
        'options'     => [
            'enctype' => 'multipart/form-data',
            'action'  => [ 'adverts/preview' ],
            'id' => 'update-ad',
            'class'   => 'form-horizontal',
        ],
        'fieldConfig' => [
            'template'     => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-offset-2 col-sm-6">{error}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ],
        ],
    ] ); ?>

    <?= $form->field( $model, 'ad_id' )->hiddenInput( [ 'id' => 'ad_id', 'value' => $model->id ] )->label( false ) ?>

    <?= $form->field( $model, 'cat_id' )->dropDownList( $categoryList,
        [
            'id'      => 'cat-id',
            'prompt'  => 'Выберите раздел',
            'options' => [ ". $categorySelected->id." => [ 'selected' => true ] ]
        ] ) ?>

    <?= $form->field( $model, 'subcat_id' )->widget( DepDrop::classname(), [
        'options'       => [ 'prompt' => 'Выберите подраздел', ],
        'data'          => $subcategoryList,
        //        'data'          => [ $model->subcat_id => $subcategoryList[$model->subcat_id] ],
        'pluginOptions' => [
            'depends'     => [ 'cat-id' ],
            'placeholder' => 'Выберите подраздел',
            'url'         => Url::to( [ '/site/subcat' ] )
        ]
    ] ) ?>

    <?= $form->field( $model, 'type' )->dropDownList( $typeList,
        [ 'prompt' => 'Выберите тип', 'options' => [ ". $model->type ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'period' )->dropDownList( $periodList, [ 'prompt' => 'Выберите период', 'options' => [ ". $model->period ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'header' )->textInput() ?>

    <?= $form->field( $model, 'description' )->textarea( [ 'rows' => 4 ] ) ?>

    <?/*= $form->field( $price, 'price', [
        'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-2"></div><div class="col-sm-offset-2 col-sm-6">{error}</div>'
    ] )->textInput( [ 'placeholder' => 'Целое число', 'value' => number_format( $price->price, 0, '', ' ' ) ] )
    */?><!--

    --><?/*= $form->field( $currency, 'short_name', [
        'template' => '<div class="col-sm-offset-6 col-sm-2">{input}</div>'
    ] )->dropDownList( $currencyList, [ 'options' => [ ". $currency->id ." => [ 'selected' => true ] ], ] )->label( false ) */?>


	<div class="form-group">
		<label for="" class="col-sm-2 control-label">Цена</label>
		<div class="col-sm-4">
        <?= Html::activeInput( 'text', $price, 'price', [ 'class' => 'form-control', 'label' => false, 'value' => Helpers::format($price->price) ] ) ?>
		</div>

		<div class="col-sm-2">
        <?= Html::activeDropDownList( $currency, 'short_name', $currencyList,
            [ 'class' => 'form-control', 'label' => false, 'value' => $price->currency_id] ) ?>
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

	<div class="form-group">
		<div class="col-sm-10">

        <?= FileUploadUI::widget( [
            'model'         => $images,
            'attribute'     => 'image',
            'url'           => [ 'images/image-upload', 'id' => $images->id ],
            'gallery'       => false,
            'fieldOptions'  => [
                'accept' => 'image/*'
            ],
            'clientOptions' => [
                //    		'acceptFileTypes' => '/(\.|\/)(gif|jpe?g|png)$/i',
                'maxFileSize' => 2000000,
                'minFileSize' => 100,
                'maxNumberOfFiles' => 4,
            ],
            // ...
            'clientEvents'  => [
                'fileuploadprocessdone' => 'function(e, data) {

    				console.log("Processing " + data.files[data.index].name + " done . ");
    		}',
                'fileuploaddone' => 'function(e, data) {

        		$.each(data.files, function (index, file) {
								console.log("Added file: " + file.name);
						});
                                console.log( "Event: " + e);
                                console.log( "Data: " + data ) ;
										console.log( "Result: " + data.result );
										console.log( "Text status: " + data.textStatus );
										console.log( "Data jq: " + data.jqXHR );
										console.log( "Data context: " + data.context );
                            }',
                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
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
        ] );

        ?>
		</div>
	</div>

	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<h4>Контактная информация
			</h4>
		</div>
	</div>

    <?= $form->field( $model, 'country' )->dropDownList( $countryList,
        [ 'prompt' => 'Выберите', 'options' => [ ". $model->country ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'author' )->textInput( [ 'placeholder' => 'Иванов Иван', ] ) ?>

    <?= $form->field( $model, 'email' )->textInput( [ 'placeholder' => 'someone@mail.ru', ] ) ?>

	<div id="form-phones-update">
      <?php
      foreach ( $phonesArray as $key => $val ) {
          if ( $key == 0 ) {
              echo $form->field( $phonesArray[$key], 'phone[]', [
                  'template' => '{label}<div class="col-sm-5">{input}</div><div class="col-sm-1"><button class="btn btn-default add-phone-btn" type="button" title="Добавить телефон"><i class="fa fa-plus" aria-hidden="true"></i></button></div><div class="col-sm-offset-2 col-sm-5">{error}</div>'
              ] )->textInput( [ 'placeholder' => '8 xxx xxx xx xx', 'value' => $phonesArray[$key]->phone ] );
          }
          else {
              echo $form->field( $phonesArray[$key], 'phone[]', [
                  'template' => '<div class="col-sm-offset-2 col-sm-5">{input}</div><div class="col-sm-1"><button class="btn btn-default remove-phone-btn" type="button" title="Удалить телефон"><i class="fa fa-times" aria-hidden="true"></i></button></div><div class="col-sm-offset-2 col-sm-5">{error}</div>'
              ] )->textInput( [ 'placeholder' => '8 xxx xxx xx xx', 'value' => $phonesArray[$key]->phone ] ) ?>
          <?php }
      }
      ?>
	</div>

    <?php $this->registerJsFile( '@web/js/add_phones.js', ['depends' => [\yii\web\JqueryAsset::className()]] ); ?>
	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
        <?= Html::submitButton( 'Сохранить и перейти >>', [ 'class' => 'btn btn-primary' ] ) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>