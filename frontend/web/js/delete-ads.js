$(document).ready(function () {
	var deleteBtn = $(document).find(".ad-delete-btn"),
		url = "/adverts/delete";

	deleteBtn.on("click", function (e) {
		e.preventDefault();
		var id = $(this).attr("data-id"),
			n = new Noty({
				text: "<span class=\"glyphicon glyphicon-alert\" aria-hidden=\"true\"></span>&nbsp;&nbsp;Удалить объявление?",
				theme: "metroui",
				layout: "center",
				buttons: [
					Noty.button(
						"Удалить",
						"btn btn-success",
						function () {
							n.close();
							deleteAd(url, id);
						},
						{
							id: "button1",
							"data-status": "ok"
						}
					),
					Noty.button(
						"Отмена",
						"btn btn-danger noty-btn",
						function () {
							n.close();
						})
				]
			}).show();
	});

	function deleteAd(url, id) {
		// TODO: сделать заглушку-спиннер
		$.ajax({
			url: url,
			method: "post",
			data: "id=" + id,
			success: function (data) {
				if (data.message === "success") {
					$(document).find("div#" + id).remove();
					new Noty({
						type: "success",
						layout: "center",
						text: "<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;&nbsp;Объявление удалено!",
						timeout: 3000
					}).show();
				}
				if (data.message === "error") {
					new Noty({
						type: "info",
						layout: "center",
						text: "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>&nbsp;&nbsp;Ошибка при удалении объявления",
						timeout: 3000
					}).show();
				}
			},
			error: function () {
				new Noty({
					type: "info",
					layout: "center",
					text: "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>&nbsp;&nbsp;Ошибка при удалении объявления",
					timeout: 3000
				}).show();
			}
		});
	}
});