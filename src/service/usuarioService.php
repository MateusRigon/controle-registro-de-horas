<?php

require '../repository/dataBase.php';

class UsuarioService{

    public function logarUsuario($email, $senha){

        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();
        global $msgErro;

        $query = " SELECT * FROM usuarios 
                        WHERE (email = '$email') 
                            AND (senha = '$senha') ";
        $retorno = mysqli_query($conexao, $query);
        $usuario = mysqli_fetch_assoc($retorno);

        $perfil = array($usuario['perfil_1']);

        if(!empty($usuario['perfil_2'])){
            array_push($perfil, $usuario['perfil_2']);
        }
        if(!empty($usuario['perfil_3'])){
            array_push($perfil, $usuario['perfil_3']);
        }
        
        if (mysqli_num_rows($retorno) <= 0) {
            $msgErro = "* Email e/ou senha errados";
        } else {
            session_start();
            $_SESSION['usuarioLogado'] = ucfirst($usuario['login']);
            $_SESSION['perfil'] = $perfil;

            echo"<script language='javascript' type='text/javascript'>
			        alert('Logado com sucesso!');window.location.
	     		        href='selecionarPerfil.php'</script>";
        }
        

    }

    public function perfilSelecionado($perfil){
        session_start();
        $_SESSION['perfil'] = ucfirst($perfil);
        return header("location: index.php");
    }
}

?>