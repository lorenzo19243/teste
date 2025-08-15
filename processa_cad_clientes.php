<?php
session_start();
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$situacao = mysqli_real_escape_string($conn, $_POST['situacao']);
$observacao = mysqli_real_escape_string($conn, $_POST['observacao']);
$tecnico = mysqli_real_escape_string($conn, $_POST['tecnico']);
$rua = mysqli_real_escape_string($conn, $_POST['rua']);
$numero = mysqli_real_escape_string($conn, $_POST['numero']);
$bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
$criado_por = $_SESSION['usuarioNome'];
$status = mysqli_real_escape_string($conn, $_POST['status']);
$sinal = mysqli_real_escape_string($conn, $_POST['sinal']);
$pppoe = mysqli_real_escape_string($conn, $_POST['pppoe']);
$plano = mysqli_real_escape_string($conn, $_POST['plano']);
$rede = mysqli_real_escape_string($conn, $_POST['rede']);
$redesenha = mysqli_real_escape_string($conn, $_POST['redesenha']);
$onu = mysqli_real_escape_string($conn, $_POST['onu']);
$latitude= mysqli_real_escape_string($conn, $_POST['latitude']);
$longitude = mysqli_real_escape_string($conn, $_POST['longitude']);
$concluido = 'NAO';
$data_cadastro = date('Y-m-d H:i:s');
$agendado = mysqli_real_escape_string($conn, $_POST['agendado']);

    $link = mysqli_query($conn, "SELECT nome FROM clientes WHERE nome = '$nome' AND  STATUS in ('A LANÇAR','REMARCAR','ANDAMENTO') ");
    
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
     header('Location: reparos');	
	 

    
    }else{


$altera_cliente = "INSERT INTO clientes (nome, situacao, observacao, tecnico, rua, numero, bairro, data_cadastro, criado_por, status, sinal, pppoe, plano, rede, redesenha, concluido, agendado, onu, latitude, longitude) 
VALUES ('$nome', '$situacao', '$observacao', '$tecnico', '$rua', '$numero', '$bairro', '$data_cadastro', '$criado_por', '$status', '$sinal', '$pppoe', '$plano', '$rede', '$redesenha', '$concluido','$agendado','$onu','$latitude','$longitude')";
$log_categoria = "INSERT INTO hb_os_logs set log='AGENDOU $nome $situacao ', data='$data_cadastro', utilizador='$criado_por'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['toast_msg'] = '<div class="toast show fade text-bg-success p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="success" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-success p-3">
              <i class="fas fa-check fa-lg me-2"></i>
              <strong class="me-auto"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">TUDO CERTO :)</font></font></strong>
              <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.date('H:i:s').'</font></font></small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fechar"></button>
            </div>
            <div class="toast-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">AGENDADO COM SUCESSO!.</font></font></div>
          </div>';
    header('Location: reparos');
}else{
    $_SESSION['toast_msg'] = '<div class="toast show fade text-bg-danger p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="danger" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-danger p-3">
              <i class="fas fa-exclamation-circle fa-lg me-2"></i>
              <strong class="me-auto">ERRO!</strong>
              <small>'.date('H:i:s').'</small>
              <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">NÃO FOI POSSIVEL AGENDAR!</div>
          </div>';
     header('Location: reparos');
    
}
}

?>
