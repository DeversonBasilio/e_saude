<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];
    $UBS       = $_SESSION["UBS"];

    if(isset($_POST["PersonID"]) && isset($_POST["UBS"])) {
        $PESSOA_ID = $_POST["PersonID"];
        $UBS       = $_POST["UBS"];
    }

    if($PESSOA_ID > 0 && $UBS > 0) {
        
            /// CARREGA UBS
        $sql = " select 
                    id as UBS_ID,
                    cod_cnes,
                    nom_estab,
                    CEP,
                    dsc_endereco,
                    end_num,
                    dsc_bairro,
                    dsc_cidade, 
                    dsc_telefone
                from Ubs U
                where id = ?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('i',$UBS);
        $stmt->execute();
        $result = $stmt->get_result();

        foreach ($result as $row) { 

            $data = array();
            $data['UBS_ID']        = $row["UBS_ID"];
            $data['cod_cnes']      = $row["cod_cnes"];
            $data['nom_estab']     = $row["nom_estab"];
            $data['CEP']           = $row["CEP"];
            $data['dsc_endereco']  = $row["dsc_endereco"];
            $data['end_num']       = $row["end_num"];
            $data['dsc_bairro']    = $row["dsc_bairro"];
            $data['dsc_cidade']    = $row["dsc_cidade"];
            $data['dsc_telefone']  = $row["dsc_telefone"];

            $UBS= $data;  
        }
    }
}
?>