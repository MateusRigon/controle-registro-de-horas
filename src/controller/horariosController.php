<?php

require '../service/horariosService.php';

class HorariosController{

    public function insereHora($data, $horaEntrada, $horaSaida, $justificativa){
        $service = new HorariosService();
        $service->insereHorario($data, $horaEntrada, $horaSaida, $justificativa);
    }

    public function retornaHorariosInseridos(){
        $service = new HorariosService();
        return $service->retornaHorariosInseridos();
    }

    public function excluirHorario($id){
        $service = new HorariosService();
        $service->excluirHorario($id);
    }

    public function enviarParaAnalise($listaId){
        $service = new HorariosService();
        $service->enviarParaAnalise($listaId);
    }
}
?>