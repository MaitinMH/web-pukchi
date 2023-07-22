<?php

    class Nivel2 extends Controller{
        
        function __construct() {
            parent::__construct();
        }
        
        function main(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 || Session::getvalue('ROL') == 3 || Session::getvalue('ROL') == 4){
					if(isset($_GET['find_cli_nom'])){
						
						($_GET['find_cli_nom']!='') 	? 	$buscar['nombre']		= $_GET['find_cli_nom'] 	: $buscar['nombre'] 	= '';
						
						$estado = 'E';
						$this->view->clietblData	= $this->model->tblDatos($estado,$buscar);
					}else{
						$estado = 'E';
						$this->view->clietblData	= $this->model->tblDatos($estado);								  				  
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
					if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 || Session::getvalue('ROL') == 3 || Session::getvalue('ROL') == 4){
					
					if(isset($_GET['codReg'])){
						$id = @$_GET['codReg'];															
						$this->view->clieData	= $this->model->obtDatos($id)[0];

						$this->view->AlternData	= $this->model->obtAlterDatos($id);
					}								
					
					$estado = 'E';							
					
					
					$this->view->render($this,'form'); 
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
			}else{
				  header("location: ".URL);
			  }
        }	

		function respuesta(){

			if(Session::exist()){
				if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 || Session::getvalue('ROL') == 3 || Session::getvalue('ROL') == 4){
				
				if(isset($_GET['id'])){
					$id 		= @$_GET['id'];															
					$respData	= $this->model->obtRespDatos($id)[0];

					/*if($respData['correcto']){
						echo 1;
					}else{
						echo 0;
					}*/
					
					echo $respData['correcto'];
				}																						
												
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
						$id_detmovil = @$_GET['id'];															
						$this->view->viewData = $this->model->datosView($id_detmovil)[0];					
						$this->view->render($this,'view'); 
					}														
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
			}else{
				  header("location: ".URL);
			  }
        }
		
		function actionForm(){														
				
				if(isset($_POST["nombres"])){				
					
					/*===============================
					 * Tipo 2: Actualizamos los datos
					 * Tipo 1: Agregamos datos nuevos
					 *===============================
					 */


					if(isset($_POST['tipo']) && $_POST['tipo']==2){ 						

												
						$data["nombre"]			= $_POST["nombres"];
						
																				
						$data["fech_actualizacion"]	= date("Y-m-d H:i:s");						


																							
						if($this->model->actDatos($_POST['codReg'],$data)){							
							echo 1;
						}else{
							echo 0;
							}
					}elseif(isset($_POST['tipo']) && $_POST['tipo']==1){
																		

						$data["nombre"]			= $_POST["nombres"];
						
																							
						$data["fech_creacion"]		= date("Y-m-d H:i:s");
						$data["fech_actualizacion"]	= date("Y-m-d H:i:s");
						$data["estado"]				= 'A';
						
												
						$this->model->inserDatos($data);
						echo 1;							
						
					}
						
          		}else{
					echo 0;
					}				
		}	
		
		function deleteData(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$data['estado']			 = 'E';	
				$data["fech_actualizacion"]	= date("Y-m-d H:i:s");			
				if($this->model->deleteData($id,$data)){
					echo 1;
				}else{
					echo 0;
					}
			}else{
				echo 2;
				}
		}		
		
		function viewfrontData(){
			if(isset($_GET['id']) && isset($_GET['estado'])){	
				$id = $_GET['id'];

				if($_GET['estado']!='E') $data['estado']=($_GET['estado']=='A') ? $data['estado']='I' : $data['estado']='A';
				else $data['estado']=$_GET['estado'];

				$data["fech_actualizacion"]	= date("Y-m-d H:i:s");			

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