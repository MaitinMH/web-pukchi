<?PHP
	class Includes{		
						
		static function head(){
			$head='<!doctype html>
			<html>
			<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
			
			<link rel="shortcut icon" href="'.URL.'public/image/favi.svg" type="image/x-icon" >

			<LINK REL=StyleSheet HREF="'.URL.'public/css/reset.css" TYPE="text/css" MEDIA=screen>
			
			<LINK REL=StyleSheet HREF="'.URL.'public/css/validador.css" TYPE="text/css" MEDIA=screen>
			<LINK REL=StyleSheet HREF="'.URL.'public/css/estilos.css" TYPE="text/css" MEDIA=screen>
								
			<LINK REL=StyleSheet HREF="'.URL.'public/fonts/styleiconomovistar.css" TYPE="text/css" MEDIA=screen>
			<LINK REL=StyleSheet HREF="'.URL.'public/css/jquery-ui-1.8.21.custom.css" TYPE="text/css" MEDIA=screen>

			<LINK REL=StyleSheet HREF="'.URL.'public/css/bootstrap.css" TYPE="text/css" MEDIA=screen>
			<LINK REL=StyleSheet HREF="'.URL.'public/css/bootstrap-table.css" TYPE="text/css" MEDIA=screen>
									
			<!--<script src="'.URL.'public/js/jquery-1.7.1.min.js"></script>-->
			<!--<script src="'.URL.'public/js/jquery-1.11.1.min.js"></script>-->
			<script src="'.URL.'public/js/jquery-3.6.0.min.js"></script>

			<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->

			<script src="'.URL.'public/js/popper.min.js"></script>
			<script src="'.URL.'public/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="'.URL.'public/js/jquery.validationEngine.js"></script>
			<script type="text/javascript" src="'.URL.'public/js/jquery.validationEngine-es.js"></script>			
			<script type="text/javascript" src="'.URL.'public/js/jquery-ui-1.9.1.js"></script>		
			
			<script src="'.URL.'public/js/bootstrap-table.js"></script>
			<script src="'.URL.'public/js/bootstrap-table-es-MX.js"></script>			

			<script src="'.URL.'public/js/funciones.js"></script>		

			<link rel="stylesheet" href="'.URL.'public/fontawesome/css/all.css">

			<title>.: Plataforma educativa :.</title>
			</head>';
			return $head;
			}
			
		static function banner(){						
			$banner ='<nav class="navbar navbar-expand bg-cl-main-color mb-4 shadow">
						
						<button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#contMenuLeft"  aria-controls="contMenuLeft" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fa fa-bars text-secondary"></i>
						</button>													

						<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown no-arrow mx-1">
								<a class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<i class="fas fa-user-cog"></i> '.Session::getValue('U_ROL').': '. Session::getValue('U_NAME').'
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="'.URL.'miperfil/main"><i class="fas fa-id-badge"></i> Mi Perfil</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item closeSessionBtn" href="#"><i class="fas fa-id-badge"></i> Salir</a>
								</div>
							</li>
						</ul>
					</nav>';
			return $banner;
			}
		
		static function menu_izq(){
			//$menu_izquierdo = file_get_contents('../views/menu_izquierdo.php'); 	
			if(Session::exist()){
					
			$menu_izquierdo =			
			'<div class="collapse navbar-collapse show" id="contMenuLeft">
				<ul class="nav nav-tabs nav-stacked main-menu">';
				
			if(Session::getValue('ROL') == 1 ){
				$menu_izquierdo .='
				
					<li class="nav-item col-6 col-sm-4 rounded bg-primary text-center m-2">
						<a class="nav-link" href="'.URL.'administracion/form">
							<i class="fas fa-cogs fa-3x text-white"></i>
							<p class="mt-2 text-white">Administración</p>						
						</a>
					</li>
					
					<li class="nav-item col-6 col-sm-4 rounded bg-primary text-center m-2">
						<a class="nav-link" href="'.URL.'usuarios/main">
							<i class="fas fa-user-tie fa-3x text-white"></i>
							<p class="mt-2 text-white">Usuarios</p>
						</a>
					</li>

					<li id="separator" class="mt-2 mb-2 w-100 d-none d-md-block"></li>
																	
				';
			}
			
			if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 4){
				$menu_izquierdo .='
				
									
				<li class="nav-item col-6 col-sm-4 rounded bg-primary text-center m-2">
					<a class="nav-link" href="'.URL.'Nivel1/main">
						<i class="fab fa-product-hunt fa-3x text-white"></i>
						<p class="mt-2 text-white">Nivel 1</p>
					</a>
				</li>	

				<li class="nav-item col-6 col-sm-4 rounded bg-primary text-center m-2">
					<a class="nav-link" href="'.URL.'Nivel2/main">
						<i class="fab fa-product-hunt fa-3x text-white"></i>
						<p class="mt-2 text-white">Nivel 2</p>
					</a>
				</li>
					
				

				<li id="separator" class="mt-2 mb-2 w-100 d-none d-md-block"></li>
					

					                                             
				';									
			}

			
			$menu_izquierdo .='</ul></div>';			

			$menu_izquierdo .='<script>
			$(function(){
				$( ".active_menu" ).click(function() {
				  $( ".sub_content_menu_responsive ul" ).toggle( "slow", function() {
					// Animation complete.
				  });
				});
				
				$(".closeSessionBtn").click(function(){            		
					document.location = "'.URL.'user/destroySession"; 
             	});
			});
			</script>
			<!--Fin menu respondsive-->';
			}
		
			return $menu_izquierdo;
		}	
										
	}