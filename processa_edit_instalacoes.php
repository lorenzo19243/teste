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
$rede = mysqli_real_escape_string($conn, $_POST['rede']);
$redesenha = mysqli_real_escape_string($conn, $_POST['redesenha']);
$conclusao = mysqli_real_escape_string($conn, $_POST['conclusao']);
$sinal = mysqli_real_escape_string($conn, $_POST['sinal']);
$conector = mysqli_real_escape_string($conn, $_POST['conector']);
$buxa_parafuso = mysqli_real_escape_string($conn, $_POST['buxa_parafuso']);
$prensa = mysqli_real_escape_string($conn, $_POST['prensa']);
$esticador = mysqli_real_escape_string($conn, $_POST['esticador']);
$repetidor = mysqli_real_escape_string($conn, $_POST['repetidor']);
$remoto = mysqli_real_escape_string($conn, $_POST['remoto']);
$concluido = mysqli_real_escape_string($conn, $_POST['concluido']);
$pppoe = mysqli_real_escape_string($conn, $_POST['pppoe']);
$tempo = mysqli_real_escape_string($conn, $_POST['tempo']);
$agendado = mysqli_real_escape_string($conn, $_POST['recipient-agendado']);
$drop_solto = mysqli_real_escape_string($conn, $_POST['drop_solto']);
$alterado_por = $_SESSION['usuarioNome'];
$horario = mysqli_real_escape_string($conn, $_POST['horario']);

$ultima_alteracao = date('Y-m-d H:i:s');
$data_fim = date('Y-m-d');

$roteador_saida = ($_POST['roteador_saida']);
$roteador_quantidade_saida = ($_POST['roteador_quantidade_saida']);
$qtd_formatada = str_replace(',', '.', str_replace('.', '', $roteador_quantidade_saida));

$onu_saida = ($_POST['onu_saida']);
$onu_quantidade_saida = ($_POST['onu_quantidade_saida']);
$qtd_formatada_onu = str_replace(',', '.', str_replace('.', '', $onu_quantidade_saida));

$timer_saida = ($_POST['timer_saida']);
$timer_quantidade_saida = ($_POST['timer_quantidade_saida']);
$qtd_formatada_timer = str_replace(',', '.', str_replace('.', '', $timer_quantidade_saida));

$cabo_drop = ($_POST['cabo_drop']);
$qtd_formatada_drop = str_replace(',', '.', str_replace('.', '', $cabo_drop));



$altera_cliente = "UPDATE instalacoes SET horario='$horario', tecnico='$tecnico', veiculo='$veiculo', alterado_por='$alterado_por', ultima_alteracao='$ultima_alteracao', status='$status',  rede='$rede', redesenha='$redesenha', conclusao='$conclusao', sinal='$sinal',  conector='$conector', buxa_parafuso='$buxa_parafuso', prensa='$prensa',  esticador='$esticador', remoto='$remoto', repetidor='$repetidor', pppoe='$pppoe', concluido='$concluido', data_fim='$data_fim', tempo='$tempo', agendado='$agendado',  roteador_saida='$qtd_formatada $roteador_saida', onu_saida='$qtd_formatada_onu $onu_saida', timer_saida='$qtd_formatada_timer $timer_saida'  WHERE id_cliente='$id_cliente'";

$log_categoria = "INSERT INTO hb_os_logs set log='ALTEROU O STATUS DA INSTALAÇÃO DE $nome PARA $status', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);

if($concluido == 'SIM'){ 

$log_estoque = "INSERT INTO hb_logs_estoque_roteadores set log='UTILIZADO $qtd_formatada $roteador_saida  $qtd_formatada_onu $onu_saida  $qtd_formatada_timer $timer_saida ', motivo='INSTALAÇÃO DE $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque = mysqli_query($conn, $log_estoque); 

$sql1="UPDATE hb_estoque set quantidade = quantidade - '$qtd_formatada' WHERE produto='$roteador_saida'";
$resultado1 = mysqli_query($conn, $sql1);

$sql2="UPDATE hb_estoque set quantidade = quantidade - '$qtd_formatada_onu' WHERE produto='$onu_saida'";
$resultado2 = mysqli_query($conn, $sql2);

$sql3="UPDATE hb_estoque set quantidade = quantidade - '$qtd_formatada_timer' WHERE produto='$timer_saida'";
$resultado3 = mysqli_query($conn, $sql3);

}

if($concluido == 'SIM' and $drop_solto == 'NAO' and $cabo_drop != ''){ 
    
$sql7="UPDATE instalacoes set cabo_drop='$qtd_formatada_drop' WHERE id_cliente='$id_cliente'";
$resultado7 = mysqli_query($conn, $sql7);
    
$sql4="UPDATE hb_estoque_geral set quantidade = quantidade - '$qtd_formatada_drop' WHERE produto='BOBINA CABO DROP'";
$resultado4 = mysqli_query($conn, $sql4);

$log_estoque2 = "INSERT INTO hb_logs_estoque_geral set log='USADO $qtd_formatada_drop METROS DE CABO DROP', motivo='INSTALAÇÃO DE $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque2 = mysqli_query($conn, $log_estoque2);
  }
  
if($concluido == 'SIM' and $drop_solto == 'SIM' and $cabo_drop != ''){ 
    
$sql5="UPDATE instalacoes set drop_solto='$qtd_formatada_drop' WHERE id_cliente='$id_cliente'";
$resultado5 = mysqli_query($conn, $sql5);

$log_estoque2 = "INSERT INTO hb_logs_estoque_geral set log='USADO $qtd_formatada_drop METROS DE CABO DROP SOLTO', motivo='INSTALAÇÃO DE $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque2 = mysqli_query($conn, $log_estoque2);
  }    

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['toast_msg'] = '<div class="toast show fade toast-info" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="info" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header toast-info">
              <i class="fas fa-info-circle fa-lg me-2"></i>
              <strong class="me-auto"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">STATUS ALTERADO!</font></font></strong>
              <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.date('H:i:s').'</font></font></small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
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