<?=Includes::head();?>
<script>
    $(document).ready(function(){                       
        formData('form_config','actionForm');
    });
</script>
<body>
	<div class="main_section">
    	
        <?=Includes::banner()?>        
        	
         <div class="middle_section">
         	
            <div class="content_left">
            	<?=Includes::menu_izq()?>
            </div>
            <div class="content_right">
            	<div class="sub_content">
                	<div class="content_administracion">	
                    	<div class="title_sub_content title_admins">ADMINISTRACIÓN</div>
                        
                        <div class="content_form_admins">                        	
                        	<form name="fonrm_admins" id="form_config">
                                <input type="hidden" name="tipo" value="2">
                            	<fieldset>
                                <legend>Datos</legend>
                                <div class="container">
                                	
                                    <div class="row">
                                    	<div class="col-sm"><label>Nombre de Empresa:</label></div>
                                        <div class="col-sm"> <input type="text" name="nombre_empresa" value="<?=$this->admData["empresa"]?>"></div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-sm"><label>Razón Social:</label></div>
                                        <div class="col-sm"><input type="text" name="razon_social" value="<?=$this->admData["razon_social"]?>"></div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-sm"><label>Ruc:</label></div>
                                        <div class="col-sm"><input type="text" name="ruc" value="<?=$this->admData["ruc"]?>"></div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-sm"><label>Dirección:</label></div>
                                        <div class="col-sm"><input type="text" name="direccion" value="<?=$this->admData["direccion"]?>"></div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-sm"><label>Teléfonos:</label></div>
                                        <div class="col-sm"><input type="text" name="telefonos" value="<?=$this->admData["telefono"]?>"></div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-sm"><label>Ubicación:</label></div>
                                        <div class="col-sm"><input type="text" name="ubicacion" value="<?=$this->admData["ubicacion"]?>"></div>
                                    </div>
                                    <!--<div class="row">
                                    	<div class="col-2"><label >Imagen:</label></div>
                                        <div class="col-sm"><input type="file" name="imagen"></div>
                                    </div>-->
                                    
                                </div>
                                
                                </fieldset>
                                <input type="submit" class="cursor btn_small btn_form btn_form_green" value="Guardar">
                            </form>
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