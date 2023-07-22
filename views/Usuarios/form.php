<?php 
if($_GET['tipo']==2){
	$_codUsu	=	$_GET['codUsu'];
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
}elseif($_GET['tipo'] == 1){
	$estado     =   "";
    $_codUsu	=	"";
	$codUsu		=	"";
	$codRol		=	"";
	$nombres	=	"";
	$apellidos	=	"";
	$DI			=	"";
	$direccion	=	"";
	$telefono	=	"";
	$correo		=	"";
	$pwd		=	"";
    $fechNanc   =   "";
	//$imagen		=	"";	
}
?>
<?=Includes::head();?>
<script src="<?=URL?>public/js/usuarios.js"></script>
<script>
    $(document).ready(function(){
        $.datepicker.regional['es'] ={
        /*closeText: 'Cerrar',
        prevText: 'Previo',
        nextText: 'Próximo',*/
       
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        //monthStatus: 'Ver otro mes', 
        //yearStatus: 'Ver otro año',
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        dateFormat: 'yy-mm-dd', 
        firstDay: 1,
        //initStatus: 'Selecciona la fecha', isRTL: false
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
    $( ".datepicker" ).datepicker({changeYear: true, changeMonth: true,yearRange: '-60:+0', });
        });
    </script>
<script>
	$(document).ready(function(){						
        formData('fonrm_admins','add_usuarios');
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
                        	<div class="title_btn_navigation">
                            	<a href="main" tile="Atrás" class="btn_back cursor"><i class="fas fa-arrow-circle-left" style="color:#565656"></i></a>
                                <!--<a class="btn_next cursor"><i class="icon30 icon-next"></i></a>-->
                            </div>
                            USUARIOS
                        </div>
                        <div class="sub_content_usuarios">
                            <div class="block_agregar">                            
                                <form name="fonrm_admins" id="fonrm_admins">
                                	<input type="hidden" name="tipo" value=<?=$_GET['tipo']?>>
                                    <input type="hidden" name="codUsu" value=<?=$_codUsu?>>
                                    <fieldset>                                    
                                    <legend>Datos</legend>
                                    <div class="datos_form">
                                        <div class="container">
                                            <div class="row">
                                            	<div class="col-2"><label id="lbl_cod">Estado:</label></div>
                                                <div class="col-sm">
                                                	<select name="estado" class="select_form validate[required]" id="sel_rol">
                                                        <option value="A" <?php if($estado=='A'){echo "selected='selected'";}?>>Activo</option> 
                                                        <option value="I" <?php if($estado=='I'){echo "selected='selected'";}?>>Inactivo</option>                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label id="lbl_cod">Codigo:</label></div>
                                                <div class="col-sm"><input type="text" name="cod_usu" id="text_cod" value="<?=$codUsu?>" class="validate[required]"></div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label id="lbl_rol">Rol:</label></div>
                                                <div class="col-sm"><select name="rol" class="select_form validate[required]" id="sel_rol">
                                                        <option value="">Seleccionar</option>
                                                        <?php foreach($this->rolsData as $r){?>
                                                        <option value="<?=$r['id']?>" <?php if($r['id']==$codRol){echo "selected='selected'";}?>><?=$r['nombre']?></option>
                                                        <?php }?>                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label>Nombre(s):</label></div>
                                                <div class="col-sm"><input type="text" name="nom_usu" value="<?=$nombres?>" class="validate[required]"></div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label>Apellidos:</label></div>
                                                <div class="col-sm"><input type="text" name="ap_usu" value="<?=$apellidos?>" class="validate[required]"></div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label>DNI:</label></div>
                                                <div class="col-sm"><input type="text" name="di_usu" value="<?=$DI?>" class="validate[required]"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2"><label>Fech. Nacimiento:</label></div>
                                                <div class="col-sm"><input type="text" name="fechn_usu" value="<?=$fechNanc?>" class="datepicker"></div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label>Dirección:</label></div>
                                                <div class="col-sm"><input type="text" name="direc_usu" value="<?=$direccion?>"></div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label>Teléfono:</label></div>
                                                <div class="col-sm"><input type="text" name="telf_usu" value="<?=$telefono?>"></div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label>Correo:</label></div>
                                                <div class="col-sm"><input type="text" name="email_usu" value="<?=$correo?>" class="validate[required,custom[email]"></div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-2"><label>Contraseña:</label></div>
                                                <div class="col-sm"><input type="password" name="pwd_usu" value="<?=$pwd?>" class="validate[required]"></div>
                                            </div>
                                            
                                        
                                        </div>
                                        
                                    </div>
                                    
                                    </fieldset>
                                    <input type="submit" class="cursor btn_small btn_form btn_form_green" id="btn_add_usu" value="Guardar">
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