<?php 
	class reservasController extends controller {

		public function index() {
			header('Location: '.BASE_URL);
			exit;
		}

		public function reservar() {
			$dados = array();
			$dados['msg'] = '';

			$reservas = new Reservas();
			$carros = new Carros();

			if (isset($_POST['reserva_carro']) && isset($_POST['reserva_inicio']) && 
					isset($_POST['reserva_fim']) && isset($_POST['pessoa_nome']) &&
					isset($_POST['pessoa_cpf']) && isset($_POST['pessoa_phone']))
			{
				$carro = addslashes($_POST['reserva_carro']);
				$data_inicio = addslashes($_POST['reserva_inicio']);
				$data_fim = addslashes($_POST['reserva_fim']);
				$nome = addslashes($_POST['pessoa_nome']);
				$cpf = addslashes($_POST['pessoa_cpf']);
				$phone = addslashes($_POST['pessoa_phone']);

				if (!empty($_POST['reserva_carro']) && !empty($_POST['reserva_carro']) &&
						!empty($_POST['reserva_inicio']) && !empty($_POST['reserva_inicio']) &&
						!empty($_POST['reserva_fim']) && !empty($_POST['reserva_fim']) &&
						!empty($_POST['pessoa_nome']) && !empty($_POST['pessoa_nome']) &&
						!empty($_POST['pessoa_cpf']) && !empty($_POST['pessoa_cpf']) &&
						!empty($_POST['pessoa_phone']) && !empty($_POST['pessoa_phone']))
				{
					if ($reservas -> verificarDisponibilidade($carro, $data_inicio, $data_fim)) {
						$reservas -> reservar($carro, $data_inicio, $data_fim, $nome, $cpf, $phone);

						header('Location: '.BASE_URL);
						exit;
					} else {
						$dados['msg'] =
						'<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<p>Este carro não está disponível neste período.</p>
						</div>';
					}
				} else {
					$dados['msg'] =
					'<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<p>Preencha todos os campos para continuar.</p>
					</div>';
				}
			}

			$dados['carros'] = $carros -> getCarros();

			$this -> loadTemplate('reservar', $dados);
		}

		public function editar($id) {
			$dados = array();
			$dados['msg'] = '';

			$reservas = new Reservas();
			$carros = new Carros();

			if (isset($id) && !empty($id)) {
				$id = addslashes($id);

				$dados['carros'] = $carros -> getCarros();
				$dados['reserva'] = $reservas -> getInfo($id);
			} else {
				header('Location: '.BASE_URL);
				exit;
			}

			if (isset($_POST['reserva_carro']) && isset($_POST['reserva_inicio']) && 
					isset($_POST['reserva_fim']) && isset($_POST['pessoa_nome']) &&
					isset($_POST['pessoa_cpf']) && isset($_POST['pessoa_phone']))
			{
				$carro = addslashes($_POST['reserva_carro']);
				$data_inicio = addslashes($_POST['reserva_inicio']);
				$data_fim = addslashes($_POST['reserva_fim']);
				$nome = addslashes($_POST['pessoa_nome']);
				$cpf = addslashes($_POST['pessoa_cpf']);
				$phone = addslashes($_POST['pessoa_phone']);

				if (!empty($_POST['reserva_carro']) && !empty($_POST['reserva_carro']) &&
						!empty($_POST['reserva_inicio']) && !empty($_POST['reserva_inicio']) &&
						!empty($_POST['reserva_fim']) && !empty($_POST['reserva_fim']) &&
						!empty($_POST['pessoa_nome']) && !empty($_POST['pessoa_nome']) &&
						!empty($_POST['pessoa_cpf']) && !empty($_POST['pessoa_cpf']) &&
						!empty($_POST['pessoa_phone']) && !empty($_POST['pessoa_phone']))
				{
					if ($reservas -> verificarDisponibilidadeAoEditar($carro, $data_inicio, $data_fim, $id)) {
						$reservas -> editarReserva($id, $carro, $data_inicio, $data_fim, $dados['reserva']['id_pessoa'], $nome, $cpf, $phone);

						header('Location: '.BASE_URL.'#reservas');
						exit;
					} else {
						$dados['msg'] =
						'<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<p>Este carro não está disponível neste período.</p>
						</div>';
					}
				} else {
					$dados['msg'] =
					'<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<p>Preencha todos os campos para continuar.</p>
					</div>';
				}
			}

			$this -> loadTemplate('editar_reserva', $dados);
		}

		public function remover($id) {
			$reservas = new Reservas();

			if (isset($id) && !empty($id)) {
				$id = addslashes($id);

				$reservas -> removerReserva($id);
			}

			header('Location: '.BASE_URL);
		}
	}