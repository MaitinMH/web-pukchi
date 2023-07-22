<?php

    class Administracion extends Controller{
        
        function __construct() {
            parent::__construct();
        }

        function regventas(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1){
					if(isset($_GET['find_cli_ven']) && isset($_GET['find_fech_ven'])){					
						($_GET['find_cli_ven']!='') 	? 	$buscar['nombres']			= $_GET['find_cli_ven']  : $buscar['nombres'] 		= '';
						($_GET['find_fech_ven']!='') 	? 	$buscar['fecha_emision']	= $_GET['find_fech_ven'] : $buscar['fecha_emision']	= '';
						$estado = 'A';
						$this->view->doctblData	= $this->model->tblDatos($estado,$buscar);
					}else{
						$estado = 'A';
						$this->view->doctblData	= $this->model->tblDatos($estado);								  				  
					}
					$this->sesUsuBoleta = $this->model->obtInfoSessiUsuSerie1(Session::getValue("ID"),'A')[0];
					if($this->sesUsuBoleta['numero']>0){
						$datamain1['estado'] = 'C';
						$this->model->new1_actDatosSessiUsuSerie1(Session::getValue("ID"),$datamain1);
					}
					
					$this->sesUsuFactura = $this->model->obtInfoSessiUsuSerie2(Session::getValue("ID"),'A')[0];
					if($this->sesUsuFactura['numero']>0){
						$datamain2['estado'] = 'C';
						$this->model->new1_actDatosSessiUsuSerie2(Session::getValue("ID"),$datamain2);
					}
					$this->view->render($this,'regventas');							
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
			}else{
				  header("location: ".URL);
			  }
        }

        function controlcaja(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1){
					if(isset($_GET['find_fech_ven'])){					
						
						($_GET['find_fech_ven']!='') 	? 	$buscar['fecha_cierre']	= $_GET['find_fech_ven'] : $buscar['fecha_cierre']	= '';
						$estado = 'A';
						$this->view->tblDataCierrCaj	= $this->model->ObtDataCierreCaja($estado,$buscar);
					}else{
						$estado = 'A';
						$this->view->tblDataCierrCaj	= $this->model->ObtDataCierreCaja($estado);								  				  
					}

					
					$this->view->render($this,'controlcaja');							
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
			}else{
				  header("location: ".URL);
			  }
        }


        function form(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1){
					$id_config = 1;
					$this->view->admData= $this->model->obtDatos($id_config)[0];								  				  
					$this->view->render($this,'form');	
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}				 
			}else{
				  header("location: ".URL);
			  }
        }

        function main(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1){
					$id_config = 1;
					$this->view->admData= $this->model->obtDatos($id_config)[0];								  				  
					$this->view->render($this,'form');	
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}				 
			}else{
				  header("location: ".URL);
			  }
        }				
        
        function actionForm(){														
				
				if(isset($_POST["nombre_empresa"])){
					/*$imagen = '';
					 if ( 0 < @$_FILES['file']['error'] ) {
						//echo 'Error: ' . $_FILES['file']['error'] . '<br>';
					}else{					
						$imagen = FileUploader::subirImagen('imagen',array("200x200"),0,2,"./public/image/");					
																
					}*/
					
					/*===============================
					 * Tipo 2: Actualizamos los datos
					 * Tipo 1: Agregamos datos nuevos
					 *===============================
					 */
					if(isset($_POST['tipo']) && $_POST['tipo']==2){ 
						$get = $this->model->obtDatos(1)[0];					
						//$img = $get['imagen'];
						
						$data["empresa"]	 	= $_POST["nombre_empresa"];
						$data["ruc"]			= $_POST["ruc"];
						$data["razon_social"]	= $_POST["razon_social"];
						$data["direccion"]		= $_POST["direccion"];
						$data["telefono"]		= $_POST["telefonos"];
						$data["ubicacion"] 		= $_POST["ubicacion"];
						
						/*if($imagen != '' ){							
							$data["imagen"]	= $imagen;
						}*/											
						
						if($this->model->actDatos(1,$data)){
							echo 1;
						}else{
							echo 0;
							}
					}elseif(isset($_POST['tipo']) && $_POST['tipo']==1){
						$data["empresa"]	 	= $_POST["nombre_empresa"];
						$data["ruc"]			= $_POST["ruc"];
						$data["razon_social"]	= $_POST["razon_social"];
						$data["direccion"]		= $_POST["direccion"];
						$data["telefono"]		= $_POST["telefonos"];
						$data["ubicacion"] 		= $_POST["ubicacion"];
						//$data["imagen"]			= $imagen;
						
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

		function view(){    
			if(Session::exist()){
				if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 || Session::getValue('ROL') == 3 ){
					if(isset($_GET['id'])){
						$id = @$_GET['id'];															
						$this->view->viewData = $this->model->datosView($id)[0];					
						
						$id_config = 1;
						$this->view->ConfigData= $this->model->obtDataConfig($id_config)[0];

						//$this->view->CuponData= $this->model->datosViewCupon();
						
						//$this->view->prodDataview = $this->model->obtProdsView($this->view->viewData['id']);
						$this->view->prodDataview = $this->model->obtProdsView($id);
						
						
						$this->view->render($this,'view'); 
					}														
				}else{
					echo "<script>alert('No tiene privilegios de acceso a esta secci\u00F3n.');location.href='../user/main';</script>";
					}
			}else{
				  header("location: ".URL);
			  }
        }

        function killItWithfire(){
            Session::destroy();
        }
        
    }