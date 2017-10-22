$(document).ready(function(){

	$(".tipoDeContagem").click(function(event){
		$("#" + $(this).data('enable')).prop('disabled', false);
		$("#" + $(this).data('disable')).prop('disabled', true);
	});

	$('.contar').click(function(){Pace.restart();});

    setTimeout(function() {
    	$(".resultado").fadeOut("slow", function() { $(this).remove(); }); 
    	$(".callout-danger").fadeOut("slow", function() { $(this).remove(); }); 
  	}, 10000);
});