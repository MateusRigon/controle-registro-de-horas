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

        if($horaSaida > $horaEntrada){
            if($this->verificaSeExiste($data, $horaEntrada, $horaSaida)){
                $mensagemErro = "Horário já inserido!";
            }else{
                $query = "INSERT INTO horarios (data, hora_entrada, 
                            hora_saida, total_horas, justificativa, status) 
                            VALUES('$data', '$horaEntrada', 
                            '$horaSaida', '$totalHoras', '$justificativa', '$status') ";
                $retorno = mysqli_query($conexao, $query);    
                
                if($retorno){
                    $mensagemSucesso = "Horário inserido com sucesso!";
                }
            }
        }else{
            $mensagemErro = "Hora de saída deve ser maior que a hora de entrada!";
        }
        
        
    }

    public function verificaSeExiste($data, $horaEntrada, $horaSaida){
        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();

        $query = "SELECT * FROM horarios WHERE (data = '$data') 
        AND (hora_entrada = '$horaEntrada') AND (hora_saida = '$horaSaida') ";
        $retorno = mysqli_query($conexao, $query);

        if(mysqli_num_rows($retorno) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function retornaHorariosInseridos(){
        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();
        
        $query = "SELECT * FROM horarios";
        $retorno = mysqli_query($conexao, $query);
        $array = mysqli_fetch_assoc($retorno);

        if( ! empty($array)){
            global $arrayRetorno;
            global $somaHoras;
            $arrayRetorno = array();

            do{
                array_push($arrayRetorno, $array);
                $somaHoras += $array['total_horas'];
            }while($array = mysqli_fetch_assoc($retorno));

            return $arrayRetorno;
        }

    }

    public function excluirHorario($id){
        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();

        $query = "DELETE FROM horarios WHERE id = '$id'";
        $retorno = mysqli_query($conexao, $query);

        if($retorno){
            echo"<script language='javascript' type='text/javascript'>
            alert('Horário excluido com sucesso!');window.location.
                href='index.php'</script>";
        }
    }

    public function enviarParaAnalise($listaId){
        if( ! empty($listaId)){
            foreach($listaId as $teste){
                //update horarios set status = 1 where id = $teste 
            }
            echo"<script language='javascript' type='text/javascript'>
                alert('Horários enviados para análise!');window.location.
                    href='index.php'</script>";
        }
    }
}

?>