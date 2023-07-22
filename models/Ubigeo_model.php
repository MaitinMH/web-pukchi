<?php
    class Ubigeo_model extends Model{        		
		
        public function __construct() {
            parent::__construct();
        }				
                
				
		
		function obtProv($idDep){
			return $this->db->select("select * from ubigeo where id_dist='01' and id_dep = :idDep order by provincia asc",array("idDep"=>$idDep));
        }				
        
    }