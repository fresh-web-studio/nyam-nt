$(document).ready(function(){
    $(".tab_content").hide();
    $("ul.tabs li:first").addClass("active").show();
    $(".tab_content:first").show();
    $("ul.tabs li").click(function(){
        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".tab_content").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;});

	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
	});

    //Фиксация меню добавляет или убавляет класс fix для ид menu
    var $div = $("#menu");
    $(window).scroll(function () {
        if ($(this).scrollTop() > 182 && $div.hasClass("normal")) {
            $div.removeClass("normal").addClass("fix");
        }
        else if ($(this).scrollTop() <= 182 && $div.hasClass("fix")) {
            $div.removeClass("fix").addClass("normal");
        }
    });



    // Изменение кол-ва товара в детальной карточке товара
    $("#catalog_element_form .product-item-amount-field").on("change", function() {
        calculateProductPrice(); // расчет новой цены
    });
    $("#catalog_element_form .product-item-amount-field-btn-minus, #catalog_element_form .product-item-amount-field-btn-plus").on("click", function() {
        calculateProductPrice(); // расчет новой цены
    });


    // Добавление товара в корзину из детальной карточки товара
    $("#custom_main_detail_buy_button, #custom_small_detail_buy_button").on('click', function() {
        offerID = false;
        if(typeof preEventAddCart ==='function') {
            offerID = preEventAddCart();
        }
        //console.log(111);
        $.ajax({
            type: "POST",
            url: '/local/ajax/add_to_basket_detail.php',
            data: $('#catalog_element_form').serialize()
              + '&product_id=' + $('#catalog_element_form').data("product_id")
              + '&count=' + $("#catalog_element_form .product-item-amount-field").val()
              + '&offerID=' + offerID,
            timeout: 10000,
            error: function(request, error) {
                if (error == "timeout") {
                    alert('timeout');
                }
                else {
                    alert('Error! Please try again!');
                }
            },
            success: function(data) {
                $("#modal__add-to-cart").show();
                setTimeout(function(){$('#modal__add-to-cart').fadeOut('fast')},2000);
                refreshHeaderCart(); //
            }
        });
    });
});

function refreshHeaderCompare(){
    $.ajax({
        type: "GET",
        url: location.href,
        data: "refresh-compare=Y",
        timeout: 10000,
        error: function(request, error) {},
        success: function(HTML) {
            $('#compare_list_count').html(HTML);
        }
    });
}
function refreshHeaderWish(){
    $.ajax({
        type: "GET",
        url: location.href,
        data: "refresh-wish=Y",
        timeout: 10000,
        error: function(request, error) {},
        success: function(HTML) {
            $('#wish_count').html(HTML);
        }
    });
}
function refreshHeaderCart(){
    $.ajax({
        type: "GET",
        url: location.href,
        data: "refresh-cart=Y",
        timeout: 10000,
        error: function(request, error) {},
        success: function(HTML) {
            $('#basket-container').html(HTML);
        }
    });
}

