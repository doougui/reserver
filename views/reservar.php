<h1>Adicionar reserva</h1>

<blockquote class="blockquote">
  <p class="pb-3">Insira as informações da reserva e do cliente abaixo.</p>
</blockquote>

<?= $msg ?>

<form method="POST">
	<div class="row">
		<div class="col-lg-6">
			<h2 class="pb-2">Informações da reserva</h2>
			
			<div class="form-group">
				<label for="reserva_carro">Carro</label>

				<select name="reserva_carro" id="reserva_carro" class="form-control" required>
					<?php foreach ($carros as $carro): ?>
						<option value="<?= $carro['id'] ?>"><?= $carro['nome'].' - '.$carro['placa'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="reserva_preco">Preço diário</label>

				<input type="text" name="reserva_preco" id="reserva_preco" class="form-control" placeholder="R$--,--"readonly>
			</div>

			<div class="form-group">
				<label for="reserva_inicio">Data de início</label>
				<input type="date" name="reserva_inicio" id="reserva_inicio" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="reserva_fim">Data de término</label>
				<input type="date" name="reserva_fim" id="reserva_fim" class="form-control" required>
			</div>
		</div>

		<div class="col-lg-6">
			<h2 class="pb-2">Informações do cliente</h2>
			
			<div class="form-group">
				<label for="pessoa_nome">Nome completo</label>
				<input type="text" name="pessoa_nome" id="pessoa_nome" class="form-control" placeholder="Emma Thomas" required>
			</div>

			<div class="form-group">
				<label for="pessoa_cpf">CPF</label>
				<input type="text" name="pessoa_cpf" id="pessoa_cpf" class="form-control" placeholder="000.000.000-00" required>
			</div>

			<div class="form-group">
				<label for="pessoa_phone">Telefone</label>
				<input type="text" name="pessoa_phone" id="pessoa_phone" class="form-control" placeholder="+00 (00) 00000-0000" required>
			</div>

			<small class="form-text text-muted pb-3">Estas informações são privadas e não devem ser compartilhadas com ninguém!</small>
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Reservar</button>
</form>