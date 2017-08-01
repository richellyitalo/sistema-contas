
<div class="page-title">
	<div class="title_left">
		<h3>Contas a Receber</h3>
	</div>

	<!--
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search for...">
				<span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
			</div>
		</div>
	</div>
	-->
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Lista de lançamentos</h2>
				<!--<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a>
							</li>
							<li><a href="#">Settings 2</a>
							</li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>-->
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<?php if ($this->hasMessage()): ?>
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
						<?php
						echo $this->getMessage();
						?>
                    </div>
				<?php endif; ?>

				<table id="datatable" class="table">
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
					<?php foreach ($lancamentos as $lancamento): ?>
					<tr>
						<th scope="row"><?php echo $lancamento['id'] ?></th>
						<th><?php echo $lancamento['numero_titulo'] ?></th>
						<td><?php echo $lancamento['nome'] ?></td>
						<td><?php echo readableDate($lancamento['vencimento']) ?></td>
						<td>R$ <?php echo formatNumber($lancamento['valor']) ?></td>
						<td>R$ <?php echo formatNumber($lancamento['valor_final']) ?></td>
						<td>
                            <form action="<?= url('contasreceber/delete') ?>" class="form-horizontal" method="post">
                                <input type="hidden" name="id" value="<?= $lancamento['id'] ?>">

                                <a href="<?= url('contasreceber/edit/' . $lancamento['id']) ?>">
                                    Editar
                                </a>

                                <button class="btn-link">Excluir</button>
                            </form>
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