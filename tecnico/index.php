<?php
session_start();
include_once('../assets/cabecalho.php');
include_once('../assets/rodape.php');
include('../config/conexao.php');
include_once("../config/seguranca.php");
seguranca_adm();
$log = $_SESSION['usuarioNome'] ;
$consulta = 'SELECT * FROM clientes WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" AND tecnico LIKE "%'.$log.'%" limit 1;';
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>

<a class="btn btn-secondary position-relative" href="sair.php" data-bs-toggle="tooltip" data-bs-placement="botton" title="SAIR DO SISTEMA">
                        SAIR&nbsp;
                    <i class="fas fa-sign-out-alt text text-danger"></i>
                </a>



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

<html>
	<head>
		<title>Verti by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body >
	<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
								<h1><a href="index.php"><img src="./img/xgs.png" width="100"></a></h1>
								<span>BEM VINDO <?PHP echo $_SESSION['usuarioNome'] ?>!</span>
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
                        <div style="alignment-adjust:central; text-align:center" ><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" AND tecnico LIKE "%'.$log.'%" LIMIT 1');
				$row_cnt = mysqli_num_rows($clientes);

printf("<h2>%d CHAMADO EM ANDAMENTO</h2>", $row_cnt); ?></div></section>	
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
<a href="#" class="image featured"><img src="../img/reparo.jpg" alt="" /></a>							
<h2>

------------NOVO CHAMADO---------------</h2>

TIPO CHAMADO: <?php echo $situacao ?></br>  
TÉCNICO RESPONSAVEL: <?php echo $linha['tecnico']; ?> </br>   
VEÍCULO: <?php echo $linha['veiculo']; ?>  </br> 

SINAL ATUAL: <?php echo $linha['sinal']; ?> </br>  
MENSAGEM: <?php echo $linha['observacao']; ?> - ENVIAR FOTOS DO REPARO</br> 

DADOS DO CLIENTE:</br> 
NOME: <?php echo $linha['nome']; ?>   </br> 
PPPOE: <?php echo $linha['pppoe']; ?>   </br> 
RUA: <?php echo $linha['rua']; ?>, <?php echo $linha['numero']; ?> - <?php echo $linha['bairro']; ?>  </br> 
PLANO: <?php echo $linha['plano']; ?> </br> 
REDE_WIFI_ATUAL: <?php echo $linha['rede']; ?> </br> 
SENHA_WIFI_ATUAL: <?php echo $linha['redesenha']; ?> </br> 

                            
                            
                            
                               
										    <h2>&nbsp;</h2>
</header>
											<p>	<a href="enviar_baixa.php?id_cliente=<?php echo $linha['id_cliente']; ?>" class="button icon solid fa-info-circle">ENVIAR BAIXA!</a></section>     </p>
						  </div>
									
					  </div><?php } ?>


					</div>
				</div>

			<!-- Main --><!-- Footer -->
				
					
				</div>

		<!-- Scripts -->


	</body>
</html>