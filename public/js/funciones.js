// JavaScript Document
function base_url(){
	var pathArray = location.href.split( '/' );
	var protocol = pathArray[0];
	var host = pathArray[2];
	//window.url = protocol + '//' + host;
	var BASEURL = protocol+'//' + host +"/"; //codigo para funcionamiento en el servidor
	//var BASEURL = protocol+'//' + host +"/administradorcatalogomovistar/"; //codigo para funcionamiento localS
	//var BASEURL = protocol+'//' + host +"/";
	return BASEURL;
	}
	
function accion_usu(tipo){		
	if(tipo == 1){		
		location.href="form?tipo="+tipo;	
	}else if(tipo == 2){
		var checked_usu = $( ".radio_usuarios" );
		if(checked_usu.is(':checked')){
			var val_codusu = $( "input[name=cod-usu]:checked" ).val()
			location.href="form?tipo="+tipo+"&codUsu="+val_codusu;		
		}else{
			alert("Por favor, seleccioné un usuario.")
		}				
	}else if(tipo == 3){
		var checked_usu = $( ".radio_usuarios" );
		if(checked_usu.is(':checked')){
			var val_codusu = $( "input[name=cod-usu]:checked" ).val()			
			var r = confirm("Esta operación eliminará al usuario seleccionado. ¿Está seguro de que desea continuar?");
			if (r == true) {
				txt = "You pressed OK!";
			
				$.ajax({						
					url: 'deleteData',
					//dataType: 'text',
					type: "GET",
					cache: false,
					contentType: false,
					processData: false,						
					data: 'id='+val_codusu,
					//mimeType:"multipart/form-data",
					beforeSend: function(){
						//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
						$(".loader").fadeIn("slow");
					},
					complete: function(){
						//$(".sub-fom-text").hide().remove();
						$(".loader").fadeOut("slow");
					},
					success: function(res) {
						//var new_array = JSON.parse(res)				
						//alert(res)					
						if(res == 1){
							$("#row_"+val_codusu).hide().remove();
						}else{
							alert('Fallo, inténtelo nuevamente.')
							}
					}        
				});	
			}
		}else{
			alert("Por favor, seleccioné un usuario.")
		}
	}else if(tipo == 4){
		var checked_usu = $( ".radio_usuarios" );
		if(checked_usu.is(':checked')){
		var val_codusu = $( "input[name=cod-usu]:checked" ).val()
			$.fancybox({
				'width'           	: 700,
			    'height'            : 420,
				'transitionIn'      : 'none',
				'autoScale'         : false,
				'autoSize'			: false,
				'transitionOut'     : 'none',
				'titlePosition'     : 'over',
				'href'				: base_url()+'usuarios/view?id='+val_codusu,
				'type'          	: 'iframe',
				'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">' +  (title.length ? '' + title : '') + '</span>';
				}
			});				
		}else{
			alert("Por favor, seleccioné un usuario.")
		}			
	}
}
function accion_clie(tipo){	
	if(tipo == 1){		
		location.href="form?tipo="+tipo;	
	}else if(tipo==2){
		var checked_clie = $( ".radio_clie" );
		if(checked_clie.is(':checked')){
			var val_codclie = $( "input[name=cod-clie]:checked" ).val()
			location.href="form?tipo="+tipo+"&codClie="+val_codclie;
		}else{
			alert("Por favor, seleccioné un cliente.")
			}
	}else if(tipo == 3){
		var checked_clie = $( ".radio_clie" );
		if(checked_clie.is(':checked')){
			var val_codclie = $( "input[name=cod-clie]:checked" ).val()			
			var r = confirm("Esta operación eliminará al cliente seleccionado. ¿Está seguro de que desea continuar?");
			if (r == true) {			
				$.ajax({						
					url: 'deleteData',
					//dataType: 'text',
					type: "GET",
					cache: false,
					contentType: false,
					processData: false,						
					data: 'id='+val_codclie,
					//mimeType:"multipart/form-data",
					beforeSend: function(){
						//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
					},
					complete: function(){
						//$(".sub-fom-text").hide().remove();
					},
					success: function(res) {
						//var new_array = JSON.parse(res)				
						//alert(res)					
						if(res == 1){
							$("#row_"+val_codclie).hide().remove();
						}else{
							alert('Fallo, inténtelo nuevamente.')
							}
					}        
				});	
			}
		}else{
			alert("Por favor, seleccioné un usuario.")
		}
	}else if(tipo == 4){
		var checked_clie = $( ".radio_clie" );
		if(checked_clie.is(':checked')){
		var val_codclie = $( "input[name=cod-clie]:checked" ).val()
			$.fancybox({
				'width'           	: 700,
			    'height'            : 350,
				'transitionIn'      : 'none',
				'autoScale'         : false,
				'autoSize'			: false,
				'transitionOut'     : 'none',
				'titlePosition'     : 'over',
				'href'				: base_url()+'clientes/view?id='+val_codclie,
				'type'          	: 'iframe',
				'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">' +  (title.length ? '' + title : '') + '</span>';
				}
			});				
		}else{
			alert("Por favor, seleccioné un cliente.")
		}			
	}
}


