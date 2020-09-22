$('#tester').click(function () {
    var selected = [];
    $('#imagenesProductos input:checked').each(function () {
        selected.push($(this).attr('name'));
    });
    alert(selected.length)
});
//Botones boton promociones-cambiar de opción
$('.box li').click(function () {
    $('.box li').removeClass('active');
    $(this).addClass('active');
    if ($(this).attr('id') === 'botonPromoProductos') {
        // This will disable everything contained in the div
        $("#promocionNormal").children().prop('disabled', false);
        $("#promocionNormal").attr("hidden", false);
        $("#promocionEspecial").children().prop('disabled', true);
        $("#promocionEspecial").attr("hidden", true);

    } else if ($(this).attr('id') === 'botonPromoEspecial') {
        $("#promocionNormal").children().prop('disabled', true);
        $("#promocionNormal").attr("hidden", true);
        $("#promocionEspecial").children().prop('disabled', false);
        $("#promocionEspecial").attr("hidden", false);
    }
});
/*Valida las entradas requeridas con cierta clase*/
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // fetch all the forms we want to apply custom style
        var inputs = document.getElementsByClassName('form-control')

        // loop over each input and watch blur event
        var validation = Array.prototype.filter.call(inputs, function (input) {

            input.addEventListener('blur', function (event) {
                // reset
                input.classList.remove('is-invalid')
                input.classList.remove('is-valid')

                if (input.checkValidity() === false) {
                    input.classList.add('is-invalid')
                } else {
                    input.classList.add('is-valid')
                }
            }, false);
        });
    }, false);
})();
/*Promocion normal*/
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('validacionFormularioPromoNormal');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                if (form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();


                }

            }, false);
        });
    }, false);
})();

/*Promocion Normal especial*/
/*Evita el envio del formulario si este no tiene todos los campos validados o aceptados*/
var limitePromocionesNormales = 4;
var promocionesNormales = 3;
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('validacionFormularioPromoEspecial');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                if (form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    $("#publicarPromocion").modal("show");

                }

            }, false);
        });
    }, false);
})();

$('.publicarPromocion').click(function (event) {
    var forms = document.getElementsByClassName('validacionFormularioPromoEspecial');
    if (!forms[0].checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    if (forms[0].checkValidity()) {
        $('.validacionFormularioPromoEspecial').submit();
        $("#publicarPromocion").modal("hide");
        $('.validacionFormularioPromoEspecial').each(function () {
            this.reset();

        });
        /*Simula acción que se debe realizar con AJAX(consulta)*/
        promocionesNormales++;
        if (promocionesNormales == limitePromocionesNormales) {
            $("#actualizarPaquete").modal("show");
            console.log("MuestraModal");
        }
        /**/
    }

});
//Switch hora    
$('#activarHora').click(function () {
    if ($("#activarHora").is(':checked')) {
        $("#horaInicioPromocion").attr("disabled", false);
        $("#horaInicioPromocion").attr("required", true);
    } else {
        $("#horaInicioPromocion").attr("disabled", true);
        $("#horaInicioPromocion").attr("required", false);
        $("#horaInicioPromocion").removeClass("is-invalid");

    }
});

/*Carga multiples imagenes*/
var upload = new FileUploadWithPreview('image', {
    showDeleteButtonOnImages: true,
    text: {
        chooseFile: 'Imagenes',
        browse: 'Seleccionar',
        selectedCount: 'Seleccionadas',
    },
    maxFileCount: 1
})



/*Promoción productos*/
$(function () {

    var filterMulti = $('.filter-2').filterizr({
        setupControls: true,
        multifilterLogicalOperator: 'and'

    });

    $('.filtr-select').on('change', function () {
        var multifilter = $(this).val();
        alert(multifilter);
        if (multifilter === 'all') {
            filterMulti.filterizr('filter', 'all');
            filterMulti._fltr._toggledCategories = {};
        } else {
            filterMulti.filterizr('toggleFilter', multifilter);
        }

    });

    $('.filtr-select-genero').on('change', function () {
        var multifilter = $(this).val();
        alert(multifilter);
        if (multifilter === 'all') {
            filterMulti.filterizr('filter', 'all');
            filterMulti._fltr._toggledCategories = {};
        } else {
            filterMulti.filterizr('toggleFilter', multifilter);
        }

    });

    $('.filtr-select-prenda').on('change', function () {
        var multifilter = $(this).val();
        alert(multifilter);
        if (multifilter === 'all') {
            filterMulti.filterizr('filter', 'all');
            filterMulti._fltr._toggledCategories = {};
        } else {
            filterMulti.filterizr('toggleFilter', multifilter);

        }

    });
    $('.filtr-select-talla').on('change', function () {
        var multifilter = $(this).val();
        alert(multifilter);
        if (multifilter === 'all') {
            filterMulti.filterizr('filter', 'all');
            filterMulti._fltr._toggledCategories = {};
        } else {
            filterMulti.filterizr('toggleFilter', multifilter);
            filterMulti._fltr._toggledCategories = {};
        }

    });

});

$('#marcarTodo').change(function () {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if ($('#marcarTodo').is(':checked')) {

        checkboxes.each(function () {

            if ($(this).parent().parent().parent().hasClass('filteredOut')) {
                $(this).prop('checked', false);
            } else {
                $(this).prop('checked', true);
            }
        });
    } else {
        checkboxes.each(function () {
            $(this).prop('checked', false);
        });
        
    }
    
    /*checkboxes.prop('checked', (($(this).parent().parent().parent().hasClass('filteredOut'))?$(this).is(':checked'):false));*/
});