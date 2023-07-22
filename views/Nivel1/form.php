<?php 
	

	$_codReg	   = $_GET['codReg'];

    $nombres       = $this->clieData['titulo'];
    $archivo       = $this->clieData['archivo'];

		

?>
<?=Includes::head();?>

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
        $( ".datepicker" ).datepicker({changeYear: true, changeMonth: true,yearRange: '-60:+0',});
    });
  </script>
<script>
	$(document).ready(function(){						
        formData('form_admins','actionForm');
	});
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<style>
    .ck.ck-voice-label {
        display: none !important;
    }
</style>
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
                	<div class="content_clientes">	
                    	<div class="title_sub_content title_clientes">
                        	<div class="title_btn_navigation">
                            	<a href="main" tile="Atrás" class="btn_back cursor"><i class="fas fa-arrow-circle-left" style="color:#565656"></i></a>
                                <!--<a class="btn_next cursor"><i class="icon30 icon-next"></i></a>-->
                            </div>
                            Pregunta
                        </div>
                        <div class="sub_content_clientes">
                            <div class="block_agregar">                                                            	                                
                                    <fieldset>
                                    
                                    <div class="datos_form container">                                                                                                               

                                        <div class="row">
                                            <div class="col-4">                                            
                                                <audio controls>
                                                    <source src="../public/audios/<?=$archivo?>" type="audio/wav">                                                    
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                            <div class="col-sm pt-2"><?=$nombres?></div>
                                        </div>                                          
                                        
                                        <div class="row">
                                        <?php          
                                            $i          = 1;     
                                            $correcto   = 0;                                                                    		
                                            foreach($this->AlternData as $r){        

                                                if($r['correcto']){
                                                    $correcto++;
                                                }
                                                                
                                                print '<div class="col-2 m-2 p-0 rounded border border-secondary">     
                                                            <a href="javascript:responder('.$r['id'].');">
                                                                <img src="../public/image/ejercicios/'.$r['imagen'].'" width="200" height="200"/>
                                                            </a>
                                                    </div>';
                                                    if($i == 3){
                                                        print '<div class="w-100"></div>';                                                        
                                                    }                                                    
                                                $i++;
                                            }						                                    
                                        ?> 
                                        </div>
                                    </div>
                                    
                                    </fieldset>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>

         <!-- Modal -->
        <div class="modal fade" id="myModal" data-backdrop="dinamic" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Respuesta</h5>
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
        
        <div class="footer_section">
        	<div class="left_section">
            	&nbsp;
            </div>
        </div>
    </div> 
    <script type="text/javascript">
        $(function() {
            

        });

        function responder(id){
            $.ajax({						
                url: 'respuesta',
                //dataType: 'text',
                type: "GET",
                cache: false,
                contentType: false,
                processData: false,						
                data: 'id='+id,
                //mimeType:"multipart/form-data",
                beforeSend: function(){
                    //$(".sub-fom-text").html("<img src='"+window.location.protocol +"//"+ window.location.host +"/redsoesn/img/loader-7.gif' class='img-loader'>").fadeIn();
                },
                complete: function(){
                    //$(".sub-fom-text").hide().remove();
                },
                success: function(res) {
                    //var new_array = JSON.parse(res)				
                    //alert(res)					
                    if(res == true){
                        //alert('correcto!')
                        $('#myModal .modal-body').html('Correcto!!');
                        $('#myModal').modal({show:true});
                    }else{
                        //alert('Fallo, inténtelo nuevamente.')
                        $('#myModal .modal-body').html('Fallo, inténtelo nuevamente.');
                        $('#myModal').modal({show:true});
                        }
                }        
            });
        }

    </script>

</body>
</html>