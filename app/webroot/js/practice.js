var status = 0;
function checking(data,ans,no){
        var temp = no;
	var results = data.split(','),i;
	ans = parseFloat(Math.round(ans* 100) / 100).toFixed(2);
	
         correct = parseFloat(results[--no]);
         givenAns = parseFloat(ans);
         
	if(correct == givenAns){
	 
	 $('#notSolveBtn'+ temp).hide();
	  $('#wrong'+ no).hide();
	  $('#ok'+ no).show();
	  status = 1;
	}
	else{
	  $('#ok'+ no).hide();
	  $('#wrong'+ no).show();
	  $('#notSolveBtn'+ temp).show();
	  status = 0;
	}	
}

function check_ans(ans,no){
  var url = 'AnswerSheet/'+
    $('#student_id').val()+
    '.txt';
   
    $.get(url, function(data) {
          checking(data,ans,no)
    }, 'text');
}

function check_empty_ans(currentID){
	var current = '#pQuestion' + currentID;
	var ans = $(current+' input').val();
	if(!$.trim(ans).length){
	alert('Answer first');
	$('#notSolveBtn'+currentID).show();
	return false;
	}
}

$(document).ready(function(){
//initialization part
var totalQ = $('.text_desc ').length;
$('.prevBtn').hide();
$('#pQuestion1').show();

$('.ckeckBtn').click(function(){
var currentID = $(this).attr('id');

var current = '#pQuestion' + currentID;
var ans = $(current+' input').val();
check_empty_ans(currentID);
check_ans(ans,currentID);
});

$('.nextBtn').click(function(){
var currentID = $(this).attr('id');
var current = '#pQuestion' + currentID;
if(!$.trim($(current+' input').val()).length){
alert('Answer first');
$('#notSolveBtn'+currentID).show();
return false;
}

var ans = $(current+' input').val();

check_ans(ans,currentID);

if(status == 1){
  $('.prevBtn').show();
  $('#notSolveBtn'+currentID).hide();
  $(current).hide(1000);
    if(totalQ-currentID == 1){
  $('.nextBtn').hide();
  }
  var next = '#pQuestion' + ++currentID;
   $(next).show(1000);
}
});

$('.notSolveBtn').click(function(){
var currentID = $(this).attr('name');
var current = '#pQuestion' + currentID;

$('.prevBtn').show();
if(totalQ-currentID == 1){
  $('.nextBtn').hide();
}

$(current).hide(1000);
var next = '#pQuestion' + ++currentID;
$(next).show(1000);

});

$('.prevBtn').click(function(){
$('.nextBtn').show();
var currentID = $(this).attr('id');
if(currentID == 2){
  $('.prevBtn').hide();
}

var current = '#pQuestion' + currentID;
$(current).hide(1000);
var prev = '#pQuestion' + --currentID;
$(prev).show(1000);

});

});