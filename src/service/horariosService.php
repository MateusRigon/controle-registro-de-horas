<?php

include_once '../repository/dataBase.php';

class HorariosService{

    public function insereHorario($data, $horaEntrada, $horaSaida, $justificativa){
        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();
        global $mensagemErro;
        global $mensagemSucesso;
        $totalHoras = substr($horaSaida - $horaEntrada, 0, 1); 
        $status = 0; // 0 e 1 - para 0 não enviado e 1 enviado

        $query = "INSERT INTO horarios (data, hora_entrada, 
                        hora_saida, total_horas, justificativa, status) 
                        VALUES('$data', '$horaEntrada', 
                        '$horaSaida', '$totalHoras', '$justificativa', '$status') ";
        $retorno = mysqli_query($conexao, $query);    
        
        if($retorno){
            $mensagemSucesso = "Horário inserido com sucesso!";
		}else{
			$mensagemErro = "Erro ao inserir horário!";
		}
    }

}

?>