<?php

    class Index extends Controller{
        
        function __construct() {
            parent::__construct();
        }
        
        function index(){    
			if(Session::exist()){
            	//$this->view->render($this,'index');            
				header("location: ".URL."user/main");
			}else{
				$this->view->render($this,'index');
				}
        }
		
		/*function main(){            
            $this->view->render($this,'main');            
        }*/
        
        function killItWithfire(){
            Session::destroy();
        }
        
    }