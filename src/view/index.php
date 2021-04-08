<?php 
  require '../controller/usuarioController.php';
  require '../controller/horasController.php';

  session_start();
  $controllerUsuario = new UsuarioController();
  $controllerHoras = new HorasController();

  if(isset($_GET['sair'])){
    $controllerUsuario->deslogarUsuario($_SESSION['usuarioLogado']);
  }

  if( ! isset( $_SESSION['usuarioLogado']  ) ) {
    header("location: loginUsuarios.php");
  }
  if( ! isset( $_SESSION['verificarUsuarioLogado']  ) ) {
    header("location: selecionarPerfil.php");
  }

  if(isset($_POST['insereHora'])){
    $controllerHoras->insereHora();
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
    <link rel="stylesheet" href="../../resources/css/index.css">

    <title>Página Principal</title>

  </head>
  <body>

    <div class="container">
        <div id="banner">
           <img class="w-100" src="../../resources/imagens/logoSistema.png" alt="" >
        </div>    
        <div class="grid-container">
            <div class="grid-item1">
            <table class="w-100">
                <tr>
                  <td><a href="index.php">Inserir</a></td>
                </tr>
                <tr>
                  <td><a href="editarHoras.php">Editar</a></td>
                </tr>
                <tr>
                  <td><a href="visualizarHoras.php">Visualizar</a></td>
                </tr>
                <tr>
                    <td>
                        <form method="GET">
                          <input name="sair" class="sairLink h-25" type="submit" value="Sair">
                        </form>
                    </td>
                </tr>
            </table>
            </div>
            <div class="grid-item2" >

              <div class="userDiv d-flex justify-content-between"> 
                 <h5>Usuário: <?=$_SESSION['usuarioLogado']?></h5>
                 <h5>Perfil: <?=$_SESSION['perfil']?></h5>
              </div>

              <div class="tableFuncoes">

                <div>

                  <h5>Insere Hora</h5>

                  <form id="form1" method="POST" >

                  <div>
                    <label for=""><span class="text-danger">*</span>Data</label>
                    <input required type="text" placeholder="DD/MM/AAAA">
                  </div>
                  <div class="horaInput">
                    <label for=""><span class="text-danger">*</span>Hora Entrada:</label>
                    <input required type="text" placeholder="##:##">
                  </div>
                  <div class="horaInput">
                    <label for=""><span class="text-danger">*</span>Hora Saída:</label>
                    <input required type="text" placeholder="##:##">
                  </div>

                  <div class="justificativa">
                    <label for=""><span class="text-danger">*</span>Justificativa:</label>
                    <select required name="justificativa" id="">
                      <option value="">Selecione</option>
                      <option value="volvo">Prod. Conteúdo</option>
                      <option value="saab">Versionamento</option>
                      <option value="mercedes">Capacitação</option>
                      <option value="audi">Empréstimo</option>
                    </select>

                    <div class="d-flex justify-content-center">
                       <input name="insereHora" class="submitInput" type="submit" value="Insere Hora">
                    </div>
                  
                  </div>
                  </form>
                </div>

              <form class="form2" method="POST">
                <div class="mt-3">
                    <h5>Lista de Horas</h5>
                </div>

                <div id="divTable">
                <table class="w-100 mb-3">
                  <tr>
                    <th>Data</th>
                    <th>Hora Entrada</th> 
                    <th>Hora Saída</th>
                    <th>Total Horas</th>
                    <th>Justificativa</th> 
                    <th>Opções</th>
                  </tr>
                  <tr>
                    <td><input type="text" value="10/10/2016"></td>
                    <td><input type="text" value="08:00"></td>
                    <td><input type="text" value="12:00"></td>
                    <td>4</td>
                    <td>
                      <select style="padding: 6px;" name="justificativa" id="">
                        <option value="volvo">Prod. Conteúdo</option>
                        <option value="saab">Versionamento</option>
                        <option value="mercedes">Capacitação</option>
                        <option value="audi">Empréstimo</option>
                      </select>
                    </td>
                    <td>
                    <span><img src="../../resources/imagens/iconeEditar.png"></span>
                    <span><img src="../../resources/imagens/iconeExcluir.png"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>10/10/2016</td>
                    <td>13:00</td>
                    <td>17:00</td>
                    <td>4</td>
                    <td>Produção</td>
                    <td>
                    <span><img src="../../resources/imagens/iconeEditar.png"></span>
                    <span><img src="../../resources/imagens/iconeExcluir.png"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>11/10/2016</td>
                    <td>10:00</td>
                    <td>12:00</td>
                    <td>2</td>
                    <td>Capacitação</td>
                    <td>
                    <span><img src="../../resources/imagens/iconeEditar.png"></span>
                    <span><img src="../../resources/imagens/iconeExcluir.png"></span>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>10</td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
                </div>
                <div class="mt-4 ml-4 w-25">
                    <h5>Legenda:</h5>
                    <div class="d-flex justify-content-between w-75">
                      <p>
                      <span><img src="../../resources/imagens/iconeEditar.png"></span>
                      Editar
                      </p>
                      <p>
                      <span><img src="../../resources/imagens/iconeExcluir.png"></span>
                      Excluir
                      </p>
                    </div>

                </div>

                <div class="enviarButton mt-3 d-flex justify-content-end">
                    <div style="margin-right: 10px;">
                    <input class="submitInput" type="button" value="Voltar">
                    </div>
                    <div>
                    <input class="submitInput" type="submit" value="Enviar para Análise">
                    </div>
                </div>
              </form>   
              </div>
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