<?php
session_start();

include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$id_cameras = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$situacao = mysqli_real_escape_string($conn, $_POST['situacao']);
$tecnico =  implode(" E ",$_REQUEST['tecnico']);
$sinal = mysqli_real_escape_string($conn, $_POST['sinal']);
$veiculo = mysqli_real_escape_string($conn, $_POST['veiculo']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$concluido = mysqli_real_escape_string($conn, $_POST['concluido']);
$conclusao = mysqli_real_escape_string($conn, $_POST['conclusao']);
$tempo = mysqli_real_escape_string($conn, $_POST['tempo']);
$cabo_rede = mysqli_real_escape_string($conn, $_POST['cabo_rede']);
$cabo_solto = mysqli_real_escape_string($conn, $_POST['cabo_solto']);
$conector = mysqli_real_escape_string($conn, $_POST['conector']);
$esticadores = mysqli_real_escape_string($conn, $_POST['esticadores']);
$bucha_parafuso = mysqli_real_escape_string($conn, $_POST['bucha_parafuso']);
$prensa_fio = mysqli_real_escape_string($conn, $_POST['prensa_fio']);
$plugp4 = mysqli_real_escape_string($conn, $_POST['plugp4']);
$rj45 = mysqli_real_escape_string($conn, $_POST['rj45']);
$alterado_por = $_SESSION['usuarioNome'];
$ultima_alteracao = date('Y-m-d H:i:s');
$data_fim = date('Y-m-d');

$camext_saida = ($_POST['camext_saida']);
$camext_qtd_saida = ($_POST['camext_qtd_saida']);
$qtd_formatada_camext = str_replace(',', '.', str_replace('.', '', $camext_qtd_saida));

$camint_saida = ($_POST['camint_saida']);
$camint_qtd_saida = ($_POST['camint_qtd_saida']);
$qtd_formatada_camint = str_replace(',', '.', str_replace('.', '', $camint_qtd_saida));

$onu_saida = ($_POST['onu_saida']);
$onu_quantidade_saida = ($_POST['onu_quantidade_saida']);
$qtd_formatada_onu = str_replace(',', '.', str_replace('.', '', $onu_quantidade_saida));

$cabo_rede = ($_POST['cabo_rede']);
$qtd_formatada_rede = str_replace(',', '.', str_replace('.', '', $cabo_rede));

$altera_cliente = "UPDATE cameras SET tecnico='$tecnico', veiculo='$veiculo', alterado_por='$alterado_por', ultima_alteracao='$ultima_alteracao', status='$status', concluido='$concluido', conclusao='$conclusao', data_fim='$data_fim', tempo='$tempo', cabo_rede='$cabo_rede', camera_externa='$qtd_formatada_camext CAMERA $camext_saida', camera_interna='$qtd_formatada_camint CAMERA $camint_saida', onu='$qtd_formatada_onu ONU $onu_saida', prensa_fio='$prensa_fio', conector='$conector', bucha_parafuso='$bucha_parafuso', rj45='$rj45', plugp4='$plugp4', esticadores='$esticadores', sinal='$sinal' WHERE id_cameras='$id_cameras'";

$log_categoria = "INSERT INTO hb_os_logs set log='ALTEROU O STATUS DA OS DE $nome PARA $status', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);

if($concluido == 'SIM' and $camext_saida != '' and $camint_saida != '' and $onu_saida != ''){ 
    
$sql1="UPDATE hb_estoque set quantidade = quantidade - '$qtd_formatada_camext' WHERE produto='$camext_saida'";
$resultado1 = mysqli_query($conn, $sql1);

$sql2="UPDATE hb_estoque set quantidade = quantidade - '$qtd_formatada_camint' WHERE produto='$camint_saida'";
$resultado2 = mysqli_query($conn, $sql2);

$sql3="UPDATE hb_estoque set quantidade = quantidade - '$qtd_formatada_onu' WHERE produto='$onu_saida'";
$resultado3 = mysqli_query($conn, $sql3);

$log_estoque = "INSERT INTO hb_logs_estoque_cam set log='UTILIZADO $qtd_formatada_camext $camext_saida EXTENA,  $qtd_formatada_camint  $camint_saida INTERNA, $qtd_formatada_onu $onu_saida ONU', motivo='PARA $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque = mysqli_query($conn, $log_estoque); 

}

if($status == 'CONCLUIDO' and $cabo_solto == 'NAO' and $cabo_solto != '' and $situacao != 'RECOLHA DE CAMERAS'){ 
    
$sql4="UPDATE hb_estoque_geral set quantidade = quantidade - '$qtd_formatada_rede' WHERE produto='CABO DE REDE 4 PARES'";
$resultado4 = mysqli_query($conn, $sql4);

$sql5s="UPDATE cameras set cabo_rede ='$qtd_formatada_rede' WHERE id_cliente='$id_cameras'";
$resultado5s = mysqli_query($conn, $sql5s);

$log_estoque2 = "INSERT INTO hb_logs_estoque_geral set log='USADO $qtd_formatada_rede METROS DE CABO UTP', motivo='PARA $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque2 = mysqli_query($conn, $log_estoque2);
  }
  
if($status == 'CONCLUIDO' and $cabo_solto == 'SIM' and $cabo_solto != '' and $situacao != 'RECOLHA DE CAMERAS'){ 
    
$sql5="UPDATE cameras set cabo_rede_solto ='$qtd_formatada_rede' WHERE id_cliente='$id_cameras'";
$resultado5 = mysqli_query($conn, $sql5);

$log_estoque2s = "INSERT INTO hb_logs_estoque_geral set log='USADO $qtd_formatada_drop METROS DE CABO UTP SOLTO', motivo='INSTALACAO DE $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque2s = mysqli_query($conn, $log_estoque2s);
  }  
  
if($concluido == 'SIM' and $situacao == 'RECOLHA DE CAMERAS'){ 
    
$sql4s ="UPDATE hb_estoque set quantidade = quantidade + '$qtd_formatada_camext' WHERE produto='$camext_saida'";
$resultado4s = mysqli_query($conn, $sql4s);
$sql5s ="UPDATE hb_estoque set quantidade = quantidade + '$qtd_formatada_camint' WHERE produto='$camint_saida'";
$resultado5s = mysqli_query($conn, $sql5s);
$sql6s ="UPDATE hb_estoque set quantidade = quantidade + '$qtd_formatada_onu' WHERE produto='$onu_saida'";
$resultado6s = mysqli_query($conn, $sql6s);


$log_estoque5 = "INSERT INTO hb_logs_estoque_cam set log='RECOLHIDO $qtd_formatada_camext $camext_saida,  $qtd_formatada_camint  $camint_saida, $qtd_formatada_onu $onu_saida', motivo='$situacao $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque5 = mysqli_query($conn, $log_estoque5);
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
    header('Location: listar_cameras.php');
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
     header('Location: listar_cameras.php');
    
}

?>