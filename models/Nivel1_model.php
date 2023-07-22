<?php
    class Nivel1_model extends Model{        		
		
        public function __construct() {
            parent::__construct();
        }				
                
		
		function tblDatos($estado,$buscar=''){
			//return $this->db->select("SELECT * FROM usuarios WHERE id = :id",array("id"=>$id));
			if($buscar!=''){
				ksort($buscar);					
				$fieldDetails = NULL;
				foreach($buscar as $key => $values){
					if($values !=''){
						$fieldDetails .= "and $key like '%$values%' ";			
						}
					}					
				$fieldDetails = rtrim($fieldDetails, ',');									
			}else{
				$fieldDetails = "";
				}
			return $this->db->select("SELECT * from preguntas WHERE estado <> :estado  AND nivel = 1 $fieldDetails",array("estado"=>$estado));			
        }				
		
		function obtDatos($id){
			return $this->db->select("SELECT * FROM preguntas WHERE id = :id and estado <> 'E' ",array("id"=>$id));
        }
		
		function obtAlterDatos($id){
			return $this->db->select("SELECT * FROM alternativas WHERE id_pregunta = :id and estado <> 'E' ",array("id"=>$id));
		}
		function obtRespDatos($id){
			return $this->db->select("SELECT * FROM alternativas WHERE id = :id and estado = 'A' ",array("id"=>$id));
			
		}
        
		function datosView($id){
			return $this->db->select("SELECT * FROM tipoproducto WHERE id = :id and estado <> 'E' ",array("id"=>$id));
        }
		
		function inserDatosLast($data){
			//return $this->db->insert("documento_ventas",$data);
			$res = $this->db->insert_AndLastId("tipoproducto",$data);
			$arr['exec'] = $res['exec'];
			$arr['lastinsert'] = $res['lastinsert'];
			return $arr;
			//return $this->db->insert("clientes",$data);
        }

        function inserDatos($data){
			return $this->db->insert("tipoproducto",$data);
        }
		
		function actDatos($id,$data){
			return $this->db->update("tipoproducto",$data,"id =".$id);
        }
		function deleteData($id,$data){
			return $this->db->update("tipoproducto",$data,"id =".$id);
        }
		
    }