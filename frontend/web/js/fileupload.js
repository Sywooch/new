/**
 * Created by Администратор on 28.12.2017.
 */
$(document).ready(function () {
	var form = $(document).find("#create-adv-form"),
		loader = form.find('#images-images-fileupload'),
		targetUrl = '/images/uploaded-images',
		table = form.find('table'),
		imageContainer = form.find("#preview-container"),
		ad_id = form.find("#ad_id").val(),
		sid = form.find("#sid").val();

	loader.fileupload({
		acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		dropZone: $('#dropzone')
	}).bind('fileuploadalways', function (e, data) {
		$(this).find('li.template-download:eq(2)').after('<div class="clearfix"></div>');
	}).bind('fileuploaddestroy', function (e, data) {
		$(this).find('.load-warning').remove();
	}).bind('fileuploadprocessfail', function (e, data) {
		// TODO: отловить ошибки
		console.log(data.files);
		if ($('*').is('.load-warning')) {
			return false;
		} else {
			$(this).append('<p class="load-warning">' +
				'<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>' +
				'Превышено максимальное количество файлов!</p>');
		}
	});

// Ищем загруженные картинки при редактировании
	$.ajax({
		url: targetUrl,
		dataType: 'json',
		method: 'post',
		data: {id: ad_id, sid: sid},
		beforeSend: function () {
		},
		error: function () {
		},
		success: function (data) {
			// TODO: проверка data на соответствие или пустоту
			if (data) {
				$.each(data.images, function (i, val) {
					imageContainer.find(".files").append('<div class="col-sm-4 template-download fade in">'
						+ '<div class="panel panel-default">'
						+ '<ul class="list-unstyled">'
						+ '<li class="preview">'
						+ '<img src="' + val.path + val.filename + '">'
						+ '</li>'
						+ '<li class="buttons">'
						+ '<button class="btn btn-danger delete" title="Удалить" data-type="POST" data-url="/images/image-delete?name='
						+ val.filename + '&sid=' + val.sid + '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>'
						+ '</li>'
						+ '</ul>'
						+ '</div>'
						+ '</div>');
				})
			} else {
				// Если нет картинок
				console.log('No images found');
			}
		},
		complete: function () {
		}
	});

	loader.on('click', '.cancel', function () {
		loader.find('.load-warning').remove();
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
});

