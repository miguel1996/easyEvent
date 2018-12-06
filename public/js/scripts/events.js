var numElements = 0;
$(document).ready(function(){
    $("#addElement").click(function(){
        numElements++;
        $("#fields_zone").append('<li>Extra field '+numElements+': <input type="text" name="label'+numElements+'">');
        $("#fields_zone").append('<select>'+$(".enums").each(function(){
            $("#fields_zone").append('<option value='+$(this).attr('value')+'>'+$(this).attr('value')+'</option>');
        })+'</select></li>');
    });
    
});

