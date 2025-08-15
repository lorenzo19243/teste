<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm()
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());;


$id = mysqli_real_escape_string($conn, $_GET['id']);
$produto = mysqli_real_escape_string($conn, $_GET['produto']);
$ultima_alteracao = date('Y-m-d H:i:s');
$alterado_por = $_SESSION['usuarioNome'];

$altera_cliente = "DELETE FROM hb_estoque_frenteloja WHERE id='$id'";
$log_categoria = "INSERT INTO hb_estoque_frenteloja set log='DELETOU $produto DO ESTOQUE', data='$ultima_alteracao', utilizador='$alterado_por'";
$resposta = mysqli_query($conn, $altera_cliente);
$resposta .= mysqli_query($conn, $log_categoria);

if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    $_SESSION['toast_msg'] = '<div class="toast show fade text-bg-success p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="success" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-success p-3">
              <i class="fas fa-check fa-lg me-2"></i>
              <strong class="me-auto"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">SUCESSO!</font></font></strong>
              <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.date('H:i:s').'</font></font></small>
              <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Fechar"></button>
            </div>
            <div class="toast-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">EXCLUIDO COM SUCESSO!.</font></font></div>
          </div>';
    header('Location: estoque_frenteloja.php');
}else{


    
  
  

    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL EXCLUIR O CLIENTE &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                
                            </div>";
     header('Location: cameras');
    
}
?>