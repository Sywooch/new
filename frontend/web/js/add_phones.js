/**
 * Created by Администратор on 23.12.2017.
 */
$(document).ready(function () {

	var form = $("#create-adv-form"),
		rootContainer = $("#form-phones"),
		addBtn = rootContainer.find(".add-phone-btn"),
		donor = rootContainer.find(".form-group:first"),
		limit = 3;

	changeButtons();

	function changeButtons() {
		var lengthBtn = rootContainer.find("button").length;
		if (lengthBtn > 1) {
			rootContainer.find("button:not(:first)").each(function () {
				$(this).parent().parent().parent().find("label").empty().removeAttr("for");
				$(this).removeClass("add-phone-btn").addClass("remove-phone-btn").empty().html('<i class="fa fa-minus" aria-hidden="true"></i>');
			})
		}
	}

	function createDonor() {
		var count = rootContainer.find(".form-group").length;
		if (count < limit) {
			var cloneElement = donor.clone(false, false);
			cloneElement.removeClass("has-error").removeClass("has-success");
			cloneElement.find(".help-block").empty();
			cloneElement.find("input").val("");
			cloneElement.find("label").empty().removeAttr("for");
			cloneElement.find("button").removeClass("add-phone-btn").addClass("remove-phone-btn").empty().html('<i class="fa fa-minus" aria-hidden="true"></i>').attr("title", "Удалить телефон");

			cloneElement.appendTo(rootContainer).fadeIn();
		}
	}

	addBtn.on("click", function () {
		// Создаем новую строку
		createDonor();
		// Обновление атрибутов
		updateAttributes();
		// Добавление обработчика ошибок к полям
		inputValidationHandler();
	});

// Обновление атрибутов
	function updateAttributes() {
		rootContainer.find(".form-group").each(function (i, el) {
			var newClass = $(el).attr("class").replace(/\d/g, i);
			$(el).attr("class", newClass);
			$(el).find("input").each(function (index, element) {
				var newId = $(element).attr("id").replace(/\d/g, i);
				var newName = $(element).attr("name").replace(/\d/g, i);
				$(element).attr("id", newId).attr("name", newName);

				// Удаляем обработчики валидации
				form.yiiActiveForm("remove", newId);
			});
		});
	}

	function inputValidationHandler() {
		// Обработчик ошибок
		// https://github.com/samdark/yii2-cookbook/blob/master/book/forms-activeform-js.md
		rootContainer.find(".form-group").find("input").each(function (i, el) {
			var inputId = $(el).attr("id").replace(/\d/g, i);
			var inputContainer = $(el).parent().parent().parent().attr("class").split(" ", 2);
			inputContainer = inputContainer[1].replace(/\d/g, i);
			var inputName = $(el).attr("name").replace(/\d/g, i),
				bracketPosition = inputName.indexOf("[");
			inputName = inputName.substr(bracketPosition);

			form.yiiActiveForm("add", {
				"id": inputId,
				"name": inputName,
				"container": "." + inputContainer,
				"input": "#" + inputId,
				"validate": function (attribute, value, messages, deferred) {
					yii.validation.string(value, messages, {
						"message": "Значение «Телефон» должно быть строкой.",
						"min": 6,
						"tooShort": "Значение «Телефон» должно содержать минимум 6 символов.",
						"max": 20,
						"tooLong": "Значение «Телефон» должно содержать максимум 20 символов.",
						"skipOnEmpty": 1
					});
					yii.validation.required(value, messages, {
						"message": "Необходимо заполнить «Телефон»."
					});
					yii.validation.regularExpression(value, messages, {
						"pattern": /^[-+0-9()\s]+$/,
						"not": false,
						"message": "Только цифры", "skipOnEmpty": 1
					});
				}
			});
		});
	}

// Удаление строки с инпутами
	rootContainer.on("click", ".remove-phone-btn", function () {

		// Удаление валидаторов инпутов
		var inputId = $(this).parent().parent().find("input").attr("id");
		form.yiiActiveForm("remove", inputId);

		// Удаление блока
		$(this).parent().parent().parent().fadeOut().remove();

		// Обновление атрибутов
		updateAttributes();
		// Обновление валидаторов
		inputValidationHandler();
	});

});
