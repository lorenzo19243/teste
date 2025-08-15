<?php
session_start();

include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$id_cliente = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$tecnico =  implode(" E ",$_REQUEST['tecnico']);
$veiculo = mysqli_real_escape_string($conn, $_POST['veiculo']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$rede = mysqli_real_escape_string($conn, $_POST['rede']);
$redesenha = mysqli_real_escape_string($conn, $_POST['redesenha']);
$conclusao = mysqli_real_escape_string($conn, $_POST['conclusao']);
$sinal = mysqli_real_escape_string($conn, $_POST['sinal']);
$cabo_drop = mysqli_real_escape_string($conn, $_POST['cabo_drop']);
$conector = mysqli_real_escape_string($conn, $_POST['conector']);
$buxa_parafuso = mysqli_real_escape_string($conn, $_POST['buxa_parafuso']);
$prensa = mysqli_real_escape_string($conn, $_POST['prensa']);
$esticador = mysqli_real_escape_string($conn, $_POST['esticador']);
$repetidor = mysqli_real_escape_string($conn, $_POST['repetidor']);
$remoto = mysqli_real_escape_string($conn, $_POST['remoto']);
$concluido = mysqli_real_escape_string($conn, $_POST['concluido']);
$pppoe = mysqli_real_escape_string($conn, $_POST['pppoe']);
$tempo = mysqli_real_escape_string($conn, $_POST['tempo']);
$alterado_por = $_SESSION['usuarioNome'];

$ultima_alteracao = date('Y-m-d H:i:s');
$data_fim = date('Y-m-d');


$altera_cliente = "UPDATE instalacoes SET tecnico='$tecnico', veiculo='$veiculo', alterado_por='$alterado_por', ultima_alteracao='$ultima_alteracao', status='$status',  rede='$rede', redesenha='$redesenha', conclusao='$conclusao', sinal='$sinal', cabo_drop='$cabo_drop', conector='$conector', buxa_parafuso='$buxa_parafuso', prensa='$prensa',  esticador='$esticador', remoto='$remoto', repetidor='$repetidor', pppoe='$pppoe', concluido='$concluido', data_fim='$data_fim', tempo='$tempo' WHERE id_cliente='$id_cliente'";
$log_categoria = "INSERT INTO hb_os_logs set log='ALTEROU O STATUS DA INSTALAÇÃO DE $nome PARA $status', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['toast_msg'] = '<div class="toast show fade toast-info" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="info" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header toast-info">
              <i class="fas fa-info-circle fa-lg me-2"></i>
              <strong class="me-auto"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">STATUS ALTERADO!</font></font></strong>
              <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.date('H:i:s').'</font></font></small>
              <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Fechar"></button>
            </div>
            <div class="toast-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">STATUS DO AGENDAMENTO FOI ALTERADO!.</font></font></div>
          </div>';
    header('Location: instalacoes');
}else{
    $_SESSION['toast_msg'] = '<div class="toast show fade text-bg-danger p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="danger" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-danger p-3">
              <i class="fas fa-exclamation-circle fa-lg me-2"></i>
              <strong class="me-auto">Erro!</strong>
              <small>'.date('H:i:s').'</small>
              <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">NÃO FOI POSSIVEL EDITAR ESSE AGENDAMENTO!</div>
          </div>';
     header('Location: instalacoes');
    
}

?>