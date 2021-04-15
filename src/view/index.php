<?php 
  require '../controller/usuarioController.php';
  require '../controller/horariosController.php';

  session_start();
  $controllerUsuario = new UsuarioController();
  $controllerHoras = new HorariosController();

  if(isset($_GET['sair'])){
    $controllerUsuario->deslogarUsuario($_SESSION['usuarioLogado']);
  }

  if(isset($_POST['excluir'])){
    $controllerHoras->excluirHorario($_POST['id']);
  }

  if( ! isset( $_SESSION['usuarioLogado']  ) ) {
    header("location: loginUsuarios.php");
  }
  if( ! isset( $_SESSION['verificarUsuarioLogado']  ) ) {
    header("location: selecionarPerfil.php");
  }

  if(isset($_POST['insereHora'])){
    $controllerHoras->insereHora($_SESSION['idUsuario'],$_POST['data'], $_POST['horaEntrada'],
         $_POST['horaSaida'], $_POST['justificativa']);
  }
  
  $retorno = $controllerHoras->retornaHorariosInseridos($_SESSION['idUsuario']);

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
                    <div class="d-flex">
                      <div>
                        <label for="data"><span class="text-danger">*</span>Data</label>
                        <input name="data" required type="text" placeholder="DD/MM/AAAA">
                      </div>
                      <div class="horaInput">
                        <label for="horaEntrada"><span class="text-danger">*</span>Hora Entrada:</label>
                        <input name="horaEntrada" required type="text" placeholder="##:##">
                      </div>
                    </div>

                 
                    <div class="d-flex justify-content-center">
                        <p class="mt-3 mb-0 text-success"><?= $mensagemSucesso ?></p>
                        <p class="mt-3 mb-0 text-danger"><?= $mensagemErro ?></p>
                    </div>
                  </div>

                  <div class="horaInput">
                    <label for="horaSaida"><span class="text-danger">*</span>Hora Saída:</label>
                    <input name="horaSaida" required type="text" placeholder="##:##">
                  </div>

                  <div class="justificativa">
                    <label for="justificativa"><span class="text-danger">*</span>Justificativa:</label>
                    <select required name="justificativa" id="">
                      <option value="">Selecione</option>
                      <option value="Prod. Conteúdo">Prod. Conteúdo</option>
                      <option value="Versionamento">Versionamento</option>
                      <option value="Capacitação">Capacitação</option>
                      <option value="Empréstimo">Empréstimo</option>
                    </select>

                    <div class="d-flex justify-content-center">
                       <input name="insereHora" class="submitInput" type="submit" value="Insere Hora">
                    </div>
                  
                  </div>
                  </form>
                </div>

              <?php if(isset($retorno)){ ?>
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
                    <th style="width:80px;">Opções</th>
                  </tr>
                  <?php
                  $listaId = array();
                    foreach($retorno as $horario) { 
                      array_push($listaId, $horario['id']); ?>
                      
                      <tr style="height: 33px;">
                        <td><?= $horario['data']; ?></td>
                        <td><?= $horario['hora_entrada']; ?></td>
                        <td><?= $horario['hora_saida']; ?></td>
                        <td><?= $horario['total_horas']; ?></td>
                        <td><?= $horario['justificativa']; ?></td>
                        
                        <form method="POST" >
                          <td class="d-flex justify-content-center botoesSalvarExcluir" style="border: 0;">
                            <a style="padding: 2px 4px 0px 4px;" href="editarHoras.php"> <span><img src="../../resources/imagens/iconeEditar.png"></span></a>
                            <input name="id" type="hidden" value="<?= $horario['id']; ?>">
                            <button type="submit" name="excluir"><img src="../../resources/imagens/iconeExcluir.png"></button>
                          </td>
                        </form>
                      </tr>
                  <?php }?>
    
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= $somaHoras;?></td>
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
                    <input onclick="location.href='javascript:history.back()'" class="submitInput" type="button" value="Voltar">
                    </div>
                    <div>
                    <input name="enviarAnalise" class="submitInput" type="submit" value="Enviar para Análise">

                    <?php
                      if(isset( $_POST['enviarAnalise'])){
                        $controllerHoras->enviarParaAnalise($listaId);
                      }
                    ?>
                    </div>
                </div>
              </form>   
              <?php } ?>
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