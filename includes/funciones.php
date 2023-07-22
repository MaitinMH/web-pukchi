<?php 
function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}
function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}

function url($grabar=false)
{
    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $get='';
    foreach ($_GET as $i=>$u) $get.=($get!='') ? "&$i=$u" : "?$i=$u";    
    if ($grabar) $_SESSION['url_retorno_home']=$url.$get;
    return $url.$get;    
}

function url_adm($grabar=false)
{
    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $get='';
    foreach ($_GET as $i=>$u) $get.=($get!='') ? "&$i=$u" : "?$i=$u";    
    if ($grabar) $_SESSION['url_retorno']=$url.$get;
    return $url.$get;    
}

function redireccionar($url)
{
    echo "<script type='text/javascript'> window.location='$url'; </script>";
}

function subirImagen($nombre, $dimensiones, $indice, $tipo_corte=1 ,$destino)
{    
    $imagen='';
    $n=count($dimensiones);
    $dimensiones[$n]='100x100';
    if (isset($_FILES[$nombre]['name']))
    {
        //$ruta = "../../fotos/";    
		$ruta = $destino;    
        $fileorigen=$_FILES[$nombre]['tmp_name'];
        if (file_exists($fileorigen))
        {            
            $uploadfile=mb_strtolower(basename($_FILES[$nombre]['name']));
            $uploadfile_len=mb_strlen($uploadfile);
            $uploadfile_punto=mb_strrpos($uploadfile,"."); 
            $uploadfile_ext=mb_substr($uploadfile,$uploadfile_punto,($uploadfile_len-$uploadfile_punto));            

            if (($uploadfile_ext==".jpg") || ($uploadfile_ext==".jpeg") || ($uploadfile_ext==".gif") || ($uploadfile_ext==".png"))
            {
                $imagen=time().$indice.$uploadfile_ext;
                $filedestino=$ruta.$imagen;
                if (move_uploaded_file($fileorigen, $filedestino))
                {
                    foreach ($dimensiones as $u)
                    {
                        $d=explode('x', $u);
                        $_imagen=$u.'_'.$imagen;
                        crea_imagen($filedestino, $d[0], $d[1], $tipo_corte, $ruta.$_imagen);
                    }
                }
            }
        }
    }
    
    return $imagen;        
}

function subirImagen_home($nombre, $dimensiones, $indice, $tipo_corte=1)
{    
    $imagen='';
    $n=count($dimensiones);
    $dimensiones[$n]='100x100';
    if (isset($_FILES[$nombre]['name']))
    {
        $ruta = "fotos/";    
        $fileorigen=$_FILES[$nombre]['tmp_name'];
        if (file_exists($fileorigen))
        {            
            $uploadfile=mb_strtolower(basename($_FILES[$nombre]['name']));
            $uploadfile_len=mb_strlen($uploadfile);
            $uploadfile_punto=mb_strrpos($uploadfile,"."); 
            $uploadfile_ext=mb_substr($uploadfile,$uploadfile_punto,($uploadfile_len-$uploadfile_punto));            

            if (($uploadfile_ext==".jpg") || ($uploadfile_ext==".jpeg") || ($uploadfile_ext==".gif") || ($uploadfile_ext==".png"))
            {
                $imagen=time().$indice.$uploadfile_ext;
                $filedestino=$ruta.$imagen;
                if (move_uploaded_file($fileorigen, $filedestino))
                {
                    foreach ($dimensiones as $u)
                    {
                        $d=explode('x', $u);
                        $_imagen=$u.'_'.$imagen;
                        crea_imagen($filedestino, $d[0], $d[1], $tipo_corte, $ruta.$_imagen);
                    }
                }
            }
        }
    }
    
    return $imagen;        
}

function request($dato)
{
    $dato = str_replace("<","&lt;", $_REQUEST[$dato]);
    $dato = str_replace(">","&gt;",$dato);
    $dato = str_replace("'","&#39;",$dato);
    $dato = str_replace('"',"&quot;",$dato);
    $dato = str_replace("\\","&#92;",$dato);
    $dato = str_replace("\\\\","&#92;",$dato);
    $dato = strip_tags($dato);
    return $dato;
}

