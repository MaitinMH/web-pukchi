<?=Includes::head();?>
<?php //Session::val_session();?>
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
                	<div class="content_empresa">	
                    	<div class="img_empresa">
                        	<img src="<?=URL?>public/image/logo.png" width="200" >
                        	<!--<span class="icon-logo-catalogo-tiendas fa-3x"></span>-->
                            <!--<i class="fas fa-desktop" style="font-size:42px"></i>-->
                        </div>
                        <div class="desc_empresa">                        
                            <div class="desc_text_empresa"><?=$this->admData["empresa"]?></div>
                            <div class="address_empresa"><?=$this->admData["direccion"]?></div>
                            <div class="phone_empresa"><?=$this->admData["telefono"]?></div>
                            <div class="place_empresa"><?=$this->admData["ubicacion"]?></div>
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