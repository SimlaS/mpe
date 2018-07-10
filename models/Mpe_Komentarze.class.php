<?php
include_once "models/Table.class.php";
class Mpe_Komentarze_Table extends Table{
    
    public function getAllOpen(){
        $this->db->q("SELECT
                        *                   
                      FROM
                        MPE_KOMENTARZE                       
                      WHERE 1=1
                      AND STATUS = 'O'
                      ORDER BY 1 ASC
                    ");
        $output = $this->db->ret();
        return $output;
    }
    public function getAllEntries(){
        $this->db->q("SELECT
                        *                   
                      FROM
                        MPE_KOMENTARZE                       
                      WHERE 1=1
                      
                    ");
        $output = $this->db->ret();
        return $output;
    }
    public function getAllEntriesOptions(){
        $inpArray = $this->getAllOpen();
        $return = "";
        $return = "<option disabled selected value> -- proszê wybraæ z listy -- </option>\n";
        foreach($inpArray as $row){
            $key = $row['ID'];
            $val = $row['TRESC'];
            $return .= "<option value='{$val}'>$val</option>\n";
        }
        return $return;   
    }
    public function deleteItem($id){
        $sql = "UPDATE MPE_KOMENTARZE
                 SET 
                 DATA_DANYCH=SYSDATE
                 ,STATUS = 'Z'
                 ,DEL_STATUS = SYSDATE
                 WHERE ID = '{$id}'";
        $this->db->q($sql);
        $this->db->commit();
    }
   public function addNewItem($columnsArr){      
        $sql = $this->insertSql($columnsArr);
        $compiled = $this->db->parse($sql);
        foreach(array_keys($columnsArr) as $key){
            $colBind = ":$key";
            oci_bind_by_name($compiled, $colBind, $columnsArr[$key]);            
        }
        $this->db->execute($compiled);
        $this->db->commit();    
    }

    private function getMaxId(){
        $this->db->q("SELECT
                        MAX(ID) AS MAX_ID                   
                      FROM
                        MPE_KOMENTARZE                       
                    ");
        list($output) = $this->db->ret();
        return (int) $output['MAX_ID'];
    }
    private function insertSql($columnsArr){
        $sqlCol = '';
        $sqlVal = '';
        foreach(array_keys($columnsArr) as $column){
            $sqlCol .=",$column";
            $sqlVal .=",:$column";
        }
        $newId = $this->getMaxId() + 1;
        $sql = "INSERT INTO MPE_KOMENTARZE(
            ID
            ,DATA_DANYCH
            $sqlCol)
            VALUES(
            $newId
            ,SYSDATE
            $sqlVal)";
        return $sql;
    }
   
}