function ven_panle_btns(){
	/*=============================
	 * Eventos del panel de botones
	 *===========================*/
	 
	$(".ven_add_prod").click(function(){ //Muestra el popUp oculto del catalogo de prodctos.
		document.getElementById('popup_prods').style.display = "block";
		});
	
	$(".ven_elim_prod").click(function(){ //Elimana la fila del item
		var checked_elm_prod= $( ".rad-vent-prod" );
		if(checked_elm_prod.is(':checked')){
			var val_id = $( "input[name=rad-vent-prod]:checked" ).val()			
			$("#row-"+val_id).remove();			
		}
		});
		
	$(".cal_oper").click(function(){ //Mostrar precio minimo
		var checked_elm_prod= $( ".rad-vent-prod" );
		if(checked_elm_prod.is(':checked')){
			var val_id = $( "input[name=rad-vent-prod]:checked" ).val()	
			var cant_val = $("#vent_prod_cant-"+val_id).val();
			var prec_min = $(".prec-min-"+val_id).val();
			
			$(".prec-pub-"+val_id).val(prec_min);
			if(cant_val != '' && cant_val != 0 ){
				var new_imp = 	cant_val * prec_min;
				$("#vent_prod_imp-"+val_id).val(new_imp.toFixed(2));
				}
						
			//alert(val_id)
		}else{
			alert("Por favor, selecioné un producto.")
			} 

		});	
	
	}


function searchtxtprod(){ //Busca el producto por la similitud de nombre.
		var val_cod = $("#find_prodCod").val();
		var val_text = $("#find_prod").val();
		$.ajax({						
			url: 'popup',
			//dataType: 'text',
			type: "GET",
			cache: false,
			contentType: false,
			processData: false,						
			data: 'fin_prod_vent='+val_text+'&find_prodCod='+val_cod,
			//mimeType:"multipart/form-data",
			beforeSend: function(){
				//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
			},
			complete: function(){
				//$(".sub-fom-text").hide().remove();
			},
			success: function(res) {
				//var new_array = JSON.parse(res)				
				//alert(res)
				$(".tbl_prods_list").html(res)
			}        
		});	
		return false;
				
};

function searchtxtprodCat(id){ //Busca el producto por la similitud de nombre.

	$.ajax({						
		url: 'showprodscat',
		//dataType: 'text',
		type: "GET",
		cache: false,
		contentType: false,
		processData: false,						
		data: 'find_prodCat='+id,
		//mimeType:"multipart/form-data",
		beforeSend: function(){
			//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
		},
		complete: function(){
			//$(".sub-fom-text").hide().remove();
		},
		success: function(res) {
			//var new_array = JSON.parse(res)				
			//alert(res)
			//$(".btn-atras-categorias").fadeIn("fast");
			$(".tbl_prods_list").html(res)
			
		}        
	});	
	return false;
			
};

