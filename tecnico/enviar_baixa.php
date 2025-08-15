<?php
session_start();
include_once('../assets/cabecalho.php');
include_once('../assets/rodape.php');
include('../config/conexao.php');
include_once("../config/seguranca.php");
seguranca_adm();

$id_cliente = mysqli_real_escape_string($conn, $_GET['id_cliente']);
$consulta = "SELECT * FROM clientes WHERE id_cliente='$id_cliente' ; ";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>



<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}
?>

<!DOCTYPE HTML>
<!--
	Verti by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Verti by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload homepage">
	<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
								<h1><a href="index.html"><img src="../img/xgs.png" width="100"></a></h1>
								<span>BEM VINDO ADRIANO!</span>
							</div>

						<!-- Nav -->
							

					</header>
				</div>

			<!-- Banner -->
				<div id="banner-wrapper"></div>

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
                        
							<div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
									<section class="box feature">
                        <div style="alignment-adjust:central; text-align:center" ><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" AND tecnico LIKE "%ADRIANO%" ORDER BY nome DESC');
				$row_cnt = mysqli_num_rows($clientes);

printf("<h2>%d CHAMADO ATIVO</h2>", $row_cnt); ?></div></section>	
										<?php 
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id_cliente = $linha['id_cliente'];
        $nome = $linha['nome'];
		$status = $linha['status'];
	    $situacao = $linha['situacao'];
		$tecnico = $linha['tecnico'];
		$rua = $linha['rua'];
		$numero = $linha['numero'];
		$bairro = $linha['bairro'];
		$tecnico = $linha['tecnico'];
		$veiculo = $linha['veiculo'];
        $responsavel = $linha['criado_por'];
		 $observacao = $linha['observacao'];
		$pppoe = $linha['pppoe'];
		$plano = $linha['plano'];
        $alterado_por = $linha['alterado_por'];
		
        // CONVERTENDO DATA/HORA PARA PADRAO PORTUGUES-BR
        $ultima_alteracao = $linha['ultima_alteracao'];
        $ultima_alteracao = date('d/m/Y H:i:s',  strtotime($ultima_alteracao));

        // CONVERTENDO DATA/HORA PARA PADRAO PORTUGUES-BR
        $data_cadastro = $linha['data_cadastro'];
        $data_cadastro = date('d/m/Y H:i:s',  strtotime($data_cadastro));

    ?>						
		<div class="inner">
        
										  <header>	
                                         <div style="alignment-adjust:central; text-align:center" > <h2><?php echo $linha['nome']; ?> </BR>
                                          
                                          				
<span style="text-align:center">O QUE FOI FEITO NESSE CLIENTE?!</span>	</BR>	</h2></div>				
<form method="POST" action="processa_edit_tecnico.php?id_cliente=<?php echo $linha['id_cliente']; ?> " enctype="multipart/form-data">
         <div class="col-md-12 col-sm-12">
            <textarea class="form-control" name="conclusao" id="recipient-conclusao"  aria-label="With textarea" ></textarea>
          </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>                      
                            
                            
                               
											  <h2>&nbsp;</h2>
</header>
						  </div>
									
					  </div><?php } ?>


					</div>
				</div>

			<!-- Main --><!-- Footer -->
				
					
				</div>

		<!-- Scripts -->


	</body>
</html>