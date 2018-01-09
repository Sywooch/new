/**
 * Created by Администратор on 28.12.2017.
 */
var targetUrl='/images/uploaded-images';

$.ajax({
	url:targetUrl,
	dataType:'json',
	method:'post',
	data: {

	},
	beforeSend: function () {

	},
	error: function () {

	},
	success: function(data){

		var table = $(document).find('#images-image-fileupload').find('table');
		$.each( data.images, function (i, val ) {
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
				'<button class="btn btn-danger delete" data-type="POST" data-url="image-delete?name=' + val.filename + '">' +
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