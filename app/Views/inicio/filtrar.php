<?php ob_start(); ?>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="x_panel">
			<div class="x_title">
				<h2>Contas a Pagar</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<table class="table table-hover" class="table">
					<thead>
					<tr>
						<th>ID</th>
						<th>Nº do Título</th>
						<th>Fornecedor</th>
						<th>Vencimento</th>
						<th>Valor</th>
						<th>Valor final</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($contasPagarRes as $lancamento): ?>
						<tr>
							<th scope="row"><?php echo $lancamento['id'] ?></th>
							<th><?php echo $lancamento['numero_titulo'] ?></th>
							<td><?php echo $lancamento['nome'] ?></td>
							<td><?php echo readableDate($lancamento['vencimento']) ?></td>
							<td>R$ <?php echo formatNumber($lancamento['valor']) ?></td>
							<td>R$ <?php echo formatNumber($lancamento['valor_final']) ?></td>
							<td>
								<a href="<?= url('contasPagar/edit/' . $lancamento['id']) ?>">
									Editar
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="x_panel">
			<div class="x_title">
				<h2>Contas a Receber</h2>

				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<table  class="table table-hover" class="table">
					<thead>
					<tr>
						<th>ID</th>
						<th>Nº do Título</th>
						<th>Fornecedor</th>
						<th>Vencimento</th>
						<th>Valor</th>
						<th>Valor final</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($contasReceberRes as $lancamento): ?>
						<tr>
							<th scope="row"><?php echo $lancamento['id'] ?></th>
							<th><?php echo $lancamento['numero_titulo'] ?></th>
							<td><?php echo $lancamento['nome'] ?></td>
							<td><?php echo readableDate($lancamento['vencimento']) ?></td>
							<td>R$ <?php echo formatNumber($lancamento['valor']) ?></td>
							<td>R$ <?php echo formatNumber($lancamento['valor_final']) ?></td>
							<td>
								<a href="<?= url('contasReceber/edit/' . $lancamento['id']) ?>">
									Editar
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<div class="clearfix"></div>

</div>

<?php
$html = ob_get_clean();

echo json_encode([
	'data' => array_values($resGraph),
	'html' => $html
]);
?>