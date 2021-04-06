<?php 
  require '../controller/usuarioController.php';

  session_start();

  if(isset($_POST['entrar'])) { 
      $controller = new UsuarioController();
      $controller->perfilSelecionado($_POST['perfil']);
  }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../resources/css/selecionarPerfil.css">

    <title>Seleção de Perfil</title>
  
  </head>
  <body>

    <?php if( isset( $_SESSION['usuarioLogado'] ) ) { ?>

      <div class="container">
      <div id="banner">
         <img class="w-100" src="../../resources/imagens/logoSistema.png" alt="" >
      </div>    
      <div class="grid-container">
         
          <div class="grid-item" >

            <div class="userDiv"> 
               <h5>Bem-Vindo <?= $_SESSION['usuarioLogado'];?>!</h5>
            </div>

            <div class="tableFuncoes w-100 d-flex justify-content-center">

              <form  method="POST">
                  <label for=""><span class="text-danger">*</span> Perfil de Usúario</label>
                  <select required class="h-25" name="perfil" id="">
                    <option value="">Selecione</option>
                    <?php
                      foreach( $_SESSION['perfil'] as $perfil ) {
                          echo '<option value="'.$perfil.'">'. ucfirst($perfil) .'</option>';
                      }
                    ?>
                  </select>

                  <div class="d-flex justify-content-end mt-5">
                      <input name="entrar" class="submitInput" type="submit" value="Acessar">
                  </div>

              </form>
              </div>
            </div>
        </div>
    </div>
    
  <?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>