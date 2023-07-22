<?php
	//setlocale(LC_ALL,"es_ES");
	date_default_timezone_set('America/Lima');
    require 'config.php';
    // -->Controller/Method/Params
  
	$url = (isset($_GET["url"])) ? $_GET["url"] : "index/index";
	//$url = (isset($_GET["url"]) && $_GET['url']!='index.php') ? $_GET["url"] : "Index/index";
    
	$url = explode("/", $url);

    if(isset($url[0])){$controller = $url[0];}
    if(isset($url[1])){ if($url[1] != ''){ $method = $url[1];} }
    if(isset($url[2])){ if($url[2] != ''){ $params = $url[2];} }
    
    spl_autoload_register(function($class){
        
		if(file_exists(LIBS.$class.".php")){
            require LIBS.$class.".php";
        }
		
		if(file_exists(INCLUD.$class.".php")){
            require INCLUD.$class.".php";
        }
    });    
    $path = './controllers/'.$controller.'.php';   
    if(file_exists($path)){        
		require $path;
        $controller = new $controller();		
		
		
        if(isset($method)){
            if(method_exists($controller, $method)){
                if(isset($params)){
                    $controller->{$method}($params);
                }else{
                    $controller->{$method}();
                }
            }
        }else{
            $controller->index();						
        }
    }else{
        echo 'Error';		
		//echo $path;
    }
    

