<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
$consulta = "SELECT * FROM clientes WHERE concluido = 'NAO' ORDER BY ultima_alteracao DESC ; ";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>

<?php include_once('assets/menu.php'); ?>
<div class="navbar-collapse offcanvas-collapse bg-warning" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <br>
            <br>
            <br>
            <br>
        </ul>
      </div>
<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 bg-warning justify-content-between p-3">
        
        </div>

        <div class="col-md-2 bg-warning justify-content-between p-3">
            <div class="form-label-group">

                

            </div>
        </div>
        <div class="col-md-4 bg-warning  justify-content-between p-3 d-flex">
            
        </div>
    </div>
</div>

<div class="container-sm">
 <div class="modal-content border-0">
  <div class="badge  text-wrap">
    <div class="col-md-auto"><h5><small class="text-muted">
     <?php
	 
	$_SESSION["usuarioNome"]; 
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $semana = array(
        'Sun' => 'Domingo', 
        'Mon' => 'Segunda-Feira',
        'Tue' => 'Terça-Feira',
        'Wed' => 'Quarta-Feira',
        'Thu' => 'Quinta-Feira',
        'Fri' => 'Sexta-Feira',
        'Sat' => 'Sabado'
    );
    
    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Março',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );
    
    echo 'Olá ','<strong>', $_SESSION["usuarioNome"],'</strong>', ' Hoje é ', $semana["$data"] .  ", dia {$dia} de " . $mes_extenso["$mes"] . " de {$ano}"; ?></small></h5>
        
    </div>
  </div>
</br>  
</div>
</div><body>
<div class="container">
  <div class="row">
   <div class="col-md-3 col-sm-12">
   <b>REPAROS</b></BR>
<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'u310272217_app_xgs';
$username = 'u310272217_hbweb';
$password = '@Adminbinho2012';
 
try {
    // Criando a conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Definindo o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // Obtendo as datas do formulário usando filter_input
    $data1 = filter_input(INPUT_POST, 'data1');
    $data2 = filter_input(INPUT_POST, 'data2');
 
    // Verificando se as datas foram fornecidas
    if (!$data1 || !$data2) {
        throw new Exception("As datas de início e fim são necessárias.");
    }
 
    // Preparando a consulta SQL
    $sql = "SELECT data_fim, SUM(concluido='SIM') AS total_valor
FROM clientes
WHERE data_fim BETWEEN :data1 AND :data2
GROUP BY data_fim
ORDER BY data_fim;";
	
    $stmt = $pdo->prepare($sql);
 
    // Bind dos parâmetros
    $stmt->bindParam(':data1', $data1);
    $stmt->bindParam(':data2', $data2);
 
    // Executando a consulta
    $stmt->execute();
 
    // Obtendo os resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    // Exibindo os resultados
    if(count($resultados) > 0) {
        foreach ($resultados as $row) {
            echo "" .date('d/m/Y', strtotime($row['data_fim'])). " - " .str_pad($row['total_valor'],2,'0', STR_PAD_LEFT). " concluidos</br>"; 
                date('d/m/Y', strtotime($row['data_fim']));
        }
		
    } else {
        echo "Nenhum registro encontrado entre as datas fornecidas.";
    }
 
} catch (PDOException $e) {
    // Tratando erros de conexão ou SQL
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Tratando outros erros
    echo "Erro: " . $e->getMessage();
} 

?>   
   
   </div>
 <div class="col-md-3 col-sm-12">
<b>INSTALAÇÕES</b></BR> 
 <?php

 
try {
    // Criando a conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Definindo o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // Obtendo as datas do formulário usando filter_input
    $data1 = filter_input(INPUT_POST, 'data1');
    $data2 = filter_input(INPUT_POST, 'data2');
 
    // Verificando se as datas foram fornecidas
    if (!$data1 || !$data2) {
        throw new Exception("As datas de início e fim são necessárias.");
    }
 
    // Preparando a consulta SQL
    $sql = "SELECT data_fim, SUM(concluido='SIM') AS total_valor
FROM instalacoes
WHERE data_fim BETWEEN :data1 AND :data2
GROUP BY data_fim
ORDER BY data_fim;";
	
    $stmt = $pdo->prepare($sql);
 
    // Bind dos parâmetros
    $stmt->bindParam(':data1', $data1);
    $stmt->bindParam(':data2', $data2);
 
    // Executando a consulta
    $stmt->execute();
 
    // Obtendo os resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    // Exibindo os resultados
    if(count($resultados) > 0) {
        foreach ($resultados as $row) {
            echo "" .date('d/m/Y', strtotime($row['data_fim'])). " - " .str_pad($row['total_valor'],2,'0', STR_PAD_LEFT). " concluidos</br>";
                date('d/m/Y', strtotime($row['data_fim']));
        }
		
    } else {
        echo "Nenhum registro encontrado entre as datas fornecidas.";
    }
 
} catch (PDOException $e) {
    // Tratando erros de conexão ou SQL
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Tratando outros erros
    echo "Erro: " . $e->getMessage();
} 

