
<div class="page-title">
	<div class="title_left">
		<h3>Usuários</h3>
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
				<h2>Basic Tables</h2>
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
						<th>Nome</th>
						<th>E-mail</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($usuarios as $usuario): ?>
					<tr>
						<th scope="row"><?php echo $usuario['id'] ?></th>
						<th><?php echo $usuario['nome'] ?></th>
						<td><?php echo $usuario['email'] ?></td>
						<td>
                            <form action="<?= url('usuarios/delete') ?>" class="form-horizontal" method="post">
                                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                                <a href="<?= url('usuarios/edit/' . $usuario['id']) ?>">
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