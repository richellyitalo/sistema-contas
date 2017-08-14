
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

				<ul class="nav navbar-right panel_toolbox">
					<li class="dropdown">
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a>
							</li>
							<li><a href="#">Settings 2</a>
							</li>
						</ul>
					</li>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content2">
				<h3>Filtro de resultado</h3>
				<form action="" class="form-inline" id="formFilter">
					<div class="form-group">
						<label for="">De</label>
						<input type="text" id="dataDe" class="form-control">
					</div>
					<div class="form-group">
						<label for="">Até</label>
						<input type="text" id="dataAte" class="form-control">
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

<div id="response"></div>

<script>

	window.onload = function() {

        var char = Morris.Line({
                element: 'relatorioMoris',
            xkey: 'data',
            ykeys: ['pagar', 'receber'],
            labels: ['A pagar', 'A peceber'],
            xLabelFormat: function(d) {
                    console.log(d);
                return d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear();
            },
            hideHover: 'auto',
            lineColors: ['red', 'green'],
            data: [],
            resize: true
        });

        $('#dataDe, #dataAte').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('#formFilter').on('submit', function (event) {
            event.preventDefault();

            $.post(
                './home/filtrar',
                {
                    de: $('#dataDe').val(),
                    ate: $('#dataAte').val(),
                },
                function (response) {
                    char.setData(response.data);

                    $('#response').html(response.html);
                },
                'json'
            );

        });
        $('#formFilter').trigger('submit');

	};
</script>