function searchtxtCat(){ //Busca el producto por la similitud de nombre.

	$.ajax({						
		url: 'showcategorias',
		//dataType: 'text',
		type: "GET",
		cache: false,
		contentType: false,
		processData: false,	
		//mimeType:"multipart/form-data",
		beforeSend: function(){
			//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
		},
		complete: function(){
			//$(".sub-fom-text").hide().remove();
		},
		success: function(res) {
			//var new_array = JSON.parse(res)				
			//alert(res)
			//$(".btn-atras-categorias").fadeOut("fast");
			$(".tbl_prods_list").html(res)
		}        
	});	
	return false;
			
};

function formSearch(idForm,direcUrl,idBtn){
	
	$('#'+idBtn).click(function(){
		$('#'+idForm).submit();		
	});
}

function formData(idForm,direcUrl){					
        //$("#"+idForm).validationEngine();
	    $('#'+idForm).validationEngine({
            scroll: false,
            promptPosition: "topLeft", 
            onValidationComplete: function(form, status)
            {
                if ( $('#'+idForm).validationEngine('validate')==true) {
					   				   				   	
					var form_data = new FormData($('form#'+idForm)[0]);                  
					$.ajax({						
						url: direcUrl,
						//dataType: 'text',
					  	type: "POST",
					  	cache: false,
					  	contentType: false,
					  	processData: false,						
					  	data: form_data,
					  	//mimeType:"multipart/form-data",
					  	beforeSend: function(){
							//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
							$(".loader").fadeIn("slow");
					  	},
					  	complete: function(){
						  	//$(".sub-fom-text").hide().remove();
						  	$(".loader").fadeOut("slow");
					  	},
					  	success: function(res) {
						  	//var new_array = JSON.parse(res)
							if( res == 1){	
							//$(".sub_content_usuarios").html(res);
								alert("Exito! Datos guardados.");
								//location.href="main";
								history.go(-1);
							}else if(res == 7){//codigo que el dni se repite
								alert("El DNI ya existe!.");
							}else if(res == 9){//codigo que el dni se repite
								alert("No tiene puntos suficientes!.");
							}else{
								alert("Fallo!. Lo sentimos.")
								//alert(res);
								}
							//alert(res)
					 	}        
				  	});
                }
            }
		});
	}
	function formDatav2(idForm,direcUrl,successUrl){					
        //$("#"+idForm).validationEngine();
	    $('#'+idForm).validationEngine({
            scroll: false,
            promptPosition: "topLeft", 
            onValidationComplete: function(form, status)
            {
                if ( $('#'+idForm).validationEngine('validate')==true) {
					   				   				   	
					var form_data = new FormData($('form#'+idForm)[0]);                  
					$.ajax({						
						url: direcUrl,
						//dataType: 'text',
					  	type: "POST",
					  	cache: false,
					  	contentType: false,
					  	processData: false,						
					  	data: form_data,
					  	//mimeType:"multipart/form-data",
					  	beforeSend: function(){
							//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
							$(".loader").fadeIn("slow");
					  	},
					  	complete: function(){
						  	//$(".sub-fom-text").hide().remove();
						  	$(".loader").fadeOut("slow");
					  	},
					  	success: function(res) {
						  	//var new_array = JSON.parse(res)
							if( res == 1){	
							//$(".sub_content_usuarios").html(res);
								alert("Exito! Datos guardados.");
								//location.href="main";
								location.href=successUrl;
							}else if(res == 7){//codigo que el dni se repite
								alert("El DNI ya existe!.");
							}else if(res == 9){//codigo que el dni se repite
								alert("No tiene puntos suficientes!.");
							}else{
								alert("Fallo!. Lo sentimos.")
								//alert(res);
								}
							//alert(res)
					 	}        
				  	});
                }
            }
		});
	}
	function formDataBoots(idForm,direcUrl){		
		
		// Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
					}else{
						var form_data = new FormData($('form#'+idForm)[0]);                  
						$.ajax({						
							url: direcUrl,
							//dataType: 'text',
							type: "POST",
							cache: false,
							contentType: false,
							processData: false,						
							data: form_data,
							//mimeType:"multipart/form-data",
							beforeSend: function(){
								//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
								$(".loader").fadeIn("slow");
							},
							complete: function(){
								//$(".sub-fom-text").hide().remove();
								$(".loader").fadeOut("slow");
							},
							success: function(res) {
								//var new_array = JSON.parse(res)
								if( res == 1){	
								//$(".sub_content_usuarios").html(res);
									alert("Exito! Datos guardados.");
									location.href="main";
								}else if(res == 7){//codigo que el dni se repite
									alert("El DNI ya existe!.");
								}else if(res == 9){//codigo que el dni se repite
									alert("No tiene puntos suficientes!.");
								}else{
									alert("Fallo!. Lo sentimos.")
									//alert(res);
									}
								//alert(res)
							}        
						});
						
					}
					form.classList.add('was-validated');
				}, false);
				});
			}, false);
			})();
        
					   				   				   	
					
               
	}
