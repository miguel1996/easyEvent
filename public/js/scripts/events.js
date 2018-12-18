var numElements = 0;
$(document).ready(function(){
    // console.log("#field" + numElements);
    
    $("#addElement").click(function () {
        
        if ($("#field" + numElements).val() != "" && $("#enumSelect" + numElements).val() != "") {

            console.log(numElements);
            numElements++;

            //will append a list of the possible enums and the necessary fields to insert an extra element to the event subscription
            $("#fields_zone").append("Extra field " + numElements + ': <input id="field' + numElements + '" type="text" name="label' + numElements + '" required pattern="[a-zA-Z]{4,}">' + " ");
            $("#fields_zone").append("Extra field type " + numElements + ':<select id="enumSelect' + numElements + '" name="enumSelect' + numElements + '" required></select><br><br>');
            $("#enumSelect" + numElements).append('<option style="display:none">' + "</option>");
            $(".enums").each(function () {
                $("#enumSelect" + numElements).append("<option value=" + $(this).attr("value") + ">" + $(this).attr("value") + "</option>");
                // the page will scroll to the button so that when we add an element we can see the part of the page that was updated
                $([
                    document.documentElement,
                    document.body
                ]).animate({ scrollTop: $("#enumSelect"+numElements).offset().top -200 }, 1); //this blocked with 2000 instead of 1
                $("#numOfElements").val(numElements);
            });
        };
    });

});

