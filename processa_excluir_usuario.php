<?php
session_start();
include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());


$id = mysqli_real_escape_string($conn, $_GET['id']);
$nome = mysqli_real_escape_string($conn, $_GET['nome']);
$ultima_alteracao = date('Y-m-d H:i:s');
$alterado_por = $_SESSION['usuarioNome'];


$log_categoria = "INSERT INTO hb_os_logs set log='DELETOU O USUARIO $nome', data='$ultima_alteracao', utilizador='$alterado_por'";
$altera_cliente = "DELETE FROM usuarios WHERE id='$id'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> USUARIO EXCLUÍDO COM SUCESSO &nbsp; <i class='far fa-smile-wink fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                </button>
                                
                        </div>";
    header('Location: usuarios.php');
}else{


    
  
  

    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL EXCLUIR O CLIENTE &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                            </div>";
     header('Location: usuarios.php');
    
}
?>