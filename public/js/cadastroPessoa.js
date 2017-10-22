$(document).ready(function () {

	$('#cpf').keyup(function () {
		this.value = this.value.replace(/[^0-9]/g,'');
	});

	setTimeout(function() {
    	$(".callout-danger").fadeOut("slow", function() { $(this).remove(); }); 
  	}, 10000);

  	$('input').change(function () {
  		if($('.'+$(this).attr('name')).hasClass('has-error')) {
  			if ($(this).val().length > 0) {
				$('.'+$(this).attr('name')).removeClass('has-error');
  			}  			
  		}
  	});
});
