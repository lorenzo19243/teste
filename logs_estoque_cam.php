<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
$consulta = 'SELECT * FROM clientes WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>"   
union 
(SELECT * FROM clientes WHERE  STATUS="<button type=\'button\' class=\'btn btn-danger btn-sm\' >remarcar</button>" )
union
(SELECT * FROM clientes WHERE  STATUS="A LANÇAR" ORDER BY data_cadastro DESC) 
;';
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>
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
?>
<body>
 <?php  
 include('config/conexao.php');
 $query ="SELECT * FROM hb_logs_estoque_cam ORDER BY log ASC";  
 $result = mysqli_query($conn, $query);  
 ?>  

<link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet" >
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js" ></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js" ></script>


<main class="container">
<div class="p-4 p-md-12 mb-4 rounded text-body-emphasis bg-body-secondary">
  <div class="col-lg-4 col-md-12 mx-auto">
        <h1 class="fw-light">LOGS ESTOQUE CAM</h1>
        </p>
      </div>              
 </div> 
       
<div class="my-3 p-3 bg-body rounded shadow-sm">
<table id="example" class="table table-striped" style="width:100%">
                          <thead>  
                               <tr>  
                                    <td>ID</td>  
                                    <td>LOG</td>  
                                    <td>MOTIVO</td>  
                                    <td>DATA</td>  
                                    <td>USUARIO</td>  
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["id"].'</td>  
                                    <td>'.$row["log"].'</td>  
                                    <td>'.$row["motivo"].'</td>  
                                    <td>'.$row["data"].'</td>  
                                    <td>'.$row["utilizador"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table> 
  
		
		<script>
		    
		    new DataTable('#example', {
    pageLength: 50,
    order: [[0, 'desc']]
});

		</script>
		</div>
</main>
<?php
include_once('assets/rodape.php');
?>