/*!
 jQuery [advsort] plugin
 @name jquery.[name].js
 @author [beckson] ([becksonq@gmail.com] or @[author twitter])
 @version 1.0
 @date 01/01/2013
 @category jQuery Plugin
 @copyright (c) 2018 [company/person name] ([company/person website])
 @license Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
 */

(function ($) {
	"use strict";

	var defaults = {
		typesortCookie : Cookies.get('typesortCookie'),
		datesortCookie : Cookies.get('datesortCookie'),
		pricesortCookie : Cookies.get('pricesortCookie'),
		citysortCookie : Cookies.get('citysortCookie'),
		categorysortCookie : Cookies.get('categorysortCookie'),
		subcatsortCookie : Cookies.get('subcatsortCookie'),
		savesortCookie : Cookies.get('savesortCookie'),
		self : window.location.href
	};
	var options = {
		cookieTime : 7,
		type : ['type','date','price','city','category']
	};

	var methods = {
		init: function (params) {
			options = $.extend({}, defaults, options, params);
		},
		on: function ( type ) {
			// var el = type + 'Select'; console.log(el);
			// el.on( 'change', function () {
			// 	var val = $(this).val();
			// 	methods.changes(val);
			// 	Cookies.set( type + "sortCookie", val, options.cookieTime);
			// });
		},
		resets: function (parent) {
			parent.find(':input').not(':button, :submit, :reset').val('');
			parent.find('select').attr('selected', false);
			parent.find('#subcategory-sort').attr('disabled', true);
			parent.find('button:not([type=submit],[type=reset])').removeClass('btn-primary').addClass('btn-default');

			Cookies.remove('typesortCookie');
			Cookies.remove('datesortCookie');
			Cookies.remove('pricesortCookie');
			Cookies.remove('citysortCookie');
			Cookies.remove('categorysortCookie');
			Cookies.remove('subcatsortCookie');
			Cookies.remove('savesortCookie');
			$(location).attr('href', defaults.self);
		},
		changes: function (val) {
			$(this).prop('selected', false);
			$(this).find('[value=' + val + ']').attr('selected', true);
			$(this).val(val);
		},
		update: function (content) {
		},
		createList: function (response, el) {
			var data;
			if (typeof response === 'object') {
				// mime type application/json responsed
				data = response;
			} else {
				try {
					data = JSON.parse(response); //console.log(data);
					var options = '';
					if (data.output !== null) {
						$(data.output).each(function (i, val) {
							options += '<option value="' + val.id + '">' + val.name + '</option>';
						});

						el.html(options);
						el.prepend( $('<option value="">По подкатегории</option>'));
						// el.find('option:first').attr("selected", "selected");
						el.attr('disabled', false);
						return el;
					}
				} catch (e) {
					console.log(methods.tr('error:ajax-request'));
				}
			}
		},
		tr: function (params, lang) {
			var messages = {}, translated = '', code;

			messages.ru_RU = {
				'error': {
					'ajax-request': 'Произошла ошибка при отправке запроса'
				}
			};
			lang = lang || 'ru_RU';
			params = params.toLowerCase().split(':');
			if (messages[lang] !== undefined && params.length) {
				for (var i = 0, msgcat = messages[lang]; i < params.length; i++) {
					code = params[i];
					if (typeof msgcat[code] === 'object') {
						msgcat = msgcat[code];
					}
					if (typeof msgcat[code] === 'string') {
						translated = msgcat[code];
						break;
					}
				}
			}
			return translated;
		}
	};

	$.fn.advSort = function ( method ) {

		options = $.extend({}, defaults, options, method);

		var $this = $(this),
			action = $this.find('form').attr('action'),
			citySelect = $this.find('#city-sort'),
			typeSelect = $this.find('#type-sort').find('select'),
			subSelect = $this.find('#subcategory-sort'),
			categorySelect = $this.find('#category-sort'),
			dateSelect = $this.find('#date-sort'),
			priceSelect = $this.find('#price-sort'),
			url = '/site/subcat';

		// Смотрим куки и ставим выпадающие списки
		// $.each(options.type, function (i, val) {
		// 	var select = val + 'Select';
		// 	var cookie = defaults + '.' + val + 'sortCookie';
		// 	if (cookie) {
		// 		$(select).find('[value="' + cookie + '"]').attr('selected', 'selected');
		// 	}
		// });

		if (defaults.typesortCookie) {
			typeSelect.find('[value="' + defaults.typesortCookie + '"]').attr('selected', 'selected');
		}
		if (defaults.citysortCookie) {
			citySelect.find('[value="' + defaults.citysortCookie + '"]').attr('selected', 'selected');
		}
		if (defaults.categorysortCookie) {
			categorySelect.find('[value="' + defaults.categorysortCookie + '"]').attr('selected', 'selected');
		}
		if (defaults.datesortCookie) {
			dateSelect.find('[value="' + defaults.datesortCookie + '"]').attr('selected', 'selected');
		}
		if (defaults.pricesortCookie) {
			priceSelect.find('[value="' + defaults.pricesortCookie + '"]').attr('selected', 'selected');
		}

		// Панель сортировки
		var sortCookie = Cookies.get('sortCookie');
		if (sortCookie) {
			$this.addClass('in');
		}
		$('#ads-sort').click(function () {
			$this.collapse('toggle');
		});
		$this.on('shown.bs.collapse', function () {
			Cookies.set("sortCookie", "1", 7);
		});
		$this.on('hidden.bs.collapse', function () {
			Cookies.remove('sortCookie');
		});

		// Кнопка сброса
		$this.find('button[type=reset]').on( 'click', function (e) {
			e.preventDefault();
			methods.resets($this);
		});

		// Расположение
		citySelect.on( 'change', function () {
			var val = $(this).val();
			methods.changes(val);
			Cookies.set("citysortCookie", val, 7);
		});

		//Тип объявления
		typeSelect.on( 'change', function () {
			var val = $(this).val();
			methods.changes(val);
			Cookies.set("typesortCookie", val, 7);
		});

		// По дате
		dateSelect.on( 'change', function () {
			var val = $(this).val();
			Cookies.set("datesortCookie", val, 7);
		});

		// По цене
		priceSelect.on( 'change', function () {
			var val = $(this).val();
			Cookies.set("pricesortCookie", val, 7);
		});

		// Создаем подкатерогию после перезагрузки
		var categorySelectedVal = categorySelect.find(':selected').val();
		if ((categorySelectedVal !== '') && (typeof categorySelectedVal !== 'undefined')) {
			$.ajax({
				url: url,
				method: 'post',
				data: 'depdrop_parents[0]=' + categorySelectedVal + "&depdrop_all_params[cat-id]=" + categorySelectedVal,
				success: function (data) {
					methods.createList(data, subSelect);
					subSelect.find('[value="' + defaults.subcatsortCookie + '"]').attr('selected', true);
				},
				error: function () {
					console.log('error');
				}
			});
		}

		// Действие при изменении подкатегории
		subSelect.on( 'change', function () {
			var val = $(this).val();
			methods.changes(val);
			Cookies.set("subcatsortCookie", val, 7);
		});

		// Действие при переключении категории
		categorySelect.on( 'change', function () {
			var val = $(this).val();
			if (val === '') {
				subSelect.attr('disabled', true);
				subSelect.empty().prepend( $('<option value="">По подкатегории</option>'));
				Cookies.remove('categorysortCookie');
				Cookies.remove('subcatsortCookie');
				return false;
			}
			methods.changes(val);
			Cookies.set("categorysortCookie", val, 7);

			$.ajax({
				url: url,
				data: "depdrop_parents[0]=" + val + "&depdrop_all_params[cat-id]=" + val,
				method: 'post',
				success: function (data) {
					methods.createList(data, subSelect);
					subSelect.find('option:first').attr("selected", "selected");
				},
				error: function () {
					console.log('get connect error');
					return false;
				}
			});
		});

		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Метод ' + method + ' в jQuery.advSort не существует');
		}

	};

})(jQuery);

$(document).ready( function () {
	$('#ads-sort-block').advSort();
});

