/**
 * Created by Администратор on 28.12.2017.
 */
$(document).ready(function () {
	var loader = $(document).find('#images-images-fileupload'),
		targetUrl = '/images/uploaded-images',
		ad_id = $(document).find('#marker').val(),
		table = loader.find('table');

	loader.fileupload({
		// autoUpload: true,
		// maxFileSize: 2000000,
		minFileSize: 100,
		// previewMaxWidth: 144,
		// previewMaxHeight: 85,
		maxNumberOfFiles: 4,
		acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		// acceptFileTypes: /(\.|\/)(jpg)$/i,
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
		data: {id: ad_id},
		beforeSend: function () {
		},
		error: function () {
		},
		success: function (data) {
			// TODO: проверка data на соответствие или пустоту
			if (data) {
				$.each(data.images, function (i, val) { //console.log('images--' + val);
					console.log(table);
					table.append('<tr class="template-download fade in">' +
						'<td><span class="preview">' +
						'<a href="' + val.path + val.filename + '" title="' + val.filename + '" download="' +
						val.filename + '" data-gallery=""><img src="' + val.path + val.filename + '"></a>' +
						'</span></td>' +
						'<td><p class="name">' +
						'<a href="' + val.path + val.filename + '" title="' + val.filename + '" download="' +
						val.filename + '" data-gallery="">' + val.filename + '</a>' +
						'</p></td>' +
						'<td><span class="size">' + val.size + '</span></td>' +
						'<td>' +
						'<button class="btn btn-danger delete" data-type="POST" data-url="/images/image-delete?name=' + val.filename + '">' +
						'<i class="glyphicon glyphicon-trash"></i>' +
						'<span>Удалить</span></button>' +
						'<input class="toggle" name="delete" value="1" type="checkbox">' +
						'</td>' +
						'</tr>');
				})
			} else {
				// Если нет картинок
				console.log(data);
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

