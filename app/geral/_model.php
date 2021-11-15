<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

    ///Função de deslogar
    if( isset($_POST["SAIR"]))
    {   
        session_destroy(); 
        $_SESSION = array();
    }

    if(isset($_POST["Trocar"])) {
        $_SESSION["UBS"] = -1;
    }

    if(isset($_POST["ubs_escolhida"])) {
        $_SESSION["UBS"] = $_POST["ubs_escolhida"];
    }

    if(isset($_POST["Perfil_escolhido"]) && $_POST["Perfil_escolhido"] == 1) {
        $_SESSION["UBS"] = 0;
    }

    if(isset($_POST["Perfil_escolhido"]) && $_POST["Perfil_escolhido"] == 2 && isset($_SESSION['USUARIOS']['PersonID'])) {
        
        $ubs_correspondetes = [];

        if(in_array($_SESSION['USUARIOS']['usuario_tipo'], array(2,3,4))) {
            $sql = "select Ubs_id, nom_estab, dsc_endereco, end_num, dsc_bairro, dsc_cidade
                    from 			Funcionario F
                    inner 	join	Ubs			U	on F.Ubs_id = U.id
                    where	Pessoa_id  = ?";
        
            $stmt=$conn->prepare($sql);
            $stmt->bind_param('i',$_SESSION['USUARIOS']['PersonID']);
            $stmt->execute();
            $result = $stmt->get_result();
                        
            $row_cnt = mysqli_num_rows($result);

            if($row_cnt == 1) {
                
                foreach ($result as $row) { 
                    $_SESSION["UBS"] = $row["Ubs_id"];
                }                
            }    

            if($row_cnt > 1) {
                foreach ($result as $row) { 
                    $data = array();
                    $data["Ubs_id"] = $row["Ubs_id"];
                    $data["nom_estab"] = $row["nom_estab"];
                    $data["dsc_endereco"] = $row["dsc_endereco"];
                    $data["dsc_bairro"] = $row["dsc_bairro"];
                    $data["dsc_cidade"] = $row["dsc_cidade"];
                    
                    $ubs_correspondetes[] = $data;
                }
            }

            if($row_cnt == 0) {
                echo '<h4 class="text-center">Não encontramos vínculo com nenhuma ubs</h4>';
            }
        }

        if($_SESSION['USUARIOS']['usuario_tipo'] == 1) {                ?>
            <div class="row">
                <h4 class="text-center"> Qual UBS deseja logar? </h4>
                
                <div class="col-12 col-md-5">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="termo" placeholder="Informações da ubs buscada" aria-label="Informações da ubs buscada" id="ipt_termo" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="Buscar_Ubs()">Buscar</button>
                    </div>
                </div>
                <div id="conteudo_2"></div>

<?php   }
    }

    if(isset($_POST["TERMO_BUSCA"])) {
        
        $UBS_TEXT = $_POST["TERMO_BUSCA"];

        $sql = "    select 	
                    id  ,                
                    nom_estab           as 'Nome', 
                    dsc_endereco        as 'End', 
                    dsc_bairro          as 'Bairro', 
                    dsc_cidade          as 'Cidade'
                from 		Ubs U
                where (nom_estab like '%".$UBS_TEXT."%' or dsc_endereco like '%".$UBS_TEXT."%' or dsc_bairro like '%".$UBS_TEXT."%' or  dsc_cidade like '%".$UBS_TEXT."%')";

        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $row_cnt = mysqli_num_rows($result);

        foreach ($result as $row) { 
            $data = array();
            $data["Ubs_id"] = $row["id"];
            $data["nom_estab"] = $row["Nome"];
            $data["dsc_endereco"] = $row["End"];
            $data["dsc_bairro"] = $row["Bairro"];
            $data["dsc_cidade"] = $row["Cidade"];
            
            $ubs_correspondetes[] = $data;
        }

        if($row_cnt == 0 ) {
?>
            <div class="row">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Nenhum resultado encontrado! 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
<?php
        }
    }

    if($ubs_correspondetes) {           
        foreach($ubs_correspondetes as $ub) {               ?>
            <div class="card col col-12" style="width: 18rem;">
                <h6 class="text-center"><?php echo $ub["nom_estab"]; ?></h6>
                <div class="card-body">
                    <p class="text-center row "><?php echo $ub["dsc_endereco"]; ?></p>
                    <p class=" row text-center"><?php echo $ub["dsc_bairro"]." - ".$ub["dsc_cidade"]; ?></p>
                    <button class="btn btn-success" onclick="selecionar_ubs(<?php echo $ub['Ubs_id']; ?>)">
                        Selecionar
                    </button>
                </div>
            </div>
<?php       }      
    }
?>