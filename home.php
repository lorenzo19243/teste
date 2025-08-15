<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
$consulta = "SELECT * FROM clientes WHERE concluido = 'NAO' ORDER BY ultima_alteracao DESC ; ";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>
<style>
.card-columns {
  @include media-breakpoint-only(lg) {
    column-count: 4;
  }
</style>
<?php include_once('assets/menu.php'); ?>
<div class="navbar-collapse offcanvas-collapse bg-light" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <br>
            <br>
            <br>
            <br>
            <br>
        </ul>
      </div>
<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}


if (isset($_GET['dia']))

    $dia_hoje = $_GET['dia'];
else
    $dia_hoje = date('d');
    
if (isset($_GET['mes']))

    $mes_hoje = $_GET['mes'];
else
    $mes_hoje = date('m');

if (isset($_GET['ano']))
    $ano_hoje = $_GET['ano'];
else
    $ano_hoje = date('Y');
?>



<div class="container-sm">
    
  
 <div class="row">
  <div class="row g-3 align-items-center ">
      <div class="col-md-4"></div>
  <div class="col-auto">
    <label for="inputPassword6" class="col-form-label">SELECIONE O ANO:</label>
  </div>
  <div class="col-auto">
  </div>
  <div class="col-auto">
<select class="form-select" aria-label=".form-select-lg example" onchange="location.replace('?mes=<?php echo $mes_hoje?>&ano='+this.value)">
<?php
for ($i=2024;$i<=2026;$i++){
?>
<option class="datatable-selector" value="<?php echo $i?>" <?php if ($i==$ano_hoje) echo "selected=selected"?> ><?php echo $i?></option>
<?php }?>
</select> 
  </div>
</div>  
    </div>
  </div>


<div class="my-3 p-3 bg-body rounded shadow-sm">
<div class="row g-1 justify-content-evenly ">
  <div class="card text-white bg-primary mb-3" style="max-width: 17rem;">
  <div class="card-header" style="text-align: center;">REPAROS TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title" style="text-align: center;"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text" style="text-align: center;">REPAROS CONCLUIDOS</p>
  </div>
</div>
  <div class="card text-white bg-danger mb-3" style="max-width: 17rem;">
  <div class="card-header" style="text-align: center;">INSTALAÇÕES TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title" style="text-align: center;"><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text" style="text-align: center;">INSTAL. CONCLUIDAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 17rem;">
  <div class="card-header" style="text-align: center;">MUDANÇAS TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title" style="text-align: center;"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text" style="text-align: center;">MUDANÇAS CONCLUIDAS</p>
  </div>
</div>
   <div class="card text-white bg-success mb-3" style="max-width: 17rem;">
  <div class="card-header" style="text-align: center;">RECOLHAS TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title" style="text-align: center;"> <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text" style="text-align: center;">RECOLHAS CONCLUIDAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 17rem;">
  <div class="card-header" style="text-align: center;">TOTAL DE CHAMADOS</div>
  <div class="card-body">
    <h1 class="card-title" style="text-align: center;"><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM clientes WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ) +
    (SELECT COUNT(*) FROM instalacoes WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ) +
    (SELECT COUNT(*) FROM mudanca WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ) +
    (SELECT COUNT(*) FROM recolhas WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ) AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text" style="text-align: center;">TOTAL DE CHAMADOS CONCLUIDOS</p>
  </div>
</div>

</div>
</div>
</BR>
<div id="columnchart_material"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['RELATORIO MENSAL', 'REPAROS', 'INSTALAÇÕES', 'MUDANÇAS', 'RECOLHAS'],
          ['JANEIRO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="01"  AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['FEVEREIRO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['MARÇO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['ABRIL', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['MAIO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['JUNHO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="06" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="06" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="06" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="06" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['JULHO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['AGOSTO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['SETEMBRO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['OUTUBRO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['NOVEMBRO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
          ['DEZEMBRO', <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>]


          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
</body>
</html>
<html>
  <head>
    <script type="text/javascript">
            google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'MES');
      data.addColumn('number', 'REPAROS');
      data.addColumn('number', 'INSTALAÇÕES');
      data.addColumn('number', 'MUDANÇAS');
      data.addColumn('number', 'RECOLHAS');

      data.addRows([
        [01,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'"  AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="01"  AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [02,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [03,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,   <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="03" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [04,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="04" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [05,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="05" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [06,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="06" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="06" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="06"  AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="06"  AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [07,   <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="07" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [08,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'"  AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="08" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [09,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="09" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [10, <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [11,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>],
        [12,  <?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>,  <?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>, <?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?>]
      ]);

      var options = {
          title: '',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

      var chart = new google.charts.Line(document.getElementById('balanco'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
    </script>
  </head>
  <body>
      <div class="col-md-12">
    <div id="balanco" ></div>
    </div>
  </body>
</html>
<link rel="stylesheet" href="bootstrap-select.min.css" />
<link href="form-validation.css" rel="stylesheet">


      
    <!-- End Example Code -->

<?php
include_once('assets/rodape.php');
?>