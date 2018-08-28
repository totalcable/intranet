var request=null;
function postRequest(formid,fields,processUrl){
   // alert(processUrl);
	// Variable to hold request
// Bind to the submit event of our form
$(formid).submit(function(event){
$('.alert-error').remove();
 //  Abort any pending request
if(request){
    request.abort();
}
    var $form = $(this);
    var $inputs = $form.find(fields);
    var serializedData = $form.serialize();
    $inputs.prop("disabled", true);
     request = $.ajax({
        url: processUrl,
        type: "post",
        data: serializedData
    });
     // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.log(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        var arr = response.split('####');
        var redirectUrl = arr[0];
          alert(redirectUrl);
       
        if (redirectUrl.toLowerCase().indexOf("haserror") >= 0){
        	 request.abort();
        	$('.alert-error').remove();
         var errorMsg=  redirectUrl.replace("hasError", "");
         $('#info-container').append(errorMsg);

        }
        else{
            redirectUrl=redirectUrl.replace("/frontends", "");
        	window.location.replace(redirectUrl); 
        }
       
    });

    // Prevent default posting of form
    event.preventDefault();
});
}

$(document).ready(function(){
	$('#studentAcc').click(function(){
		$('#sloginForm').hide();
		$('#sregirtrationForm').show(1000);
	});

	$('#studentLogin').click(function(){
		$('#sregirtrationForm').hide();
		$('#sloginForm').show(1000);
	});
    var formid ='#regForm';
    var fields = "input, select, button, textarea";
    var processUrl = 'registration';
    $('#rgstrBtn').click(function(){
    	postRequest(formid,fields,processUrl);
    });
    
     var formid2 ='#loginForm';
     var fields2 = "input, button";
     var processUrl2 = 'login';
    $('#loginBtn').click(function(){
    	postRequest(formid2,fields2,processUrl2);
    });
	
});