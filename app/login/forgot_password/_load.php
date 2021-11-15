<?php   include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    $queryArray = array();
    parse_str($_SERVER['QUERY_STRING'],$queryArray);
    
    if(isset($queryArray["uid"])) {
        $_EMAIL = base64_decode($queryArray["uid"]);
        
        $sql = "select 	u.id, email, nome 
                from 		Usuario u 
                inner join 	Pessoa  P on u.pessoa_id = P.id
                where  u.email = ?";

        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$_EMAIL);
        $stmt->execute();
        $result = $stmt->get_result();
                        
        foreach ($result as $row) { 
            
            $data = array();
            $data['PersonId']    = $row["id"];
            $data['Personemail'] = $row["email"];
            $data['Personnome']  = $row["nome"];

            $Persons= $data;              
        }
    }
}
?>