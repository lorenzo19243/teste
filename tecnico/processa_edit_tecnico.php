<?php
session_start();
 ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL);


include('../config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$id_cliente = mysqli_real_escape_string($conn, $_GET['id_cliente']);
$conclusao = mysqli_real_escape_string($conn, $_POST['conclusao']);



$altera_cliente = "UPDATE clientes SET conclusao='$conclusao' WHERE id_cliente='$id_cliente'";
$resposta = mysqli_query($conn, $altera_cliente);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> SITUAÇÃO ENVIADA COM SUCESSO &nbsp; <i class='far fa-smile-wink fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                        </div>";
    header('Location: index.php');
}else{
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL EDITAR O CLIENTE &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                            </div>";
     header('Location: listar_instalacoes.php');
    
}

?>