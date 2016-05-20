$(document).ready(function(){


window.onload = function () {
	function index(element, collection) {
		var len = collection.length;
		for (var i = 0; i < len; i++) {
			if (element == collection[i]) {
				return i;
			}
		}
	}
	document.getElementById('form').onclick = function (e) {
		var e = e || event;
		var target = e.target || e.srcElement;
		var serch = $('#sort_s').val();
		if (target.type == 'button') {
			var number =index(target, document.getElementsByName('n'));
			//alert(number);
			var sort_s =$(".but-1").eq(number).val();
			console.log(number);
			console.log(serch);
			$('.result_div').empty();


			$.ajax({
				type: "POST",
				url: "sort/sort.php",
				data: "sort_s="+serch+"&tag="+number,
				success: function(html)
				{
					$(".a").html(html);
				}
			});
			
		}
	}

}

	});		
/*$('.but-1').click(function(){
		
		var sort_s =$(".but-1").eq(0).val();
		console.log(sort_s);
		$.ajax({
			type: "POST",
			url: "show.php",
			data: "sort_s="+$("#sort_s").val()+"&tag="+$("#radio-inline").prop("checked"),
			success: function(html)
			{
				$("#content").html(html);
			}
		});
		return false;
	});*/
	
	/* $(document).on( "click", ".advice_variant", function(e){ 

        // ставим текст в input поиска
        $('.form-control-serch').val($(this).text());
        // прячем слой подсказки
        $('#search_advice_wrapper').fadeOut(350).html('');
    });*/
 




