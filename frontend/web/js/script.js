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

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$('#fileupload')
	.fileupload({
		dropZone: $('#dropzone')
	});


// Изменение размеров dropzone
$(document).bind('dragover', function (e) {
	var dropZone = $('#dropzone'),
		timeout = window.dropZoneTimeout;
	if (timeout) {
		clearTimeout(timeout);
	} else {
		dropZone.addClass('in');
	}
	var hoveredDropZone = $(e.target).closest(dropZone);
	dropZone.toggleClass('hover', hoveredDropZone.length);
	window.dropZoneTimeout = setTimeout(function () {
		window.dropZoneTimeout = null;
		dropZone.removeClass('in hover');
	}, 100);
}).bind('drop dragover', function (e) {
	e.preventDefault();
});

