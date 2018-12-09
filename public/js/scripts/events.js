var numElements = 0;
$(document).ready(function(){
    $("#addElement").click(function(){
        numElements++;
        $("#fields_zone").append('<li>Extra field '+numElements+': <input type="text" name="label'+numElements+'">');
        $("#fields_zone").append('<select id=enumSelect></select></li>');
        $(".enums").each(function(){
            $("#enumSelect").append('<option value='+$(this).attr('value')+'>'+$(this).attr('value')+'</option>');
        });
    });
});

