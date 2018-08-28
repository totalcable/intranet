$(document).ready(function(){
    $('.sub-menu li>a').on('click',function(event){
        //event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        $('.open').addClass('active');
        //alert('it works');
        //console.log($(this).parent());
    });
});