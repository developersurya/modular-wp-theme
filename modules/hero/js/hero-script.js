$("#homeslider").carousel({
    //interval: 5000
    interval: false
});
$("#homeslider").swiperight(function() {
    $(this).carousel('prev');
});
$("#homeslider").swipeleft(function() {
    $(this).carousel('next');
});