

$(function () {
    $(".btnddlist").click(function () {
        var ddlist = $(".ddlist");
        if (ddlist.val() == "") {
            //If the "Please Select" option is selected display error.
            alert("Please select a dropdown data!");
            return false;
        }
        return true;
    });
});  

