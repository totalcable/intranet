$(document).ready(function () {
    // ################# product details toggle ########################### 
    $(".product_toggle").click(function () {
        var id = '#info-' + $(this).attr('id');
        $(id).slideToggle();
    });
// ################# End- product details toggle ###########################
// ################# Action details toggle ########################### 
    $(".action_toggle").click(function () {
        var id = '#info-' + $(this).attr('id'); // this id should be changed 
        $(id).slideToggle();
    });
// ################# End- Action details toggle ###########################
});