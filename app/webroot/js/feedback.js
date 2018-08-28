var settings = ( {
    timeout:20000,
    animation_duration:2000
    })
    $(document).ready(function(){
    setInterval(addRotator,settings.timeout);
    function addRotator(){
    var currentFeedback = $(".user-feedback div.current");
    var nextFeedback = currentFeedback.next().length?currentFeedback.next():$(".user-feedback div:first");
	    currentFeedback.removeClass("current").addClass("previous");
            nextFeedback.addClass("current");
            $('.previous').hide(100);
            $('.current').show(1000);
    }
   });// JavaScript Document