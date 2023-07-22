<?php

    class Ubigeo extends Controller{
        
        function __construct() {
            parent::__construct();
        }                
		
		function prov(){    
			if(Session::exist()){				
				if(isset($_GET['dep'])){	
					$idDep	= $_GET['dep'];
					$this->provData	= $this->model->obtProv($idDep);
					$this->view->render($this,'form'); 
					foreach($this->view->provData as $r){
						echo "<option value='".$r['id_prov']."'>".$r['provincia']."</option>";
					}
				}
			}else{
				  header("location: ".URL);
			  }
			  echo "asd";
        }	
								
        
        function killItWithfire(){
            Session::destroy();
        }
        
    }