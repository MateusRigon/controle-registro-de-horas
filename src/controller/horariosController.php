<?php

require '../service/horariosService.php';

class HorariosController{

    public function insereHora($idUsuario, $data, $horaEntrada, $horaSaida, $justificativa){
        $service = new HorariosService();
        $service->insereHorario($idUsuario, $data, $horaEntrada, $horaSaida, $justificativa);
    }

    public function retornaHorariosInseridos($idUsuario){
        $service = new HorariosService();
        return $service->retornaHorariosInseridos($idUsuario);
    }

    public function excluirHorario($id){
        $service = new HorariosService();
        $service->excluirHorario($id);
    }

    public function enviarParaAnalise($listaId){
        $service = new HorariosService();
        $service->enviarParaAnalise($listaId);
    }

    public function retornaHorariosPorHoraOuJustificativa($idUsuario, $dataInicial, $dataFinal, $justificativa){
        $service = new HorariosService();
        return $service->retornaHorariosPorHoraOuJustificativa($idUsuario, $dataInicial, $dataFinal, $justificativa);
    }
}
?>