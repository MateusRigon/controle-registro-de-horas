<?php

require '../service/usuarioService.php';

class UsuarioController{

    public function logarUsuario($email, $senha){
        $service = new UsuarioService;
        return $service->logarUsuario($email, $senha);
    }

    public function perfilSelecionado($perfil){
        $service = new UsuarioService;
        return $service->perfilSelecionado($perfil);
    }
}
?>