<?php
    class Usuarios_model extends Model{        		
		
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
			if(Session::getValue('ROL') == 1 ){
				return $this->db->select("select USU.*, R.nombre as nomRol ,
										case USU.estado 
										when 'A' then 'Activo'
										when 'I' then 'Inactivo'
										when 'E' then 'Eliminado'
										end as estado
										from  usuarios as USU
										inner join rols AS R 
										where USU.rol = R.id and USU.estado= :estado $fieldDetails",array("estado"=>$estado));
			}elseif (Session::getValue('ROL') == 2) {
				return $this->db->select("select USU.*, R.nombre as nomRol ,
										case USU.estado 
										when 'A' then 'Activo'
										when 'I' then 'Inactivo'
										when 'E' then 'Eliminado'
										end as estado
										from  usuarios as USU
										inner join rols AS R 
										where USU.rol = R.id and USU.estado= :estado and USU.rol <> 1 $fieldDetails",array("estado"=>$estado));
				}
        }
		
		function obtRols(){
			if(Session::getValue('ROL') == 1 ){
				return $this->db->select("SELECT * FROM rols WHERE estado = 'A' order by id");
			}elseif(Session::getValue('ROL') == 2){
				return $this->db->select("SELECT * FROM rols WHERE estado = 'A' and id <> 1 order by id");				
			}
        }
		
		function obtDatos($id){
			return $this->db->select("SELECT * FROM usuarios WHERE id = :id and estado = 'A' ",array("id"=>$id));
        }
		
		function datosView($id){
			return $this->db->select("select USU.*, R.nombre as nomRol ,
										case USU.estado 
										when 'A' then 'Activo'
										when 'I' then 'Inactivo'
										when 'E' then 'Eliminado'
										end as estado
										from  usuarios as USU
										inner join rols AS R 
										where USU.rol = R.id AND USU.estado = 'A' AND USU.id =:id",array("id"=>$id));
        }
		
		function inserDatos($data){
			return $this->db->insert("usuarios",$data);
        }
		
		function actDatos($id,$data){
			return $this->db->update("usuarios",$data,"id =".$id);
        }
		
		function deleteData($id,$data){
			return $this->db->update("usuarios",$data,"id =".$id);
        }
        
    }