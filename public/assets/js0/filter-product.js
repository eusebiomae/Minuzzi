$(document).ready(function(){

	$('.type_list .type_item[myType="all"]').addClass('active');

	$('.type_item').click(function(){
		var TypeProduct = $(this).attr('myType');

		// ocultando produtos
		$('.product_item').hide();

		// mostrando produtos
		$('.product_item[myType="' + TypeProduct + '"]').show();

		// mostrando todos os produtos
		$('.type_item[myType="all"]').click(function(){
			$('.product_item').show();
		});

	});

});
