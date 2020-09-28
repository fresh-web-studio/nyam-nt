// Handle change diameter
$(document).delegate('a[data-role="pizza_diameter"]', 'click', function(e){
	e.preventDefault();
	let
		divPrice = $('div[data-role="buy_price"]'),
		inputQuantity = $('input[data-role="buy_quantity"]'),
		btnBuy = $('a[data-role="buy_button"]');
	divPrice.attr('data-price', $(this).attr('data-price')).text($(this).attr('data-price-formatted'));
	inputQuantity.val('1');
	btnBuy.attr('data-id', $(this).attr('data-id'));
	$(this).children().addClass('goods__active').parent().siblings().children().removeClass('goods__active');
});
// Handle increment/decrement (+ / -)
$(document).delegate('span[data-role="buy_decrement"], span[data-role="buy_increment"]', 'click', function(e){
	e.preventDefault();
	let 
		divPrice = $('div[data-role="buy_price"]'),
		inputQuantity = $('input[data-role="buy_quantity"]'),
		isDecrement = $(this).attr('data-role') == 'buy_decrement',
		delta = isDecrement ? -1 : 1,
		quantity = parseInt(inputQuantity.val()),
		quantityNew = isNaN(quantity) || quantity <= 0 ? 1 : quantity + delta,
		quantityCorrected = quantityNew > 1 ? quantityNew : 1,
		price = divPrice.attr('data-price'),
		summ = quantityNew * price;
	inputQuantity.val(quantityNew);
	divPrice.html(BX.Currency.currencyFormat(summ, 'RUB', true));
});
// Handle change quantity
$(document).delegate('input[data-role="buy_quantity"]', 'input', function(e){
	let 
		divPrice = $('div[data-role="buy_price"]'),
		inputQuantity = $(this),
		quantity = parseInt(inputQuantity.val()),
		quantityNew = isNaN(quantity) || quantity <= 0 ? 1 : quantity,
		quantityCorrected = quantityNew > 1 ? quantityNew : 1,
		price = divPrice.attr('data-price'),
		summ = quantityNew * price;
	inputQuantity.val(quantityNew);
	divPrice.html(BX.Currency.currencyFormat(summ, 'RUB', true));
});

// Handle add to basket
$(document).delegate('a[data-role="buy_button"]', 'click', function(e){
	e.preventDefault();
	let
		productId = $(this).attr('data-id'),
		inputQuantity = $('input[data-role="buy_quantity"]'),
		quantity = parseInt(inputQuantity.val()),
		quantityNew = isNaN(quantity) || quantity <= 0 ? 1 : quantity,
		quantityCorrected = quantityNew > 1 ? quantityNew : 1;
	$.ajax({
		url: location.href,
		type: 'POST',
		data: {ajax_add_to_cart:'Y', product_id: productId, quantity: quantityCorrected},
		datatype: 'json',
		success: function(arJson) {
			if(arJson.Success){
				$.ajax({
						type: 'GET',
						url: location.href,
						data: "refresh-cart=Y",
						success: function(HTML) {
							$('#basket-container').html(HTML);
						}
				});
				$.jGrowl(arJson.SuccessMessage);
			}
			else{
				if(arJson.ErrorMessage){
					$.jGrowl(arJson.ErrorMessage);
				}
			}
		}
	});
});
// Set first active diameter
$(document).ready(function(){
	$('a[data-role="pizza_diameter"]').first().trigger('click');
});

//If there are no trade offers
// Handle increment/decrement (+ / -)
$(document).delegate('span[data-role="buy_decrement_n"], span[data-role="buy_increment_n"]', 'click', function(e){
	e.preventDefault();
	let
		divPrice = $('div[data-role="buy_price_n"]'),
		inputQuantity = $('input[data-role="buy_quantity_n"]'),
		isDecrement = $(this).attr('data-role') == 'buy_decrement_n',
		delta = isDecrement ? -1 : 1,
		quantity = parseInt(inputQuantity.val()),
		quantityNew = isNaN(quantity) || quantity <= 0 ? 1 : quantity + delta,
		quantityCorrected = quantityNew > 1 ? quantityNew : 1,
		price = divPrice.attr('data-price'),
		summ = quantityNew * price;
	inputQuantity.val(quantityNew);
	divPrice.html(BX.Currency.currencyFormat(summ, 'RUB', true));
});
// Handle change quantity
$(document).delegate('input[data-role="buy_quantity_n"]', 'input', function(e){
	let
		divPrice = $('div[data-role="buy_price_n"]'),
		inputQuantity = $(this),
		quantity = parseInt(inputQuantity.val()),
		quantityNew = isNaN(quantity) || quantity <= 0 ? 1 : quantity,
		quantityCorrected = quantityNew > 1 ? quantityNew : 1,
		price = divPrice.attr('data-price'),
		summ = quantityNew * price;
	inputQuantity.val(quantityNew);
	divPrice.html(BX.Currency.currencyFormat(summ, 'RUB', true));
});

// Handle add to basket
$(document).delegate('a[data-role="buy_button_n"]', 'click', function(e){
	e.preventDefault();
	let
		productId = $(this).attr('data-id'),
		inputQuantity = $('input[data-role="buy_quantity_n"]'),
		quantity = parseInt(inputQuantity.val()),
		quantityNew = isNaN(quantity) || quantity <= 0 ? 1 : quantity,
		quantityCorrected = quantityNew > 1 ? quantityNew : 1;
	$.ajax({
		url: location.href,
		type: 'POST',
		data: {ajax_add_to_cart:'Y', product_id: productId, quantity: quantityCorrected},
		datatype: 'json',
		success: function(arJson) {
			if(arJson.Success){
				$.ajax({
					type: 'GET',
					url: location.href,
					data: "refresh-cart=Y",
					success: function(HTML) {
						$('#basket-container').html(HTML);
					}
				});
				$.jGrowl(arJson.SuccessMessage);
			}
			else{
				if(arJson.ErrorMessage){
					$.jGrowl(arJson.ErrorMessage);
				}
			}
		}
	});
});







