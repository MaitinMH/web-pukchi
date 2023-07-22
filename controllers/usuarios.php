<?php

    class Usuarios extends Controller{
        
        function __construct() {
            parent::__construct();
        }
        
        function main(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 ){
					if(isset($_GET['find_cod']) && isset($_GET['find_nom']) && isset($_GET['find_ap'])){					
	
						($_GET['find_cod']!='') 	? 	$buscar['cod_usu']		= $_GET['find_cod'] : $buscar['cod_usu'] = '';
						($_GET['find_nom']!='') 	? 	$buscar['nombres']		= $_GET['find_nom'] : $buscar['nombres'] = '';
						($_GET['find_ap']!='') 		? 	$buscar['apellidos']	= $_GET['find_ap']	: $buscar['apellidos'] = '';										
						$estado = 'A';
						$this->view->usutblData		= $this->model->tblDatos($estado,$buscar);
					}else{
						$estado = 'A';
						$this->view->usutblData		= $this->model->tblDatos($estado);								  				  
					}
					$this->view->render($this,'main');							
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
				 
			}else{
				  header("location: ".URL);
			  }
        }
		
		function form(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 ){
					if(isset($_GET['codUsu'])){
						$id = @$_GET['codUsu'];															
						$this->view->usuData	= $this->model->obtDatos($id)[0];					
					}
									
					$this->view->rolsData	= $this->model->obtRols();
					$this->view->render($this,'form'); 
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
			}else{
				  header("location: ".URL);
			  }
        }
		
		function view(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 ){
					if(isset($_GET['id'])){
						$id = @$_GET['id'];															
						$this->view->viewData = $this->model->datosView($id)[0];					
						$this->view->render($this,'view'); 
					}														
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
			}else{
				  header("location: ".URL);
			  }
        }	
		
		function add_usuarios(){														
				if(isset($_POST["cod_usu"]) && isset($_POST['nom_usu']) && isset($_POST['rol']) && isset($_POST['ap_usu']) && isset($_POST['di_usu'])
				 && isset($_POST['email_usu']) && isset($_POST['pwd_usu'])){
					/*$imagen = '';
					 if ( 0 < @$_FILES['file']['error'] ) {
						//echo 'Error: ' . $_FILES['file']['error'] . '<br>';
					}else{					
						$imagen = FileUploader::subirImagen('imagen_usu',array("200x200"),0,2,"./public/image/usuarios/");					
																
					}*/
					
					if(isset($_POST['tipo']) && $_POST['tipo']==2){
						$get = $this->model->obtDatos($_POST['codUsu'])[0];
						$pwd = $get['pwd'];
						//$img = $get['imagen'];
						
						$data["cod_usu"] 	= $_POST["cod_usu"];
						$data["rol"] 		= $_POST["rol"];						
						$data["nombres"]	= $_POST["nom_usu"];
						$data["apellidos"]	= $_POST["ap_usu"];
						$data["di"] 		= $_POST["di_usu"];
						$data["direccion"]	= $_POST["direc_usu"];
						$data["telefono"]	= $_POST["telf_usu"];
						$data["correo"]		= $_POST["email_usu"];
						$data["estado"]		= $_POST["estado"];
						$data["fechNanc"]	= $_POST["fechn_usu"];
						
						if($pwd != $_POST["pwd_usu"]){							
							$data["pwd"]	= md5($_POST["pwd_usu"]);
						}
						/*if($imagen != '' ){							
							$data["imagen"]	= $imagen;
						}*/
						$data["fe_modificacion"]= date("Y-m-d H:i:s");						
					
						//echo $this->model->actDatos($data,"id = ".$id);
						
						if($this->model->actDatos($_POST['codUsu'],$data)){
							echo 1;
						}else{
							echo 0;
							}
					}elseif(isset($_POST['tipo']) && $_POST['tipo']==1){
						$data["cod_usu"] 	= $_POST["cod_usu"];
						$data["rol"] 		= $_POST["rol"];
						//$data["imagen"]		= $imagen;
						$data["nombres"]	= $_POST["nom_usu"];
						$data["apellidos"]	= $_POST["ap_usu"];
						$data["di"] 		= $_POST["di_usu"];
						$data["direccion"]	= $_POST["direc_usu"];
						$data["telefono"]	= $_POST["telf_usu"];
						$data["correo"]		= $_POST["email_usu"];
						$data["pwd"]		= md5($_POST["pwd_usu"]);
						$data["fechNanc"]	= $_POST["fechn_usu"];
						$data["fe_creacion"]= date("Y-m-d H:i:s");
						$data["estado"]		= $_POST["estado"];
						
						//echo $this->model->inserDatos($data);
						
							if($this->model->inserDatos($data)){
								echo 1;
							}else{
								echo 0;
								}
							}
						
          		}else{
					echo 0;
					}				
		}				
        
		function deleteData(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$data['fe_modificacion'] = date("Y-m-d H:i:s");
				$data['estado']			 = 'E';				
				if($this->model->deleteData($id,$data)){
					echo 1;
				}else{
					echo 0;
					}
			}else{
				echo 2;
				}
		}
        function killItWithfire(){
            Session::destroy();
        }
        
    }