$(document).ready(function(){
 $('#account-settings').on('click',function(){
    $(this).parent('li').addClass('active').siblings().removeClass('active');
    $('#accountSettings').fadeIn(1000);
    $('#accountOverview').fadeOut(10);
 });
 $('#account-overview').on('click',function(){
    $(this).parent('li').addClass('active').siblings().removeClass('active');
    $('#accountOverview').fadeIn(1000);
    $('#accountSettings').fadeOut(10);
 });
 
});