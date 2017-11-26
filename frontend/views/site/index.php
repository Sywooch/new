<?php
use frontend\assets\FontAwesomeAsset;

/* @var $this yii\web\View */
FontAwesomeAsset::register( $this );
$this->title = 'vezugruz29.ru';
?>
<div class="site-index">

		<div class="row">
			<div class="col-xs-12">
				<form id="searchForm" class="form" action="/" method="post">
					<input type="hidden" name="_csrf-frontend" value="OTctbkpoMHcBZUgLJC1RGm5ASD8rXkBGAGZBHwlZcihPfABXHDBvBg=="><div class="form-group field-searchform-qact">

						<input type="hidden" id="searchform-qact" class="form-control" name="SearchForm[qact]" options="{&quot;value&quot;:&quot;search_adv&quot;}">


					</div><div class="form-group field-searchform-sortby">

						<input type="hidden" id="searchform-sortby" class="form-control" name="SearchForm[SortBy]" options="{&quot;value&quot;:&quot;Time&quot;}">


					</div><div class="form-group field-searchform-dir">

						<input type="hidden" id="searchform-dir" class="form-control" name="SearchForm[Dir]" option="{&quot;value&quot;:&quot;d&quot;}">


					</div><div class="form-group field-searchform-city">

						<input type="hidden" id="searchform-city" class="form-control" name="SearchForm[City]" option="{&quot;value&quot;:&quot;-1&quot;}">


					</div><div class="form-group field-searchform-folder">

						<input type="hidden" id="searchform-folder" class="form-control" name="SearchForm[Folder]" option="{&quot;value&quot;:&quot;-1&quot;}">


					</div><div class="form-group field-searchform-type">

						<input type="hidden" id="searchform-type" class="form-control" name="SearchForm[Type]" option="{&quot;value&quot;:&quot;-1&quot;}">


					</div><div class="form-group field-searchform-price_start">

						<input type="hidden" id="searchform-price_start" class="form-control" name="SearchForm[Price_Start]" option="{&quot;value&quot;:&quot;&quot;}">


					</div><div class="form-group field-searchform-price_end">

						<input type="hidden" id="searchform-price_end" class="form-control" name="SearchForm[Price_End]" option="{&quot;value&quot;:&quot;&quot;}">


					</div><div class="form-group field-searchform-currency">

						<input type="hidden" id="searchform-currency" class="form-control" name="SearchForm[Currency]" option="{&quot;value&quot;:&quot;1&quot;}">


					</div><div class="form-group field-searchform-period">

						<input type="hidden" id="searchform-period" class="form-control" name="SearchForm[Period]" option="{&quot;value&quot;:&quot;3000&quot;}">


					</div><div class="form-group field-searchform-owneradvid">

						<input type="hidden" id="searchform-owneradvid" class="form-control" name="SearchForm[OwnerAdvID]" option="{&quot;value&quot;:&quot;0&quot;}">


					</div><div class="form-group field-searchform-searchword has-success">

						<div class="input-group"><input type="text" id="searchform-searchword" class="form-control" name="SearchForm[searchWord]" placeholder="Поиск объявления" autofocus="" style="" aria-invalid="false"><span class="input-group-btn"><button id="sub-btn-search" class="btn btn-primary" type="button">Найти</button></span></div>

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
			<ul id="w2" class="nav-tabs nav"><li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Недвижимость <b class="caret"></b></a><ul id="w3" class="dropdown-menu"><li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=1&amp;f=1" tabindex="-1">Квартиры</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=2&amp;f=1" tabindex="-1">Комнаты</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=3&amp;f=1" tabindex="-1">Дома и коттеджи</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=4&amp;f=1" tabindex="-1">Коммерческая недвижимость</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=5&amp;f=1" tabindex="-1">Участки и дачи</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=6&amp;f=1" tabindex="-1">Гаражи</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=7&amp;f=1" tabindex="-1">Прочее</a></li></ul></li>
				<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Транспорт <b class="caret"></b></a><ul id="w4" class="dropdown-menu"><li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=8&amp;f=1" tabindex="-1">Легковые автомобили</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=9&amp;f=1" tabindex="-1">Грузовые автомобили</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=10&amp;f=1" tabindex="-1">Коммерческий транспорт</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=11&amp;f=1" tabindex="-1">Мото и велотранспорт</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=12&amp;f=1" tabindex="-1">Водный транспорт</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=13&amp;f=1" tabindex="-1">Запчасти</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=14&amp;f=1" tabindex="-1">Прочее</a></li></ul></li>
				<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Работа <b class="caret"></b></a><ul id="w5" class="dropdown-menu"><li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=23&amp;f=1" tabindex="-1">Поиск сотрудников</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=24&amp;f=1" tabindex="-1">Поиск работы</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=25&amp;f=1" tabindex="-1">Обучение и образование</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=26&amp;f=1" tabindex="-1">Прочее</a></li></ul></li>
				<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Услуги <b class="caret"></b></a><ul id="w6" class="dropdown-menu"><li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=35&amp;f=1" tabindex="-1">Транспортные</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=36&amp;f=1" tabindex="-1">Ремонтные</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=37&amp;f=1" tabindex="-1">Фото и видеосъемка</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=38&amp;f=1" tabindex="-1">Юридические</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=39&amp;f=1" tabindex="-1">Бухгалтерские</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=40&amp;f=1" tabindex="-1">Бытовые услуги</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=41&amp;f=1" tabindex="-1">Репетиторство</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=42&amp;f=1" tabindex="-1">Прочее</a></li></ul></li>
				<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Строительство <b class="caret"></b></a><ul id="w7" class="dropdown-menu"><li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=43&amp;f=1" tabindex="-1">Стройматериалы</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=44&amp;f=1" tabindex="-1">Инструменты</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=45&amp;f=1" tabindex="-1">Электрика</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=46&amp;f=1" tabindex="-1">Срубы, бани и пр.</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=47&amp;f=1" tabindex="-1">Сантехника</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=48&amp;f=1" tabindex="-1">Прочее</a></li></ul></li>
				<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Электроника <b class="caret"></b></a><ul id="w8" class="dropdown-menu"><li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=49&amp;f=1" tabindex="-1">Аудио и видео</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=50&amp;f=1" tabindex="-1">Компьютеры и комплектующие</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=51&amp;f=1" tabindex="-1">Телефоны и аксессуары</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=52&amp;f=1" tabindex="-1">Офисная техника</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=53&amp;f=1" tabindex="-1">Фото и оптика</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=54&amp;f=1" tabindex="-1">Игровые приставки</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=55&amp;f=1" tabindex="-1">Приборы и радиодетали</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-subcategory-page&amp;id=56&amp;f=1" tabindex="-1">Прочее</a></li></ul></li>
				<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Прочее <b class="caret"></b></a><ul id="w9" class="dropdown-menu"><li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=7&amp;f=0" tabindex="-1">Оборудование</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=8&amp;f=0" tabindex="-1">Хозяйство и быт</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=9&amp;f=0" tabindex="-1">Хобби и отдых</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=10&amp;f=0" tabindex="-1">Все для дачи</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=11&amp;f=0" tabindex="-1">Отдам даром</a></li>
						<li><a href="/frontend/web/index.php?r=adverts%2Fshow-category-page&amp;id=12&amp;f=0" tabindex="-1">Обращения</a></li></ul></li></ul>
		</div>

