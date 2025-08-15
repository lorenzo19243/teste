<?php
session_start();

include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

$id_cliente = mysqli_real_escape_string($conn, $_POST['id']);
$tecnico =  implode(" E ",$_REQUEST['tecnico']);
$veiculo = mysqli_real_escape_string($conn, $_POST['veiculo']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$novo_sinal = mysqli_real_escape_string($conn, $_POST['novo_sinal']);
$conclusao = mysqli_real_escape_string($conn, $_POST['conclusao']);
$concluido = mysqli_real_escape_string($conn, $_POST['concluido']);
$repetidor = mysqli_real_escape_string($conn, $_POST['repetidor']);
$remoto = mysqli_real_escape_string($conn, $_POST['remoto']);
$rede = mysqli_real_escape_string($conn, $_POST['rede']);
$redesenha = mysqli_real_escape_string($conn, $_POST['redesenha']);
$tempo = mysqli_real_escape_string($conn, $_POST['tempo']);
$urgente = mysqli_real_escape_string($conn, $_POST['urgente']);
$alterado_por = $_SESSION['usuarioNome'];

$ultima_alteracao = date('Y-m-d H:i:s');
$data_fim = date('Y-m-d');


$altera_cliente = "UPDATE clientes SET tecnico='$tecnico', veiculo='$veiculo', status='$status', novo_sinal='$novo_sinal', conclusao='$conclusao', concluido='$concluido', remoto='$remoto', repetidor='$repetidor', rede='$rede', redesenha='$redesenha', urgente='$urgente' WHERE id_cliente='$id_cliente'";
$resposta = mysqli_query($conn, $altera_cliente);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> STATUS ALTERADO COM SUCESSO &nbsp; <i class='far fa-smile-wink fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                        </div>";
    header('Location: listar_chamados_concluidos.php');
}else{
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL EDITAR O CLIENTE &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                            </div>";
     header('Location: listar_chamados_concluidos.php');
    
}

?>