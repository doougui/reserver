<?php
	class homeController extends controller {
		public function index() {
			$dados = array();
			$reservas = new Reservas();
			$carros = new Carros();

			if (!empty($_GET['ano']) && !empty($_GET['mes'])) {
				$dados['data'] = $_GET['ano'].'-'.$_GET['mes'];
			} else {
				$dados['data'] = date('Y').'-'.date('m');
			}

			$dados['dia1'] = date('w', strtotime($dados['data']));
			$dados['dias'] = date('t', strtotime($dados['data']));
			$dados['linhas'] = ceil(($dados['dia1'] + $dados['dias']) / 7);
			$dados['dia1'] = -$dados['dia1'];
			$dados['data_inicio'] = date('Y-m-d', strtotime($dados['dia1'].' days', strtotime($dados['data'])));
			$dados['data_fim'] = date("Y-m-d", strtotime(( ($dados['dia1'] + ($dados['linhas'] * 7) - 1) )." days", strtotime($dados['data'])));

			$data_dividida = explode('-', $dados['data']);
			$dados['ano'] = $data_dividida[0];
			$dados['mes'] = $data_dividida[1];

			$dados['reservas'] = $reservas -> getReservas($dados['data_inicio'], $dados['data_fim']);
			$dados['qtd_carros'] = $carros -> getQtdCarros();

			$this -> loadTemplate('home', $dados);
		}

	}