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
var block = $('#ads-sort-block'),
	typesortCookie = Cookies.get('typesortCookie'),
	datesortCookies = Cookies.get('datesortCookies'),
	pricesortCookies = Cookies.get('pricesortCookies'),
	citysortCookie = Cookies.get('citysortCookie'),
	categorysortCookie = Cookies.get('categorysortCookie'),
	subcatsortCookie = Cookies.get('subcatsortCookie'),
	savesortCookie = Cookies.get('savesortCookie'),
	subcategorySelect = block.find('#subcategory-sort').find('select'),
	categorySelect = block.find('#category-sort').find('select'),
	categorySelectVal,
	self = window.location.href,
	url = 'site/subcat';

// Смотрим куки и ставим выпадающие списки
if (typesortCookie) {
	block.find('#type-sort').find('select [value="' + typesortCookie + '"]').attr('selected', 'selected');
}
if (citysortCookie) {
	block.find('#city-sort').find('select [value="' + citysortCookie + '"]').attr('selected', 'selected');
}
if (categorysortCookie) {
	block.find('#category-sort').find('select [value="' + categorysortCookie + '"]').attr('selected', 'selected');
}
if (datesortCookies) {
	block.find('#date-sort').find('button[data-id=' + datesortCookies + ']').toggleClass('btn-default btn-primary').siblings('input[type=hidden]').val(datesortCookies);
}
if (pricesortCookies) {
	block.find('#price-sort').find('button[data-id=' + pricesortCookies + ']').toggleClass('btn-default btn-primary').siblings('input[type=hidden]').val(pricesortCookies);
}

// Обработка кнопок больше/меньше
block.find('button:not([type=submit],[type=reset])').click(function (e) {
	e.preventDefault(); //console.log( this );
	var siblingsBtn = $(this).siblings('.btn'); //console.log( siblingsBtn );
	var inputHidden = $(this).siblings('input[type=hidden]'); //console.log(inputHidden);
	var id = $(this).attr('data-id');
	var val = inputHidden.val();

	$(this).toggleClass('btn-default btn-primary');
	if (siblingsBtn.hasClass('btn-primary')) {
		siblingsBtn.removeClass('btn-primary').addClass('btn-default');
	}

	if (( val === '' ) || ( val !== id )) {
		inputHidden.val(id);
	} else if (val === id) {
		inputHidden.val('');
	}
});

// Кнопка сброса
block.find('button[type=reset]').click(function () {
	$(':input', block).not(':button, :submit, :reset').val('');
	block.find('select').attr('selected', false);
	block.find('#subcategory-sort').find('select').attr('disabled', true);
	block.find('button:not([type=submit],[type=reset])').removeClass('btn-primary').addClass('btn-default');

	Cookies.remove('typesortCookie');
	Cookies.remove('datesortCookies');
	Cookies.remove('pricesortCookies');
	Cookies.remove('citysortCookie');
	Cookies.remove('categorysortCookie');
	Cookies.remove('subcatsortCookie');
	Cookies.remove('savesortCookie');
	$(location).attr('href', self);
});

// Подраздел
categorySelectVal = categorySelect.find(':selected').val(); //console.log(categorySelectVal);
if ((categorySelectVal !== '') && (typeof categorySelectVal !== 'undefined')) {
	$.ajax({
		url: url,
		data: 'depdrop_parents=' + categorySelectVal,
		method: 'post',
		success: function (data) {
			createList(data);
			subcategorySelect.find('[value="' + subcatsortCookie + '"]').attr('selected', true);
		},
		error: function () {
			console.log('error');
		}
	});
}

// Категория
categorySelect.change(function () { //console.log(categorySelectVal);
	categorySelectVal = $(this).val();
	if (categorySelectVal === '') {
		subcategorySelect.attr('disabled', true);
		subcategorySelect.find('[value="' + subcatsortCookie + '"]').attr('selected', false);
		subcategorySelect.find('[value=""]').attr('selected', true);
		return false;
	}
	categorySelect.attr('selected', false);
	categorySelect.find('[value=' + categorySelectVal + ']').attr('selected', true);
	categorySelect.val(categorySelectVal); //console.log(categorySelectVal);
	$.ajax({
		url: url,
		data: "depdrop_parents=" + categorySelectVal,
		method: 'post',
		success: function (data) {
			createList(data);
		},
		error: function () {
			console.log('get connect error');
			return false;
		}
	});
});

// Меню сортировки
var sortCookie = Cookies.get('sortCookie');
if (sortCookie) {
	block.addClass('in');
}
$('#ads-sort').click(function () {
	block.collapse('toggle');
});
block.on('shown.bs.collapse', function () {
	Cookies.set("sortCookie", "1", 7);
});
block.on('hidden.bs.collapse', function () {
	Cookies.remove('sortCookie');
});

function createList(data) {
	var data = $.parseJSON(data);
	var options = '';
	if (data.output !== null) {
		$(data.output).each(function (i, val) {
			options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('name') + '</option>';
		});

		subcategorySelect.html(options);
		subcategorySelect.find('option:first').text('По подкатегории');
		subcategorySelect.attr('disabled', false);
	}
}



