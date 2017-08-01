
<div class="page-title">
    <div class="title_left">
        <h3>Lançamentos <small>Conta a pagar</small></h3>
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
                <h2>Formulário de lançamento</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?= url('fornecedors') ?>">Contas a pagar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
				<?php if ($this->hasMessage() || $lancamento->getErrors()): ?>
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
						<?php
						echo $this->getMessage();

						if ($lancamento->getErrors()) {
							echo '<ul class="list">';
							foreach ($lancamento->getErrors() as $campo => $mensagem) {
								echo sprintf('<li><strong>%s:</strong> %s</li>', $campo, $mensagem);
							}
							echo '</ul>';
						}
						?>
                    </div>
				<?php endif; ?>
                <br />
                <form class="form-horizontal form-label-left" data-parsley-validate  method="post">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Número do título <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="numero_titulo" id="numero_titulo" class="form-control col-md-7 col-xs-12" value="<?php echo $lancamento->numero_titulo ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fornecedor_id">Fornecedor<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="fornecedor_id" id="fornecedor_id" class="form-control">
                                <option value="">Selecione o fornecedor</option>
								<?php foreach ($fornecedores as $fornecedor): ?>
                                    <option value="<?= $fornecedor['id'] ?>" <?= $lancamento->fornecedor_id == $fornecedor['id'] ? 'selected="selected"' : '' ?>>
										<?= $fornecedor['nome'] ?>
                                    </option>
								<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Valor <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="text" id="valor" name="valor" required="required" data-mask-type="price" class="form-control col-md-7 col-xs-12" value="<?= $lancamento->custom('valor') ?>">
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="valor-final">Valor final
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="text" id="valor-final" name="valor_final" readonly required="required" data-mask-type="price" class="form-control col-md-7 col-xs-12" value="<?= $lancamento->custom('valor_final') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Vencimento <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" id="vencimento" name="vencimento" required="required" class="form-control col-md-7 col-xs-12" value="<?= $lancamento->custom('vencimento') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Recorrente?
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="">
                                <label>
                                    <input type="hidden" name="recorrente" value="0">
                                    <input id="recorrente" name="recorrente" type="checkbox" value="1" <?= $lancamento->recorrente ? 'checked="checked"' : '' ?> class="js-switch"/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="data_recorrente_container">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Até quando?
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="text" id="recorrente_data_final" name="recorrente_data_final" class="form-control col-md-7 col-xs-12" value="<?= $lancamento->custom('recorrente_data_final') ?>">
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Descontos</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <button class="btn btn-primary" id="addDesconto" data-toggle="modal" data-target=".modal-desconto" type="button"><i class="fa fa-plus"></i> Adicionar desconto</button>

                        </div>
                    </div>


                    <div id="descontos">
                        <?php
                        $i = 0;
                        foreach ($descontos as $desconto):
                        ?>
                        <div class="desconto">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Desconto <span>#<?= $i + 1 ?></span>
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    descrição<br/>
                                    <input type="text" name="descontos[<?= $i ?>][descricao]" class="form-control col-md-7 col-xs-12" required="required" value="<?= $desconto['descricao'] ?>">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    valor<br/>
                                    <input type="text" name="descontos[<?= $i ?>][valor]" data-mask-type="price" class="inputDesconto form-control col-md-7 col-xs-12" required="required" value="<?= $desconto['valor'] ?>">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <br/>
                                    <button  class="btn btn-danger removeInput" type="button"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                        endforeach; ?>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-danger" type="button">Cancelar</button>
                            <button type="submit" class="btn btn-success">Lançar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
</div>

<?php include  'script.php' ?>