
//cancel a subscription through ajax
function cancelSub(id) {
    var validate = confirm(
        "Tem a certeza que quere cancelar a subcrição?"
    );
    if (!validate) {
        return false;
    } else {
        var token = $("#myToken").val();
        $.post("subscriptions/delete", "_token=" + token+"&event_id=" + id,
            function (responseTxt, statusTxt, xhr) {
                if(statusTxt === "success"){
                    $('#'+id).remove();
                }else{
                    alert(responseTxt);
                }
            }
        ).fail(function(responseTxt, statusTxt, xhr) { alert("Erro ao cancelar subscrição"); });
    }
}