<?php
include_once "models/Table.class.php";
class Mpe_Komentatorzy_Ip_Table extends Table{
    
    public function getComentatorByIp($ip){
        $this->db->q("SELECT
                        *                   
                      FROM
                        MPE_KOMENTATORZY_IP                       
                      WHERE 1=1
                        AND IP = '{$ip}'
                    ");
        $who = $this->db->ret();
        if($this->db->ROWS > 0){
            return $who;
        }else{
            return false;
        }
    }
    
    public function getAll(){
        $this->db->q("SELECT * FROM MPE_KOMENTATORZY_IP
                    ");
        return $this->db->ret();
    }
    
    
    public function getAllComentators(){
            $inpArray = $this->getAll();
            $return = "";
            $return = "<option disabled selected value> -- proszê wybraæ -- </option>\n";
            foreach($inpArray as $idx => $row){
                $key = $row['ID'];
                $val = $row['IMIE'].' '.$row['NAZWISKO'];
                $return .= "<option value='{$key}'>$val</option>\n";
            }
        return $return;
    }

//    public function deleteAllAwaiting(){
//        $this->db->q("Delete FROM skip_zadania  WHERE status is null or status <> 1");
//        $this->db->commit();
//    }
    public function updateKomentator($id,$ip){
        $this->db->q("Update MPE_KOMENTATORZY_IP 
                set IP = '{$ip}'
                        WHERE 1=1
                        AND ID = {$id}");
        $this->db->commit();
    }
}
