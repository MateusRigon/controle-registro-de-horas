<?php
  require '../controller/usuarioController.php';

  session_start();

  if(isset($_POST['entrar'])) { 
      $controllerUsuario = new UsuarioController();
      $controllerUsuario->logarUsuario($_POST['email'], $_POST['senha']);
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
    <link rel="stylesheet" href="../../resources/css/loginUsuarios.css">

    <title>Login Usuários</title>

  </head>
  <body>

    <div class="container">
        <div id="banner">
           <img class="w-100" src="../../resources/imagens/capaSistema.png" alt="" >
        </div>    
        <div class="grid-container">
            <div class="grid-item1">
              <p style="background-color: #e0dcdc;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Proin nec nunc et purus efficitur dapibus sit amet sit amet est. 
                Vivamus auctor vehicula orci, et fermentum est sagittis ut. 
                Vestibulum ultrices non quam et vehicula. Mauris facilisis lacus velit
              </p>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Proin nec nunc et purus efficitur dapibus sit amet sit amet est. 
                Vivamus auctor vehicula orci, et fermentum est sagittis ut. 
                Vestibulum ultrices non quam et vehicula. Mauris facilisis lacus velit
              </p>  
            </div>
            <div class="grid-item2" >
              <div class="text-center" style="font-size: 20px;">
                <p>Digite seu e-mail para acessar o sistema Ajuste de ponto</p>
              </div>
              <hr class="w-50">
              <form method="POST" style="margin-left: 50px;">

                <div>
                  <label for="email">Email</label>
                  <input required type="email" name="email">
                </div>
                <div style="margin-top: 10px;">
                  <label for="senha">Senha <span class="text-danger"> <?= $msgErro; ?> </span> </label>
                  <input required type="password" name="senha">
                </div>

                <div class="d-flex mt-3 justify-content-between">
                  <div>
                    <a style="display:block;" href="#">Ainda não sou cadastrado!</a>
                    <a style="display:block;" href="#">Esqueceu a senha?</a>
                  </div>

                  <div class="botao-entrar mr-5">
                   <input name="entrar" type="submit" value="Entrar">
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>