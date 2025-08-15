<?php
session_start();

include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

    $motivo = ($_POST['motivo']);
    $produto_saida = ($_POST['produto_saida']);
    $quantidade_saida = ($_POST['quantidade_saida']);
    $qtd_formatada = str_replace(',', '.', str_replace('.', '', $quantidade_saida));
    $data_cadastro = date('Y-m-d H:i:s');
    $alterado_por = $_SESSION['usuarioNome'];
    

    $query = "UPDATE hb_estoque set quantidade = quantidade - '$qtd_formatada' WHERE  produto ='$produto_saida'";
    $log_categoria = "INSERT INTO hb_os_logs set log='SAIDA DE $qtd_formatada $produto_saida DO ESTOQUE! - $motivo', data='$data_cadastro', utilizador='$alterado_por'";
    $resposta = mysqli_query($conn, $query);
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
            <div class="toast-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">alterado!.</font></font></div>
          </div>';
    header('Location: estoque.php');
}else{
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL EDITAR A SENHA &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                <span aria-hidden='true'></span>
                                </button>
                                
                            </div>";
     header('Location: reparos');
    
}

?>