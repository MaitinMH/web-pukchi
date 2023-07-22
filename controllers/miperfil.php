<?php

    class Miperfil extends Controller{
        
        function __construct() {
            parent::__construct();
        }                
		
		function main(){    
			if(Session::exist()){								  
				  $id = Session::getValue('ID');																				
				  $this->view->usuData	= $this->model->obtDatos($id)[0];					
				  $this->view->rolsData	= $this->model->obtRols($this->view->usuData["rol"])[0];
				  $this->view->render($this,'main'); 				
			}else{
				  header("location: ".URL);
			  }
        }
				
		
		function actionForm(){														
				if(isset($_POST["codUsu"])){
					$permiso = 0;
					/*$imagen = '';
					 if ( 0 < @$_FILES['file']['error'] ) {
						//echo 'Error: ' . $_FILES['file']['error'] . '<br>';
					}else{					
						$imagen = FileUploader::subirImagen('imagen_usu',array("200x200"),0,2,"./public/image/usuarios/");					
																
					}*/
					
					$id	= $_POST["codUsu"];	
					
					$get = $this->model->obtDatos($id)[0];
					$pwd = $get['pwd'];					
									
					
					if(isset($_POST['Act_pwd']) && isset($_POST['Npwd']) && isset($_POST['N2pwd'])){
						$Actpwd = $_POST["Act_pwd"];
						$Npwd 	= $_POST["Npwd"] ;
						$N2pwd 	= $_POST["N2pwd"] ;
						if(md5($Actpwd) == $pwd ){							
							if($Npwd == $N2pwd){
								$data["pwd"] = md5($Npwd);
								$permiso = 1;
							}else{
								echo 3;
								}
						}else{
							echo 2;
							}
					}
					
					/*if($imagen != '' ){							
						$data["imagen"]	= $imagen;
						$permiso = 1;
					}*/
																							
					if($permiso == 1){
						$data["fe_modificacion"]= date("Y-m-d H:i:s");
						if($this->model->actDatos($id,$data)){
							echo 1;
						}else{
							echo 0;
							}
					}
											
          		}else{
					echo 0;
					}				
		}				
		        		
        function killItWithfire(){
            Session::destroy();
        }
        
    }