function ActPassword(idForm,direcUrl){					
        //$("#"+idForm).validationEngine();
	    $('#'+idForm).validationEngine({
            scroll: false,
            promptPosition: "topLeft", 
            onValidationComplete: function(form, status){
                if ( $('#'+idForm).validationEngine('validate')==true) {
					   				   				   	
					var form_data = new FormData($('form#'+idForm)[0]);                  
					$.ajax({						
						url: direcUrl,
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
								alert("su contraseña ha sido actualizada.");
								location.href="main";
							}else if(res == 2){
								alert("Contraseña actual incorrecta.");
							}else if(res == 3){
								alert("Los campos nueva contraseña y repita contraseña no coinciden.")
							}else{
								alert("Fallo!. Lo sentimos.")
								}
							//alert(res)
					 	}        
				  	});
                }
            }
		});
	}
function uploadImgfrombutton(idForm,direcUrl){
	  var form_data = new FormData($('form#'+idForm)[0]); 
	  $.ajax({						
		  url: direcUrl,
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
				  alert("Exito! Datos guardados.");
				  location.href="main";
			  }else{
				  alert("Fallo!. Lo sentimos.")
				  //alert(res);
				  }
			  //alert(res)
		  }        
	  });	
	}

function Comenzar(){
	var reloj=new Date();
	var dia = reloj.getDate();
	var mes = reloj.getMonth()+1;
	var anio = reloj.getFullYear();
	var horas=reloj.getHours();
	var minutos=reloj.getMinutes();
	var segundos=reloj.getSeconds();
	// Agrega un cero si .. minutos o segundos <10
	minutos=revisarTiempo(minutos);
	segundos=revisarTiempo(segundos);
	
	dia = revisarTiempo(dia);
	mes = revisarTiempo(mes);
	

	document.getElementById('fech_reloj').innerHTML="Fecha: "+(dia+"/"+mes+"/"+anio)+" Hora: "+horas+":"+minutos+":"+segundos;
	tiempo=setTimeout(function(){Comenzar()},500); 
	/*en tiempo creamos una funcion generica que cada 
	500 milisegundos ejecuta la funcion Comenzar()*/
}

function revisarTiempo(i){
	if (i<10)
	  {
	  i="0" + i;
	  }
	return i;
	/*Esta funcion le agrega un 0 
	a una variable i que sea menor a 10*/
}

