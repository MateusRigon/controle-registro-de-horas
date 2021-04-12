<?php

require '../service/horariosService.php';

class HorariosController{

    public function insereHora($data, $horaEntrada, $horaSaida, $justificativa){
        $service = new HorariosService();
        $service->insereHorario($data, $horaEntrada, $horaSaida, $justificativa);
    }
}
?>