<?php 
	$_codUsu	=	Session::getValue('ID');
	$codUsu		=	$this->usuData['cod_usu'];
	$codRol		=	$this->usuData['rol'];
	$nombres	=	$this->usuData['nombres'];
	$apellidos	=	$this->usuData['apellidos'];
	$DI			=	$this->usuData['di'];
	$direccion	=	$this->usuData['direccion'];
	$telefono	=	$this->usuData['telefono'];
	$correo		=	$this->usuData['correo'];
	$pwd		=	$this->usuData['pwd'];
    $fechNanc   =   $this->usuData['fechNanc'];
	//$imagen		=	$this->usuData['imagen'];
	$estado		=	$this->usuData['estado'];	
	$Nrol		=   $this->rolsData["nombre"];

?>
<?=Includes::head();?>
<script>
	$(document).ready(function(){						
        ActPassword('fonrm_admins2','actionForm');
		
		$(".detmen").click(function(){
			$("#fonrm_admins").show("slow");
			$("#fonrm_admins2").hide("slow");
			
			$( this ).css({"background":"#F2F2F2","color":"#646464"});
			$(".pwdmen").css({"background":"#646464","color":"#F2F2F2"});
		});
		
		$(".pwdmen").click(function(){
			$("#fonrm_admins2").show("slow");
			$("#fonrm_admins").hide("slow");
			
			$( this ).css({"background":"#F2F2F2","color":"#646464"});
			$(".detmen").css({"background":"#646464","color":"#F2F2F2"});
		});
	});
</script>
<body>
	<div class="main_section">
    	<div class="banner_section">
        	<?=Includes::banner()?>
        </div>        	
         <div class="middle_section">
         	<div class="content_left">
            	<?=Includes::menu_izq()?>
            </div>            
            <div class="content_right">
            	<div class="sub_content">
                	<div class="content_usuarios">	
                    	<div class="title_sub_content title_usuarios">                        	
                            MI PERFIL
                        </div>
                        <div class="sub_content_usuarios">
                            <div class="block_agregar">   
                            	<div class="miperfil_menu_head">   
                                	<div class="detmen cursor">Detalle</div>
                                    <div class="pwdmen cursor">Contraseña</div>
                                </div>
                                <form name="fonrm_admins" id="fonrm_admins">
                                    <input type="hidden" name="codUsu" value=<?=$_codUsu?>>
                                    <fieldset>                                    
                                    <!--<legend>Detalle</legend>-->
                                    <div class="datos_form">
                                        <table class="tbl_form">
                                        <tr>
                                        	<td><label id="lbl_cod">Rol:</label></td>
                                            <td colspan="2">
                                            	<?=$Nrol?>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td><label id="lbl_cod">Codigo:</label></td><td colspan="2"><?=$codUsu?>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td><label>Nombre(s):</label></td><td><?=$nombres?></td>
                                        </tr>
                                        <tr>
                                        	<td><label>Apellidos:</label></td><td><?=$apellidos?></td>
                                        </tr>
                                        <tr>
                                        	<td><label>DNI:</label></td><td><?=$DI?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Fech. Nacimiento:</label></td><td><?=$fechNanc?></td>
                                        </tr>
                                        <tr>
                                        	<td><label>Dirección:</label></td><td><?=$direccion?></td>
                                        </tr>
                                        <tr>
                                        	<td><label>Teléfono:</label></td><td><?=$telefono?></td>
                                        </tr>
                                        <tr>
                                        	<td><label>Correo:</label></td><td><?=$correo?></td>
                                        </tr>                                        
                                        </table>
                                    </div>
                                    
                                    </fieldset>                                    
                                </form>
                                <form name="fonrm_admins2" id="fonrm_admins2" >
                                    <input type="hidden" name="codUsu" value=<?=$_codUsu?>>
                                    <fieldset style="padding-bottom:15px;">                                    
                                    <!--<legend>Contraseña</legend>-->
                                    <div class="datos_form">
                                        <table class="tbl_form">                                        
                                            <tr>
                                                <td><label>Contraseña actual:</label></td><td><input type="password" name="Act_pwd" class="validate[required]"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Nueva contraseña:</label></td><td><input type="password" name="Npwd" class="validate[required]"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Repirta nueva contraseña:</label></td><td><input type="password" name="N2pwd"  class="validate[required]"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td><td><input type="submit" class="cursor btn_small btn_form btn_form_green" id="btn_add_usu" value="Actualizar"></td>
                                            </tr>
                                        <tr>
                                        </table>
                                    </div>                                    
                                    </fieldset>                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        
        <div class="footer_section">
        	<div class="left_section">
                &nbsp;
            </div>
        </div>
    </div>
</body>
</html>