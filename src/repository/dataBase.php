<?php 
	// conexão MySQL

	class ConexaoDataBase{

		public function conectar(){
			$hostname = "localhost";
			$password = "";
			$user = "root";
			$db = "sistema_controle_de_horas";
			return mysqli_connect($hostname, $user, $password, $db);
		}
	}
 ?>