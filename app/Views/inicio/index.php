
<div class="page-title">
	<div class="title_left">
		<h3>Relatórios</h3>
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
				<h2>Line graph</h2>

				<ul class="nav navbar-right panel_toolbox">
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
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content2">
				<h3>Filtre de resultado</h3>
				<form action="" class="form-inline">
					<div class="form-group">
						<label for="">De</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Até</label>
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<label for="">&nbsp;</label>
						<button class="btn btn-primary">Filtrar</button>
					</div>
				</form>
				<br/>
				<div>
					<div id="relatorioMoris"></div>
				</div>
			</div>
		</div>
	</div>

</div>
<script>

	window.onload = function() {


        if ($('#relatorioMoris').length ) {

            var char = Morris.Line({
                element: 'relatorioMoris',
                xkey: 'data',
                ykeys: ['pagar', 'receber'],
                labels: ['A pagar', 'A peceber'],
                hideHover: 'auto',
                lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                data: [
                    {data: '2012', pagar: 20, receber: 30},
                    {data: '2013', pagar: 10, receber: 50},
                    {data: '2014', pagar: 5, receber: 50},
                    {data: '2015', pagar: 5, receber: 50},
                    {data: '2016', pagar: 20, receber: 50},
                    {data: '2017', pagar: 20},
                    {data: '2018', pagar: 30, receber: 40},
                ],
                resize: true
            });

        }
	};
</script>