?>
</div>
 <div class="col-md-3 col-sm-12">
<b>MUDANÇAS</b></BR> 
 <?php

 
try {
    // Criando a conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Definindo o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // Obtendo as datas do formulário usando filter_input
    $data1 = filter_input(INPUT_POST, 'data1');
    $data2 = filter_input(INPUT_POST, 'data2');
 
    // Verificando se as datas foram fornecidas
    if (!$data1 || !$data2) {
        throw new Exception("As datas de início e fim são necessárias.");
    }
 
    // Preparando a consulta SQL
    $sql = "SELECT data_fim, SUM(concluido='SIM') AS total_valor
FROM mudanca
WHERE data_fim BETWEEN :data1 AND :data2
GROUP BY data_fim
ORDER BY data_fim;";
	
    $stmt = $pdo->prepare($sql);
 
    // Bind dos parâmetros
    $stmt->bindParam(':data1', $data1);
    $stmt->bindParam(':data2', $data2);
 
    // Executando a consulta
    $stmt->execute();
 
    // Obtendo os resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    // Exibindo os resultados
    if(count($resultados) > 0) {
        foreach ($resultados as $row) {
            echo "" .date('d/m/Y', strtotime($row['data_fim'])). " - " . str_pad($row['total_valor'],2,'0', STR_PAD_LEFT). " concluidos</br>";
                date('d/m/Y', strtotime($row['data_fim']));
        }
		
    } else {
        echo "Nenhum registro encontrado entre as datas fornecidas.";
    }
 
} catch (PDOException $e) {
    // Tratando erros de conexão ou SQL
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Tratando outros erros
    echo "Erro: " . $e->getMessage();
} 

?></div>
 <div class="col-md-3 col-sm-12">
<b>RECOLHAS</b></BR> 
 <?php

 
try {
    // Criando a conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Definindo o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // Obtendo as datas do formulário usando filter_input
    $data1 = filter_input(INPUT_POST, 'data1');
    $data2 = filter_input(INPUT_POST, 'data2');
 
    // Verificando se as datas foram fornecidas
    if (!$data1 || !$data2) {
        throw new Exception("As datas de início e fim são necessárias.");
    }
 
    // Preparando a consulta SQL
    $sql = "SELECT data_fim, SUM(concluido='SIM') AS total_valor
FROM recolhas
WHERE data_fim BETWEEN :data1 AND :data2
GROUP BY data_fim
ORDER BY data_fim;";
	
    $stmt = $pdo->prepare($sql);
 
    // Bind dos parâmetros
    $stmt->bindParam(':data1', $data1);
    $stmt->bindParam(':data2', $data2);
 
    // Executando a consulta
    $stmt->execute();
 
    // Obtendo os resultados
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    // Exibindo os resultados
    if(count($resultados) > 0) {
        foreach ($resultados as $row) {
            echo "" .date('d/m/Y', strtotime($row['data_fim'])). " - " . str_pad($row['total_valor'],2,'0', STR_PAD_LEFT). " concluidos</br>";
                date('d/m/Y', strtotime($row['data_fim']));
        }
		
    } else {
        echo "Nenhum registro encontrado entre as datas fornecidas.";
    }
 
} catch (PDOException $e) {
    // Tratando erros de conexão ou SQL
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Tratando outros erros
    echo "Erro: " . $e->getMessage();
} 

?></div>
</div>








<div class="container">
  <div class="row">
    <div class="col">
      
    </div>

    <div class="badge  text-wrap"></BR>
<?php
echo '<table class="table table-hover">
<h5>Relatório: <b>'.date('d/m/Y', strtotime($_POST['data1'])).'</b> A <b>'.date('d/m/Y', strtotime($_POST['data2'])).'</b></h5><form method="post"  action="printmesresult.php" target="_blank"><input type="text" name="data1" value="'.$_POST['data1'].'" style="width:75px;" hidden> <input name="data2" value="'.$_POST['data2'].'" autocomplete="off"  style="width:75px;" hidden>
<button class="btn btn-secondary position-relative" type="submit" title="Imprimir Mensal">Imprimir</button>
</form>
    </table>';

?>

    </div>
    <div class="col">
      </div>
    </div>
  </div>
</div>


    </div>
    <div class="col">
      
    </div>
  </div>
</div>
</div>

<?php
include_once('assets/rodape.php');
?>