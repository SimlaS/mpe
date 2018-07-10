<?php
include_once "models/Table.class.php";
class Mpe_Email_Oczekujace_Table extends Table{
    
    public function getReceiverEmailList($id){
        $this->db->q("SELECT
                        MRZ.*
                        ,MLO.EMAIL
                      FROM
                        MPE_REJESTR_ZASILEN MRZ
                        ,MPE_LISTA_ODBIORCOW MLO
                      WHERE 1=1
                        AND MRZ.ID_PROCESU = MLO.ID_PROCESU
                        AND MLO.STATUS = 'O'
                        AND UPPER(MLO.TYP_ODBIORCY) = 'BP' 
                        AND MRZ.ID = {$id}
                    ");
        $lista =  $this->db->ret();
        return $lista;
    }
    public function InsertAwaitingEmail($email,$tekst_alarmu,$data_danych,$komentarz){
        $this->db->q("Insert into MPE_EMAIL_OCZEKUJACE
                            (
                            ID             ,
                            DATA_WPISU     ,
                            STATUS         ,
                            EMAIL          ,
                            TEMAT          ,
                            TRESC          ,
                            STOPKA         
                            )
                      VALUES
                            (
                        SEQ_MEO_ID.NEXTVAL  ,
                        SYSDATE             ,
                        0                   ,
                        '{$email}'          ,
                        '{$tekst_alarmu}' || ': ' || '{$data_danych}',
                        '{$komentarz}',
                        CHR(13)||CHR(10)|| 'Hurtownia Danych'||CHR(13)||CHR(10)|| 'hd@pocztowy.pl'
                            )
                        ");
        $this->db->commit();
    }
}
