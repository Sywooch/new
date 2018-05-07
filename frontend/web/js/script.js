/**
 * Created by Администратор on 27.11.2017.
 */

$(function () {
	$('[data-toggle="popover"]').popover();
	$('body').on('click', function (e) {
		$('[data-toggle="popover"]').each(function () {
			if (!$(this).is(e.target)
				&& $(this).has(e.target).length === 0
				&& $('.popover').has(e.target).length === 0) {
				$(this).popover('hide');
			}
		});
	});
});

// Сортировка объявлений
var block = $('#ads-sort-block');

$('#ads-sort').click(function () {
	block.collapse('toggle');
});

$(document).ready(function () {
	// Выравнивание изображений
	$('ul.thumbnails').find('.image-additional:eq(2)').after('<div class="clearfix"></div>');
});

// Форма отправки ответа автору объявления
$("#response-email").on("pjax:end", function () {
	var container = $(document).find("#response-email"),
		form = container.find("#response-form");
	container.hide("slow");
	form.remove();

	new Noty({
		type: 'success',
		layout: 'topRight',
		theme: 'metroui',
		text: 'Ваше сообщение отправлено!'
	}).show();
});
