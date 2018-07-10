
$(function(){
    ///////////////USTAWIENIA POCZÄ„TKOWE ////////////////////
    
     //uruchomienie pol wyboru komentatorow
    $('#komentatorzy').chosen({
       disable_search_threshold: 1,
       no_results_text: "Nie znaleziono wyników dla frazy",
       search_contains: true,
       width: "100%"
   }).change(function(e){
       document.loginForm.submit();
   });
   
   $('[name=komentarz]').chosen({
       disable_search_threshold: 1,
       no_results_text: "Nie znaleziono wyników dla frazy",
       search_contains: true,
       width: "100%"
   });
    $('[data-toggle="tooltip"]').tooltip(); 

    ////////////////OBSÅ?UGA ZDARZEÅ? //////////////////////////
    
    //edycja tabeli w modalu
        $('body').on('click', 'a[data-target=#myModal]', function(ev) {
            ev.preventDefault();
            var target = $(this).attr("href");
            var id = $(this).parents('.input-group').find('select').attr('name');
            if (undefined != id){
                $("#myModal").attr('data-id',id);
            }
            //w przypadku usuwania zamykamy modal i odœwie¿amy
            $("#myModal .modal-body").load(target);
            if(ev.target.className === "fa fa-trash"){
                setTimeout(function(){  
                    $('#myModal').modal('hide'); 
                    location.reload(true);

                }, 500);
            }else{
                $('#myModal').modal('show');
            }
            
        });
        //wysy³anie formularza w modalu
        $('body').on('click', 'input[data-target=#myModal]', function(ev) {
            ev.preventDefault();
            var $form = $(this).parents('form');
            var target = $form.attr("action");

            $.ajax({
                   url: target,
                   type: 'post',
                   dataType: 'html',
                   data: $form.serialize(),
                   success: function(data){
//                       var id  = $('#myModal').attr('data-id');
//                       var $sel = $("#"+id);
//                       $("#"+id+" option").remove();
//                       $sel.append(data);
//                       $sel.trigger('chosen:updated');; 
                       $('#myModal').modal('hide'); 
                       location.reload();
                   }
               });
        });
});

//////////////////FUNKCJE/////////////////////
