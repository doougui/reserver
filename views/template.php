<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reserver - Reserve seu carro</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm p-3 rounded fixed-top">
		<a href="<?= BASE_URL ?>" class="navbar-brand">RESERVER</a>

		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-menu">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="navbar-collapse collapse" id="navbar-menu">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="<?= BASE_URL ?>" class="nav-link">Home</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a href="<?= BASE_URL ?>reservas/reservar" class="nav-link">Cadastrar reserva</a>
				</li>

				<li class="nav-item">
					<a href="#" class="nav-link" data-toggle="modal" data-target="#add_veiculo">Adicionar veículo</a>
				</li>
			</ul>
		</div>
	</nav>

	<!-- Modal -->
	<div class="modal fade" id="add_veiculo">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Adicionar veículo</h4>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="<?= BASE_URL ?>veiculos/adicionar">
						<div class="form-group">
							<label for="carro_modelo">Modelo do carro</label>
							<input type="text" name="carro_modelo" class="form-control" id="carro_modelo" placeholder="Gol Quadrado" required>
						</div>

						<div class="form-group">
							<label for="carro_placa">Placa</label>
							<input type="text" name="carro_placa" class="form-control" id="carro_placa" placeholder="GAY-2424" required>
						</div>

						<div class="form-group">
							<label for="carro_preco">Preço diário</label>
							<input type="text" name="carro_preco" class="form-control" id="carro_preco" placeholder="69,90" required> 
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Adicionar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<br><br><br><br>

	<div class="container">
		<?php $this -> loadViewInTemplate($viewName, $viewData); ?>
	</div>

	<footer class="footer d-flex mt-5 bg-primary text-dark align-items-center">
		<p>Douglas P. Goulart - 2019 © Todos os direitos reservados.</p>
	</footer>

	<!-- JavaScript -->
	<script src="<?= BASE_URL ?>assets/js/jquery-3.4.1.min.js"></script>
	<script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?= BASE_URL ?>assets/js/jquery.mask.js"></script>
	<script>var BASE_URL = '<?= BASE_URL ?>'</script>
	<script src="<?= BASE_URL ?>assets/js/script.js"></script>
</body>
</html>