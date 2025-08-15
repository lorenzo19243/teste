<?php
session_start();
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$id_cliente = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$tecnico =  implode(" E ",$_REQUEST['tecnico']);
$veiculo = mysqli_real_escape_string($conn, $_POST['veiculo']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$concluido = mysqli_real_escape_string($conn, $_POST['concluido']);
$conclusao = mysqli_real_escape_string($conn, $_POST['conclusao']);
$agendado = mysqli_real_escape_string($conn, $_POST['agendado']);
$tempo = mysqli_real_escape_string($conn, $_POST['tempo']);
$cabo_drop = mysqli_real_escape_string($conn, $_POST['cabo_drop']);
$cabo_utp = mysqli_real_escape_string($conn, $_POST['cabo_utp']);
$conector = mysqli_real_escape_string($conn, $_POST['conector']);
$esticador = mysqli_real_escape_string($conn, $_POST['esticador']);
$alterado_por = $_SESSION['usuarioNome'];

$ultima_alteracao = date('Y-m-d H:i:s');
$data_fim = date('Y-m-d');

$roteador_entrada = ($_POST['roteador_entrada']);
$roteador_quantidade_entrada = ($_POST['roteador_quantidade_entrada']);
$qtd_formatada = str_replace(',', '.', str_replace('.', '', $roteador_quantidade_entrada));

$onu_entrada = ($_POST['onu_entrada']);
$onu_quantidade_entrada = ($_POST['onu_quantidade_entrada']);
$qtd_formatada_onu = str_replace(',', '.', str_replace('.', '', $onu_quantidade_entrada));

$timer_entrada = ($_POST['timer_entrada']);
$timer_quantidade_entrada = ($_POST['timer_quantidade_entrada']);
$qtd_formatada_timer = str_replace(',', '.', str_replace('.', '', $timer_quantidade_entrada));


$altera_cliente = "UPDATE recolhas SET tecnico='$tecnico', veiculo='$veiculo', alterado_por='$alterado_por', ultima_alteracao='$ultima_alteracao', status='$status', concluido='$concluido',  agendado='$agendado', conclusao='$conclusao', data_fim='$data_fim', tempo='$tempo', cabo_utp='$cabo_utp', cabo_drop='$cabo_drop', conector='$conector', esticador='$esticador', roteador_entrada='$qtd_formatada $roteador_entrada', onu_entrada='$qtd_formatada_onu $onu_entrada', timer_entrada='$qtd_formatada_timer $timer_entrada' WHERE id_cliente='$id_cliente'";

$log_categoria = "INSERT INTO hb_os_logs set log='ALTEROU O STATUS DA RECOLHA DE $nome PARA $status ', data='$ultima_alteracao', utilizador='$alterado_por'";

$resposta = mysqli_query($conn, $altera_cliente);

$resposta .= mysqli_query($conn, $log_categoria);


if($concluido == 'SIM'){ 

$sql1="UPDATE hb_estoque set quantidade = quantidade + '$qtd_formatada' WHERE produto='$roteador_entrada'";
$resultado1 = mysqli_query($conn, $sql1);

$sql2="UPDATE hb_estoque set quantidade = quantidade + '$qtd_formatada_onu' WHERE produto='$onu_entrada'";
$resultado2 = mysqli_query($conn, $sql2);

$sql3="UPDATE hb_estoque set quantidade = quantidade + '$qtd_formatada_timer' WHERE produto='$timer_entrada'";
$resultado3 = mysqli_query($conn, $sql3); }

if($status == 'CONCLUIDO'){ 

$log_estoque = "INSERT INTO hb_logs_estoque_roteadores set log='RECOLHIDO $qtd_formatada $roteador_entrada $qtd_formatada_onu $onu_entrada $qtd_formatada_timer $timer_entrada', motivo='RECOLHA DE $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque = mysqli_query($conn, $log_estoque); 
  }



if($resposta){
    $_SESSION['toast_msg'] = '<div class="toast show fade toast-info" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="info" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header toast-info">
              <i class="fas fa-info-circle fa-lg me-2"></i>
              <strong class="me-auto"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">STATUS ALTERADO!</font></font></strong>
              <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.date('H:i:s').'</font></font></small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
            </div>
            <div class="toast-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">STATUS DO AGENDAMENTO FOI ALTERADO!.</font></font></div>
          </div>';
    header('Location: recolhas');
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
     header('Location: recolhas');
    
}

?>