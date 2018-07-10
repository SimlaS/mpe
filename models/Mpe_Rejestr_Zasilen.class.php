<?php
include_once "models/Table.class.php";
class Mpe_Rejestr_Zasilen_Table extends Table{
    
    public function getAllNotCompleted(){
        $this->db->q("SELECT
                        MRZ.*
                        ,to_char(MRZ.DATA_KOMENTARZA, 'YYYY-MM-DD hh24:mi:ss') DATA_KOMENTARZA_TXT
                        ,MKI.IMIE||' '||MKI.NAZWISKO AS KOMENTATOR
                      FROM
                        MPE_REJESTR_ZASILEN MRZ
                        ,MPE_KOMENTATORZY_IP MKI
                      WHERE 1=1
                        AND MKI.ID(+) = MRZ.ID_KOMENTATORA
                        --AND STATUS_OBSLUGI ='O'
                        AND CODE <> 0
                        AND TRUNC(MRZ.DATA_WPISU,'DD') BETWEEN TRUNC(add_months(sysdate, -1),'DD') AND TRUNC(sysdate,'DD')          
                        ORDER BY DATA_WPISU DESC
                    ");
        return $this->db->ret();
    }
    public function getDetailsForEmail($id){
        $this->db->q("SELECT
                        MRZ.*
                        ,to_char(MRZ.DATA_KOMENTARZA, 'YYYY-MM-DD hh24:mi:ss') DATA_KOMENTARZA_TXT
                        ,MKI.IMIE||' '||MKI.NAZWISKO AS KOMENTATOR
                      FROM
                        MPE_REJESTR_ZASILEN MRZ
                        ,MPE_KOMENTATORZY_IP MKI
                      WHERE 1=1
                        AND MKI.ID(+) = MRZ.ID_KOMENTATORA
                        --AND STATUS_OBSLUGI ='O'
                        AND CODE <> 0
                        AND TRUNC(MRZ.DATA_WPISU,'DD') BETWEEN TRUNC(add_months(sysdate, -1),'DD') AND TRUNC(sysdate,'DD')          
                        ORDER BY DATA_WPISU DESC
                    ");
        return $this->db->ret();
    }
    public function updateComment($id,$komentarz,$status,$id_komentatora,$ip_komentatora){
        $this->db->q("Update MPE_REJESTR_ZASILEN 
                set TEKST_KOMENTARZA = '{$komentarz}',
                    STATUS_OBSLUGI = '{$status}',
                    DATA_KOMENTARZA = SYSDATE,
                    ID_KOMENTATORA = $id_komentatora,
                    IP_KOMENTATORA = '{$ip_komentatora}'
                        WHERE 1=1
                        AND ID = {$id}");
        $this->db->commit();
    }
}
