<?php

    class User extends Controller{   
		
		function __construct() {
            parent::__construct();					
			
        }
		       
		public function main(){
			if(Session::exist()){
				if(Session::getValue('ROL') == 1 || Session::getValue('ROL') == 2 || Session::getValue('ROL') == 4){
					$this->view->userData= $this->model->consultar(Session::getValue("ID"))[0];
					
					$this->view->userRol = $this->model->consultar_rol($this->view->userData['rol'])[0];
                    $this->getRol($this->view->userRol['nombre']);
                    
                    $id_config = 1;
					$this->view->admData= $this->model->obtDatos($id_config)[0];								  				  					
					
					$this->view->render($this,'main');								
				}else{
					$this->view->userData= $this->model->consultar(Session::getValue("ID"))[0];
					
					$this->view->userRol = $this->model->consultar_rol($this->view->userData['rol'])[0];
					$this->getRol($this->view->userRol['nombre']);
					header("location: ".URL."user/main");
					}
            }else{
                header("location: ".URL);
                }
			
		}
		
        public function signUp(){
            
            //name,username,email,password
            if( isset($_POST["name"]) && isset($_POST["username"]) &&
                isset($_POST["email"]) && isset($_POST["password"])){
                
                $data["name"] = $_POST["name"];
                $data["username"] = $_POST["username"];
                $data["email"] = $_POST["email"];
                $data["password"] = $_POST["password"];
                
                echo $this->model->signUp($data);
            }
            
        }
        
        public function signIn(){
            
            if( isset($_POST["username"]) && isset($_POST["pwd"])){
                
                //$response = $this->model->signIn('*',"username = '".$_POST["username"]."'");
				
				
                
                
                if($response = $this->model->signIn(array(":correo"=>$_POST["username"]))){
                    $response = $response[0];
                    if($response["pwd"] == md5($_POST["pwd"])){
                        $data['fe_lastlogin'] = date("Y-m-d H:i:s");
                        $this->model->actLogin($response["id"],$data);
                        
                        $this->createSession($response["nombres"],$response["id"],$response['rol']);
                        echo 1;					
                        //header("location: ".URL."user/main"); 
                    }else{
                        echo 0;
                        //echo "<script>alert('Usuario o Password Incorrectos'); location.href = '".URL."';</script>";
                        //header("location: ".URL);
                    }
            	}else{
                    echo 0;
                	//echo "<script>alert('Usuario o Password Incorrectos'); location.href = '".URL."';</script>";
                	//header("location: ".URL);
                }
            }
        } 

            
		
		function getRol($idrol){
            Session::setValue('U_ROL', $idrol);           
        }   							
			
        function createSession($username,$id,$rol){
            Session::setValue('U_NAME', $username);           
			Session::setValue('ID', $id);
			Session::setValue('ROL', $rol);			
        }
        
        function destroySession(){
            Session::destroy();
            header('location:'.URL_ADM);
        }	

    }