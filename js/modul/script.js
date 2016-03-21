$(document).ready(function(){

	$('#id_fac').change(function(){
		$.ajax({
			type: "POST",
			url: "show.php",
			data: "id="+$("#id_fac").val()+"&type="+$("#radio-inline").prop("checked"),
			success: function(html)
			{
				$("#content").html(html);
			}
		});
		return false;
	});
		$(document).on( "click", "#id_spec", function(e){
		$.ajax({
			type: "POST",
			url: "show.php",
			data: "id_spec="+$("#id_spec").val(),
			success: function(html)
			{
				$("#content2").html(html);
			}
		});
		return false;
	});

	$(document).on( "click", "#id_kurs", function(e){
		$.ajax({
			type: "POST",
			url: "show.php",
			data: "id_kurs="+$("#id_kurs").val(),
			success: function(html)
			{
				$("#content3").html(html);
			}
		});
		return false;
	});

	$(document).on( "click", "#id_group", function(e){
		$.ajax({
			type: "POST",
			url: "show.php",
			data: "id_group="+$("#id_group").val(),
			success: function(html)
			{
				$("#content4").html(html);
			}
		});
		return false;
	});

		$(document).on( "click", "#id_name", function(e){
		$.ajax({
			type: "POST",
			url: "show.php",
			data: "id_name="+$("#id_name").val(),
			success: function(html)
			{
				$("#content5").html(html);
			}
		});
		return false;
	});

	/* $(document).on( "click", ".advice_variant", function(e){ 

        // ставим текст в input поиска
        $('.form-control-serch').val($(this).text());
        // прячем слой подсказки
        $('#search_advice_wrapper').fadeOut(350).html('');
    });*/
 

	});