function paginacion($parametros)
{    
/*
	$parametros=array(
		'sql'=>'Consulta sql',
		'id'=>'Id del ul',
		'class'=>'Clase del ul',
		'resultados'=>'numero de elementos por pagina'
		'extremos'=>array('texto para el boton anterior', 'texto para el boton siguiente')		
	)
	
   retorno=array(
   		'data'=>'registros de la pagina',
		'html'=>'html del paginado'
   )
*/
	global $db; //importamos la variable de conexion
	
    $data=array();
    $id=(isset($parametros['id'])) ? "id='".$parametros['id']."'" : '';
    $clase=(isset($parametros['class'])) ? "class='".$parametros['class']."'" : '';

    $paginacion="<ul $id $clase >";
    $numero=$parametros['resultados'];
	$jquery=$parametros['ajaxjquery'];
	$dataajax=$parametros['dataajax'];
    $pagina=(isset($_GET['pagina'])) ? round($_GET['pagina']) : 0;
    $desde=$pagina*$numero;
    
	
	/*$cardinal=  mysql_query($parametros['sql']);
    $r_cardinal=  mysql_num_rows($cardinal);*/
	
	try{
		$cardinal = $db->prepare($parametros['sql']);
		$cardinal->execute();
		$r_cardinal = $cardinal->rowCount();  
	}catch(PDOException $ex) {
		//echo $ex->getMessage(); //Mensaje del sistema no amigable
		echo "Lo sentimos, ha habido un error en la conexion";
	}
	
	
	$residuo=($r_cardinal%$numero);                    
    $num_pag=($r_cardinal-$residuo)/$numero;    
    if ($residuo>0) $num_pag++;
    
    
    $url=url();
    if (strstr($url, '&pagina')){
        $url=explode('&pagina', $url);
        $url=$url[0].'&';        
    }
    else if (strstr($url, '?pagina')){
        $url=explode('?pagina', $url);
        $url=$url[0].'?';        
    }
	else if (strstr($url, '&') || strstr($url, '?')) $url.='&';	
	else $url.='?';	

    if ($num_pag>1){ 
       if($jquery=='si'){
			if ($pagina>0 && (isset($parametros['extremos']))) $paginacion.="<li><a href='javascript:paginado(".$dataajax.",".($pagina-1).")'>".$parametros['extremos'][0]."</a></li>";
		}else{
	    	if ($pagina>0 && (isset($parametros['extremos']))) $paginacion.="<li><a href='".$url."pagina=".($pagina-1)."'>".$parametros['extremos'][0]."</a></li>";
		}
       
	    for($i=0; $i<$num_pag; $i++){ 
            $activo=($pagina==$i) ? "class='activo'" : '';
            if($jquery=='si'){
					$paginacion.='<li><a href="javascript:paginado('.$dataajax.','.$i.')" '.$activo.' >'.($i+1).'</a></li>';
				}else{
					$paginacion.="<li><a href='".$url."pagina=$i' $activo >".($i+1)."</a></li>";
				}
        } 
        if($jquery=='si'){
			if ($pagina<($num_pag-1) && (isset($parametros['extremos']))) $paginacion.="<li><a href='javascript:paginado(".$dataajax.",".($pagina+1).")'>".$parametros['extremos'][1]."</a></li>";
		}else{
			if ($pagina<($num_pag-1) && (isset($parametros['extremos']))) $paginacion.="<li><a href='".$url."pagina=".($pagina+1)."'>".$parametros['extremos'][1]."</a></li>";
		}
    }
    $paginacion.="</ul>";
    $sql=$parametros['sql']." LIMIT $desde, $numero";

	$c= $db->prepare($sql);
	$c->execute();
	//$rs = $c->fetchAll(PDO::FETCH_ASSOC);
	while($rs = $c->fetch(PDO::FETCH_ASSOC)) $data[]=$rs;						
    
    return array(
        'data'  => $data,
        'html'  => $paginacion
    );
}

function subirArchivo($nombre, $extensiones, $num = 0)
{    

    $archivo = '';
    if (isset($_FILES[$nombre]['name']))
    {
        $ruta = "../../archivos/";    
        $fileorigen=$_FILES[$nombre]['tmp_name'];
        if (file_exists($fileorigen))
        {
            $subir=false;
            $uploadfile=mb_strtolower(basename($_FILES[$nombre]['name']));
            $uploadfile_len=mb_strlen($uploadfile);
            $uploadfile_punto=mb_strrpos($uploadfile,".");
            $uploadfile_ext=mb_substr($uploadfile,$uploadfile_punto,($uploadfile_len-$uploadfile_punto));
            
            foreach($extensiones as $x)
            {
                if ('.'.$x==$uploadfile_ext){
                    $subir=true;
                    break;
                }
            }
            if ($subir){
                $archivo=time().$num.$uploadfile_ext;
                $filedestino=$ruta.$archivo;
                move_uploaded_file($fileorigen, $filedestino);
            }
        }
    }
    
    return $archivo;
}

function subirArchivo_home($nombre, $extensiones, $num = 0)
{    
    $archivo = '';
    if (isset($_FILES[$nombre]['name']))
    {
        $ruta = "archivos/";    
        $fileorigen=$_FILES[$nombre]['tmp_name'];
        if (file_exists($fileorigen))
        {
            $subir=false;
            $uploadfile=mb_strtolower(basename($_FILES[$nombre]['name']));
            $uploadfile_len=mb_strlen($uploadfile);
            $uploadfile_punto=mb_strrpos($uploadfile,".");
            $uploadfile_ext=mb_substr($uploadfile,$uploadfile_punto,($uploadfile_len-$uploadfile_punto));
            
            foreach($extensiones as $x)
            {
                if ('.'.$x==$uploadfile_ext){
                    $subir=true;
                    break;
                }
            }
            if ($subir){
                $archivo=time().$num.$uploadfile_ext;
                $filedestino=$ruta.$archivo;
                move_uploaded_file($fileorigen, $filedestino);
            }
        }
    }
    
    return $archivo;
}

