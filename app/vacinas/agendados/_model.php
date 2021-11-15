<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/config/_db.php'); 

if (CONEXAO == 'yes') 
{
    if(isset($_POST["PROC_ID"]) && isset($_POST["Data_Agenda"]) && isset($_SESSION["UBS"])) {

        $UBS_ID  = $_SESSION["UBS"];
        $PROC_ID = $_POST["PROC_ID"];
        $DATA_AGENDA = date('Y-m-d', strtotime($_POST["Data_Agenda"])) ;   
        
        $sql = "select 
                    A.id,
                    A.Procedimento_ID,
                    P.Procedimento,
                    U.nom_estab,
                    Pe.Nome,
                    A.Data_Agenda,
                    A.Horario_Agenda
                from 		Agendamentos 	A
                inner  join Procedimento	P	on A.Procedimento_ID = P.id
                inner  join Pessoa			Pe	on A.Pessoa_ID		 = Pe.id
                inner  join Ubs				U	on A.Ubs_ID			 = U.id
                where A.Ubs_ID = ".$UBS_ID." and P.id = ".$PROC_ID." and A.Data_Agenda = '".$DATA_AGENDA."' order by  A.Data_Agenda ";
        
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $Agendamentos = null;
?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> Paciente </th>
                        <th> Procedimento </th>
                        <th> Horário </th>
                        <th>          </th>
                    </tr>
                </thead>
                <tbody>
<?php
        foreach ($result as $row) { 
            echo '<tr>'.
                        '<td>'.$row["Nome"].'</td>'.
                        '<td>'.$row["Procedimento"].'</td>'.
                        '<td>'.$row["Horario_Agenda"].'</td>'.
                        '<td>
                             <button type="button" class="btn btn-primary" onclick="Atender_Paciente('.$row["id"].','.$row["Procedimento_ID"].')" > 
                                Atender 
                             </button> 
                        </td>
                    </tr>';
        }    
?>
            </tbody>
        </table>
<?php 

    }

    if(isset($_POST["ID_AGENDA"]) && isset($_POST["ID_CARTEIRA"])) 
    {
        $ID_CARTEIRA = $_POST["ID_CARTEIRA"];

        $sql = 'DELETE FROM Carteirinhas where id = '.$ID_CARTEIRA;

        if ($conn->query($sql) === TRUE) {
            echo "sucesso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }

    
    if( isset($_POST["ID_AGENDA"])   && isset($_POST["PessoaID"]) && isset($_POST["VACINA"])      
    &&  isset($_POST["dose"])        && isset($_POST["DATA_VAC"])) 
    {

        $Pessoa_ID = $_POST["PessoaID"];
        $Vacina    = $_POST["VACINA"];
        $Dose      = $_POST["dose"];
        $DATA_VAC  = $_POST["DATA_VAC"];
        
        $sql = 'INSERT INTO Carteirinhas ( id_pessoa, id_vacina, data_vacina, dose)
                values( '.$Pessoa_ID.' , '.$Vacina.' , "'.$DATA_VAC.'" , "'.$Dose.'")';

        if ($conn->query($sql) === TRUE) {
            echo "sucesso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    if(    isset($_POST["ID_AGENDA"])   && isset($_POST["NOME"])    && isset($_POST["NASC"]) 
    && isset($_POST["SANG"])        && isset($_POST["COR"])     && isset($_POST["Sexo"]) 
    && isset($_POST["PessoaID"])) {

        $Nome               = $_POST["NOME"];
        $Data_Nascimento    = $_POST["NASC"];
        $Tipo_Sangue        = $_POST["SANG"];
        $Cor                = $_POST["COR"];
        $sexo               = $_POST["Sexo"];
        $Pessoa_ID          = $_POST["PessoaID"];

        $sql = "Update Pessoa
                Set	Nome		        = ?,
                    Data_Nascimento     = ?,
                    Tipo_Sangue         = ?,
                    Cor_Id			    = ?,
                    Sexo_Id			    = ?
                Where Id = ?";
        
        // Prepare the statement.
        $statement = $conn->prepare($sql);
        
        // Bind your parameters (ssi tells mysqli what type of params it is, s = string, i = int).
        $statement->bind_param('sssiii',  $Nome ,$Data_Nascimento, $Tipo_Sangue  ,$Cor     ,$sexo    , $Pessoa_ID);
        // Execute the statement.
        $statement->execute();
}


    /// Busca agenda 
    if(isset($_POST["ID_AGENDA"])) {

        $ID_AGENDA = $_POST["ID_AGENDA"];
        
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

        $sql = "SELECT id, Procedimento FROM Procedimento";

        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
         
        $Procedimentos = null;

        foreach ($result as $row) { 
            $data = array();
            $data["Pr_id"]         = $row["id"];
            $data["Pr_dsc"]        = $row["Procedimento"];

            $Procedimentos[]= $data;  
        }

        $sql = "select 	P.Nome, 
                        P.Data_Nascimento,
                        P.Tipo_Sangue,
                        P.Sexo_Id,
                        P.Cor_Id,
                        P.id
                from 		Agendamentos A
                inner join 	Pessoa  	 P	on A.Pessoa_ID = P.id
                where A.id = ?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('s',$ID_AGENDA);
        $stmt->execute();
        $result = $stmt->get_result();
        
        foreach ($result as $row) { 
?>

            <input type="hidden" id="ipt_ID_AGENDA" value="<?php echo $ID_AGENDA?>" />
            <input type="hidden" id="ipt_Pessoa_ID" value="<?php echo $row["id"];?>" />
            
            <div class="row">
                <div class="row">
                    <div class="form-floating mb-3">
                        <input type="text"   name="Nome" class="form-control text-center" id="ipt_nome" placeholder="Nome" value="<?php echo $row["Nome"]?>">
                        <label for="ipt_nome">Nome completo</label>
                    </div>
                <div>
        
                <div class="row">
                    <div class="form-floating mb-3 col">
                        <input type="date"   name="Data_Nascimento" class="form-control text-center" id="ipt_dtnasc" placeholder="Data_Nascimento" value="<?php echo $row["Data_Nascimento"]?>">
                        <label for="ipt_dtnasc">Nascimento</label>
                    </div>

                    <div class="form-floating mb-3 col">
                        <select name="Tipo_Sangue" class="form-control text-center" id="sel_Sangue" placeholder="Tipo Sanguíneo">
                            <option value="NA"  <?php echo (!isset($row["Tipo_Sangue"])? "selected" : " "); ?> >Selecione</option>
                            <option value="UNK"  <?php echo ($row["Tipo_Sangue"] == "UNK" ? "selected" : " "); ?>>Não Sei</option>
                            <option value="A+"   <?php echo ($row["Tipo_Sangue"] == "A+" ? "selected" : " "); ?>> A+</option>
                            <option value="A-"   <?php echo ($row["Tipo_Sangue"] == "A-" ? "selected" : " "); ?>> A-</option>
                            <option value="B+"   <?php echo ($row["Tipo_Sangue"] == "B+" ? "selected" : " "); ?>> B+</option>
                            <option value="B-"   <?php echo ($row["Tipo_Sangue"] == "B-" ? "selected" : " "); ?>> B-</option>
                            <option value="AB+"  <?php echo ($row["Tipo_Sangue"] == "AB+" ? "selected" : " "); ?>>AB+</option>
                            <option value="AB-"  <?php echo ($row["Tipo_Sangue"] == "AB-" ? "selected" : " "); ?>>AB-</option>
                            <option value="O+"   <?php echo ($row["Tipo_Sangue"] == "O+" ? "selected" : " "); ?>> O+</option>
                            <option value="O-"   <?php echo ($row["Tipo_Sangue"] == "O-" ? "selected" : " "); ?>> O-</option>
                        </select>
                        <label for="sel_Sangue">Sangue</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-floating mb-3 col">                
                        <select name="Cor" class="form-control text-center" id="sel_cor">  <?php 
                            foreach($Cores as $Cor){  ?>  
                                    <option value="<?php echo $Cor["CorID"]; ?>" 
                                        <?php echo ($row["Cor_Id"] == $Cor["CorID"] ? "selected" : " " ) ?>>   <?php echo $Cor["CorDesc"];?>  </option> 
                            <?php   }                           ?>
                        </select>
                        <label for="sel_cor">Cor</label>
                    </div>

                    <div class="form-floating mb-3 col">                
                        <select name="sexo" class="form-control text-center" id="sel_sexo">  <?php 
                            foreach($sexos as $sexo){  ?>  
                                    <option value="<?php echo $sexo["sexoId"]; ?>" 
                                        <?php echo ($row["Sexo_Id"] == $sexo["sexoId"] ? "selected" : " " ) ?>>   <?php echo $sexo["sexoDesc"];?>  </option> 
                            <?php   }                           ?>
                        </select>
                        <label for="sel_sexo">Sexo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary" onclick="Salva_Info_Basicas()">
                                Salvar Informações Basícas
                        </button>
                    </div> 
                </div>
            </div>

            <div id="mensagem"></div>
<?php   
                 $sql = "   Select P.Procedimento, C.dose, data_vacina, C.id as ID_Carteirinhas 
                            from 		Carteirinhas 	C
                            inner join	Procedimento 	P	on C.id_vacina = P.id
                            where id_pessoa = ?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param('s',$row["id"]);
                $stmt->execute();
                $result1 = $stmt->get_result();

?>
            <h6 class="display-6">Vacinas </h6>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <select class="form-control text-center" id="sel_proc">
                            <option value="-1"> selecione </option>
        <?php                   foreach($Procedimentos as $Proc){                                                                                  ?>
                                    <option value="<?php echo $Proc["Pr_id"];?>"> <?php echo $Proc["Pr_dsc"];?> </option>
        <?php                   }                                                                                           ?>
                        </select>
                        <label for="sel_proc">Procedimentos</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating mb-3">
                        <select id="sel_dose" class="form-control text-center">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>R1</option>
                            <option>R2</option>
                            <option>A1</option>
                            <option>A2</option>
                            <option>A3</option>
                            <option>A4</option>
                            <option>A5</option>
                        </select>
                        <label for="sel_dose">Dose</label>
                    </div>
                </div>                    
                <div class="col-md-3">
                    <div class="form-floating mb-3">
                        <input type="date" id="dt_vacina"  class="form-control text-center" />
                        <label for="dt_vacina">Data da Vacina</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success" onclick="Adicionar_Vacina()">Adicionar</button>
                </div>
            </div>
            <div class="row">
                <table table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Vacina</th>
                            <th>Dose  </th>
                            <th>Data  </th>
                            <th>      </th>
                        </tr>
                    </thead>
                    <tbody>
<?php
                        foreach($result1 as $row1) {
?>                              <tr>
                                <td><?php echo $row1["Procedimento"]; ?></td>
                                <td><?php echo $row1["dose"]; ?></td>
                                <td><?php echo $row1["data_vacina"]; ?></td>
                                <td><button class="btn btn-danger" onclick='Excluir_Vacina(<?php echo $row1["ID_Carteirinhas"]; ?>)'> X </button> </td>                                    
                            </tr>
<?php
                        }
?>
                    </tbody>
                </table>
            </div> 
<?php
        }
                 
    }
}
?>