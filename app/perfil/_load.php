<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 


if (CONEXAO == 'yes') {
    $PESSOA_ID = $_SESSION["USUARIOS"]['PersonID'];
        
    if(isset($PESSOA_ID)) {

        $sql = "select  P.Id,             
                        CPF,      			
                        RG,                     
                        CNS,
                        Nome,               
                        Data_Nascimento,  	
                        Tipo_Sangue,       
                        Cor_Id,     
                        C.Descricao as Cor_Desc,
                        Sexo_Id,      
                        S.Descricao as Sexo_Desc,
                        celular,            
                        Telefone, 	
                        Telefone_2,     
                        CEP,                
                        Rua,        
                        Numero,         
                        Bairro,                 
                        Complemento, 
                        cidade_id,
                        Cidade,             
                        UF,         
                        Pais
                from        Pessoa  P
                left join   Cor		C on C.id = P.Cor_Id
                left join   Sexo 	S on S.id = P.Sexo_Id
                where   P.Id = ?";

        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$PESSOA_ID);
        $stmt->execute();
        $result = $stmt->get_result();
                        
        foreach ($result as $row) { 
            
            $data = array();
            $data['PersonId']    = $row["Id"];
            $data['PersonCPF']   = $row["CPF"];
            $data['PersonRG']    = $row["RG"];
            $data['PersonCNS']   = $row["CNS"];

            $data['PersonNome']             = $row["Nome"];
            $data['PersonData_Nascimento']  = $row["Data_Nascimento"];
            
            $data['PersonTipo_Sangue']      = $row["Tipo_Sangue"];
            $data['PersonCor_Id']           = $row["Cor_Id"];
            $data['PersonCor_Desc']           = $row["Cor_Desc"];
            $data['PersonSexo_Id']          = $row["Sexo_Id"];
            $data['PersonSexo_Desc']          = $row["Sexo_Desc"];
            
            $data['Personcelular']     = $row["celular"];
            $data['PersonTelefone']    = $row["Telefone"];
            $data['PersonTelefone_2']  = $row["Telefone_2"];
        
            $data['PersonCEP']          = $row["CEP"];
            $data['PersonRua']          = $row["Rua"];
            $data['PersonNumero']       = $row["Numero"];
            $data['PersonBairro']       = $row["Bairro"];  
            $data['PersonComplemento']  = $row["Complemento"];
            $data['PersonCidade_id']    = $row["cidade_id"];  
            $data['PersonCidade']       = $row["Cidade"];  
            $data['PersonUF']           = $row["UF"];
            $data['PersonPais']         = $row["Pais"];  

            $Persons= $data;              
        }
    }

    ///Sexo
    /// Carrega lista geral Sexo
    $sql = "select id, Descricao from Sexo";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    foreach ($result as $row) { 
        
        $data = array();
        $data['sexoId']    = $row["id"];
        $data['sexoDesc']  = $row["Descricao"];
    
        $sexos[]= $data;  
    }

    /// COR
    /// Carrega lista geral de Cores/Raças
    $sql = "select id, Descricao from Cor";
    
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    foreach ($result as $row) { 
        $data = array();
        $data['CorID'] = $row["id"];
        $data['CorDesc'] = $row["Descricao"];
    
        $Cores[]= $data;  
    }        
}

?>