function change_doc(){
	var tipo_doc = $("#tip_doc").val();				
	if(tipo_doc == 1){
		location.href="form?tipo=1&tipo_doc="+tipo_doc;
		/*$.ajax({						
			url: 'boleta',
			//dataType: 'text',
			type: "GET",
			cache: false,
			contentType: false,
			processData: false,						
			data: "tipo_doc="+tipo_doc,
			//mimeType:"multipart/form-data",
			beforeSend: function(){
				//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
			},
			complete: function(){
				//$(".sub-fom-text").hide().remove();
			},
			success: function(res) {
				//$('.data_form').html(res)					
				var new_array = JSON.parse(res)
				$('.datos_form').html(new_array['form']);
				$('.title_det_doc').html(new_array['det_doc']);
			}        
		});*/
	}else if(tipo_doc==2){
		location.href="form2?tipo=1&tipo_doc="+tipo_doc;		
		/*$.ajax({						
			url: 'factura',
			//dataType: 'text',
			type: "GET",
			cache: false,
			contentType: false,
			processData: false,						
			data: "tipo_doc="+tipo_doc,
			//mimeType:"multipart/form-data",
			beforeSend: function(){
				//$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
			},
			complete: function(){
				//$(".sub-fom-text").hide().remove();
			},
			success: function(res) {
				var new_array = JSON.parse(res)
				$('.datos_form').html(new_array['form']);
				$('.title_det_doc').html(new_array['det_doc']);
				//alert(new_array['form']);
			}        
		});*/
	}
}
function obt_text_puntos(){
	//Guardamos en una variable el nombre del campo provincia.
	var valid = $("#id_premio").val();
	$.ajax({
		url: 'text_puntos',
		type: "POST",
		data: "id_premio="+valid,
		success: function(resultado){
			$('.cont_txt_put').html(resultado)				
			//$('.selec_prov').append(new Option('Foo', 'foo', true, true));

			}
	});

}
function depar(){
	
	var dep = $(".selec_dep").val()
	
	$.ajax({
		url: 'prov',
		type: "GET",
		data: "dep="+dep,
		success: function(resultado){
			$('.selec_prov').html(resultado)				
			//$('.selec_prov').append(new Option('Foo', 'foo', true, true));

			}
	});
	}
	
/*function prov(){
	
	var dep = $("#departamento").val()
	var prov = $("#provincia").val()
	
	$.ajax({
		url: 'Ubigeo/.php',
		type: "GET",
		data: "dep="+dep+"&prov="+prov,
		success: function(resultado){						
					$("#cont_dist").html(resultado);
				}
	});
	}*/
function importe(id){		
	var cant = $("#vent_prod_cant-"+id).val();
	var prec = $("#vent_prod_prec-"+id).val();
	
	var imprt  = cant * prec
    $("#vent_prod_imp-"+id).val(imprt.toFixed(1));
	//alert(parseFloat(imprt))
    
	}
function cal_oper(){	
		var $textboxes = $('input[name="vent_prod_imp[]"]');
		var countTxt = $textboxes.length;
		if(countTxt > 0){
			var subTotal = 0;
			for(i = 0; i<countTxt; i++){
				var valores = $textboxes.eq(i).val();
				if(valores != 0){
					var subTotal = parseFloat(subTotal) + parseFloat(valores);
				}else{
					var subTotal = 0.00;
					}
				
			}
			if(subTotal == 0.00){
				var igv = 0.00;
			}else{
				var igv = parseFloat(0.18 * subTotal) + parseFloat(subTotal);
			}
			var total = parseFloat(igv) + parseFloat(subTotal);
			
			$("#ven_sub_tot").val(subTotal.toFixed(2));
			$("#ven_igv").val(igv.toFixed(2));
			$("#ven_tot").val(total.toFixed(2));
			$("#ven_tot2").val(subTotal.toFixed(2));
		}else{
			//alert("Necesita agregar productos a lista.");
			var cer = 0;
			$("#ven_sub_tot").val(cer.toFixed(2));
			$("#ven_igv").val(cer.toFixed(2));
			$("#ven_tot").val(cer.toFixed(2));
			$("#ven_tot2").val(cer.toFixed(2));
			}
		setTimeout(function(){cal_oper()},500); 
		//alert(subTotal);
		//var subTotal  = parseFloat(valores) + 0;
		//alert(subTotal.toFixed(2));	
	}
