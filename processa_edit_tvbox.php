<?php
session_start();

include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$id_tvbox = mysqli_real_escape_string($conn, $_POST['id']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$situacao = mysqli_real_escape_string($conn, $_POST['situacao']);
$tecnico =  implode(" E ",$_REQUEST['tecnico']);
$veiculo = mysqli_real_escape_string($conn, $_POST['veiculo']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$concluido = mysqli_real_escape_string($conn, $_POST['concluido']);
$conclusao = mysqli_real_escape_string($conn, $_POST['conclusao']);
$tempo = mysqli_real_escape_string($conn, $_POST['tempo']);
$alterado_por = $_SESSION['usuarioNome'];

$box_saida = ($_POST['box_saida']);
$box_qtd_saida = ($_POST['box_qtd_saida']);
$qtd_box = str_replace(',', '.', str_replace('.', '', $box_qtd_saida));

$controle_saida = ($_POST['controle_saida']);
$controle_qtd_saida = ($_POST['controle_qtd_saida']);
$qtd_controle = str_replace(',', '.', str_replace('.', '', $controle_qtd_saida));

$fonte_saida = ($_POST['fonte_saida']);
$fonte_qtd_saida = ($_POST['fonte_qtd_saida']);
$qtd_fonte = str_replace(',', '.', str_replace('.', '', $fonte_qtd_saida));

$cabo_hdmi = ($_POST['cabo_hdmi']);
$qtd_cabo_hdmi = str_replace(',', '.', str_replace('.', '', $cabo_hdmi));

$caboextensor_box = ($_POST['caboextensor_box']);
$qtd_caboextensor = str_replace(',', '.', str_replace('.', '', $caboextensor_box));

$caborca_box = ($_POST['caborca_box']);
$qtd_caborca = str_replace(',', '.', str_replace('.', '', $caborca_box));

$cabo_fonte_box = ($_POST['cabo_fonte_box']);
$qtd_cabo_fonte = str_replace(',', '.', str_replace('.', '', $cabo_fonte_box));

$conversor_hdmi = ($_POST['conversor_hdmi']);
$qtd_conversor_hdmi = str_replace(',', '.', str_replace('.', '', $conversor_hdmi));

$ultima_alteracao = date('Y-m-d H:i:s');
$data_fim = date('Y-m-d');


$altera_cliente = "UPDATE tvbox_chamados SET tecnico='$tecnico', veiculo='$veiculo', alterado_por='$alterado_por', ultima_alteracao='$ultima_alteracao', status='$status', concluido='$concluido', conclusao='$conclusao', data_fim='$data_fim', tempo='$tempo', aparelho_box='APARELHO $qtd_box $box_saida', fonte_box='$qtd_fonte_box', cabo_hdmi='$qtd_cabo_hdmi', controle_box='$qtd_controle_box', fonte_box_cabo='$qtd_fonte_box_cabo', conversor_hdmi='$qtd_conversor_hdmi' WHERE id_tvbox='$id_tvbox'";
$log_categoria = "INSERT INTO hb_os_logs set log='ALTEROU $situacao DE $nome' PARA $status, data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);
  
if($concluido == 'SIM' and $box_saida != '' and $situacao != 'RECOLHA TVBOX'){ 

$sql3s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_box' WHERE produto='$box_saida'";
$resultado3s = mysqli_query($conn, $sql3s);
$sql5s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_controle' WHERE produto='$controle_saida'";
$resultado5s = mysqli_query($conn, $sql5s);
$sql6s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_fonte' WHERE produto='$fonte_saida'";
$resultado6s = mysqli_query($conn, $sql6s);  
$sql7s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_cabo_hdmi' WHERE produto='CABO HDMI'";
$resultado7s = mysqli_query($conn, $sql7s);
$sql8s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_caboextensor' WHERE produto='CABO EXTENSOR'";
$resultado8s = mysqli_query($conn, $sql8s);
$sql9s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_caborca' WHERE produto='CABO RCA'";
$resultado9s = mysqli_query($conn, $sql9s);
$sql10s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_cabo_fonte' WHERE produto='CABO FONTE MISTIK'";
$resultado10s = mysqli_query($conn, $sql10s);
$sql11s ="UPDATE hb_estoque set quantidade = quantidade - '$qtd_conversor_hdmi' WHERE produto='CONVERSOR HDMI-AV'";
$resultado11s = mysqli_query($conn, $sql11s);

$log_estoque2 = "INSERT INTO hb_logs_estoque_box set log='USADO $qtd_box $box_saida, $qtd_cabo_hdmi CABO HDMI, $qtd_controle_box $controle_saida, $fonte_qtd_saida $fonte_saida, $qtd_conversor_hdmi CONVERSOR HDMI, $qtd_caboextensor CABO EXTENSOR, $qtd_caborca CABO RC, $qtd_cabo_fonte CABO FONTE', motivo='$situacao $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta_estoque2 = mysqli_query($conn, $log_estoque2);
  }  
  
if($concluido == 'SIM' and $situacao == 'RECOLHA TVBOX'){ 
    
$sql4="UPDATE hb_estoque set quantidade = quantidade + '$qtd_box' WHERE produto='$box_saida'";
$resultado4 = mysqli_query($conn, $sql4);
$sql5="UPDATE hb_estoque set quantidade = quantidade + '$qtd_controle' WHERE produto='$controle_saida'";
$resultado5 = mysqli_query($conn, $sql5);
$sql6="UPDATE hb_estoque set quantidade = quantidade + '$qtd_fonte' WHERE produto='$fonte_saida'";
$resultado6 = mysqli_query($conn, $sql6);
$sql7="UPDATE hb_estoque set quantidade = quantidade + '$qtd_cabo_hdmi' WHERE produto='CABO HDMI'";
$resultado7 = mysqli_query($conn, $sql7);
$sql8 ="UPDATE hb_estoque set quantidade = quantidade + '$qtd_caboextensor' WHERE produto='CABO EXTENSOR'";
$resultado8 = mysqli_query($conn, $sql8);
$sql9 ="UPDATE hb_estoque set quantidade = quantidade + '$qtd_caborca' WHERE produto='CABO RCA'";
$resultado9 = mysqli_query($conn, $sql9);
$sql10 ="UPDATE hb_estoque set quantidade = quantidade + '$qtd_cabo_fonte' WHERE produto='CABO FONTE MISTIK'";
$resultado10 = mysqli_query($conn, $sql10);
$sql11 ="UPDATE hb_estoque set quantidade = quantidade + '$qtd_conversor_hdmi' WHERE produto='CONVERSOR HDMI-AV'";
$resultado11 = mysqli_query($conn, $sql11);

$log_estoque5 = "INSERT INTO hb_logs_estoque_box set log='RECOLHIDO$qtd_box $box_saida, $qtd_cabo_hdmi CABO HDMI, $qtd_controle_box $controle_saida, $fonte_qtd_saida $fonte_saida, $qtd_conversor_hdmi CONVERSOR HDMI, $qtd_caboextensor CABO EXTENSOR, $qtd_caborca CABO RC, $qtd_cabo_fonte CABO FONTE', motivo='$situacao $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
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
    header('Location: listar_box.php');
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
     header('Location: listar_box.php');
    
}

?>