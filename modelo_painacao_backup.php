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



<main class="container">

        
<?php
    
    $pag = (isset($_GET['pagina']))?$_GET['pagina'] : 1;
    
    $busca = "SELECT *FROM hb_os_logs ORDER BY data DESC";
    $todos = mysqli_query($conn, "$busca");
    
    $registros = "50";
    
    $tr = mysqli_num_rows($todos);
    $tp = ceil($tr/$registros);
    
    $inicio = ($registros*$pag)-$registros;
    $limite = mysqli_query($conn, "$busca LIMIT $inicio, $registros");
    
    $anterior = $pag -1;
    $proximo = $pag +1;
    
    
?>    
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Logs do Sistema:</h6>
        <?php 
     while($linha = mysqli_fetch_array($limite)){
        $id = $linha['id'];
		$log = $linha['log'];
		$data = $linha['data'];
		$utilizador = $linha['utilizador'];
        
 
    ?>
    <div class="d-flex text-body-secondary pt-3">
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark"><?php echo $utilizador ?></strong>
        <?php echo $log ?> DIA <?php echo date('d/m/Y  H:i:s',  strtotime($data));?>.
      </p>
    </div>
    <?php } ?>
    <small class="d-block text-end mt-3">
        <nav aria-label="...">
            <ul class="pagination pagination-sm">
                <?php
                if($pag >1){
                ?>
                <li class="page-item">
                <a class="page-link" href="?pagina=<?=$anterior;?>" aria-label="Anterior">
                        <span aria-hidden="true">Anterior</span>
                    </a>
                </li>
                <?php }?>
                
                <?php
                for($i=1; $i<=$tp; $i++){
                    if($pag == $i ){
                        echo "<li class='page-item active'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                    }else{
                        echo "<li class='page-item'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                    }
                }
                ?>
                
                
                
                <?php 
                if($pag < $tp){
                ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?=$proximo;?>" aria-label="Próximo">
                        <span aria-hidden="true">Próximo</span>
                        
                    </a>
                </li><?php }?>
                </ul>
                </nav>
                
    </small>
  </div>


<?php
include_once('assets/rodape.php');
?>