function numero(e) {
		 /*var codigo; 
		 codigo = (document.all) ? e.keyCode : e.which; 
		 if (codigo > 31 && (codigo < 48 || codigo > 57)) {
		 return false;
		 }
		 return true;*/

		 var codigo; 
		 codigo = (document.all) ? e.keyCode : e.which; 
		 if(e.keyCode > 47 && e.keyCode < 58 || e.keyCode == 46)
            {
               /*var txtbx=document.getElementById(txt);
               var amount = document.getElementById(txt).value;*/
               var present=0;
               var count=0;

               if(codigo.indexOf(".",present)||codigo.indexOf(".",present+1));
               {
              // alert('0');
               }

              /*if(amount.length==2)
              {
                if(event.keyCode != 46)
                return false;
              }*/
               do
               {
               present=codigo.indexOf(".",present);
               if(present!=-1)
                {
                 count++;
                 present++;
                 }
               }
               while(present!=-1);
               if(present==-1 && codigo.length==0 && event.keyCode == 46)
               {
                    event.keyCode=0;
                    //alert("Wrong position of decimal point not  allowed !!");
                    return false;
               }

               if(count>=1 && event.keyCode == 46)
               {

                    event.keyCode=0;
                    //alert("Only one decimal point is allowed !!");
                    return false;
               }
               if(count==1)
               {
                var lastdigits=codigo.substring(amount.indexOf(".")+1,codigo.length);
                if(lastdigits.length>=2)
                            {
                              //alert("Two decimal places only allowed");
                              event.keyCode=0;
                              return false;
                              }
               }
                    return true;
            }
            else
            {
                    event.keyCode=0;
                    //alert("Only Numbers with dot allowed !!");
                    return false;
            }
	}
	
function soloLetras(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}

	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

function imprSelec(muestra){
	var ficha=document.getElementById(muestra);
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
}

function ocultar(id,estado,title){
	var r = confirm("Esta operación "+title+" la opción seleccionada. ¿Está seguro de que desea continuar?");
	if (r == true) {	
		
		fetch('viewfrontData?id=' + id+'&estado='+estado)
		.then(res =>{
			return res.json();
		})
		.then(data =>{        			
			if(data == 1){
				location.reload();
				/*var classes = $("#showList_"+id).attr('class').split(' ')[1];
				if(classes == 'fa-window-close'){
					$("#showList_"+id).addClass('fa-check-square').removeClass('fa-window-close');

				}else if(classes == 'fa-check-square'){
					$("#showList_"+id).addClass('fa-window-close').removeClass('fa-check-square');
				}*/
			}else{
				alert('Fallo, inténtelo nuevamente.')
				}
			
		});		
	}
}

function actulizarinfront(id){	

	let formurlData = '';	
	$("#row_"+id).find("td input:text,td select").each(function() {
		textVal = this.value;
		inputName = $(this).attr("name");
		formurlData+='&'+inputName+'='+textVal;			
	});
	//console.log(formurlData);
	fetch('updateData?id=' + id + formurlData)
		.then(res =>{
			return res.json();
		})
		.then(data =>{        			
			if(data == 1){
				alert("Datos actulizados.");				
			}else{
				alert('Fallo, inténtelo nuevamente.')
				}
			
		});
}

function eliminar(id){
	//if (confirm("Esta Ud. seguro de querer elimiar este registro?"))
	//window.location=("deleteData?id=" + id);

	var r = confirm("Esta operación eliminará la opción seleccionada. ¿Está seguro de que desea continuar?");
	if (r == true) {	
		//var url_base = base_url();
		//fetch('http://localhost/curso/49.%20carrito/terminado/api/carrito/api-carrito.php?action=remove&id=' + id)
		fetch('deleteData?id=' + id)
		.then(res =>{
			return res.json();
		})
		.then(data =>{        
			//console.log(data);
			//actualizarCarritoUI();
			if(data == 1){
				$("#row_"+id).hide().remove();
			}else{
				alert('Fallo, inténtelo nuevamente.')
				}
			
		});		
	}
}
function eliminar2(id){
	//if (confirm("Esta Ud. seguro de querer elimiar este registro?"))
	//window.location=("deleteData?id=" + id);

	var r = confirm("Esta operación eliminará la opción seleccionada. ¿Está seguro de que desea continuar?");
	if (r == true) {	
		//var url_base = base_url();
		//fetch('http://localhost/curso/49.%20carrito/terminado/api/carrito/api-carrito.php?action=remove&id=' + id)
		fetch('deleteData2?id=' + id)
		.then(res =>{
			return res.json();
		})
		.then(data =>{        
			//console.log(data);
			//actualizarCarritoUI();
			if(data == 1){
				$("#row_"+id).hide().remove();
			}else{
				alert('Fallo, inténtelo nuevamente.')
				}
			
		});		
	}
}