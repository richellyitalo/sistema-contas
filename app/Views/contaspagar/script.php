
<style>
	#data_recorrente_container {display: none;}
</style>

<script>
    window.onload = function() {
        var inputDesconto = function() {
            var nodeNumber = $('#descontos .desconto').length;

            var input =
                '<div class="desconto">\n' +
                '       <div class="form-group">\n' +
                '        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Desconto <span>#' + (nodeNumber + 1) + '</span>\n' +
                '        </label>\n' +
                '        <div class="col-md-2 col-sm-2 col-xs-12">\n' +
                '            descrição<br/>\n' +
                '            <input type="text" name="descontos[' + nodeNumber + '][descricao]" class="form-control col-md-7 col-xs-12" required="required"  value="">\n' +
                '        </div>\n' +
                '        <div class="col-md-2 col-sm-2 col-xs-12">\n' +
                '            valor<br/>\n' +
                '            <input type="text" name="descontos[' + nodeNumber + '][valor]" data-mask-type="price" class="inputDesconto form-control col-md-7 col-xs-12" required="required" value="">\n' +
                '        </div>\n' +
                '        <div class="col-md-2 col-sm-2 col-xs-12">\n' +
                '            <br/>\n' +
                '            <button class="btn btn-danger removeInput" type="button"><i class="fa fa-minus"></i></button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>';
            return input;
        };

        $('#vencimento').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#recorrente_data_final').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        function recalcula()
        {
            var valor = inputToFloat($('input[name="valor"]').val());
            var valorDesconto = 0.00;
            var valorFinal = 0.00;

            $('.inputDesconto').each(function() {
                valorDesconto += inputToFloat( $(this).val() );
            });

            valorFinal = valor - valorDesconto;
            $('input[name="valor_final"]').val(valorFinal.toLocaleString("pt-BR", { minimumFractionDigits: 2 }));
        }

        $('#addDesconto').on('click', function () {
            $('#descontos').append(inputDesconto());
        });

        $('#descontos').on('click', '.removeInput', function (event) {
            event.preventDefault();

            $(this)
                .closest('.desconto')
                .fadeOut('slow', function () {
                    $(this).remove();
                    recalcula();
                });
        });

        $(document).on('keyup', '.inputDesconto', recalcula);
        $('input[name="valor"]').on('keyup', recalcula);

        $('#recorrente').on('change', function(){
            var checked = $(this).is(':checked');

            if (checked) {
                $('#data_recorrente_container').fadeIn();
            } else {
                $('#data_recorrente_container').fadeOut();
            }
        });

        $('#recorrente').trigger('change');
    }
</script>