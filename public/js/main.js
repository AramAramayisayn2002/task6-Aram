var logpassword = $('#logpassword');
//----------this function for the password to appear----------//
$('#iconPass').click(function () {
	if (logpassword.attr('type') === 'password') {
		logpassword.attr('type', 'text');
	} else {
		logpassword.attr('type', 'password');
	}
})

function inCard(tag) {
	let id = $(tag).data('id');
	$.ajax({
		url: 'http://localhost/intership/electronic.am/index/inCard',
		type: 'post',
		dataType: 'json',
		data: { 'id': id },
		success: function (res) {
			if ('error' in res) {
				alert(res.error)
			}
		}
	})
}
function decrease_btn(button) {
	let input = $(button).closest('.quantity').find('input');
	let id = input.data('id');
	let quantity = input.val();
	quantity--;
	let sum = $(button).closest('tr').find('.finalPrice');
	$.ajax({
		url: 'http://localhost/intership/electronic.am/index/inCardQuantity',
		type: 'post',
		dataType: 'json',
		data: { 'id': id, 'quantity': quantity},
		success: function (res) {
			if ('quantity' in res) {
				input.val(res.quantity);
				if ('price' in res) {
					sum.text(res.price);
				}
			} else {
				window.location.href = 'http://localhost/intership/electronic.am/error';
			}
		}
	})
}

function increase_btn(button) {
	let input = $(button).closest('.quantity').find('input');
	let id = input.data('id');
	let sum = $(button).closest('tr').find('.finalPrice');
	let quantity = input.val();
	quantity++;
	$.ajax({
		url: 'http://localhost/intership/electronic.am/index/inCardQuantity',
		type: 'post',
		dataType: 'json',
		data: { 'id': id, 'quantity': quantity},
		success: function (res) {
			if ('quantity' in res) {
				input.val(res.quantity);
				if ('price' in res) {
					sum.text(res.price);
				}
			} else {
				window.location.href = 'http://localhost/intership/electronic.am/error';
			}
		}
	})
}
