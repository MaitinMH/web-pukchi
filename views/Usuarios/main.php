<?=Includes::head();?>
<script>
$(document).ready(function(){	
	formSearch('formSearch','main','btnSearch')
});
</script>
<?php 
if(isset($_GET['find_cod']) && isset($_GET['find_nom']) && isset($_GET['find_ap'])){
	$getNom		= $_GET['find_nom'];
	$getAp		= $_GET['find_ap'];
	$getCod		= $_GET['find_cod'];	
	}else{
	$getNom		= "";
	$getAp		= "";
	$getCod		= "";
		}
?>
<body>
	<div class="main_section">
    	
        <?=Includes::banner()?>
        
        	
         <div class="middle_section">
         	<div class="content_left">
            	<?=Includes::menu_izq()?>
            </div>            
            <div class="content_right">
            	<div class="sub_content">
                	<div class="content_usuarios">	                    	
                        <div class="title_sub_content title_usuarios">                        	
                        	USUARIOS
                        </div>                        
                        <div class="sub_content_usuarios">
                        	<div class="content_search">
                                <form id="formSearch" method="get" action="main">
                                <fieldset>
                                    <legend>Buscador</legend>
                                    <div class="row">
                                        <div class="col-1 pt-2"><label>Codigo: </label></div>
                                        <div class="col-sm pt-2"><input type="text" name="find_cod" id="txt_cod" value="<?=$getCod?>"></div>
                                        <div class="col-1 pt-2"><label>Nombre(s): </label></div>
                                        <div class="col-sm pt-2"><input type="text" name="find_nom" id="txt_nom" value="<?=$getNom?>"></div>
                                        <div class="col-1 pt-2"><label>Apellidos: </label></div>
                                        <div class="col-sm pt-2"><input type="text" name="find_ap" id="txt_ap" value="<?=$getAp?>"></div>
                                        <div class="col-sm pt-2"><input type="button" class="btn_form btn_form_orange_gradient btn_small cursor" id="btnSearch" value="Buscar"></div>
                                    </div>
                                </fieldset>
                                </form>
                            </div>
                            
                            <div class="table_usuarios">                            	
                                <div class="table-responsive">
                                <table class="table table-fixed">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-1">Num.</th>
                                        <th scope="col" class="col-1">Codigo</th>
                                        <th scope="col" class="col-1">Rol</th>
                                        <th scope="col" class="col-2">Nombres</th>
                                        <th scope="col" class="col-2">Apellidos</th>
                                        <th scope="col" class="col-2">Correo</th>
                                        <!--<th scope="col" class="col-2">Ult. Fech. Login</th>-->
                                        <th scope="col" class="col-1">Estado</th>
                                        <th scope="col" class="col-2">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $i=1; 		
									foreach($this->usutblData as $r){
										print "<tr id='row_".$r['id']."'>
											   		<th align='center' scope='row' class='col-1'>".$i."</th>													
													<td align='center' class='col-1'>".$r['cod_usu']."</td>
													<td align='center'class='col-1'>".$r['nomRol']."</td>
													<td class='col-2'>".$r['nombres']."</td>
													<td class='col-2'>".$r['apellidos']."</td>
													<td align='center' class='col-2'>".$r['correo']."</td>
													
													<td align='center' class='col-1'>".$r['estado']."</td>
                                                    <td align='center' class='col-2'>
                                                        <a href='javascript:void(0);' data-href='view?id=".$r['id']."' class='text-dark openPopup' data-target='#theModal' data-toggle='modal' ><i class='fas fa-eye'></i></a>
                                                        <a href='form?tipo=2&codUsu=".$r['id']."' class='text-dark'><i class='fas fa-edit'></i></a>
                                                        <a href='javascript:eliminar(".$r['id'].");'class='text-dark openPopup'><i class='fas fa-trash-alt'></i></a>
                                                    </td>
											   </tr>";
										$i++;
									}						                                    
                                    ?>                                                                                                       
                                    </tbody>
                                </table>
                            </div>
                                <div class="mt-2 btn-group nav justify-content-end" role="group" aria-label="Basic example">
                                    <!--<a class="btn_link btn_form_green btn_small cursor mr-2 text-white" id="btn_view" onClick="accion_usu(4)"><i class="fas fa-eye"></i> Detalle</a>
                                    <a class="btn_link btn_form_green btn_small cursor mr-2 text-white" id="btn_delete" onClick="accion_usu(3)"><i class="fas fa-trash-alt"></i> Eliminar</a>
                                    <a class="btn_link btn_form_green btn_small cursor mr-2 text-white" id="btn_edit" onClick="accion_usu(2)"><i class="fas fa-pen"></i> Editar</a>-->
                                    <a class="btn_link btn_form_green btn_small cursor mr-2 text-white" id="btn_add" onClick="accion_usu(1)"><i class="fas fa-file"></i> Agregar</a>
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

    <!-- Modal -->
        <div class="modal fade" id="myModal" data-backdrop="dinamic" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detalle usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                
            </div>
            </div>
        </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.openPopup').on('click',function(){
                    var dataURL = $(this).attr('data-href');
                    $('.modal-body').load(dataURL,function(){
                        $('#myModal').modal({show:true});
                    });
                }); 
            });
        </script>
</body>
</html>