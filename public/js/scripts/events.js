var numElements = 0;
$(document).ready(function(){
    // console.log("#field" + numElements);
    
    $("#addElement").click(function () {
        
        if ($("#field" + numElements).val() != "" && $("#enumSelect" + numElements).val() != "") {

            console.log(numElements);
            numElements++;

            //will append a list of the possible enums and the necessary fields to insert an extra element to the event subscription
            $("#fields_zone").append("Extra field " + numElements + ': <input id="field' + numElements + '" type="text" name="label' + numElements + '" required pattern="[a-z A-Z]{4,}">' + " ");
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

$("#event_date").change(function(){
    
    if(!checkDate($(this).val(), Date(), "Data de início do evento tem de ser superior a data atual")){
        $(this).css({ "border-color": "red" });
    }else
    {
        $(this).css({ "border-color": "green" });
    }
           
});

$("#opening_subscription_date").change(function() {
    if (!checkDate($("#event_date").val(), $(this).val(), "Data da subscrição, superior ou igual a data do evento!")) {
        $(this).css({ "border-color": "red" });
    } else {
        $(this).css({ "border-color": "green" });
    }
});

$("#closing_subscription_date").change(function() {
    if (!checkDate($("#opening_subscription_date").val(), $(this).val(), "Data de início da subscrição, superior ou igual a data do fim!")) {
        $(this).css({ "border-color": "red" });
    } else {
        $(this).css({ "border-color": "green" });
    }
});


function checkDate(startDt, endDt, message) {
    if (new Date(startDt).getTime() <= new Date(endDt).getTime()) {
        // Your code here
        alert(message);
        
        return false;
    } else {
       
        return true;
    }
}

