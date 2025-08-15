<?php
session_start();
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$observacao = mysqli_real_escape_string($conn, $_POST['observacao']);
$rua = mysqli_real_escape_string($conn, $_POST['rua']);
$numero = mysqli_real_escape_string($conn, $_POST['numero']);
$bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
$criado_por = $_SESSION['usuarioNome'];
$status = mysqli_real_escape_string($conn, $_POST['status']);
$plano = mysqli_real_escape_string($conn, $_POST['plano']);
$concluido = 'NAO';
$data_cadastro = date('Y-m-d H:i:s');
$agendado = mysqli_real_escape_string($conn, $_POST['agendado']);
$latitude= mysqli_real_escape_string($conn, $_POST['latitude']);
$longitude = mysqli_real_escape_string($conn, $_POST['longitude']);

   
    $link = mysqli_query($conn, "SELECT nome FROM recolhas WHERE nome = '$nome' AND  STATUS in ('A LANÇAR','REMARCAR','ANDAMENTO') ");
    
    $array = mysqli_fetch_array($link);
    
    $nomearray = $array['nome'];
    

    
    if($nomearray == $nome){
		
$_SESSION['toast_msg'] = '<div class="toast show fade text-bg-danger p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="danger" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-danger p-3">
              <i class="fas fa-exclamation-circle fa-lg me-2"></i>
              <strong class="me-auto">ERRO!</strong>
              <small>'.date('H:i:s').'</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">CLIENTE JÁ TEM UM AGENDAMENTO!</div>
          </div>';
     header('Location: recolhas');	
	 

    
    }else{



$altera_cliente = "INSERT INTO `recolhas`(`nome`, `observacao`, `rua`, `numero`, `bairro`, `plano`, `criado_por`, `alterado_por`, `status`, `veiculo`, `tecnico`, `concluido`, `data_cadastro`, `ultima_alteracao`, `data_fim`, `agendado`, `latitude`, `longitude`) VALUES  ('$nome','$observacao','$rua','$numero','$bairro','$plano','$criado_por','$alterado_por','$status','$veiculo','$tecnico','$concluido','$data_cadastro','$ultima_alteracao','$data_fim','$agendado','$latitude','$longitude')";
$log_categoria = "INSERT INTO hb_os_logs set log='AGENDOU A RECOLHA DE $nome', data='$data_cadastro', utilizador='$criado_por'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
$_SESSION['toast_msg'] = '<div class="toast show fade text-bg-success p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="success" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-success p-3">
              <i class="fas fa-check fa-lg me-2"></i>
              <strong class="me-auto"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">SUCESSO!</font></font></strong>
              <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.date('H:i:s').'</font></font></small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
            </div>
            <div class="toast-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">AGENDADO COM SUCESSO!.</font></font></div>
          </div>';
    header('Location: recolhas');
}else{
    $_SESSION['error'] = '<div class="toast show fade text-bg-danger p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="danger" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-danger p-3">
              <i class="fas fa-exclamation-circle fa-lg me-2"></i>
              <strong class="me-auto">ERRO!</strong>
              <small>'.date('H:i:s').'</small>
              <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">NÃO FOI POSSIVEL AGENDAR!</div>
          </div>';
     header('Location: recolhas');
    
}
}
?>
