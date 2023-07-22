<?php

    class Administracion_model extends Model{        		
		
        public function __construct() {
            parent::__construct();
        }				
                
		
		function obtDatos($id){
			return $this->db->select("SELECT * FROM configuracion WHERE id = :id",array("id"=>$id));
        }
		
		/*function inserDatos($id){
			return $this->db->select("SELECT * FROM rols WHERE id = :id_rol",array("id_rol"=>$id));
        }*/
        

        function actDatos($id,$data){
			return $this->db->update("configuracion",$data,"id =".$id);
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
            return $this->db->select("select DV.id AS id,fecha_emision,fe_modificacion, nombres, direccion, di_ruc, sub_total, igv, total,
CASE tipoDoc
										WHEN 1 THEN 'Efectivo'
										WHEN 2 THEN 'Crédito'
										WHEN 3 THEN 'Yape'
										WHEN 4 THEN 'Plin'
										WHEN 5 THEN 'Transferencia'	
END AS tipoDoc
										FROM docnotapedido as DV 										
										WHERE DV.estado <> :estado $fieldDetails ORDER BY DV.id DESC",array("estado"=>$estado));         
        }

        function obtDataConfig($id){
            return $this->db->select("SELECT * FROM configuracion WHERE id = :id",array("id"=>$id));
        }

        //CONSULTAS PARA LA SECCION VIEW
        function datosView($id){
            return $this->db->select("SELECT * FROM docnotapedido WHERE estado <> 'A' and id = :id",array("id"=>$id));
        }
        function obtSerieViewD1($id_doc){
            return $this->db->select("SELECT DS1.letra as letra, DS1.numero as  numero, DS1.serie AS serie
                                        FROM docVent_doc1serie AS DV1
                                        INNER JOIN doc1_serie AS DS1 ON DS1.id = DV1.id_serie
                                        WHERE DV1.id_doc = :id_doc",array("id_doc"=>$id_doc));
        }
        function obtSerieViewD2($id_doc){
            return $this->db->select("SELECT DS2.letra as letra, DS2.numero as  numero, DS2.serie AS serie
                                        FROM docVent_doc2serie AS DV2
                                        INNER JOIN doc2_serie AS DS2 ON DS2.id = DV2.id_serie
                                        WHERE DV2.id_doc = :id_doc",array("id_doc"=>$id_doc));
        }
        function obtProdsView($id_docvent){
            return $this->db->select("SELECT DP.cant as cantidad, DP.unidMedidas as unidMedidas, DP.precUni as precUni, P.nombre as producto, DP.importe as importe
										FROM detnotapedido AS DP
										inner join productos AS P ON P.id =  DP.id_prod
										WHERE DP.estado <> 'E' and DP.id_docnotapedido = :id_docnotapedido",array("id_docnotapedido"=>$id_docvent));
        }
        //FIN VIEW

        /*===============================
         * Procesos de simulacion session
         * usuario & serie de Boletas
         *=============================*/
        function obtInfoSessiUsuSerie1($id_usu,$estado){
            return $this->db->select("SELECT count(*) as numero , S1.* FROM sessionUsuSerieVent1 as S1 WHERE id_usu = :id_usu and estado = :estado",array("id_usu"=>$id_usu,"estado"=>$estado));            
        }
        function obtOneInfoSessiUsuSerie1($estado){
            return $this->db->select("SELECT count(*) as cant , S1.*  FROM sessionUsuSerieVent1 as S1 WHERE estado = :estado",array("estado"=>$estado));            
        }
        function obtNewDoc1Serie($id){
            return $this->db->select("SELECT * FROM doc1_serie WHERE id = :id",array("id"=>$id));
        }
        function obtOneDoc1Serie($id){
            return $this->db->select("SELECT count(*) AS cant from doc1_serie AS D1S
                                        inner join sessionUsuSerieVent1 AS S1 ON S1.id_serie = D1S.id
                                        Where S1.estado <> 'U' AND S1.id_serie = :id",array("id"=>$id));
        }
        
        function IfExitSerie1Act($id){
            return $this->db->select("select count(*) as cant , d1.*  from doc1_serie as d1 where d1.id not in (select id_serie from sessionUsuSerieVent1) and d1.id <> :id",array("id"=>$id));
        }
        
        function callInsertDoc1(){
            return $this->db->precedure("CALL doc1serie_insert()");
        }
        
        function inserDatosSessiUsuSerie1($data){
            return $this->db->insert("sessionUsuSerieVent1",$data);
        }
        function actDatosSessiUsuSerie1($id_usu,$id_serie,$data){
            return $this->db->update("sessionUsuSerieVent1",$data,"id_usu =".$id_usu. " and id_serie =".$id_serie);
        }
        function new_actDatosSessiUsuSerie1($id_serie,$data){
            return $this->db->update("sessionUsuSerieVent1",$data,"id_serie =".$id_serie);
        }
        function new1_actDatosSessiUsuSerie1($id_usu,$data){
            return $this->db->update("sessionUsuSerieVent1",$data,"id_usu =".$id_usu." and estado <> 'U' ");
        }
        /*========================
         * Fin procesos simulacion
         * session.
         *=======================*/
         
         /*===============================
         * Procesos de simulacion session
         * usuario & serie de Facturas.
         *=============================*/
        function obtInfoSessiUsuSerie2($id_usu,$estado){
            return $this->db->select("SELECT count(*) as numero , S2.* FROM sessionUsuSerieVent2 as S2 WHERE id_usu = :id_usu and estado = :estado",array("id_usu"=>$id_usu,"estado"=>$estado));            
        }
        function obtOneInfoSessiUsuSerie2($estado){
            return $this->db->select("SELECT count(*) as cant , S2.*  FROM sessionUsuSerieVent2 as S2 WHERE estado = :estado",array("estado"=>$estado));            
        }
        function obtNewDoc2Serie($id){
            return $this->db->select("SELECT * FROM doc2_serie WHERE id = :id",array("id"=>$id));
        }
        function obtOneDoc2Serie($id){
            return $this->db->select("SELECT count(*) AS cant from doc2_serie AS D2S
                                        inner join sessionUsuSerieVent2 AS S2 ON S2.id_serie = D2S.id
                                        Where S2.estado <> 'U' AND S2.id_serie = :id",array("id"=>$id));
        }
        
        function IfExitSerie2Act($id){
            return $this->db->select("select count(*) as cant , d2.*  from doc2_serie as d2 where d2.id not in (select id_serie from sessionUsuSerieVent2) and d2.id <> :id",array("id"=>$id));
        }
        
        function callInsertDoc2(){
            return $this->db->precedure("CALL doc2serie_insert()");
        }
        
        function inserDatosSessiUsuSerie2($data){
            return $this->db->insert("sessionUsuSerieVent2",$data);
        }
        function actDatosSessiUsuSerie2($id_usu,$id_serie,$data){
            return $this->db->update("sessionUsuSerieVent2",$data,"id_usu =".$id_usu. " and id_serie =".$id_serie);
        }
        function new_actDatosSessiUsuSerie2($id_serie,$data){
            return $this->db->update("sessionUsuSerieVent2",$data,"id_serie =".$id_serie);
        }
        function new1_actDatosSessiUsuSerie2($id_usu,$data){
            return $this->db->update("sessionUsuSerieVent2",$data,"id_usu =".$id_usu." and estado <> 'U' ");
        }
        /*========================
         * Fin procesos simulacion
         * session.
         *=======================*/


        /*=============
         * CONTROL CAJA
         *===========*/
        function ObtDetDCVent($estado,$buscar=''){
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
            return $this->db->select("SELECT * FROM docnotapedido WHERE fecha_emision = :fecha and estado = 'A'",array("fecha"=>$estado)); 
        }

        function ObtDataCierreCaja($estado,$buscar=''){
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
                //$fieldDetails = "";
                $fieldDetails = "and fecha_cierre like '%".date('Y-m-')."%' ";
                }

            return $this->db->select("SELECT saldoCaja,monto, 
            (SELECT SUM(TOTAL) FROM docnotapedido AS DV WHERE DV.fecha_emision = CJ.fecha_cierre and tipoDoc=1 and DV.estado = 'A' group by DV.fecha_emision) AS VenEfectivo,
			(SELECT SUM(TOTAL) FROM docnotapedido AS DV WHERE DV.fecha_emision = CJ.fecha_cierre and tipoDoc=2 and DV.estado = 'A' group by DV.fecha_emision) AS venCredito,
			(SELECT SUM(TOTAL) FROM docnotapedido AS DV WHERE DV.fecha_emision = CJ.fecha_cierre and tipoDoc=3 and DV.estado = 'A' group by DV.fecha_emision) AS venYape,
			(SELECT SUM(TOTAL) FROM docnotapedido AS DV WHERE DV.fecha_emision = CJ.fecha_cierre and tipoDoc=4 and DV.estado = 'A' group by DV.fecha_emision) AS venPlin,
			(SELECT SUM(TOTAL) FROM docnotapedido AS DV WHERE DV.fecha_emision = CJ.fecha_cierre and tipoDoc=5 and DV.estado = 'A' group by DV.fecha_emision) AS venTransferencia,
            (SELECT SUM(TOTAL) FROM docnotapedido AS DV WHERE DV.fecha_emision = CJ.fecha_cierre and DV. estado = 'A' group by DV.fecha_emision) AS ventas,
            (SELECT SUM(costo) FROM gastos_diarios AS GS WHERE GS.fecha = CJ.fecha_cierre and CJ.estado = 'A' group by GS.fecha) AS gastos,
            CJ.fecha_cierre 
            FROM caja AS CJ WHERE CJ.estado = :estado $fieldDetails order by fecha_cierre desc",array("estado"=>$estado)); 
        }
        /*=================
         * FIN CONTROL CAJA
         *===============*/
        
    }