function idiomas($idioma){
	switch($idioma){
		case 'ES':
			$res = 1;
			break;
		case 'EN':
			$res = 2;
			break;
		case 'PO':
			$res = 3;
		case 'CH':
			$res = 4;
			break;
		case '':
			$res = '';
			break;
		}
	return $res;
	}
function string_sanitize($string, $force_lowercase = true, $anal = false) {
    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".", " "),
        '-',
        $string
    );


    return $string;
}

function randomcaracter()
{
    $caracteres='123456789abcdefghijklmnopqrstuvxyz';        
    $n= strlen($caracteres)-1;    
    global $newcaracter;
    $newcaracter='';
    for($i=0; $i<6; $i++)
    {
        $v=rand(0, $n);
        $newcaracter.=$caracteres[$v];
    }
    return $newcaracter;
}
function generaOrden()
{
    $caracteres='0123456789';        
    $n= strlen($caracteres)-1;    
    global $orden;
    $orden='';
    for($i=0; $i<9; $i++)
    {
        $v=rand(0, $n);
        $orden.=$caracteres[$v];
    }
    return $orden;
}
function getday($fecha){
	$fechats = strtotime($fecha); //a timestamp 

	//el parametro w en la funcion date indica que queremos el dia de la semana 
	//lo devuelve en numero 0 domingo, 1 lunes,.... 
	switch (date('w', $fechats)){ 
		case 0: $diaf =  "Domingo"; break; 
		case 1: $diaf = "Lunes"; break; 
		case 2: $diaf = "Martes"; break; 
		case 3: $diaf = "Miercoles"; break; 
		case 4: $diaf = "Jueves"; break; 
		case 5: $diaf = "Viernes"; break; 
		case 6: $diaf = "Sabado"; break; 
	} 
	return $diaf;
}
function get_code_youtube($cadena) { 
        if (strpos($cadena, "youtube") === FALSE AND strpos($cadena, "youtu.be") === FALSE AND strpos($cadena, "http://") === FALSE) { 
            return FALSE; 
        } 


        if (strpos($cadena, "youtube.com") !== FALSE) { 


            if (strpos($cadena, "?v=") !== FALSE) { 
                $cadena = explode("?v=", $cadena); 
                $cadena = $cadena[1]; 

                if (strpos($cadena, "&") !== FALSE) { 
                    $cadena = explode("&", $cadena); 
                    $cadena = $cadena[0]; 
                } 
            } else { 

                if (strpos($cadena, "&v=") !== FALSE) { 
                    $cadena = explode("&v=", $cadena); 
                    $cadena = $cadena[1]; 

                    if (strpos($cadena, "&") !== FALSE) { 
                        $cadena = explode("&", $cadena); 
                        $cadena = $cadena[0]; 
                    } 
                } 
            } 
        } 



        if (strpos($cadena, "youtu.be") !== FALSE) { 

            if (strpos($cadena, "http://") !== FALSE) { 
                $cadena = str_replace("http://", "", $cadena); 
            } 
            if (strpos($cadena, "/") !== FALSE) { 
                $cadena = explode("/", $cadena); 
                $cadena = $cadena[1]; 
            } 
            if (strpos($cadena, "?") !== FALSE) { 
                $cadena = explode("?", $cadena); 
                $cadena = $cadena[0]; 
            } 
        } 


        @$json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/" . $cadena . "?v=2&alt=jsonc"), true); 
        if (!is_array($json)) { 
            return FALSE; 
        } else { 

            return $cadena; 
        } 
    } 

function getVimeoInfo($cadena)
{
      
   if (strpos($cadena, "vimeo") === FALSE AND strpos($cadena, "http://") === FALSE) { 
   		return FALSE; 
   }
   
   if (strpos($cadena, "vimeo.com") !== FALSE) { 
            if (strpos($cadena, "/") !== FALSE) { 
                $cadena = explode("/", $cadena); 
                //$cadena = $cadena[5];                 
            } 
			if(count($cadena) > 4){
				$cadena = $cadena[5];
				}else{
					$cadena = $cadena[3];
					}
        }
	
	return $cadena;
}
function hourdiff($hour_1 , $hour_2 , $formated=false){
    
    $h1_explode = explode(":" , $hour_1);
    $h2_explode = explode(":" , $hour_2);

    $h1_explode[0] = (int) $h1_explode[0];
    $h1_explode[1] = (int) $h1_explode[1];
    $h2_explode[0] = (int) $h2_explode[0];
    $h2_explode[1] = (int) $h2_explode[1];
    

    $h1_to_minutes = ($h1_explode[0] * 60) + $h1_explode[1];
    $h2_to_minutes = ($h2_explode[0] * 60) + $h2_explode[1];

    
    if($h1_to_minutes > $h2_to_minutes){
    $subtraction = $h1_to_minutes - $h2_to_minutes;
    }
    else
    {
    $subtraction = $h2_to_minutes - $h1_to_minutes;
    }

    $result = $subtraction / 60;

    if(is_float($result) && $formated){
    
    $result = (string) $result;
      
    $result_explode = explode(".",$result);

    return $result_explode[0].":".(($result_explode[1]*60)/10);
    }
    else
    {
    return $result;
    }
}
?>