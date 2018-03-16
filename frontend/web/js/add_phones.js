/**
 * Created by Администратор on 23.12.2017.
 */
$(document).ready(function () {
	var maxFields = 3,
		i = 1,
		formPhonesCreate = $('#form-phones-create'),
		addPhoneBtn = formPhonesCreate.find('.add-phone-btn'),
		input = '<input id="userphones-phone" class="form-control" name="UserPhones[phone][]" placeholder="8 xxx xxx xx xx" type="text">',
		errorDiv = '<div class="col-sm-offset-2 col-sm-5"><p class="help-block help-block-error"></p></div>',
		removeBtn = '<button class="btn btn-default remove-phone-btn" type="button" title="Удалить телефон"><i class="fa fa-times" aria-hidden="true"></i></button>';

	$(addPhoneBtn).click(function (e) {
		e.preventDefault();
		if (i < maxFields) {
			i++;
			formPhonesCreate.append('<div class="form-group field-userphones-phone required"><div class="col-sm-offset-2 col-sm-5">' + input + '</div><div class="col-sm-1">' + removeBtn + '</div>' + errorDiv + '</div>');
		}
		formPhonesCreate.on('click', '.remove-phone-btn', function (e) {
			e.preventDefault();
			$(this).parent().parent('div').remove();
			i--;
		})
	});

	var formPhonesUpdate = $('#form-phones-update'),
		length = formPhonesUpdate.find('div.form-group.field-userphones-phone').length;

	$(formPhonesUpdate).on('click', '.add-phone-btn', function (e) {
		e.preventDefault();

		if (length < maxFields) {
			length++;
			formPhonesUpdate.append('<div class="form-group field-userphones-phone required"><div class="col-sm-offset-2 col-sm-5">' + input + '</div><div class="col-sm-1">' + removeBtn + '</div>' + errorDiv + '</div>');
		}
	});

	$(formPhonesUpdate).on('click', '.remove-phone-btn', function (e) {
		e.preventDefault();
		$(this).parent().parent('div').remove();
		length--;
	});
});
