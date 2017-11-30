<?php
use frontend\assets\FontAwesomeAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
FontAwesomeAsset::register( $this );
$this->title = 'vezugruz29.ru';

//\common\models\Helpers::p( $dataProvider->getModels() ); die;
?>
<div class="site-index">

	<div class="row">
		<div class="col-xs-12">
			<form id="searchForm" class="form" action="/" method="post">
				<input type="hidden" name="_csrf-frontend" value="OTctbkpoMHcBZUgLJC1RGm5ASD8rXkBGAGZBHwlZcihPfABXHDBvBg==">
				<div class="form-group field-searchform-qact">

					<input type="hidden" id="searchform-qact" class="form-control" name="SearchForm[qact]"
								 options="{&quot;value&quot;:&quot;search_adv&quot;}">


				</div>
				<div class="form-group field-searchform-sortby">

					<input type="hidden" id="searchform-sortby" class="form-control" name="SearchForm[SortBy]"
								 options="{&quot;value&quot;:&quot;Time&quot;}">


				</div>
				<div class="form-group field-searchform-dir">

					<input type="hidden" id="searchform-dir" class="form-control" name="SearchForm[Dir]"
								 option="{&quot;value&quot;:&quot;d&quot;}">


				</div>
				<div class="form-group field-searchform-city">

					<input type="hidden" id="searchform-city" class="form-control" name="SearchForm[City]"
								 option="{&quot;value&quot;:&quot;-1&quot;}">


				</div>
				<div class="form-group field-searchform-folder">

					<input type="hidden" id="searchform-folder" class="form-control" name="SearchForm[Folder]"
								 option="{&quot;value&quot;:&quot;-1&quot;}">


				</div>
				<div class="form-group field-searchform-type">

					<input type="hidden" id="searchform-type" class="form-control" name="SearchForm[Type]"
								 option="{&quot;value&quot;:&quot;-1&quot;}">


				</div>
				<div class="form-group field-searchform-price_start">

					<input type="hidden" id="searchform-price_start" class="form-control" name="SearchForm[Price_Start]"
								 option="{&quot;value&quot;:&quot;&quot;}">


				</div>
				<div class="form-group field-searchform-price_end">

					<input type="hidden" id="searchform-price_end" class="form-control" name="SearchForm[Price_End]"
								 option="{&quot;value&quot;:&quot;&quot;}">


				</div>
				<div class="form-group field-searchform-currency">

					<input type="hidden" id="searchform-currency" class="form-control" name="SearchForm[Currency]"
								 option="{&quot;value&quot;:&quot;1&quot;}">


				</div>
				<div class="form-group field-searchform-period">

					<input type="hidden" id="searchform-period" class="form-control" name="SearchForm[Period]"
								 option="{&quot;value&quot;:&quot;3000&quot;}">


				</div>
				<div class="form-group field-searchform-owneradvid">

					<input type="hidden" id="searchform-owneradvid" class="form-control" name="SearchForm[OwnerAdvID]"
								 option="{&quot;value&quot;:&quot;0&quot;}">


				</div>
				<div class="form-group field-searchform-searchword has-success">

					<div class="input-group"><input type="text" id="searchform-searchword" class="form-control"
																					name="SearchForm[searchWord]" placeholder="Поиск объявления" autofocus=""
																					style="" aria-invalid="false"><span class="input-group-btn"><button
									id="sub-btn-search" class="btn btn-primary" type="button">Найти</button></span></div>

					<p class="help-block help-block-error"></p>
				</div>
			</form>

			<p class="help-block">
				Пример: nokia&nbsp;&nbsp;
				<b><a id="ext-search-link" href="javascript:void();"><i class="fa fa-search-plus"></i>&nbsp;&nbsp;Расширенный
						поиск</a></b>
				<!-- Статистика объявлений -->
				<span class="pull-right">Всего в базе объявлений <strong class="text-primary">666</strong>, за месяц 444, за сутки
	333</span>
			</p></div>
	</div>

	<div class="row">
		<ul id="w2" class="nav-tabs nav">
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Недвижимость <b class="caret"></b></a>
				<ul id="w3" class="dropdown-menu">
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=1&amp;f=1" tabindex="-1">Квартиры</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=2&amp;f=1"
								 tabindex="-1">Комнаты</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=3&amp;f=1" tabindex="-1">Дома и
							коттеджи</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=4&amp;f=1" tabindex="-1">Коммерческая
							недвижимость</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=5&amp;f=1" tabindex="-1">Участки
							и дачи</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=6&amp;f=1"
								 tabindex="-1">Гаражи</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=7&amp;f=1"
								 tabindex="-1">Прочее</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Транспорт <b
							class="caret"></b></a>
				<ul id="w4" class="dropdown-menu">
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=8&amp;f=1" tabindex="-1">Легковые
							автомобили</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=9&amp;f=1" tabindex="-1">Грузовые
							автомобили</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=10&amp;f=1" tabindex="-1">Коммерческий
							транспорт</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=11&amp;f=1" tabindex="-1">Мото и
							велотранспорт</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=12&amp;f=1" tabindex="-1">Водный
							транспорт</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=13&amp;f=1" tabindex="-1">Запчасти</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=14&amp;f=1"
								 tabindex="-1">Прочее</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Работа <b class="caret"></b></a>
				<ul id="w5" class="dropdown-menu">
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=23&amp;f=1" tabindex="-1">Поиск
							сотрудников</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=24&amp;f=1" tabindex="-1">Поиск
							работы</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=25&amp;f=1" tabindex="-1">Обучение
							и образование</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=26&amp;f=1"
								 tabindex="-1">Прочее</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Услуги <b class="caret"></b></a>
				<ul id="w6" class="dropdown-menu">
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=35&amp;f=1" tabindex="-1">Транспортные</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=36&amp;f=1" tabindex="-1">Ремонтные</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=37&amp;f=1" tabindex="-1">Фото и
							видеосъемка</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=38&amp;f=1" tabindex="-1">Юридические</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=39&amp;f=1" tabindex="-1">Бухгалтерские</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=40&amp;f=1" tabindex="-1">Бытовые
							услуги</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=41&amp;f=1" tabindex="-1">Репетиторство</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=42&amp;f=1"
								 tabindex="-1">Прочее</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Строительство <b
							class="caret"></b></a>
				<ul id="w7" class="dropdown-menu">
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=43&amp;f=1" tabindex="-1">Стройматериалы</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=44&amp;f=1" tabindex="-1">Инструменты</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=45&amp;f=1" tabindex="-1">Электрика</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=46&amp;f=1" tabindex="-1">Срубы,
							бани и пр.</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=47&amp;f=1" tabindex="-1">Сантехника</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=48&amp;f=1"
								 tabindex="-1">Прочее</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Электроника <b class="caret"></b></a>
				<ul id="w8" class="dropdown-menu">
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=49&amp;f=1" tabindex="-1">Аудио
							и видео</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=50&amp;f=1" tabindex="-1">Компьютеры
							и комплектующие</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=51&amp;f=1" tabindex="-1">Телефоны
							и аксессуары</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=52&amp;f=1" tabindex="-1">Офисная
							техника</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=53&amp;f=1" tabindex="-1">Фото и
							оптика</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=54&amp;f=1" tabindex="-1">Игровые
							приставки</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=55&amp;f=1" tabindex="-1">Приборы
							и радиодетали</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=56&amp;f=1"
								 tabindex="-1">Прочее</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Прочее <b class="caret"></b></a>
				<ul id="w9" class="dropdown-menu">
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=7&amp;f=0" tabindex="-1">Оборудование</a>
					</li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=8&amp;f=0" tabindex="-1">Хозяйство
							и быт</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=9&amp;f=0" tabindex="-1">Хобби и
							отдых</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=10&amp;f=0" tabindex="-1">Все для
							дачи</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=11&amp;f=0" tabindex="-1">Отдам
							даром</a></li>
					<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=12&amp;f=0"
								 tabindex="-1">Обращения</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<br>

	<div id="sort-site-index" class="row">
		<div class="col-sm-5">
			<h4>Последние добавленные объявления</h4>
		</div>

		<div class="col-sm-7 text-right">
			<div id="list-btn-a-link" class="btn-group" role="group" aria-label="...">
				<button id="ads-sort" type="button" class="btn btn-default"><i class="fa fa-sort"></i>Сортировать</button>
				<a id="list-btn-toggle-a" class="btn btn-default" href="javascript:void(0);"
					 title="Вывод объявлений списком"><i class="fa fa-th-list"></i></a>
				<a id="block-btn-toggle-a" class="btn btn-default" href="javascript:void(0);"
					 title="Вывод объявлений блоками"><i class="fa fa-th-large"></i></a>
			</div>
		</div>
	</div>


	<div class="clearfix"></div>

	<div id="ads-sort-block" class="col-sm-12 collapse">
		<div class="panel panel-default">
			<div class="panel-body">

          <?php $form = ActiveForm::begin( [
          		'options' => ['action' => '/site/index','class' => 'form-horizontal']
          		]); ?>

          <?= Html::hiddenInput( 'form_action', 'ads_sort' ) ?>

				<div class="form-group">
            <?/*= $form->field( $model, 'country' )->dropDownList( $country, [ 'prompt' => 'Выберите' ] ) */?>

					<div class="col-sm-3">
						<div id="date-sort">
							По дате&nbsp;&nbsp;
                <?= Html::hiddenInput( 'date_sort', '', [ 'id' => 'date' ] ) ?>
                <?= Html::button( '<i class="fa fa-angle-up" aria-hidden="true"></i>',
                    [ 'data-id' => 2, 'class' => 'btn btn-default btn-sm', 'title' => 'По возрастанию' ] ) ?>
                <?= Html::button( '<i class="fa fa-angle-down" aria-hidden="true"></i>',
                    [ 'data-id' => 1, 'class' => 'btn btn-default btn-sm', 'title' => 'По убыванию' ] ) ?>
						</div>
					</div>

					<div class="col-sm-3">
						<div id="price-sort">
							По цене&nbsp;&nbsp;
                <?= Html::hiddenInput( 'price_sort', '', [ 'id' => 'price' ] ) ?>

                <?= Html::button( '<i class="fa fa-angle-up" aria-hidden="true"></i>',
                    [ 'data-id' => 2, 'class' => 'btn btn-default btn-sm', 'title' => 'По возрастанию' ] ) ?>
                <?= Html::button( '<i class="fa fa-angle-down" aria-hidden="true"></i>',
                    [ 'data-id' => 1, 'class' => 'btn btn-default btn-sm', 'title' => 'По убыванию' ] ) ?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-3 hide">
              <?= Html::checkbox( 'img_only', true, [ 'label' => false, 'id' => 'img-only' ] ) ?>
						Только с фотографиями
					</div>
					<div class="col-sm-offset-6 col-sm-3">
              <?= Html::checkbox( 'save_sort', true,
                  [ 'label' => false, 'id' => 'save-sort', 'checked' => 'checked' ] ) ?>
						Сохранить сортировку
					</div>
					<div class="col-sm-3">
              <?= Html::submitButton( 'Сортировать', [ 'class' => 'btn btn-success btn-sm' ] ) ?>
              <?= Html::resetButton( 'Сбросить', [ 'class' => 'btn btn-default btn-sm' ] ) ?>
					</div>
				</div>

				<div class="clearfix"></div>

          <?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<hr>
		</div>
      <?php // \common\models\Helpers::p( $dataProvider->getModels() );  die; ?>
      <?php foreach ( $dataProvider->getModels() as $model ){ //print_r( $model ); exit;?>
          <?= $this->render( '_single_adv', [
              'model' => $model
          ] ) ?>
      <?php } ?>

	</div>
</div>
