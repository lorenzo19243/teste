
<?php
session_start();
include('config/conexao.php');
include_once("config/seguranca.php");

$id_cliente = $_GET["id_cliente"]; 

$consulta = "SELECT * FROM instalacoes WHERE id_cliente = ".$id_cliente."";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<!-- Meta tags Obrigatórias -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">    <!-- IMPORTANDO PLUGIN DO SELECT2 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js">
</script>
<script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<style>
@media print { 
#noprint { display:none; } 
body { background: #fff; }
}
</style>
<body ng-controller="GeradorContratoCtrl">


<div class="container-sm">
<div class="row" >
<div class="col-md-2">
    </div>

<div class="col-md-8"  id="horarios">	
<div class="table-responsive-sm" >
 <table class="table table-striped table-sm" >
      <thead>
  <tr>
    <td></td>
    <td><strong>25/11 A 01/12</strong></td>
    <td></td>
  </tr>
    </thead>  
 <thead class="bg-dark text text-white">
  <tr>
    <td>COLABORADORES EXTERNOS</td>
    <td>SEGUNDA A SEXTA</td>
    <td>SABADO</td>
  </tr>
    </thead>  
<tbody> 
<?php 
$consulta = "SELECT * FROM horarios WHERE local = 'EXTERNO' ORDER BY id";
$resultado = mysqli_query($conn, $consulta);

?>   
<?php 
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id = $linha['id'];
        $tecnicos = $linha['tecnicos'];
		$semana = $linha['semana'];
		$local = $linha['local'];
		$sabado = $linha['sabado'];
 
    ?>
  <tr>
    <td><?php echo $tecnicos?></td>
    <td><?php echo $semana?></td>
    <td><?php echo $sabado?></td>
  </tr>
  <?php } ?>
</tbody>
 <thead class="bg-dark text text-white">
  <tr>
    <td>COLABORADORES INTERNOS</td>
    <td>SEGUNDA A SEXTA</td>
    <td>SABADO</td>
  </tr>
    </thead>  
<tbody> 

<?php 
$consulta = "SELECT * FROM horarios WHERE local = 'INTERNO' ORDER BY id";
$resultado = mysqli_query($conn, $consulta);

?>  <?php 
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id = $linha['id'];
        $tecnicos = $linha['tecnicos'];
		$semana = $linha['semana'];
		$local = $linha['local'];
		$sabado = $linha['sabado'];
 
    ?> 
  <tr>
    <td><?php echo $tecnicos?></td>
    <td><?php echo $semana?></td>
    <td><?php echo $sabado?></td>
  </tr> <?php } ?>


</tbody>
 <thead class="bg-dark text text-white">

  <tr>
    <td>COLABORADORES</td>
    <td>PLANTAO DOMINGO</td>
    <td></td>
  </tr>
    </thead>  
<tbody>     <?php 
$consulta = "SELECT * FROM horarios WHERE sabado = 'HORARIO COMERCIAL' ORDER BY id";
$resultado = mysqli_query($conn, $consulta);

?>  <?php 
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id = $linha['id'];
        $tecnicos = $linha['tecnicos'];
		$semana = $linha['semana'];
		$local = $linha['local'];
		$sabado = $linha['sabado'];
 
    ?>     
      <td><?php echo $tecnicos?></td>
    <td><?php echo $semana?></td>
    <td><?php echo $sabado?></td>
  </tr> <?php } ?>
</tbody>
</table>
<div class="col-md-2">
    </div>
</div>

<div class="row"> 
<div class="col-md-2">
    </div>
				<div class="col-md-8" id="noprint" >
<button type="button" class="btn btn-primary btn-block btn-lg" onclick="printDiv('horarios')" >Imprimir!</button>					
				</div>
<div class="col-md-2">
    </div>				
</div>
</div>
</body>
</html>
