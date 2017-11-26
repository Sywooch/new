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

$this->title = 'Создать объявление';
$this->params['breadcrumbs'][] = $this->title;
//\common\models\Helpers::p( $model->type,1 ); die;
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

    <?php
    /*if ( !$model->isNewRecord && isset( $model->cat_id ) ) {
        echo $form->field( $model, 'subcat_id' )->dropDownList( $subcategoryList,
            [ 'prompt' => 'Выберите подраздел', 'options' => [ ". $model->subcat_id ." => [ 'selected' => true ] ] ] );
    } else {
        echo $form->field( $model, 'subcat_id' )->widget( DepDrop::classname(), [
            'options'       => [ 'prompt' => 'Выберите подраздел', ],
            //        'data'          => [ $model->subcat_id => $subcategoryList[$model->subcat_id] ],
            'pluginOptions' => [
                'depends'     => [ 'cat-id' ],
                'placeholder' => 'Выберите подраздел',
                'url'         => Url::to( [ '/site/subcat' ] )
            ]
        ] );
		}*/
    ?>
    <?= $form->field( $model, 'subcat_id' )->widget( DepDrop::classname(), [
        'options'       => [ 'prompt' => 'Выберите подраздел', ],
        'data'          => $subcategoryList,
//        'data'          => [ $model->subcat_id => $subcategoryList[$model->subcat_id] ],
        'pluginOptions' => [
            'depends'     => [ 'cat-id' ],
            'placeholder' => 'Выберите подраздел',
            'url'         => Url::to( [ '/site/subcat' ] )
        ]
    ] )  ?>

    <?= $form->field( $model, 'type' )->dropDownList( $typeList,
        [ 'prompt' => 'Выберите тип', 'options' => [ ". $model->type ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'periods' )->dropDownList( $periodList,
        [ 'prompt' => 'Выберите период', 'options' => [ ". $model->periods ." => [ 'selected' => true ] ] ] ) ?>

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
        [ 'prompt' => 'Выберите', 'options' => [ ". $model->countries ." => [ 'selected' => true ] ] ] ) ?>

    <?= $form->field( $model, 'author' )->textInput( [ 'placeholder' => 'Иванов Иван', ] ) ?>

    <?= $form->field( $model, 'email' )->textInput( [ 'placeholder' => 'someone@mail.ru', ] ) ?>

	<div id="form-phones-update">
      <?php
      foreach ( $phonesArray as $key => $val ) { ?>

				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Телефон</label>
					<div class="col-sm-5">
              <?= Html::activeInput( 'text', $phonesArray[$key], 'phone[]',
                  [
                      'class'       => 'form-control',
                      'placeholder' => '8 xxx xxx xx xx',
                      'label'       => false,
                      'value'       => $phonesArray[$key]->phone
                  ] ) ?>
					</div>
					<div class="col-sm-1">
						<button class="btn btn-default add-phone-btn hidden" type="button" title="Добавить телефон">+</button>
					</div>
				</div>

      <?php }
      ?>
	</div>

    <?php
    // TODO:
    $addPhone = <<< JS
    var formPhonesUpdate = $('#form-phones-update');
		var length = formPhonesUpdate.find('div.form-group').length;		 
		var addPhoneBtn = formPhonesUpdate.find('.add-phone-btn');
		if(length === 1) addPhoneBtn.removeClass('hidden').addClass('show');
		if(length === 2) addPhoneBtn.eq(1).removeClass('hidden').addClass('show');		
		$(formPhonesUpdate).on('click','.add-phone-btn',function(e){
			e.preventDefault();
			$(this).removeClass('show').addClass('hidden');			
			if(length<3){
				$('<div class="form-group"><div class="col-sm-offset-2 col-sm-5"><input id="userphones-phone" class="form-control" name="UserPhones[phone][]"  placeholder="8 xxx xxx xx xx" type="text"></div><div class="col-sm-1"><button class="btn btn-default add-phone-btn hidden" type="button" title="Добавить телефон">+</button></div></div>').appendTo(formPhonesUpdate);
				var l = formPhonesUpdate.find('.add-phone-btn');
				if(l.length === 2) l.eq(1).removeClass('hidden').addClass('show');
			}
		});		 
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