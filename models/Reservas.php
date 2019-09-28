<?php 
	class Reservas extends model {
		public function getReservas($data_inicio, $data_fim) {
			$reservas = array();

			$sql = "SELECT 
								reservas.*, 
								carros.nome AS carro,
								carros.placa AS placa,
								pessoas.nome AS pessoa,
								pessoas.cpf AS cpf,
								pessoas.telefone AS telefone
							FROM reservas 
							INNER JOIN carros 
								ON reservas.id_carro = carros.id
							INNER JOIN pessoas
								ON reservas.id_pessoa = pessoas.id
							WHERE
								(NOT (data_inicio > :data_fim OR data_fim < :data_inicio))";

			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':data_inicio', $data_inicio);
			$sql -> bindValue(':data_fim', $data_fim);
			$sql -> execute();

			if ($sql -> rowCount() > 0) {
				$reservas = $sql -> fetchAll();
			}

			return $reservas;
		}

		public function getInfo($id) {
			$info = array();

			$sql = "SELECT 
								reservas.*, 
								carros.nome AS carro,
								carros.placa AS placa,
								pessoas.nome AS pessoa,
								pessoas.cpf AS cpf,
								pessoas.telefone AS telefone
							FROM reservas 
							INNER JOIN carros 
								ON reservas.id_carro = carros.id
							INNER JOIN pessoas
								ON reservas.id_pessoa = pessoas.id
							WHERE
								reservas.id = :id";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':id', $id);
			$sql -> execute();

			if ($sql -> rowCount() > 0) {
				$info = $sql -> fetch();
			}

			return $info;
		}

		public function verificarDisponibilidade($carro, $data_inicio, $data_fim) {
			if ($data_fim > $data_inicio) {
				$sql = "SELECT 
									reservas.* 
								FROM reservas 
								WHERE id_carro = :carro 
								AND (NOT (data_inicio > :data_fim OR data_fim < :data_inicio))";
				$sql = $this -> db -> prepare($sql);
				$sql -> bindValue(':carro', $carro);
				$sql -> bindValue(':data_inicio', $data_inicio);
				$sql -> bindValue(':data_fim', $data_fim);
				$sql -> execute();

				if ($sql -> rowCount() > 0) {
					return false;
				} else {
					return true;
				}
			} else {
				return false;
			}
		}

		public function verificarDisponibilidadeAoEditar($carro, $data_inicio, $data_fim, $id) {
			if ($data_fim > $data_inicio) {
				$sql = "SELECT 
									reservas.* 
								FROM reservas 
								WHERE id_carro = :carro 
								AND reservas.id <> :id
								AND (NOT (data_inicio > :data_fim OR data_fim < :data_inicio))";
				$sql = $this -> db -> prepare($sql);
				$sql -> bindValue(':carro', $carro);
				$sql -> bindValue(':data_inicio', $data_inicio);
				$sql -> bindValue(':data_fim', $data_fim);
				$sql -> bindValue(':id', $id);
				$sql -> execute();

				if ($sql -> rowCount() > 0) {
					return false;
				} else {
					return true;
				}
			} else {
				return false;
			}
		}

		public function reservar($carro, $data_inicio, $data_fim, $nome, $cpf, $phone) {
			$sql = "INSERT INTO pessoas 
								(nome, cpf, telefone) 
							VALUES 
								(:nome, :cpf, :telefone)";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':nome', $nome);
			$sql -> bindValue(':cpf', $cpf);
			$sql -> bindValue(':telefone', $phone);
			$sql -> execute();

			$pessoa = $this -> db -> lastInsertId();

			$sql = "INSERT INTO reservas 
								(id_carro, id_pessoa, data_inicio, data_fim) 
							VALUES 
								(:id_carro, :id_pessoa, :data_inicio, :data_fim)";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':id_carro', $carro);
			$sql -> bindValue(':id_pessoa', $pessoa);
			$sql -> bindValue(':data_inicio', $data_inicio);
			$sql -> bindValue(':data_fim', $data_fim);
			$sql -> execute();
		}

		public function editarReserva($id, $carro, $data_inicio, $data_fim, $id_pessoa, $nome, $cpf, $phone) {
			$sql = "UPDATE reservas 
							SET id_carro = :carro, 
									data_inicio = :data_inicio,
									data_fim = :data_fim
							WHERE id = :id";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':carro', $carro);
			$sql -> bindValue(':data_inicio', $data_inicio);
			$sql -> bindValue(':data_fim', $data_fim);
			$sql -> bindValue(':id', $id);
			$sql -> execute();

			$sql = "UPDATE pessoas
							SET nome = :nome,
									cpf = :cpf,
									telefone = :phone
							WHERE id = :id_pessoa";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':nome', $nome);
			$sql -> bindValue(':cpf', $cpf);
			$sql -> bindValue(':phone', $phone);
			$sql -> bindValue(':id_pessoa', $id_pessoa);
			$sql -> execute();
		}

		public function removerReserva($id) {
			$sql = "DELETE FROM reservas WHERE id = :id";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':id', $id);
			$sql -> execute();
		}
	}