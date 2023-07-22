// JavaScript Document
function add_usuario(){					
        $('#fonrm_admins').validationEngine({
            scroll: false,
            promptPosition: "topLeft", 
            onValidationComplete: function(form, status)
            {
                if ( $('#fonrm_admins').validationEngine('validate')==true) {					 				   	
				   
				   	//var file_data = $('#imagen_usu').prop('files')[0];   					
				   	//var form_data = new FormData();                  					
				   	//form_data.append('file', file_data);				
					   				   				   	
					var form_data = new FormData($('form#fonrm_admins')[0]);                  
					$.ajax({						
						url: 'add_usuarios',
						//dataType: 'text',
					  	type: "POST",
					  	cache: false,
					  	contentType: false,
					  	processData: false,						
					  	data: form_data,
					  	//mimeType:"multipart/form-data",
					  	beforeSend: function(){
							//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
					  	},
					  	complete: function(){
						  	//$(".sub-fom-text").hide().remove();
					  	},
					  	success: function(res) {
						  	//var new_array = JSON.parse(res)
							if( res == 1){	
							//$(".sub_content_usuarios").html(res);
								alert("Exito! Datos guadados.");
								location.href="main";
							}else{
								alert("Fallo!. Lo sentimos.")
								}
					 	}        
				  	});
                }
            }
        });
	}
