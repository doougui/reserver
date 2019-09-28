<?php 
	class Carros extends model {
		public function getCarros() {
			$carros = array();

			$sql = "SELECT * FROM carros";
			$sql = $this -> db -> query($sql);

			if ($sql -> rowCount() > 0) {
				$carros = $sql -> fetchAll();
			}

			return $carros;
		}

		public function getQtdCarros() {
			$qtd = 0;

			$sql = "SELECT COUNT(*) AS qtd FROM carros";
			$sql = $this -> db -> query($sql);

			if ($sql -> rowCount() > 0) {
				$qtd = $sql -> fetch();
			}

			return $qtd['qtd'];
		}

		public function getPreco($id_carro) {
			$preco = '';

			$sql = "SELECT * FROM carros WHERE id = :id_carro";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':id_carro', $id_carro);
			$sql -> execute();

			if ($sql -> rowCount() > 0) {
				$preco = $sql -> fetch();
			}

			return $preco;
		}

		public function adicionarCarro($modelo, $placa, $preco) {
			$sql = "INSERT INTO carros (nome, placa, preco_dia) VALUES (:modelo, :placa, :preco)";
			$sql = $this -> db -> prepare($sql);
			$sql -> bindValue(':modelo', $modelo);
			$sql -> bindValue(':placa', $placa);
			$sql -> bindValue(':preco', $preco);
			$sql -> execute();
		}
	}