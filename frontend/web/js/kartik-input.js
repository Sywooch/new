/**
 * Created by Администратор on 14.11.2017.
 */
$(document).on("ready", function() {
	alert('ee');
	$("#input-700").fileinput({
		uploadUrl: "/upload/",
		maxFileCount: 6
	});
});