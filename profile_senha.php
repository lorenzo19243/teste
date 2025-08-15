<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>

<div class="navbar-collapse offcanvas-collapse bg-light" id="navbarsExampleDefault">
  <ul class="navbar-nav mr-auto">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </ul>
</div>
<?php include_once('assets/menu.php'); ?>
<main class="container">

  <div class="bg-body-tertiary p-5 rounded mt-3"> 
    <?php 
$id = $_GET['id']; 
$y =  "SELECT * FROM usuarios WHERE id='$id'";
$resultado = mysqli_query($conn, $y);
while($x = mysqli_fetch_assoc($resultado)){
?>
    <form method="POST" enctype="multipart/form-data" action="processa_edit_senha.php?id=<?php echo $x['id']; ?>">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col"> </div>
        <div class="card" style="width: 18rem;"> <?php
$foto = $x['foto'];

if ($foto >= '0')
{
$y = "<img src=\"uploads/$foto\" class=\"card-img-top\" alt=\"...\">";
}
else
{
$y = "<img src=\"default.jpg\" class=\"card-img-top\" alt=\"...\"> ";
}

echo $y;
?></div>
        <div class="col"> </div>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">NOME:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $x['nome']?>">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">DIGITE SUA NOVA SENHA</label>
        <input type="password" class="form-control" name="senha" minlength="8" required value="">
      </div>
      <div class="mb-3">

</div>
     
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-primary me-md-2" name="submit" type="submit">ALTERAR</button>
      </div>
    </form>
    <?php } ?>
  </div>

</main>
<?php
include_once('assets/rodape.php');
?>
