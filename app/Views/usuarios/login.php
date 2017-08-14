
<div>
	<a class="hiddenanchor" id="signup"></a>
	<a class="hiddenanchor" id="signin"></a>

	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">

				<?php if ($this->hasMessage()): ?>
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<?php
						echo $this->getMessage();
						?>
					</div>
				<?php endif; ?>

				<form method="post" action="" autocomplete="off">
					<h1>Sistema de Contas</h1>
					<div>
						<input type="text" name="email" class="form-control" placeholder="E-mail" required="" autocomplete="off" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" />
					</div>
					<div>
						<input type="password" name="senha" class="form-control" placeholder="Senha" required="" autocomplete="off" value="" />
					</div>
					<div>
						<button class="btn btn-default submit">Logar</button>
					</div>

					<div class="clearfix"></div>

					<div class="separator">
						</p>

						<div class="clearfix"></div>
						<br />

						<div>
							<p>
								©<?php echo date('Y') ?> Todos os direitos reservados.
								<br/>Desenvolvido por
								<a href="https://twitter.com/richellyitalo" target="_blank">
									<i class="fa fa-twitter"></i>
									@richellyitalo
								</a>
							</p>
						</div>
					</div>
				</form>
			</section>
		</div>


	</div>
</div>