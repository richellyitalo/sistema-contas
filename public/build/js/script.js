(function ($) {

    'use strict';

    $(document).ready(function() {

        $('[data-mask-type="price"]').mask("#.##0,00", {reverse: true});

    })
})(jQuery);

function inputToFloat(val)
{
    return Number.parseFloat(val.replace(/\./g, '').replace(',', '.'))
}