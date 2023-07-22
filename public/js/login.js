// JavaScript Document
// initialize validation messages variable
$.validation = {
    messages: {}
};

// add validation templates to show fancy icons with message text
$.extend($.validation.messages, {
    required: '<span class="text-danger"><small>Porfavor ingrese sus datos.</small></span>'    
});

// call our 'validateLoginForm' function when page is ready
$(document).ready(function () {
    validateLoginForm();
});

// bind jQuery validation event and form 'submit' event
var validateLoginForm = function () {
    var form_login = $('#form_login');
    var login_result = $('.ms-login-alert');

    // bind jQuery validation event
    form_login.validate({
		errorElement: "div",		
        rules: {
            username: {
                required: true,     // email field is required                
            },
            pwd: {
                required: true      // password field is required
            }
        },
        messages: {
            username: {
                required: $.validation.messages.required,
                email: $.validation.messages.email
            },
            pwd: {
                required: $.validation.messages.required
            }
        },
        errorPlacement: function (error, element) {
            // insert error message after invalid element
            error.insertAfter(element);

            // hide error message on window resize event
            $(window).resize(function () {
                error.remove();
            });
        },
        invalidHandler: function (event, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
            } else {
            }
        }
    });

    var username = $('#username');
    var pwd = $('#pwd');

    // bind form submit event
    form_login.on('submit', function (e) {
        //var remember = login_remember.is(':checked') ? 1 : 0;

        // if form is valid then call AJAX script
        if (form_login.valid()) {
						
            var ajaxRequest = $.ajax({
                type: "POST",
				url: "user/signIn",
				data: {		username: username.val(),
						 	pwd: pwd.val()
					},
				beforeSend: function(){
					//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
				}
            });

            ajaxRequest.fail(function (data, status, errorThrown) {
                // error
                var $message = data.responseText;
                login_result.html('<span class="alert alert-danger">' + $message + '</div>');
            });

            ajaxRequest.done(function (response) {
                // done
                //var $response = $.parseJSON(response);
                //login_result.html('<div class="alert alert-success">' + $response.message + '</div>');
				
				if(response == 1){
					//location.reload();								
					login_result.html('<div class="alert alert-success">Datos correctos</div>')
							setTimeout(function() {
								login_result.fadeOut("slow")
								location.href = "user/main"
							}, 1000);
							
				}else{                       
					//alert("Usuario o Password Incorrectos");											
					login_result.html('<div class="alert alert-danger">Usuario o Contraseña Incorrectos</div>');
				}
            });
        }

        // stop default submit event of form
        e.preventDefault();
        e.stopPropagation();
    });
}

function signIn(){
	var form = $('form').attr('id');	
	var username = $('#'+form).find('input[name="username"]').val();
	var password = $('#'+form).find('input[name="pwd"]').val();
	
	$.ajax({
		type: "POST",
		url: "user/signIn",
		data: {username: username, pwd: password},
		beforeSend: function(){
			//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
		},
		complete: function(){
			//$(".sub-fom-text").hide().remove();
		},
		success: function(res) {
			//alert(response);
			if(res == 1){
				//location.reload();
				
				$(".ms-login-alert").addClass('alert-success')
				$(".ms-login-alert").html('Datos correctos')
                        setTimeout(function() {
                            $(".ms-login-alert").fadeOut("slow")
							//location.href = "user/main"
                        }, 1000);
			}else{                       
				//alert("Usuario o Password Incorrectos");						
				$('.ms-login-alert').addClass('alert-danger');
				$('.ms-login-alert').html('Usuario o Password Incorrectos');
			}
		}  		
		});
	}