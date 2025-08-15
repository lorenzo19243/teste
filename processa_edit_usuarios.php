<?php
session_start();

include('config/conexao.php');
//include_once("config/seguranca.php");
//seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

    $id = $_GET['id'];
    $imagem_antiga = $_POST['imagem_antiga'];
    $nova_imagem = $_POST['nova_imagem'];
    $ultima_alteracao = date('Y-m-d H:i:s');

    $errorMsg = ""; 
    $error = 0; 
    
	$nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nasc = mysqli_real_escape_string($conn, $_POST['nasc']);
    $fone = mysqli_real_escape_string($conn, $_POST['fone']);
	$file = $_FILES["image"]["tmp_name"];

   if($nova_imagem == 'nao'){ 
    
    $query = "UPDATE usuarios SET nome='$nome', email='$email', nasc='$nasc', fone='$fone' WHERE id='$id'";
    $log_categoria = "INSERT INTO hb_os_logs set log='ALTEROU INFORMACOES DO SEU PERFIL', data='$ultima_alteracao', utilizador='$email'";   
    $resposta = mysqli_query($conn, $query);  
    $resposta .= mysqli_query($conn, $log_categoria);
       
    if($resposta){
    //$_SESSION['success'] = "<div class='danger' role='alert' id='sumirDiv'><center>Área Restrita - Realize Login</center></div>";
    
    
    $_SESSION['toast_msg'] = '<div class="toast show fade text-bg-success p-3" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-toast-init="" data-mdb-color="success" data-mdb-autohide="false" data-mdb-toast-initialized="true">
            <div class="toast-header text-bg-success p-3">
              <i class="fas fa-check fa-lg me-2"></i>
              <strong class="me-auto"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">SUCESSO!</font></font></strong>
              <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.date('H:i:s').'</font></font></small>
              <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Fechar"></button>
            </div>
            <div class="toast-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">INFORMACOES ALTERADAS POR PAVOR LOGUE NOVAMENTE!.</font></font></div>
          </div>';
    header('Location: sair.php');
}else{
    $_SESSION['error'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NÃO FOI POSSÍVEL EDITAR A SENHA &nbsp; <i class='fas fa-grin-squint-tears fa-2x'></i> </strong> 
                                <span aria-hidden='true'></span>
                                </button>
                                
                            </div>";
     header('Location: profile.php?id='.$id.'');
    
}

}
   
   
   if($nova_imagem == 'sim'){
        //Extract File Information 
        $fileName = pathinfo($_FILES["image"]["name"]);
        $fileExtension = $fileName['extension'];
        $fileSize = $_FILES["image"]["size"];
        $newFileName =  "hbsoluctions_" . time() . "." . $fileExtension;
       $fileAndLocation = "uploads/" . $newFileName; 

        // Allowed Extensions 
        $allowedExtensions = array("jpeg", "jpg", "png", "jfif");

        // Check File Size 
        if ($fileSize > 2000000) {
            $errorMsg = "File is over 2Mb in size <br>"; 
            $error = 1; 
        }

        // Check Allowed Extensions 
        if (!in_array($fileExtension, $allowedExtensions)){
            $errorMsg = "File Type is not allowed. <br>"; 
            $error = 1; 
        }


        $uniqueid = rand(); 
        $date = date("F j, Y, g:i a");

        // if everything is ok we upload the file 
        if ($error != 1){
            move_uploaded_file($file, $fileAndLocation);

            //Insert user data to database 
            $query = "UPDATE usuarios SET nome='$nome', email='$email', nasc='$nasc', fone='$fone', foto='$newFileName' WHERE id='$id'";
            $log_categoria = "INSERT INTO hb_os_logs set log='$nome ALTEROU SUA FOTO DO PERFIL', data='$ultima_alteracao', utilizador='$email'";
            $result = mysqli_query($conn, $query);
            $resposta .= mysqli_query($conn, $log_categoria);

            if($result == true){
                $errorMsg = "foto alterada com sucesso"; 
                $defaultImage = $fileAndLocation;
				 header('Location: profile.php?id='.$id.'');	 
            }else{
                $errorMsg = "File Not Inserted to Database"; 
            }



        }else{
            $errorMsg = "Something is Wrong!"; 
        }


    }


?>