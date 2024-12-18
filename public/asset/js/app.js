// $(document).on('click', '.btn-modal', function(e) {
//     e.preventDefault();
//     var container = $(this).data('container');
//     var method = $(this).data('method');
//     $.ajax({
//         url: $(this).data('href'),
//         // dataType: 'html',
//         method:method,
//         success: function(result) {

//             console.log(result,container);

//             $(container)
//                 .html(result)
//                 if(container !='.appac_show'){
//                 .modal('show');
//             }
//         },
//     });
// });


$(document).on('click', '.btn-modal', function(e) {
    e.preventDefault();
    var container = $(this).data('container');
    var method = $(this).data('method'); 
    $.ajax({
        url: $(this).data('href'),
        method: method,
        success: function(result) {
            console.log(result, container);
            $(container).html(result);
            
            if (container !== '.appac_show') {
                $(container).modal('show'); 
            }else{
                $('.appac_hide').hide();
            }
        },
       
    });
});



$(document).on('click', '.change-status', function(e) {
 
    $.ajax({
        url: $(this).data('href'),
        method: 'GET',
        success: function(result) {
          window.location.reload();
        },
       
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('.customer_modal');
    modal.setAttribute('data-bs-backdrop', 'static');
});


