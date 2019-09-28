<div class="jumbotron rounded">
	<h2 class="display-4">Seja bem-vindo ao <strong>Reserver</strong>.</h2>
	<p class="text-primary">Atualmente temos <?= $qtd_carros ?> carros disponíveis para reserva.</p>
</div>

<h1 id="calendario">Calendário de Reservas</h1>

<hr>

<form method="GET">
	<select name="ano" title="Ano">
		<?php for ($y = date('Y') - 2; $y <= (date('Y') + 2); $y++): ?>
			<option <?= ($y == $ano) ? 'selected' : '' ?>><?= $y ?></option>
		<?php endfor; ?>
	</select>

	<select name="mes" title="Mês">
		<?php for ($m = 01; $m <= 12; $m++): ?>
			<option <?= ($m == $mes) ? 'selected' : '' ?>><?= str_pad($m, 2, "0", STR_PAD_LEFT) ?></option>
		<?php endfor; ?>
	</select>

	<button type="submit" class="btn btn-sm btn-link">Mostrar</button>
</form>

<br>

<table class="w-100 d-block d-md-table text-center table table-bordered table-responsive">
	<thead class="table-info">
		<tr>
			<th>Dom</th>
			<th>Seg</th>
			<th>Ter</th>
			<th>Qua</th>
			<th>Qui</th>
			<th>Sex</th>
			<th>Sab</th>
		</tr>
	</thead>
	<tbody>
		<?php for ($l = 0; $l < $linhas; $l++): ?>
			<tr class="linha">
				<?php for ($q = 0; $q < 7; $q++): ?>
					<?php 
						$t = strtotime(($q + ($l * 7)).'days', strtotime($data_inicio));
						$w = date('Y-m-d', $t);
					?>
					<td>
						<?php 
							if (date('m', $t) < $mes || date('m', $t) > $mes) {
								echo '<span class="text-muted">'.date('d', $t)."</span><br>";
							} else {
								echo date('d', $t)."<br>";
							}

							$w = strtotime($w);

							foreach ($reservas as $reserva) {
								$data_reserva_inicio = strtotime($reserva['data_inicio']);
								$data_reserva_fim = strtotime($reserva['data_fim']);

								if ($w >= $data_reserva_inicio && $w <= $data_reserva_fim) {
									echo 
									'<span data-toggle="tooltip" data-placement="bottom" title="'.$reserva['carro'].' - '.$reserva['placa'].'"><a class="inpage-link" href="#reservas">*</a></span>';
								}
							}
						?>
					</td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
	</tbody>
</table>

<br>

<h1 id="reservas">Lista de Reservas</h1>

<hr>

<table class="w-100 d-block d-md-table text-center table table-bordered table-responsive">
	<thead>
		<tr>
			<th>Carro</th>
			<th>Placa</th>
			<th>Cliente</th>
			<th>Inicio da reserva</th>
			<th>Fim da reserva</th>
			<th>Quantidade de dias</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($reservas as $reserva): ?>
			<?php 
				$qtd = date('d', strtotime($reserva['data_fim'])) - date('d', strtotime($reserva['data_inicio']));
			?>
			<tr>
				<td><?= $reserva['carro'] ?></td>
				<td><?= $reserva['placa'] ?></td>
				<td><span data-toggle="tooltip" data-placement="bottom" title="<?= $reserva['cpf'].' - '.$reserva['telefone'] ?>"><?= $reserva['pessoa'] ?></span></td>
				<td><?= date('d/m/Y', strtotime($reserva['data_inicio'])) ?></td>
				<td><?= date('d/m/Y', strtotime($reserva['data_fim'])) ?></td>
				<td>
					<span class="px-3 py-2 badge badge-primary badge-pill"><?= $qtd ?> dias</span>
				</td>
				<td>
					<a href="<?= BASE_URL ?>reservas/editar/<?= $reserva['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
					<a href="<?= BASE_URL ?>reservas/remover/<?= $reserva['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
