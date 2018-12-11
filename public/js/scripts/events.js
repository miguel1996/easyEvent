var numElements = 0;
$(document).ready(function(){
    $("#addElement").click(function(){
        numElements++;
       //will append a list of the possible enums and the necessary fields to insert an extra element to the event subscription
        $("#fields_zone").append('<li>Extra field '+numElements+': <input type="text" name="label'+numElements+'>');
        $("#fields_zone").append('<select id=enumSelect'+numElements+'></select></li>');
        $(".enums").each(function(){
            $("#enumSelect"+numElements).append('<option value='+$(this).attr('value')+'>'+$(this).attr('value')+'</option>');
        // the page will scroll to the button so that when we add an element we can see the part of the page that was updated
            $([document.documentElement, document.body]).animate({
            scrollTop: $("#addElement").offset().top
        }, 1); //this blocked with 2000 instead of 1
        // $('body').animate({scrollTop: $('#addElement').offset().top - $('body').offset().top + $('body').scrollTop()});
        });
    });
});

