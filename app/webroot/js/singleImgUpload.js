function readSingleURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#prev_image'+id+' img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

$(document).ready(function(){
 $("body").on("change", '.single_img_btn', function(){
   
                var id = $(this).attr('id');
                
              var newImg = '<div class="img_prev" >'+
                          '<img class="img_thumb"  src="#" />'+
                          '</div>';
            $('#prev_image'+id).html(newImg);
            
         readSingleURL(this,id);         
                          
});

});

