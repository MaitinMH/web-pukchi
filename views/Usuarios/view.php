<?php 
	$codUsu		=	$this->viewData['cod_usu'];
	$Rol		=	$this->viewData['nomRol'];
	$nombres	=	$this->viewData['nombres'];
	$apellidos	=	$this->viewData['apellidos'];
	$DI			=	$this->viewData['di'];
	$direccion	=	$this->viewData['direccion'];
	$telefono	=	$this->viewData['telefono'];
	$correo		=	$this->viewData['correo'];
	$pwd		=	$this->viewData['pwd'];
    $fechNanc   =   $this->viewData['fechNanc'];
	$imagen		=	$this->viewData['imagen'];
	$estado		=	$this->viewData['estado'];	
?>
<?=Includes::head();?>
<body>
	<div class="main_section">    	     	
         <div class="middle_section">         	
            <div class="content_right">
            	<div class="sub_content">
                	<div class="content_usuarios">	
                    	<div class="title_sub_content title_usuarios">                        	
                            USUARIO
                        </div>
                        <div class="sub_content_usuarios">
                            <div class="block_agregar">                            
                                <form name="fonrm_admins" id="fonrm_admins">                                	
                                    <fieldset>                                    
                                    <legend>Datos</legend>
                                    <div class="datos_form">
                                        <table class="tbl_form">
                                        <tr>
                                        	<td><label id="lbl_cod">Estado:</label></td>
                                            <td colspan="2">
                                            	<?=$estado?>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td><label id="lbl_cod">Codigo:</label></td>
                                            <td><?=$codUsu?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                        		<label>Rol:</label>
                                             </td>
                                             <td>
                                                <?=$Rol?>
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
                                    <div class="datos_form_img">            
                                        <div class="img_emp">
                                        	<?php if($imagen !=''){?>
                                            <img src="<?=URL?>public/image/usuarios/200x200_<?=$imagen?>.">
                                            <?php }else{ ?>
											<img src="<?=URL?>public/image/nonusu_200x200.jpg">	
											<?php }?>
                                        </div>
                                    </div>
                                    </fieldset>                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>               
    </div>
</body>
</html>