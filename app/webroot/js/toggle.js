$(document).ready(function(){
    $('.toggleDiv').click(function (e){
        e.preventDefault();
        var taget = $(this).attr('href');
        $('.hideRest').hide();
        $('#'+taget).toggle();
        
    });
});

