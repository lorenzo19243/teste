<?php
session_start();
include('config/conexao.php');
?>
<html lang=¨pt-br¨>
<meta charset="UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>LOGIN - HB SOLUTIONS</title>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-9/assets/css/login-9.css">
<!-- Login 9 - Bootstrap Brain Component -->
<section class="bg-primary py-3 py-md-5 py-xl-8">
  <div class="container">
    <div class="row gy-4 align-items-center">
      <div class="col-12 col-md-6 col-xl-7">
        <div class="d-flex justify-content-center text-bg-primary">
          <div class="col-12 col-xl-9">
            <img class="img-fluid rounded mb-4" loading="lazy" src="img/xgs2.png" width="100%" height="80" alt="BootstrapBrain Logo">
            <hr class="border-primary-subtle mb-4">
            <p class="lead mb-5">Sistema para gerenciamento de agendamentos personalizado!.</p>
            <div class="text-endx">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                <path d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-5">
        <div class="card border-0 rounded-4">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-4">
                  <h3>Faça seu Login!</h3>
                 
                </div>
              </div>
            </div>
            <form class="needs-validation" novalidate method="POST" action="valida.php">
              <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="validationDefaultUsername" placeholder="name@example.com" aria-describedby="validationTooltipUsernamePrepend" required>
                    <label for="email" class="form-label" for="validationDefaultUsername">Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="senha" id="password" value="" placeholder="Password" required>
                    <label for="password" class="form-label">Password</label>
                  </div>
                </div> 
                <div class="col-12">
                  <div class="form-check">
                    <?php
if (isset($_SESSION['loginErro'])) {
    echo $_SESSION['loginErro'];
    unset($_SESSION['loginErro']);
}
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['tokenEspirado'])) {
    echo $_SESSION['tokenEspirado'];
    unset($_SESSION['tokenEspirado']);
}

if (isset($_SESSION['logindeslogado'])) {
    echo $_SESSION['logindeslogado'];
    unset($_SESSION['logindeslogado']);
}

if (!isset($_SESSION['status'])) header('Location: home');

?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn btn-primary btn-lg" type="submit">LOGAR</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end mt-4">
                  <a href="#!">Forgot password</a>
                </div>
              </div>
            </div>
    
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> 
<script src="js/scripts.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> 
<script>
 // SCRIPT DE VALIDAÇÃO DO PROPRIO BOOTSTRAP
  (function() {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<style>
#show_msg {
  min-width: 300px;
  visibility: hidden;
  color: #fff;
  text-align: center;
  padding: 0px;
  position: fixed;
  border-radius: 2px;
  z-index: 1;
  top: 50%;
  font-size: 17px;
}

#show_msg.display {
  visibility: visible;
  -webkit-animation: fadein 1s, fadeout 1s 4s;
  animation: fadein 1s, fadeout 1s 4s;
}
</style>
<?php if (isset($_SESSION['toast_msg'])) { ?>

	<div id="show_msg"><?php echo $_SESSION['toast_msg'];?></div>
<?php } ?>
<script>
$(document).ready(function() {
    <?php if (isset($_SESSION['toast_msg']) && $_SESSION['toast_msg'] != '') { ?>
        var toast_msg = document.getElementById("show_msg");
        toast_msg.className = "display";
        setTimeout(function(){ toast_msg.className = toast_msg.className.replace("display", ""); }, 5000);
      <?php } 
      unset($_SESSION['toast_msg']); ?>
      });
	  
	  
</script>