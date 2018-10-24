console.log('working....');
jQuery(document).ready(function($){

    
    
    $(document).on('click','.general-enquiry-form',function(){

        var trip_data_title_local = $(this).data('title');
        localStorage.setItem('modal_title',trip_data_title_local);
    });

    // show.bs.modal => This event fires immediately when the show instance method is called.
    // shown.bs.modal => This event is fired when the modal has been made visible to the user (will wait for CSS transitions to complete).

    // $('#general-enquiry-form').on('shown.bs.modal', function () {

    //     var trip_title = $('.title-for-modal').html();
    //     var trip_data_title = localStorage.getItem('modal_title');
    //     if(trip_title){
    //         $('.form-trip-title input').val(trip_title);
    //     }else{
    //         $('.form-trip-title input').val(trip_data_title);

    //     }
    // });

    //Booking form JS
    
    //home-page inquiry logic
    $(document).on('click','.home-inq-btn,.enq-without-date',function(){
        
        var data = $(this).attr('data-title');
        $('.top-trip-title input').val(data);
        //$('.border-btm').remove();
        $('.top-trip-title').after('<h1 class="border-btm">'+ data +'</h1>');
       
        $('.top-trip-title').hide();
        localStorage.setItem('trip_title',data);
        setTimeout(
            function(){
                $('.top-trip-title').after('<h1 class="border-btm">'+ data +'</h1>');
            },1000);
    });
    
        
});
jQuery(document).load(function($){
  
});