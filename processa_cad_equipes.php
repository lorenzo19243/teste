<?php
session_start();

include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$tecnicos =  implode(" E ",$_REQUEST['tecnicos']);
$veiculo = mysqli_real_escape_string($conn, $_POST['veiculo']);
$data = date('Y-m-d H:i:s');

{


$altera_cliente = "INSERT INTO equipes (tecnicos, veiculo, data) 
VALUES ('$tecnicos', '$veiculo', '$data')";
$resposta = mysqli_query($conn, $altera_cliente);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> CADATRADO COM SUCESSO &nbsp; <i class='far fa-smile-wink fa-2x'></i> </strong> 
                                <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button>
                                
                        </div>";
    header('Location: listar_equipes.php');
}else{
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL AGENDAR &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                                                    <button type=\"button\" class=\"btn-close\" data-dismiss=\"alert\" aria-label=\"Close\"></button>
                                
                            </div>";
     header('Location: listar_equipes.php');
    
}
}

?>
