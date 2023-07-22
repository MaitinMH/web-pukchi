<?=Includes::head();?>
<script>
$(document).ready(function(){	
	formSearch('formSearch','main','btnSearch')
});
</script>
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

<?php 
if(isset($_GET['find_cli_nom']) ){
	
    $getCli		= $_GET['find_cli_nom'];

	}else{  
	$getCli		= "";
	
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
                	<div class="content_ventas">	                    	
                        <div class="title_sub_content title_ventas">                        	
                        	PREGUNTAS
                        </div>
                        <div class="sub_content_ventas">                            
                            <div class="table_ventas">
                                <div class="table-responsive">
                                <table data-toggle="table" data-pagination="true" data-search="true" data-checkbox="true">
                                    <thead>
                                        <tr class="text-center">                                            
                                            <th scope="col" >Num.</th>                                            
                                            <th scope="col" >Pregunta</th>                                            
                                            <th scope="col">Acción</th>                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $i=1;
                                    $showtotal = 0; 		
									foreach($this->clietblData as $r){        

                                        $p=($r['estado']=='A') ? 'fa-window-close':'fa-check-square';
                                        $t=($r['estado']=='A') ? 'Despublicar' : 'Publicar';    
                                        $y=($r['estado']=='A') ? 'checked' : '';    
                                        $titlepopup=($r['estado']=='A') ? 'Ocultara' : 'Mostrar'; 
                                                          
										print "<tr id='row_".$r['id']."'>
											   		<th align='center' scope='row'>".$i."</th>													
													<td >".$r['titulo']."</td>                                                    													
                                                    <td align='center'>                                                                                                                
                                                        <a href='form?codReg=".$r['id']."' class='text-dark'><i class='fas fa-edit'></i></a>                                                        
                                                    </td>                                                    
											   </tr>";
										                                        
                                        $i++;
									}						                                    
                                    ?>     
                                    </tbody>                           
                                </table>
                                </div>
                            </div>
                                
                                                                   
    
        <!-- Modal -->
        <div class="modal fade" id="myModal" data-backdrop="dinamic" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos</h5>
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