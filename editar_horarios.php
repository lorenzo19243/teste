<?php
session_start();
include_once('assets/cabecalho.php');
include_once('assets/rodape.php');
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



<div class="container-sm"></br>
</br>
</br>
</br>
 <div class="modal-content border-0">
  <div class="badge  text-wrap">
    <div class="col-md-auto"><h5><small class="text-muted">
     <?php
	 
	$_SESSION["usuarioNome"]; 
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $semana = array(
        'Sun' => 'Domingo', 
        'Mon' => 'Segunda-Feira',
        'Tue' => 'Terça-Feira',
        'Wed' => 'Quarta-Feira',
        'Thu' => 'Quinta-Feira',
        'Fri' => 'Sexta-Feira',
        'Sat' => 'Sabado'
    );
    
    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Março',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );
    
    echo 'Olá ','<strong>', $_SESSION["usuarioNome"],'</strong>', ' Hoje é ', $semana["$data"] .  ", dia {$dia} de " . $mes_extenso["$mes"] . " de {$ano}"; ?></small></h5>
        <span class="btn btn-primary btn-sm"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt); ?> REPAROS EM ANDAMENTO!</span>

<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' ><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt); ?>
 INSTALAÇÃO EM ANDAMENTO!</button>


    <span class="btn btn-primary btn-sm"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt); ?> MUDANÇAS EM ANDAMENTO!</span>
<span class="btn btn-primary btn-sm"><?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt); ?> RECOLHAS EM ANDAMENTO!</span>
    </div>
  </div>
</div>

<div class="container">
    <div class="col-md-8 order-md-1">
<form>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">TECNICOS </label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">SEGUNDA A SEXTA</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="06:40 ÁS 11:00 - 13:00 ÁS 16:40" disabled>
    </div>
        <div class="form-group col-md-3">
      <label for="inputPassword4">SABADO</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
        <div class="form-group col-md-4">

      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" >
    </div>
    <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
        <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
        <div class="form-group col-md-4">

      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" >
    </div>
    <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
        <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
            <div class="form-group col-md-4">

      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" >
    </div>
    <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
        <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
            <div class="form-group col-md-4">

      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
        <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
                <div class="form-group col-md-4">

      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
        <div class="form-group col-md-4">

      <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" disabled>
    </div>
    
    </div>
 
  <div class="form-row">

  </div>
  <button type="submit" class="btn btn-primary">Entrar</button>
</form>
</div>
</div>
</div>
<footer class="bd-footer py-5 mt-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col"> </div>
      <div class="badge  text-wrap">
        <p class="mt-5 mb-1 text-muted">&copy; <?php echo date('d/m/Y') ?></p>
        <p class="mt-1 mb-1 text-muted">HB WEB E CIA - All Rights Reserved</p>
        <p class="mt-1 mb-1 text-muted">Versão 1.0 </p>
        <p class="mt-1 mb-1 text-muted"><a class="btn btn-secondary position-relative" href="relatorio.php"> RELATORIO ANO</a> <a class="btn btn-secondary position-relative" href="relatorio_mes.php"> RELATORIO MES</a> <a class="btn btn-secondary position-relative" href="pesquisar_relatorio_tecnico.php"> RELATORIO TECNICO</a> </p>
      </div>
      <div class="col"> </div>
    </div>
  </div>
</footer>

   
    
