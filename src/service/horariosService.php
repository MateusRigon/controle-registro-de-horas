<?php

include_once '../repository/dataBase.php';

class HorariosService{

    public function insereHorario($idUsuario, $data, $horaEntrada, $horaSaida, $justificativa){
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
                            hora_saida, total_horas, justificativa, status, id_usuario) 
                            VALUES('$data', '$horaEntrada', 
                            '$horaSaida', '$totalHoras', '$justificativa', '$status', '$idUsuario') ";
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

    public function retornaHorariosInseridos($idUsuario){
        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();
        
        $query = "SELECT * FROM horarios WHERE status = 0 AND id_usuario = '$idUsuario' 
        ORDER BY data DESC";
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
            foreach($listaId as $id){
                $classConexao = new ConexaoDataBase();
                $conexao = $classConexao->conectar();

                $query = "UPDATE horarios SET status = 1 WHERE id = '$id'";
                $retorno = mysqli_query($conexao, $query);
            }
            echo"<script language='javascript' type='text/javascript'>
                alert('Horários enviados para análise!');window.location.
                    href='index.php'</script>";
        }
    }

    public function retornaHorariosPorHoraOuJustificativa($idUsuario, $dataInicial, $dataFinal, $justificativa, $pagina){

        $status = 0; // 0 e 1 - para 0 não enviado e 1 enviado
        global $mensagemErro;
        global $mensagemSucesso;

        if( ! empty($justificativa)){
            $queryJustificativa = "AND justificativa = '$justificativa'";
        }

        if($pagina == "visualizarHoras"){
            $status = 1;
        }
        
        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();
        
        $query = "SELECT * FROM horarios WHERE 
        (data BETWEEN '$dataInicial' AND '$dataFinal') $queryJustificativa AND 
        id_usuario = '$idUsuario' AND status = '$status' ORDER BY data DESC";
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

            $totalResultado = count($arrayRetorno);
            $mensagemSucesso = "Foram encontrados $totalResultado resultados";
        
            return $arrayRetorno;
        }else{
            $mensagemErro = "Nenhum horário encontrado!";
        }
    } 

    public function salvarEdicao($idUsuario, $data, $horaEntrada, $horaSaida, $justificativa){
        $classConexao = new ConexaoDataBase();
        $conexao = $classConexao->conectar();
        global $mensagemErro;
        
        if($horaSaida > $horaEntrada){
            if($this->verificaSeExiste($data, $horaEntrada, $horaSaida)){
                $mensagemErro = "Horário já inserido!";
            }else{
                $totalHoras = substr($horaSaida - $horaEntrada, 0, 1); 

                $query = "UPDATE horarios SET data = '$data',
                hora_entrada = '$horaEntrada', hora_saida = '$horaSaida',
                total_horas = '$totalHoras', justificativa = '$justificativa' 
                WHERE id = '$idUsuario'";
                $retorno = mysqli_query($conexao, $query);
                
                if($retorno){
                    echo"<script language='javascript' type='text/javascript'>
                    alert('Horário alterado com sucesso!');window.location.
                        href='index.php'</script>";
                }
            }
        }else{
            $mensagemErro = "Hora de saída deve ser maior que a hora de entrada!";
        }
    }
}

?>