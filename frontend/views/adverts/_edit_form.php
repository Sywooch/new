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

FontAwesomeAsset::register( $this );

/* @var $model /view/create.php */
/* @var $categoryList /view/create.php */
/* @var $categorySelected /view/create.php */
/* @var $type /view/create.php */
/* @var $period /view/create.php */
/* @var $price /view/create.php */
/* @var $currency /view/create.php */
/* @var $phones /view/create.php */
/* @var $country /view/create.php */

//\common\models\Helpers::p( $categorySelect ); die;
?>
<div class="type-form">

    <?php $form = ActiveForm::begin( [
        'options'     => [
            'enctype' => 'multipart/form-data',
            'action'  => [ 'adverts/preview' ],
            'class'   => 'form-horizontal',
        ],
        'fieldConfig' => [
            'template'     => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-offset-2 col-sm-6">{error}</div>',
            'labelOptions' => [ 'class' => 'col-sm-2 control-label' ],
        ],
    ] ); ?>


    <?= $form->field( $model, 'cat_id' )->dropDownList( $categoryList,
        [
            'id'      => 'cat-id',
            'prompt'  => 'Выберите раздел',
            'options' => [ ". $categorySelected->id." => [ 'selected' => true ] ]
        ] ) ?>



    <?= $form->field( $model, 'subcat_id' )->widget( DepDrop::classname(), [
        'pluginOptions' => [
            'depends'     => [ 'cat-id' ],
            'placeholder' => 'Выберите подраздел',
            'url'         => Url::to( [ '/site/subcat' ] )
        ]
    ] ) ?>

    <?= $form->field( $model, 'type' )->dropDownList( $typeList,
        [ 'prompt' => 'Выберите тип', 'options' => [ ". $typeSelected->id ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'periods' )->dropDownList( $periodList,
        [ 'prompt' => 'Выберите период', 'options' => [ ". $periodSelected->id ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'header' )->textInput() ?>

    <?= $form->field( $model, 'description' )->textarea( [ 'rows' => 4 ] ) ?>

	<div class="form-group">
		<label for="" class="col-sm-2 control-label">Цена</label>
		<div class="col-sm-4">
        <?= Html::activeInput( 'text', $price, 'price', [ 'class' => 'form-control', 'label' => false ] ) ?>
		</div>
		<div class="col-sm-2">
        <?= Html::activeDropDownList( new \backend\models\Currency(), 'short_name', $currency,
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

    <?= $form->field( $model, 'country' )->dropDownList( $countryList,
        [ 'prompt' => 'Выберите', 'options' => [ ". $countrySelected->id ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'author' )->textInput( [ 'placeholder' => 'Иванов Иван', ] ) ?>

    <?= $form->field( $model, 'email' )->textInput( [ 'placeholder' => 'someone@mail.ru', ] ) ?>

    <?php //var_dump( $phones );
    foreach ( $phones as $key => $val ) { ?>

			<div class="form-group">
				<label for="" class="col-sm-2 control-label">Телефон</label>
				<div class="col-sm-5">
            <?= Html::activeInput( 'text', $phones[$key], 'phone[]',
                [ 'class'       => 'form-control',
                  'placeholder' => '8 xxx xxx xx xx',
                  'label'       => false,
                  'value'       => $phones[$key]->phone
                ] ) ?>
				</div>
				<div class="col-sm-1">
					<button class="btn btn-default" type="button">+</button>
				</div>
			</div>

    <?php }
    ?>


    <?php
    // TODO:
    $addPhone = <<< JS
    
JS;
    $this->registerJs( $addPhone, yii\web\View::POS_READY );
    ?>
	<hr>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
        <?= Html::submitButton( 'Сохранить и перейти >>', [ 'class' => 'btn btn-primary' ] ) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>