<?php 
	class veiculosController extends controller {
		public function index() {
			header('Location: '.BASE_URL);
			exit;
		}

		public function pegar_preco() {
			$carros = new Carros();

			if (isset($_POST['carro']) && !empty($_POST['carro'])) {
				$id_carro = addslashes($_POST['carro']);

				$preco = $carros -> getPreco($id_carro);

				echo json_encode($preco);
				exit;
			} 
		}

		public function adicionar() {
			$carros = new Carros();

			if (isset($_POST['carro_modelo']) && isset($_POST['carro_placa']) && isset($_POST['carro_preco'])) {
				$modelo = addslashes($_POST['carro_modelo']);
				$placa = addslashes($_POST['carro_placa']);
				$preco = addslashes(floatval(str_replace(',', '.', $_POST['carro_preco'])));

				if (!empty($_POST['carro_modelo']) && !empty($_POST['carro_placa']) && !empty($_POST['carro_preco'])) {
					$carros -> adicionarCarro($modelo, $placa, $preco);

					header('Location: '.BASE_URL);
					exit;
				}
			}
		}
	}