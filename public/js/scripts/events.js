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
    validateDate();
});

$("#opening_subscription_date").change(function() {
    validateDate();
});

$("#closing_subscription_date").change(function() {
    validateDate();
});

function validateDate(){

    if ($("#event_date").val() == ""){
        console.log("Valor Nulo");
    }else{

        if (!checkDate($("#event_date").val(), Date(), "Data do evento tem de ser superior a data atual")) {
            $("#event_date").css({
                "border-color": "red",
                "background-color": "#FDD"
            });
            $("#event_date_error_box").css("display", "block");
            $("#event_date_error").text("Data do evento tem de ser superior a data atual!");
        } else {
            $("#event_date").css({
                "border-color": "green",
                "background-color": "white"
            });
            $("#event_date_error").text("");
            $("#event_date_error_box").css("display", "none");
        }
    }

    if ($("#opening_subscription_date").val() == "") {
        console.log("Valor Nulo");
    } else {
        if (!checkDate($("#event_date").val(), $("#opening_subscription_date").val(), "Data de abertura da subscrição, deve ser inferior a data do evento")) {
            $("#opening_subscription_date").css({
                "border-color": "red",
                "background-color": "#FDD"
            });
            $("#opening_subscription_date_error_box").css("display", "block");
            $("#opening_subscription_date_error").text("Data de abertura da subscrição, deve ser inferior a data do evento!");
        } else {
            $("#opening_subscription_date").css({
                "border-color": "green",
                "background-color": "white"
            });
            $("#opening_subscription_date_error").text("");
            $("#opening_subscription_date_error_box").css("display", "none");
        }
    }

    if ($("#closing_subscription_date").val() == "") {
        console.log("Valor Nulo");
    } else {
        if (!checkDate($("#closing_subscription_date").val(), $("#opening_subscription_date").val(), "Data de fecho da subscrição, deve ser superior a data de abertura")
            || !checkDate($("#event_date").val(), $("#closing_subscription_date").val(), "Data de fecho da subscrição, deve ser inferior a data do evento") ){
            $("#closing_subscription_date").css({
                "border-color": "red",
                "background-color": "#FDD"
            });
            $("#closing_subscription_date_error_box").css("display", "block");
            $("#closing_subscription_date_error").text("Data de fecho da subscrição, deve ser superior a data de abertura!");
        } else {
            $("#closing_subscription_date").css({
                "border-color": "green",
                "background-color": "white"
            });
            $("#closing_subscription_date_error").text("");
            $("#closing_subscription_date_error_box").css("display", "none");
        }
    }

}

function checkDate(startDt, endDt, message) {
    if (new Date(startDt).getTime() <= new Date(endDt).getTime()) {
        // Your code here
        // alert(message);
        
        return false;
    } else {
       
        return true;
    }
}

