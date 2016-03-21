var suggest_count = 0;
var input_initial_value = '';
var suggest_selected = 0;
 
$(window).load(function(){
    // читаем ввод с клавиатуры
    $(".form-control-serch").keyup(function(I){
        // определяем какие действия нужно делать при нажатии на клавиатуру
        switch(I.keyCode) {
            // игнорируем нажатия на эти клавишы
            case 13:  // enter
            case 27:  // escape
            case 38:  // стрелка вверх
            case 40:  // стрелка вниз
            break;
 
            default:
                // производим поиск только при вводе более 2х символов
                if($(this).val().length>2){
 
                    input_initial_value = $(this).val();
                    // производим AJAX запрос к /ajax/ajax.php, передаем ему GET query, в который мы помещаем наш запрос
                    $.get("search.php", { "query":$(this).val() },function(data){
                        //php скрипт возвращает нам строку, ее надо распарсить в массив.
                        // возвращаемые данные: ['test','test 1','test 2','test 3']
                        var list = eval("("+data+")");
                        suggest_count = list.length;
                        if(suggest_count > 0){
                            // перед показом слоя подсказки, его обнуляем
                            $("#search_advice_wrapper").html("").show();
                            for(var i in list){
                                if(list[i] != ''){
                                    // добавляем слою позиции
                                    $('#search_advice_wrapper').append('<div class="advice_variant">'+list[i]+'</div>');
                                }
                            }
                        }
                    }, 'html');
                }
            break;
        }
    });
 
    //считываем нажатие клавишь, уже после вывода подсказки
    $(".form-control-serch").keydown(function(I){
        switch(I.keyCode) {
            // по нажатию клавишь прячем подсказку
            case 13: // enter
            $('.search_button').click();
            return false;
            
            case 27: // escape
                $('#search_advice_wrapper').hide();
                return false;
            break;
            // делаем переход по подсказке стрелочками клавиатуры
            case 38: // стрелка вверх
            case 40: // стрелка вниз
                I.preventDefault();
                if(suggest_count){
                    //делаем выделение пунктов в слое, переход по стрелочкам
                    key_activate( I.keyCode-39 );
                }
            break;
        }
    });
 

 $(document).on( "click", ".advice_variant", function(e){ 

        // ставим текст в input поиска
        $('.form-control-serch').val($(this).text());
        // прячем слой подсказки
        $('#search_advice_wrapper').fadeOut(350).html('');
    });

      /*$('.form-control-serch').keydown(function(){
        alert('good');
    });*/


/*$('.form-control-serch').keydown( function(e){ 
    
    var enter = e.key ;
    if(enter == == 'enter')
    {
            alert( ["enter => " + enter, "", "ctrl => "+ctrl ].join("\n") )

    }
    else
    {

    }
    
} )*/







 
    // если кликаем в любом месте сайта, нужно спрятать подсказку
    $('html').click(function(){
        $('#search_advice_wrapper').hide();
    });
    // если кликаем на поле input и есть пункты подсказки, то показываем скрытый слой
    $('.form-control-serch').click(function(event){
        //alert(suggest_count);
        if(suggest_count)
            $('#search_advice_wrapper').show();
        event.stopPropagation();
    });
});
 
function key_activate(n){
    $('#search_advice_wrapper div').eq(suggest_selected-1).removeClass('active');
 
    if(n == 1 && suggest_selected < suggest_count){
        suggest_selected++;
    }else if(n == -1 && suggest_selected > 0){
        suggest_selected--;
    }
 
    if( suggest_selected > 0){
        $('#search_advice_wrapper div').eq(suggest_selected-1).addClass('active');
        $(".form-control-serch").val( $('#search_advice_wrapper div').eq(suggest_selected-1).text() );
    } else {
        $(".form-control-serch").val( input_initial_value );
    }
}
/*$(function(){
    
    //Живой поиск
    $('.form-control-serch-serch').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'post',
                url: "search.php", //Путь к обработчику
                data: {'referal':this.value},
                response: 'text',
                success: function(data){
                    $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
        }
    })
    
    $(".search_result").hover(function(){
        $(".form-control-serch-serch").blur(); //Убираем фокус с input
    })
    
    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $(".search_result").on("click", "li", function(){
        s_user = $(this).text();
        //$(".form-control-serch-serch").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
        $(".search_result").fadeOut();
    })

})*/
 $(document).ready(function(){
    $( "#datepicker-d-1" ).datepicker( $.datepicker.regional[ "ru" ] );
});
  $(document).ready(function(){
    $( "#datepicker-d2-1" ).datepicker( $.datepicker.regional[ "ru" ] );
});
  $(document).ready(function(){
    $( "#datepicker-d-2" ).datepicker( $.datepicker.regional[ "ru" ] );
});
  $(document).ready(function(){
    $( "#datepicker-d2-2" ).datepicker( $.datepicker.regional[ "ru" ] );
});
  $(document).ready(function(){
    $( "#datepicker-d-3" ).datepicker( $.datepicker.regional[ "ru" ] );
});
  $(document).ready(function(){
    $( "#datepicker-d2-3" ).datepicker( $.datepicker.regional[ "ru" ] );
});