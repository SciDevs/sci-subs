$(document).ready(function(){    
	$('#wpmem_login').hide();
	$('#wpmem_reg').hide();
	$('.modal_register').click(function(){
		 $('#wpmem_reg').popup({
            'autoopen': true, 
        });
	});
	//$('#wpmem_reg').popup();
});
