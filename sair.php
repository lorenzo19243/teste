<?php
include_once('assets/cabecalho.php');
include('config/conexao.php'); //INCLUI A CONEXÃO COM BANCO DE DADOS
session_start();

date_default_timezone_set('America/Sao_Paulo');


$token = $_SESSION['usuarioToken'];
$senha = mysqli_real_escape_string($conn, $_POST['senha']);
$email = $_SESSION['usuarioEmail'];
$ultima_alteracao = date('Y-m-d H:i:s');


$inserir_token = ("UPDATE usuarios SET token='1', status='0' WHERE token='$token'");
$log_categoria = "INSERT INTO hb_os_logs SET log='DESLOGOU-SE DO SISTEMA', data='$ultima_alteracao', utilizador='$email'";
$resultado_token = mysqli_query($conn, $inserir_token);
$resposta .= mysqli_query($conn, $log_categoria);

unset(
	$_SESSION['usuarioToken'],
	$_SESSION['usuarioLogin'],
	$_SESSION['usuarioId'],
	$_SESSION['status'],
	$_SESSION['usuarioUsuario'],
	$_SESSION['usuarioNome'],
	$_SESSION['usuarioEmail'],
	$_SESSION['usuarioSenha']
	);

die( '<div class="container my-5">
  <div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
    <button type="button" class="position-absolute top-0 end-0 p-3 m-3 btn-close bg-secondary bg-opacity-10 rounded-pill" aria-label="Close"></button>
    <svg class="bi mt-5 mb-3" width="48" height="48"><use xlink:href="#check2-circle"></use></svg>
    <h1 class="text-body-emphasis">VOCÊ ESTA DESCONECTADO!</h1>
    <p class="col-lg-6 mx-auto mb-4">
      por favor faça login novamente!.
    </p>
    <a class="btn btn-primary px-5 mb-5"  href="login">LOGAR</a>
  </div>
</div>');

//header("Location: login");
?>
