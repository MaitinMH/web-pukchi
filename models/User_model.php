<?php

    class User_model extends Model{        		
		
        public function __construct() {
            parent::__construct();
        }				
        
        function signUp($data){
			return $this->db->insert('usuarios',$data);
        }
        
        function SignIn($data){
            //return $this->db->select($fields,'usuarios',$where);
			
			return $this->db->select("SELECT * FROM usuarios WHERE correo = :correo and estado ='A'",$data);
        }
		
		function actLogin($id,$data){
            //return $this->db->select($fields,'usuarios',$where);
			
			return $this->db->update("usuarios",$data,"id =".$id);
        }
		
		function consultar($id){
            //return $this->db->select($fields,'usuarios',$where);
			
			return $this->db->select("SELECT * FROM usuarios WHERE id = :id",array("id"=>$id));
        }
		
		function consultar_rol($id){
            //return $this->db->select($fields,'usuarios',$where);
			
			return $this->db->select("SELECT * FROM rols WHERE id = :id_rol",array("id_rol"=>$id));
        }

        function obtDatos($id){
			return $this->db->select("SELECT * FROM configuracion WHERE id = :id",array("id"=>$id));
        }
        
    }
