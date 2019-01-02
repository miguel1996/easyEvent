
function displayHiddenContent(id){
	var button = $("#more-button"+id);
	var extra = $(".card-text #extra"+id);
	if(button.attr("value") == "0"){
		extra.css("display", "inline");
		button.text('Less');
		button.attr("value", "1");
	}
	else{
		extra.css("display", "none");
		button.text('More');
		button.attr("value", "0");
	}
}


function checkInput(id){
	var input = $("#"+id +"option:selected").attr("value");//problema aqui, não retorna a opção seleccionada
	console.log(input);
	if(input == 'radio'){
		$('#fields_zone').append("<p>Please note that you need to specify the radio options using the format \"Title, Option1, Option2, ..., OptionN\"!</p>");
	}
}