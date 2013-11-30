$(document).ready(function(){    
	$('#wpmem_login').hide();
	$('#wpmem_reg').hide();
	$('.modal_register').click(function(){
		 $('#wpmem_reg').popup({
            'autoopen': true, 
        });
	});
		$('#planid').change(function(){
		planid=$(this).val();
		var price="";
		if(planid=="sci-subs-monthly"){
			price=4.99
		}
		if(planid=="sci-subs-quaterly"){
			price=12.99
		}
		if(planid=="sci-subs-half-yearly"){
			price=24.99
		}
		if(planid=="sci-subs-yearly"){
			price=45.99
		}
		$('#subs-price').html('$'+price);
	});
	html="<span id='subs-price'></span>";
	$('#planid').after(html);
	$('#planid').change();
});