<br>
		<div class="row">
			<div class="col-sm-5">
				<h4>Последние добавленные объявления</h4>
			</div>

			<div class="col-sm-7 text-right">
				<div id="list-btn-a-link" class="btn-group" role="group" aria-label="...">
					<button id="ads-sort" type="button" class="btn btn-default"><i class="fa fa-sort"></i>Сортировать</button>
					<a id="list-btn-toggle-a" class="btn btn-default" href="javascript:void(0);" title="Вывод объявлений списком"><i class="fa fa-th-list"></i></a>
					<a id="block-btn-toggle-a" class="btn btn-default" href="javascript:void(0);" title="Вывод объявлений блоками"><i class="fa fa-th-large"></i></a>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div id="ads-sort-block" class="panel panel-default collapse" style="height: 2px;">
			<div class="panel-body">
				<form class="form-horizontal" action="" method="post">
					<input type="hidden" name="qact" value="ads_sort">
					<div class="form-group">
						<div id="city-sort" class="col-sm-3">
							<select class="form-control" name="city_sort">
								<option value="-1" selected="selected">По городу</option>
								<option value="6">Архангельск - 4334</option>
								<option value="394">Северодвинск - 7</option>
								<option value="396">Новодвинск - 6</option>
								<option value="397">Котлас - 2</option>
								<option value="398">Вельск</option>
								<option value="401">Каргополь - 1</option>
								<option value="402">Коноша</option>
								<option value="403">Коряжма</option>
								<option value="404">Мезень - 1</option>
								<option value="405">Мирный - 2</option>
								<option value="406">Няндома - 2</option>
								<option value="408">Онега - 2</option>
								<option value="409">Пинега - 1</option>
								<option value="410">Плесецк - 2</option>
								<option value="413">Шенкурск - 1</option>
								<option value="414">Другой - 2229</option>
							</select>
						</div>
						<div id="type-sort" class="col-sm-3">
							<select class="form-control" name="type_sort">
								<option value="-1" selected="">По типу</option>
								<option value="0">Куплю</option>
								<option value="1">Продам</option>
								<option value="2">Сдам</option>
								<option value="3">Сниму</option>
								<option value="4">Предлагаю</option>
								<option value="5">Воспользуюсь</option>
								<option value="6">Ищу</option>
								<option value="7">Отдам</option>
								<option value="8">Приму в дар</option>
								<option value="9">Обменяю</option>
							</select>
						</div>
						<div id="date-sort" class="col-sm-3">По дате&nbsp;&nbsp;

							<input type="hidden" name="date_sort" id="date" value="">
							<button data-id="2" class="btn btn-default btn-sm" type="button" title="По возрастанию"><i
										class="fa fa-angle-up" aria-hidden="true"></i></button>
							<button data-id="1" class="btn btn-default btn-sm" type="button" title="По убыванию"><i
										class="fa fa-angle-down" aria-hidden="true"></i></button>

						</div>
						<div id="price-sort" class="col-sm-3">По цене&nbsp;&nbsp;

							<input type="hidden" name="price_sort" id="price" value="">
							<button data-id="2" class="btn btn-default btn-sm" type="button" title="По возрастанию"><i
										class="fa fa-angle-up" aria-hidden="true"></i></button>
							<button data-id="1" class="btn btn-default btn-sm" type="button" title="По убыванию"><i
										class="fa fa-angle-down" aria-hidden="true"></i></button>

						</div>
					</div>

					<div class="clearfix"></div>

					<div class="form-group">
						<div id="category-sort" class="col-sm-3">
							<select class="form-control" name="category_sort">
								<option value="-1" selected="">По категории</option>
								<option value="1">Недвижимость</option>
								<option value="2">Транспорт</option>
								<option value="22">Хозяйство, быт</option>
								<option value="55">Строительство</option>
								<option value="38">Электроника</option>
								<option value="58">Оборудование</option>
								<option value="50">Работа</option>
								<option value="47">Услуги</option>
								<option value="31">Хобби и отдых</option>
								<option value="57">Всё для дачи</option>
								<option value="56">Отдам даром</option>
								<option value="51">Обращения</option>
							</select>
						</div>
						<div id="subcategory-sort" class="col-sm-3">
							<select class="form-control" name="subcategory_sort" disabled="disabled">
							</select>
						</div>
						<div class="col-sm-3">
							<div class="checkbox">
								<label>
									<input id="save-sort" name="save_sort" type="checkbox" checked=""> Сохранить сортировку
								</label>
							</div>
						</div>
						<div class="col-sm-3">
							<button type="submit" class="btn btn-success btn-sm">Сортировать</button>
							<button type="reset" class="btn btn-default btn-sm">Сброс</button>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="row hide">
						<div class="col-sm-offset-5 col-sm-2 text-center">
							<button type="button" class="btn btn-default btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i>
							</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12"><hr></div>

<?= $this->render( '_single_adv',[] ) ?>


		</div>
</div>
