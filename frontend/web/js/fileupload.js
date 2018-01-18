/**
 * Created by Администратор on 28.12.2017.
 */
$(document).ready(function () {

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

	var targetUrl = '/images/uploaded-images';
	var ad_id = $(document).find('#ad_id').val(); //console.log(ad_id);

	$.ajax({
		url: targetUrl,
		dataType: 'json',
		method: 'post',
		data: {id:ad_id},
		beforeSend: function () {

		},
		error: function () {

		},
		success: function (data) {

			var table = $(document).find('#images-images-fileupload').find('table'); //console.log( table);

			$.each(data.images, function (i, val) {
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
		},
		complete: function () {
		}
	});
});

