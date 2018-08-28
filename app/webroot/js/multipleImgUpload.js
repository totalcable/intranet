function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img'+id).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

$(document).ready(function(){
var id = 1;
 $("body").on("change", '.img-btn', function(){
   
         if(!$('#img'+id).length){
              var newImg = '<div class="col-md-4 img_prev" id ="imgContainer'+ id +'" >'+
                          '<img class="img_thumb" id="img'+id+'" src="#" />'+
                          '<a  id="'+id+'"  class="btn red removeImg">'+
                          'X'+
			  '</a>'+
                          '</div>';
            $('#prev_image').append(newImg);
         }   
         readURL(this,id);         
          $('.removeImg').click(function(event){
            event.preventDefault();
            var removeid = $(this).attr('id');
            $('#imgContainer'+ removeid).remove();
            $(this).remove();
            $('input#'+ removeid).remove();     
            id++;      
            var fileInput = '<input type="file" name="data[Tolet][images][]" class="form-control hide img-btn" id="'+ id +'">';
            $('.img-upload>label').after(fileInput);
          });          
         id++;        
         $(this).parent().hide();         
        var newFile = '<label class="control-label col-md-offset-7 col-md-3 btn green" style="text-align:center;">'+
                          'Add Image'+
                          '<input type="file" name="data[Tolet][images][]" class="form-control hide img-btn" id="'+id+'">'+
                       '</label>';
                       
        $('.img-upload').after(newFile);        
});

});