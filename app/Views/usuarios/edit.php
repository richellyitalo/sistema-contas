
<div class="page-title">
	<div class="title_left">
		<h3>Edição de usuário <small> <?= $usuario->data['nome'] ?></small></h3>
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
                <h2>Formulário de edição</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= url('usuarios') ?>">Listar Usuários</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if (isset($mensagem)): ?>
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                        <?php echo $mensagem ?>
                        <?php
                        if ($usuario->getErrors()) {
                            echo '<ul class="list">';
                            foreach ($usuario->getErrors() as $campo => $mensagem) {
                                echo sprintf('<li><strong>%s:</strong> %s</li>', $campo, $mensagem);
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <br />
                <form class="form-horizontal form-label-left" data-parsley-validate  method="post">
                    <input type="hidden" name="id" value="<?= $usuario->data['id'] ?>" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="nome" id="nome" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $usuario->data['nome'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $usuario->data['email'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nova_senha">Nova senha
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="nova_senha" name="nova_senha"  class="form-control col-md-7 col-xs-12" value="<?= isset($_POST['nova_senha']) ? $_POST['nova_senha'] : '' ?>">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-danger" type="reset">Cancelar</button>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

	<div class="clearfix"></div>

</div>