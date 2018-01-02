/*!
 jQuery [name] plugin
 @name jquery.[name].js
 @author [author name] ([author email] or @[author twitter])
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
		datesortCookies : Cookies.get('datesortCookies'),
		pricesortCookies : Cookies.get('pricesortCookies'),
		citysortCookie : Cookies.get('citysortCookie'),
		categorysortCookie : Cookies.get('categorysortCookie'),
		subcatsortCookie : Cookies.get('subcatsortCookie'),
		savesortCookie : Cookies.get('savesortCookie')
	};
	var options = {};

	var methods = {
		init: function (params) {

			// если опции существуют, то совмещаем их
			// со значениями по умолчанию
			options = $.extend({}, defaults, options, params); // при этом важен порядок совмещения

			// var $this = $(this),
			// 	data = $this.data('tooltip'),
			// 	tooltip = $('<div />', {
			// 		text : $this.attr('title')
			// 	});

			// плагин еще не инициализирован
			/*if ( ! data ) {

			 /!*
			 Дополнительные возможности установки
			 *!/

			 $(this).data('tooltip', {
			 target : $this,
			 tooltip : tooltip
			 });

			 }*/

		},
		show: function () {
		},
		change: function (val) {
			$(this).prop('selected', false);
			$(this).find('[value=' + val + ']').attr('selected', true);
			$(this).val(val);
		},
		update: function (content) {
		},
		createList: function (response) {
			var data;
			if (typeof response === 'object') {
				// mime type application/json responsed
				data = response;
			} else {
				try {
					data = JSON.parse(response);
					var options = '';
					if (data.output !== null) {
						$(data.output).each(function (i, val) {
							options += '<option value="' + val.id + '">' + val.name + '</option>';
						});

						subSelect.html(options);
						subSelect.prepend( $('<option value="">По подкатегории</option>'));
						subSelect.find('option:first').attr("selected", "selected");
						subSelect.attr('disabled', false);
					}
				} catch (e) {
					window.alert(methods.tr('error:ajax-request'));
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

		var $this = $(this);
		var form = $this.find(form),
			subSelect = $this.find('#subcategory-sort').find('select'),
			categorySelect = $this.find('#category-sort').find('select'),
			self = window.location.href,
			url = '/site/subcat';

		// Смотрим куки и ставим выпадающие списки
		if (defaults.typesortCookie) {
			$this.find('#type-sort').find('select [value="' + defaults.typesortCookie + '"]').attr('selected', 'selected');
		}
		if (defaults.citysortCookie) {
			$this.find('#city-sort').find('select [value="' + defaults.citysortCookie + '"]').attr('selected', 'selected');
		}
		if (defaults.categorysortCookie) {
			$this.find('#category-sort').find('select [value="' + defaults.categorysortCookie + '"]').attr('selected', 'selected');
		}
		if (defaults.datesortCookies) {
			$this.find('#date-sort').find('button[data-id=' + defaults.datesortCookies + ']').toggleClass('btn-default btn-primary').siblings('input[type=hidden]').val(defaults.datesortCookies);
		}
		if (defaults.pricesortCookies) {
			$this.find('#price-sort').find('button[data-id=' + defaults.pricesortCookies + ']').toggleClass('btn-default btn-primary').siblings('input[type=hidden]').val(defaults.pricesortCookies);
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

		// Create a myPlugin instance if not available.
		// if (!this.myPluginInstance) {
		// 	this.myPluginInstance = new advSort(this, options || {});
		// } else {
		// 	this.myPluginInstance.update(options || {});
		// }

		// Обработка кнопок больше/меньше
		$this.find('button:not([type=submit],[type=reset])').click(function (e) {
			e.preventDefault();
			var siblingsBtn = $(this).siblings('.btn');
			// var inputHidden = $(this).siblings('input[type=hidden]');
			var name = $(this).parent().attr('id').replace(/-/g, "");
			var id = $(this).attr('data-id');
			Cookies.set(name + "Cookies", id, 7);
			// var val = inputHidden.val();

			$(this).toggleClass('btn-default btn-primary');
			if (siblingsBtn.hasClass('btn-primary')) {
				siblingsBtn.removeClass('btn-primary').addClass('btn-default');
			}

			// if (( val === '' ) || ( val !== id )) {
			// 	inputHidden.val(id);
			// } else if (val === id) {
			// 	inputHidden.val('');
			// }
			// TODO: запись в куки
		});

		// Кнопка сброса
		$this.find('button[type=reset]').click(function () {
			$(':input', $this).not(':button, :submit, :reset').val('');
			$this.find('select').attr('selected', false);
			$this.find('#subcategory-sort').find('select').attr('disabled', true);
			$this.find('button:not([type=submit],[type=reset])').removeClass('btn-primary').addClass('btn-default');

			Cookies.remove('typesortCookie');
			Cookies.remove('datesortCookies');
			Cookies.remove('pricesortCookies');
			Cookies.remove('citysortCookie');
			Cookies.remove('categorysortCookie');
			Cookies.remove('subcatsortCookie');
			Cookies.remove('savesortCookie');
			$(location).attr('href', self);
		});

		// Подкатегория
		var categorySelectVal = categorySelect.find(':selected').val();
		if ((categorySelectVal !== '') && (typeof categorySelectVal !== 'undefined')) {
			$.ajax({
				url: url,
				method: 'post',
				data: 'depdrop_parents[0]=' + categorySelectVal + "&depdrop_all_params[cat-id]=" + categorySelectVal,
				success: function (data) {
					methods.createList(data);
					subSelect.find('[value="' + defaults.subcatsortCookie + '"]').attr('selected', true);
				},
				error: function () {
					console.log('error');
				}
			});
		}

		subSelect.change(function () {
			var val = $(this).val();
			methods.change(val);
			Cookies.set("subcatsortCookie", val, 7);
		});

		// Категория
		categorySelect.change(function () {
			var val = $(this).val();
			if (val === '') {
				subSelect.attr('disabled', true);
				subSelect.empty().prepend( $('<option value="">По подкатегории</option>'));
				return false;
			}
			methods.change(val);
			Cookies.set("categorysortCookie", val, 7);

			$.ajax({
				url: url,
				data: "depdrop_parents[0]=" + val + "&depdrop_all_params[cat-id]=" + val,
				method: 'post',
				success: function (data) {
					methods.createList(data);
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

