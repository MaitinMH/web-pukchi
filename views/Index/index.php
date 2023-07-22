<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="shortcut icon" href="<?php echo URL;?>public/img/favi.svg" type="image/x-icon" >

<LINK REL=StyleSheet HREF="'.URL.'public/css/reset.css" TYPE="text/css" MEDIA=screen>

<LINK REL=StyleSheet HREF="<?php echo URL; ?>public/css/estilos.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="<?php echo URL; ?>public/css/bootstrap.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="<?php echo URL; ?>public/css/bootstrap-icons.css" TYPE="text/css" MEDIA=screen>

<link rel="stylesheet" href="<?php echo URL; ?>public/fontawesome/css/all.css">
<script src="<?php echo URL; ?>public/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo URL; ?>public/js/jquery.validate.js"></script>
<script src="<?php echo URL; ?>public/js/login.js"></script>

<script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
<title>.: Adminsitrador :.</title>
</head>
<body>
	<div class="container-fluid h-100 position-absolute">
        <div class="row h-100">
            <div class="col-lg-5 bg-cl-main-color pt-5">   
     	
                <div class="content-empresa row pt-2">        	
                    <div class="col text-center">                                                             
                        <div class="align-self-center">
                            <img src='<?php echo URL;?>public/image/logo.png'>
                        </div>
                    </div>            
                </div>  
                
                
            </div>
            <div class="col-lg-7 pt-5">
                <div class="content-login row pt-2">
                    <div class="col text-center">
                        <form name="form_login" id="form_login" novalidate="novalidate">                            
                            
                            <div class="pb-2">
                                <img src="<?php echo URL;?>public/img/cliente.png" width="150">
                            </div>

                            <div class="pb-4">
                                <h2 class="text-dark">Bienvenido</h2>
                            </div>

                            <div class="pb-3">
                                <i class="bi bi-person text-gray"></i>
                                <input type="text" class="input-txt-login" id="username" name="username" placeholder="Usuario" >                                
                            </div>
                            
                            <div class=" pt-2">
                                <i class="bi bi-key text-gray"></i>
                                <input type="password" class="input-txt-login" name="pwd" id="pwd" placeholder="Contraseña">                               
                            </div> 
                            <div class="pb-2 pt-2">
                                <input type="checkbox" class="" id="mostrarPwd"> <small class="font-weight-light">Mostrar Contraseña</small>                                
                            </div>                                                       
                            
                            <div class="pb-2 pt-2">
                                <button type="submit" class="btn btn-primary rounded-circle" > 
                                    <i class="fas fa-arrow-right fa-xl"></i>
                                </button>                                
                                <div class="ms-login-alert mt-2"></div>                                
                            </div>
                                                        
                        </form>
                    </div>

                </div>
            </div>

            
        </div>        
    </div>
    <script>
    $('#mostrarPwd').on('click',function(){
        if($('#pwd').attr('type') == "password"){
            $('#pwd').attr('type','text')
        }else{
            $('#pwd').attr('type','password')
        }
    })</script>
</body>
</html>