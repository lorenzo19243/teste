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
    <div class="container">
<div class="navbar-collapse offcanvas-collapse bg-light" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <br>
            <br>
            <br>
            <br>
            <br>
        </ul>
      </div>
      
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
<div class="d-grid gap-2 d-md-flex justify-content-md-end"><a class="btn btn-primary me-md-2"  href="add_profile.php">ADD NOVO USUARIO</a>
</div>
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



<div class="row mb-2">
                                     <?php
$consulta = "SELECT * FROM usuarios  ORDER BY id ASC";
$resultado = mysqli_query($conn, $consulta);			
			
$contar = mysqli_num_rows($resultado);

if ($contar == 0)
{
echo "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NENHUMA CONTA CADASTRADA NO MOMENTO!  </strong> 
                                    
                                
                        </div>";
}
else
{
echo ' ';
}


?>
 <?php 
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id = $linha['id'];
		$nome = $linha['nome'];
		$email = $linha['email'];
		$nasc = $linha['nasc'];
		$foto = $linha['foto'];
		$fone = $linha['fone'];
		$status = $linha['status'];
    ?>   
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis"></strong>
          <h3 class="mb-0"><?php echo $nome ?></h3>
          <div class="mb-1 text-body-secondary"><?php echo date('d/m/Y',  strtotime($nasc));?></div>
          <div class="mb-1 text-body-secondary"><?php echo $email ?></div>
          <div class="mb-1 text-body-secondary"><?php echo $fone ?></div>
          <div class="mb-1 text-body-secondary"><?php
$status = $status;
$foto = $linha['foto'];

if ($status >= "1")
{
$x = '<div class="d-flex gap-2 justify-content-center ">

<span class="badge d-flex align-items-center p-1 pe-2 text-success-emphasis bg-success-subtle border border-success-subtle rounded-pill">
    <img class="rounded-circle me-1" width="24" height="24" src="uploads/'.$linha['foto'].'" alt="">
    ON-LINE
  </span></div>';
}
else
{
$x = '<div class="d-flex gap-2 justify-content-center "><span class="badge d-flex align-items-center p-1 pe-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill">
    <img class="rounded-circle me-1" width="24" height="24" src="uploads/'.$linha['foto'].'" alt="">OFFLINE
  </span></div>';
}

echo $x;

?></div>
          <p class="card-text mb-auto"></p>
          <div class="btn-group"> <a class="btn btn-sm btn-outline-secondary" href="processa_excluir_usuario.php?id=<?php echo $linha['id']; ?>&nome=<?php echo $linha['nome']; ?>" onClick="return confirm('Deseja realmente deletar o usuario?')">DELETAR</a>
                  <button type="button" class="btn btn-sm btn-outline-secondary">EDITAR</button>
                </div>
        </div>
        <div class="col-auto d-none d-lg-block"><?php 

if (!empty($linha['foto'])) { 
    echo "<img src=uploads/".$linha['foto']." alt=\"homepage\" class=\"bd-placeholder-img\" width=\"200\" height=\"250\" xmlns=\"http://www.w3.org/2000/svg\" role=\"img\" aria-label=\"Placeholder: Thumbnail\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\"/>";
}

else {
    echo "<img src='default.jpg' alt=\"homepage\" class=\"bd-placeholder-img\" width=\"200\" height=\"250\" xmlns=\"http://www.w3.org/2000/svg\" role=\"img\" aria-label=\"Placeholder: Thumbnail\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\"/>";
}

?>
         
        </div>
      </div>
    </div>
<?php } ?>
  </div>
</div>  
  <?php
include_once('assets/rodape.php');
?>