  var request=null;
  var redirectUrl ='http://jegeachi.com'; 
function postRequest(formid,fields,processUrl){
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
      var filteredResponse = response.split('####');
    console.log(filteredResponse);    
        if (filteredResponse[0].toLowerCase().indexOf("haserror") >= 0){   
        	 request.abort();
        	$('.alert-error').remove();
         var errorMsg=  filteredResponse[0].replace("hasError", "");
         $('#info-container').append(errorMsg);

        }
        else{
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


// ############## get data by AJAX ######################
    function isLoggedIn(url, callback) {
    $.ajax({
        type : 'GET',
        url : url,
        success : function(data){
            try {
            var arr = data.split(',');
               redirectUrl = arr[1];
                  if(arr[0] =='NO'){
                  $('#studentRegistrationModal').modal('show');
                  }
                                     
            } catch(e) {
                alert("Error trying to parse JSON. Is your server returning JSON? " + e.message);
            }
                     
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            //$('#login_error').show();
            alert("error :: " + textStatus + " : " + errorThrown);
        }
    });
}

 var address = '/frontends/isLooged_in/';
   isLoggedIn(address);
  
       // ############## End get data by AJAX ######################