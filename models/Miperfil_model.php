<?php
    class Miperfil_model extends Model{        		
		
        public function __construct() {
            parent::__construct();
        }				                				
		
		function obtRols($id_rol){
			return $this->db->select("SELECT * FROM rols WHERE estado = 'A' and id = :id",array("id"=>$id_rol));
        }
		
		function obtDatos($id){
			return $this->db->select("SELECT * FROM usuarios WHERE id = :id and estado <> 'E' ",array("id"=>$id));
        }
				
		function actDatos($id,$data){
			return $this->db->update("usuarios",$data,"id =".$id);
        }			
        
    }