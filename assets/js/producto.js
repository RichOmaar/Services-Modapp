/*Carga multiples imagenes*/
var upload = new FileUploadWithPreview('mySecondImage', {
    showDeleteButtonOnImages: true,
    text: {
        chooseFile: 'Imagenes',
        browse: 'Seleccionar',
        selectedCount: 'Seleccionadas',
    },
    maxFileCount: 10
})
var imagenesSubidas = [];
window.addEventListener('fileUploadWithPreview:imagesAdded', function (e) {
    var klassenarray = $("#holder").find("[class]").map(function () {
        return this.className;
    }).get();

    $.unique(klassenarray).forEach(function (c) {
        $('.' + c).first().addClass('first');
    });
    // e.detail.uploadId
    // e.detail.cachedFileArray
    // e.detail.addedFilesCount
    // Use e.detail.uploadId to match up to your specific input
    if (e.detail.uploadId === 'mySecondImage') {
        //console.log(e.detail.addedFilesCount)
        imagenesSubidas = e.detail.cachedFileArray;

    }
})
var target = document.querySelector('#holder');
var observer = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
        $(".custom-file-container__image-multi-preview__single-image-clear__icon").first().empty().append('x<div style="font-size:15px;margin-top:25px;margin-left:15px;"> <strong>Fotoprincipal</strong></div>');
    });
});

var config = {
    attributes: true,
    childList: true,
    characterData: true
};

observer.observe(target, config);

/*Validacion colores*/
$cbx_group = $("input:checkbox[name^='colores']");
$cbx_group.on("click", function () {
    if ($cbx_group.is(":checked")) {
        // checkboxes become unrequired as long as one is checked
        $cbx_group.prop("required", false).each(function () {
            this.setCustomValidity("");
        });
    } else {
        // require checkboxes and set custom validation error message
        $cbx_group.prop("required", true).each(function () {
            this.setCustomValidity("Please select at least one checkbox.");
        });
    }
});


$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap_colorU"); //Fields wrapper
    var add_button = $(".add_field_button_colorU"); //Add button ID
    var x = 0; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        var primerColorUnico = document.getElementById('primerColorUnico');
        var primerTonalidadUnico = document.getElementById('primerTonalidadUnica');
        var inputVal = document.getElementById("colorUnicoNombre").value;
        var value = $("#colorUnico").spectrum('get').toHexString();
        if (primerColorUnico.checkValidity() && primerTonalidadUnico.checkValidity()) {
            if (inputVal && value) {
                $('#colorU').modal('hide');
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div style="margin-left:20px;" class="row"><label class="col-form-label">Color:</label><div class="col-4"><select style="margin-left:-10px;" class="colorUnicoNombre form-control" name="colorUNombre[]" required><option value="' + inputVal + '" selected>' + inputVal + '</option><option value="Verde">Verde</option><option value="Negro">Negro</option><option value="Azul">Azul</option><option value="Blanco">Blanco</option><option value="Amarillo">Amarillo</option><option value="Rosa">Rosa</option><option value="Café">Café</option><option value="Rojo">Rojo</option><option value="Naranja">Naranja</option></select></div><label style="margin-left:-10px;" class="col-form-label">Tonalidad:</label><div class="col-3"><input type="text" style="margin-left:-20px;" class="colorUnico form-control " name="colorU[]" value="' + value + '" required/></div><a  href="#" class="moverIzquierda remove_field"><i class="far fa-trash-alt"></i></a></div>'); //add input box
                    /*Paleta*/
                    $(".colorUnico").spectrum({
                        allowEmpty: true,
                        showAlpha: true,
                        showPalette: true,
                        palette: [
                        ['black', 'white', 'brown', 'yellow', 'blue', 'green', 'pink', 'red']
                    ],
                        change: function (color) {

                            color.toHexString();
                        }

                    });
                }
                $("#colorUnicoNombre").addClass("is-invalid");
                $("#colorUnicoNombre").val('');
                $("#colorUnico").addClass("invalid");
                $("#colorUnico").val('');
            } else {
                $("#colorUnicoNombre").addClass("is-invalid");
                $("#colorUnico").addClass("invalid");

            }
        } else {
            alert("Inserte el primer color único primero.");
        }

    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
/*Color unico*/
$(".colorUnico").spectrum({
    allowEmpty: true,
    showInitial: true,
    showInput: true,
    showAlpha: true,
    showPalette: true,
    palette: [
        ['black', 'white', 'brown', 'yellow', 'blue', 'green', 'pink', 'red']

    ],
    change: function (color) {

        color.toHexString();
    }

});
/*Color compuesto*/
$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap_colorC"); //Fields wrapper
    var add_button = $(".add_field_button_colorC"); //Add button ID
    var x = 0; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        var nombreColor1 = $("#colorCompuestoNombre1");
        var nombreColor2 = $("#colorCompuestoNombre2");
        var tonalidad1 = $("#colorCompuesto");
        var tonalidad2 = $("#colorCompuesto1");
        var color1 = nombreColor1.val();
        var color2 = nombreColor2.val();
        var inputVal = document.getElementById("colorCompuesto").value;
        var value = $("#colorCompuesto").spectrum('get').toHexString();
        var value1 = $("#colorCompuesto1").spectrum('get').toHexString();

        if (color1 && color2 && tonalidad1 && tonalidad2) {

            $('#colorC').modal('hide');
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div style="margin-top:15px;margin-left:10px;" class="row"><br><label class="col-form-label">Color1:</label><select id="colorCompuestoNombre[]" class="col-2 colorCompuestoNombre form-control" name="colorCompuestoNombre1[]" required><option value="' + color1 + '" selected>' + color1 + '</option><option value="Verde">Verde</option><option value="Negro">Negro</option><option value="Azul">Azul</option><option value="Blanco">Blanco</option><option value="Amarillo">Amarillo</option><option value="Rosa">Rosa</option><option value="Café">Café</option><option value="Rojo">Rojo</option><option value="Naranja">Naranja</option></select><label class="col-form-label">Tonalidad1:</label><input type="text" class="colorCompuesto form-control col-2" name="colorC[]" value="' + value + '" required/> /<label class="col-form-label">Color2:</label><select id="colorCompuestoNombre2[]" class="col-2 colorCompuestoNombre form-control" name="colorCompuestoNombre2[]" required><option value="' + color2 + '" selected>' + color2 + '</option><option value="Verde">Verde</option><option value="Negro">Negro</option><option value="Azul">Azul</option><option value="Blanco">Blanco</option><option value="Amarillo">Amarillo</option><option value="Rosa">Rosa</option><option value="Café">Café</option><option value="Rojo">Rojo</option><option value="Naranja">Naranja</option></select><label class="col-form-label">Tonalidad2:</label><input type="text" class="colorCompuesto form-control col-2" name="colorC1[]" value="' + value1 + '" required/><a href="#" class="remove_field"><i class="far fa-trash-alt"></i></a></div>'); //add input box
                /*Paleta*/
                $(".colorCompuesto").spectrum({
                    allowEmpty: true,
                    showInitial: true,
                    showInput: true,
                    showAlpha: true,
                    showPalette: true,
                    palette: [
                        ['black', 'white', 'brown', 'yellow', 'blue', 'green', 'pink', 'red']
                    ],
                    change: function (color) {

                        color.toHexString();
                    }

                });
            }
            nombreColor1.val("");
            nombreColor2.val("");
            tonalidad1.val("");
            tonalidad2.val("");
            nombreColor1.addClass("is-invalid");
            nombreColor2.addClass("is-invalid");


        } else {
            nombreColor1.addClass("is-invalid");
            nombreColor2.addClass("is-invalid");
            tonalidad1.addClass("is-invalid");
            tonalidad2.addClass("is-invalid");
        }


    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
/*Compuesto*/
$(".colorCompuesto").spectrum({
    showAlpha: true,
    showPalette: true,
    palette: [
            ['black', 'white', 'brown', 'yellow', 'blue', 'green', 'pink', 'red']
        ],
    change: function (color) {

        color.toHexString();
    }

});
/*Estampados*/
$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID
    var x = 0; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        var inputVal = document.getElementById("estampado").value;
        if (inputVal) {
            $("#exampleModalLong").modal("hide");
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><br><input type="text" class="form-control col-8" name="estampados[]" value="' + inputVal + '" required/><a href="#" class="remove_field"><i class="far fa-trash-alt"></i></a></div>'); //add input box
            }
            $("#estampado").val("");
            $("#estampado").addClass("is-invalid");
        } else {
            $("#estampado").addClass("is-invalid");

        }
    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
/*Tallas*/
$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap_talla"); //Fields wrapper
    var medidaColumnas = $(".medidaColumnas");
    var add_button = $(".add_field_button_talla"); //Add button ID
    var add_Row = $(".agregarFila");
    var x = 0; //initlal text box count
    var rows = 1;

    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        var talla = $("#talla");
        var inputVal = document.getElementById("talla").value;
        if (inputVal) {
            $("#modalTalla").modal("hide");
            if (x < max_fields) { //max input box allowed
                //text box increment
                $(wrapper).append('<div><br><input id="' + x + '" type="text" class="form-control col-8" name="talla[]" value="' + inputVal + '" readonly required/><a href="#" at="' + x + '" class="remove_field"><i class="far fa-trash-alt"></i></a></div>'); //add input box
                var tble = document.getElementById('unidad');
                if (!tble) {
                    $(medidaColumnas).append('<th id="' + x + '" scope="col">' + inputVal + '</th>');
                } else {
                    insertarColumnaBefore(inputVal, x);
                    //$('<th id="' + x + '" scope="col">' + inputVal + '</th>').insertBefore("#unidad");

                }
                x++;
            }
            talla.val("");
            talla.addClass("is-invalid");
        } else {
            talla.addClass("is-invalid");
        }
    });

    function insertarColumnaBefore(nombre, x) {
        var column = $('#tablaMedidas th').filter(function () {
            return $(this).text() == "Unidad";
        }).index();
        var cellBefore = column - 1;
        var cellAfter = column + 1;
        var spliceFirst = 'Val';
        var spliceLast = '<input type="text">';
        $("#tablaMedidas tbody tr").each(function (i) {
            if (i === 0) {
                $(this).find("th:eq(" + column + ")").before('<th id="' + x + '" scope="col">' + nombre + '</th>');
            } else {
                $(this).find("td:eq(" + column + ")").before("<td><select class='form-control' name='medidas[]' required><option val='' selected></option><option val='0-3'>0-3</option><option val='4-7'>4-7</option><option val='8-11'>8-11</option></select></td>");
            }
            //$(this).find("th:eq(" + column + ")").before("<th>" + spliceLast + "</th>");

        });

    }

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        var append = $(this).attr('at');
        var th = $('.medidaColumnas th[id=' + append + ']').html();
        //alert("El contenido de la columna es:"+th);
        /*Remueve toda columna*/
        var tble = document.getElementById('tablaMedidas');
        var row = tble.rows; // Getting the rows 

        for (var i = 0; i < row[0].cells.length; i++) {

            // Getting the text of columnName 
            var str = row[0].cells[i].innerHTML;

            // If 'Geek_id' matches with the columnName  
            if (str.indexOf(th) !== -1) {
                for (var j = 0; j < row.length; j++) {

                    // Deleting the ith cell of each row 
                    row[j].deleteCell(i);
                }
            }
        }
        /**/
        /*append++;
        alert(append);*/
        e.preventDefault();
        $(this).parent('div').remove();
        $('.medidaColumnas th[id=' + append + ']').remove();
        //$(medidaColumnas).find('th:eq('+(append)+')').remove();
        x--;

        if (x == 0) {
            $('.medidaColumnas th[id="unidad"]').remove();
            $('.medidaColumnas th[id="eliminar"]').remove();

            for (var i = 1; i <= rows; i++) {

                var row = document.getElementById("fila" + i);
                if (row) {

                    row.remove();
                }

            }
            rows = 1;
            x = 0;

        }
    })

    /*Medidas*/
    $(add_Row).click(function (e) { //on add input button click
        e.preventDefault();
        var inputVal = document.getElementById("medida").value;
        if (inputVal) {
            $('#modalMedida').modal('hide');
            if (x > 0) {
                var tble = document.getElementById('unidad');

                if (!tble) {
                    $(medidaColumnas).append('<th id="unidad" scope="col">Unidad</th>');
                    $(medidaColumnas).append('<th id="eliminar" scope="col">Accion</th>');
                }
                var table = document.getElementById("tablaMedidas");
                var row = table.insertRow(1);
                row.id = "fila" + rows;
                rows++;
                var cell1 = row.insertCell(0);
                cell1.innerHTML = inputVal;
                for (var i = 0; i <= x; i++) {

                    var cells = row.insertCell();
                    cells.innerHTML = "<select class='form-control' name='medidas[]' required><option val='' selected></option><option val='0-3'>0-3</option><option val='4-7'>4-7</option><option val='8-11'>8-11</option></select>";
                }
                cells.innerHTML = "<input class='form-control' type='text' placeholder='cm' required>";
                row.insertCell().innerHTML = "<a id='eliminarFila' class='eliminarFila btn btn-danger text-white'>Eliminar</a>";

            } else {
                $('#errorMedida').modal('show');
            }
            $("#medida").val("");
            $("#medida").addClass("is-invalid");
        } else {
            $("#medida").addClass("is-invalid");
        }
    });


    $("#tablaMedidas").on('click', '.eliminarFila', function () {
        $(this).closest('tr').remove();
        rows--;
        if (rows == 0) {
            rows = 1;
        }
    });




});

/*Disponibilidad*/

var color = [];
var tallaActual = [];
$(document).on('change', function () {
    tallaActual = document.querySelectorAll('input[name^="talla[]"]');
    for (var i = 0; i < tallaActual.length; i++) {
        var inp = tallaActual[i];
        //console.log("pname[" + i + "].value=" + inp.value);
    }
    color = document.querySelectorAll('[name^="colorUNombre[]"]');
    for (var i = 0; i < color.length; i++) {
        var inp = color[i];
        //console.log("pname[" + i + "].value=" + inp.value);
    }
    //console.log(tallaActual.length);
    //console.log(color.length);
});
/*Utilización de MutationObserver to get elements append*/
var obs = new MutationObserver(mutate);

function mutate(mutations) {
    // using jQuery to optimize code
    $.each(mutations, function (i, mutation) {
        var addedNodes = $(mutation.addedNodes);
        var selector = "[name^='colorUNombre[]']";
        var filteredEls = addedNodes.find(selector).addBack(selector); // finds either added alone or as tree
        filteredEls.each(function () { // can use jQuery select to filter addedNodes

            color = document.querySelectorAll('[name^="colorUNombre[]"]');
            for (var i = 0; i < color.length; i++) {
                var inp = color[i];
                //console.log("pname[" + i + "].value=" + inp.value);
            }
            //console.log("Numero de tallas:" + tallaActual.length);
            //console.log("Numero de colores:" + color.length);
            generaTablaDisponibilidad();
        });

        mutation.removedNodes.forEach(function (node) {
            tallaActual = document.querySelectorAll('input[name^="talla[]"]');
            color = document.querySelectorAll('[name^="colorUNombre[]"]');
            generaTablaDisponibilidad();

        });
    });
}

var obsTalla = new MutationObserver(mutateTalla);

function mutateTalla(mutations) {
    // using jQuery to optimize code
    $.each(mutations, function (i, mutation) {
        var addedNodes = $(mutation.addedNodes);
        var selector = "input[name^='talla[]']";
        var filteredEls = addedNodes.find(selector).addBack(selector); // finds either added alone or as tree
        filteredEls.each(function () { // can use jQuery select to filter addedNodes
            tallaActual = document.querySelectorAll('input[name^="talla[]"]');
            color = document.querySelectorAll('[name^="colorUNombre[]"]');
            if (color.length == 1 && !color[0].value) {
                color = [];
            }
            for (var i = 0; i < tallaActual.length; i++) {
                var inp = tallaActual[i];
                //console.log("pname[" + i + "].value=" + inp.value);
            }
            //console.log("Numero de tallas:" + tallaActual.length);
            //console.log("Numero de colores:" + color.length);
            generaTablaDisponibilidad();

        });

        mutation.removedNodes.forEach(function (node) {
            tallaActual = document.querySelectorAll('input[name^="talla[]"]');
            color = document.querySelectorAll('[name^="colorUNombre[]"]');
            generaTablaDisponibilidad();
        });

    });
}




var colorElement = $(".input_fields_wrap_colorU")[0];
var tallaElement = $(".input_fields_wrap_talla")[0];
obs.observe(colorElement, {
    childList: true,
    subtree: true
});
obsTalla.observe(tallaElement, {
    childList: true,
    subtree: true
});




$('.input_fields_wrap_colorU').on('change', function (e) {
    e.preventDefault();

    generaTablaDisponibilidad();
    /*color = document.querySelectorAll('input[name^="colorUNombre[]"]');
    for (var i = 0; i <color.length; i++) {
        var inp=color[i];
        console.log("pname["+i+"].value="+inp.value);
    }
    console.log(color.length);
    console.log(tallaActual.length);*/
    /*var colores = document.querySelectorAll('input[name^="colorUNombre[]"]');
        //alert(inputs.length);
        for (i = 0; i < inputs.length; i++) {
            // your code here
        }
       
        $('input[name^="colorUNombre[]"]').each(function() {
            var aValue = $(this).val();
            alert(aValue);
        });*/

    /*for(var i=0;i<=aValue.length;i++){
        al
    }*/
});

function generaTablaDisponibilidad() {
    $("#tablaDisp tbody tr").remove();
    //console.log("Número de colores:" + color.length);
    //console.log("Número de tallas:" + tallaActual.length);
    var numeroDeFilas = (color.length) * (tallaActual.length);
    //console.log("Número de filas:" + numeroDeFilas);
    if (numeroDeFilas > 0 && color[0].value) {
        var table = document.getElementById("tablaDisp").getElementsByTagName('tbody')[0];
        for (var i = 0; i < color.length; i++) {
            for (var k = 0; k < tallaActual.length; k++) {
                //console.log("Fila numero:" + i);
                var inp = tallaActual[k];
                //console.log("Valor de talla en K" + inp.value);
                var row = table.insertRow(0);
                row.id = "filaDis" + i;
                for (var j = 0; j < 5; j++) {
                    var cells = row.insertCell();
                    if (j == 0) {
                        cells.innerHTML = color[i].value;
                    } else if (j == 1) {
                        cells.innerHTML = tallaActual[k].value;
                    } else if (j == 3) {
                        cells.innerHTML = "<input style='margin-bottom:10px;' class='form-control' type='text' name='sucursales[]' placeholder='Sucursal1' required><input style='margin-bottom:10px;' class='form-control' type='text' name='sucursales[]' placeholder='Sucursal2'><input class='form-control' type='text' name='sucursales[]' placeholder='Sucursal3'>";
                    } else if (j == 4) {

                        cells.innerHTML = "<input style='margin-bottom:10px;' class='form-control w-50' type='number' placeholder='15' name='cantidad[]' required><input style='margin-bottom:10px;' class='form-control w-50' type='number' name='cantidad[]' placeholder='15' ><input class='form-control w-50' type='number' placeholder='15' name='cantidad[]'>";
                    } else {
                        cells.innerHTML = "<input class='form-control' type='number' placeholder='15' required>";
                    }
                }

            }
        }
    } else {
        //console.log("No se generan filas");
    }
}

/*Calculador de precio*/
$('#precioContenedor').change(function () {
    var precioInicial = $("#precioInicial");
    var descuentoPorcentaje = $("#descuentoPorcentaje");
    var descuentoDinero = $("#descuentoDinero");
    var precioFinal = $("#precioFinal");
    if (precioInicial.val() >= 0) {
        if (descuentoPorcentaje.val() || descuentoDinero.val()) {
            if (descuentoPorcentaje.val() > 0 && descuentoDinero.val() <= 0) {
                var precioAplicadoDescuento = precioInicial.val() - (((descuentoPorcentaje.val()) * (precioInicial.val())) / 100);
                precioFinal.val(precioAplicadoDescuento);
            } else if (descuentoPorcentaje.val() <= 0 && descuentoDinero.val() > 0) {
                var precioAplicadoDescuento = (precioInicial.val() - descuentoDinero.val());
                precioFinal.val(precioAplicadoDescuento);

            } else if (descuentoPorcentaje.val() > 0 && descuentoDinero.val() > 0) {
                var precioAplicadoDescuento = precioInicial.val() - (((descuentoPorcentaje.val()) * (precioInicial.val())) / 100);
                precioFinal.val(precioAplicadoDescuento);
            } else if (descuentoPorcentaje.val() <= 0 && descuentoDinero.val() <= 0) {
                precioFinal.val(precioInicial.val());
            }

        } else {
            precioFinal.val(precioInicial.val());
        }

    }

});
/*TAGS*/
var tagEstilo = document.querySelector('#Estilo');
var tagOcasion = document.querySelector('#Ocasion');
var tagTemporada = document.querySelector('#Temporada');
var tagEstiloJson = [];
var tagOcasionJson = [];
var tagTemporadaJson = [];
var tagifyEstilo = new Tagify(tagEstilo);
var tagifyOcasion = new Tagify(tagOcasion);
var tagifyTemporada = new Tagify(tagTemporada);
tagEstilo.addEventListener('change', onChangeEstilo);
tagOcasion.addEventListener('change', onChangeOcasion);
tagTemporada.addEventListener('change', onChangeTemporada);

function onChangeEstilo(e) {
    // outputs a String
    tagEstiloJson = tagifyEstilo.value;
    //console.log(tagEstiloJson)

}

function onChangeOcasion(e) {
    // outputs a String
    tagOcasionJson = tagifyOcasion.value;
}

function onChangeTemporada(e) {
    // outputs a String
    tagTemporadaJson = tagifyTemporada.value;
    //console.log(tagTemporadaJson)
}
/*Función convierte a json tabla medidas*/
function tableToJsonMedidas(table) {
    var data = [];

    // first row needs to be headers
    var headers = [];
    for (var i = 0; i < table.rows[0].cells.length; i++) {
        headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
    }
    // go through cells
    for (var i = 1; i < table.rows.length; i++) {

        var tableRow = table.rows[i];
        var rowData = {};

        for (var j = 0; j < tableRow.cells.length; j++) {
            if (j == 0) {

                rowData[headers[j]] = tableRow.cells[j].innerHTML;
            } else if (j > headers.length - 2) {
                rowData[headers[j]] = tableRow.cells[j].innerHTML;
            } else {
                rowData[headers[j]] = tableRow.cells[j].firstChild.value;
            }
        }
        data.push(rowData);
    }

    return data;
}
/*Función convierte a json tabla disponibilidad*/
function tableToJsonDisponibilidad(table) {
    var data = [];
    // first row needs to be headers
    var headers = [];
    for (var i = 0; i < table.rows[0].cells.length; i++) {
        headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
    }
    // go through cells
    for (var i = 1; i < table.rows.length; i++) {

        var tableRow = table.rows[i];
        var rowData = {};
        for (var j = 0; j < tableRow.cells.length; j++) {
            if (j == 0 || j == 1) {
                rowData[headers[j]] = tableRow.cells[j].innerHTML;
            } else if (j == 2) {
                rowData[headers[j]] = tableRow.cells[j].firstChild.value;
            } else if (j == 3) {
                var els = tableRow.cells[j].childNodes;
                var valorSucursales = [];
                for (var k = 0; k < els.length; ++k) {

                    valorSucursales.push(els[k].value);
                }
                //console.log(valorSucursales);
                rowData[headers[j]] = valorSucursales;
                //rowData[headers[j]] = tableRow.cells[j].firstChild.value;
            } else if (j == 4) {
                var els = tableRow.cells[j].childNodes;
                var valorCantidad = [];
                for (var l = 0; l < els.length; ++l) {
                    valorCantidad.push(els[l].value);
                }
                //console.log(valorCantidad);
                rowData[headers[j]] = valorCantidad;
            }
        }
        data.push(rowData);
    }

    return data;
}
//creating json multiple object- Esta funcion recaba todos los datos en un solo JSON que será enviado al backend
function generarPostData() {
    var arrayColoresUnicos = $('[name^="colorUNombre[]"]').map(function () {
        return $(this).val()
    }).get();
    var arrayColoresUnicosTono = $('[name^="colorU[]"]').map(function () {
        if ($(this).val()) {
            return $(this).spectrum('get').toHexString()
        }
    }).get();
    var arrayTallas = $('[name^="talla[]"]').map(function () {
        return $(this).val()
    }).get();
    var arrayEstampados = $('[name^="estampados[]"]').map(function () {
        return $(this).val()
    }).get();
    var arrayColorCompuesto1 = $('[name^="colorCompuestoNombre1[]"]').map(function () {
        return $(this).val()
    }).get();
    var arrayColoresCompuestoTono1 = $('[name^="colorC[]"]').map(function () {
        if ($(this).val()) {
            return $(this).spectrum('get').toHexString()
        }
    }).get();

    var arrayColorCompuesto2 = $('[name^="colorCompuestoNombre2[]"]').map(function () {
        return $(this).val()
    }).get();
    var arrayColoresCompuestoTono2 = $('[name^="colorC1[]"]').map(function () {
        if ($(this).val()) {
            return $(this).spectrum('get').toHexString()
        }
    }).get();



    var tMedidas = document.querySelector("#tablaMedidas");
    var tDisp = document.querySelector("#tablaDisp");

    var tablaMedidas = JSON.parse(JSON.stringify(tableToJsonMedidas(tMedidas)));
    var tablaDisp = JSON.parse(JSON.stringify(tableToJsonDisponibilidad(tDisp)));

    var CategoriasPrincipalesdelArticulo = {
        tipoArticuloCheckboxes: ($('#articulo1:checked').val() ? $('#articulo1:checked').val() : "") + "," + ($('#articulo2:checked').val() ? $('#articulo2:checked').val() : "") + "," + ($('#articulo3:checked').val() ? $('#articulo3:checked').val() : ""),
        tipoPersonaCheck: ($('#articulo4:checked').val() ? $('#articulo4:checked').val() : "") + "," + ($('#articulo5:checked').val() ? $('#articulo5:checked').val() : "") + "," + ($('#articulo6:checked').val() ? $('#articulo6:checked').val() : "") + "," + ($('#articulo7:checked').val() ? $('#articulo7:checked').val() : "") + "," + ($('#articulo8:checked').val() ? $('#articulo8:checked').val() : ""),
        tipoParteCheck: ($('#articulo9:checked').val() ? $('#articulo9:checked').val() : "") + "," + ($('#articulo10:checked').val() ? $('#articulo10:checked').val() : "") + "," + ($('#articulo11:checked').val() ? $('#articulo11:checked').val() : "")

    }

    var FichaTecnica = {
        nombreProducto: $('#nombreProducto').val(),
        id: $('#id').val(),
        articulo: $('#tipoArticulo').val(),
        imagenes: imagenesSubidas,
        marca: $('#Marca').val(),
        materiales: $('#Materiales').val(),
        manga: $('#Manga').val(),
        escote: $('#Escote').val(),
        largo: $('#Largo').val()
    }
    var Precios = {
        precioInicial: $('#precioInicial').val(),
        descuentoPorcentaje: $('#descuentoPorcentaje').val(),
        descuentoDirecto: $('#descuentoDinero').val(),
        precioFinal: $('#precioFinal').val()
    }

    var ColorUnico = {
        colorUnicoNombre: arrayColoresUnicos,
        colorUnicoTono: arrayColoresUnicosTono
    }
    var ColorCompuesto = {
        Color1: arrayColorCompuesto1,
        Tonalidad1: arrayColoresCompuestoTono1,
        Color2: arrayColorCompuesto2,
        Tonalidad2: arrayColoresCompuestoTono1
    }
    var Tags = {
        estiloTags: tagEstiloJson,
        ocacionTags: tagOcasionJson,
        temporadaTags: tagTemporadaJson
    }

    var postData = {
        fichaTecnica: FichaTecnica,
        tags: Tags,
        colorUnico: ColorUnico,
        colorCompuesto: ColorCompuesto,
        tallas: arrayTallas,
        estampados: arrayEstampados,
        medidasTabla: tablaMedidas,
        disponibilidadTabla: tablaDisp,
        categoriasPrincipales: CategoriasPrincipalesdelArticulo,
        precios: Precios

    };
    console.log(postData)
    /* $.ajax({
                type: "post"
                url: url.
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify(postData),
                success: function (data) {
                    //do you actions
                }
            });*/
}
/*Evita el envio del formulario si este no tiene todos los campos validados o aceptados*/
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
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();

                } else {
                    event.preventDefault();
                    event.stopPropagation();
                    var hayTalla = $('input[name^="talla[]"]');
                    var hayMedida = $('[name^="medidas[]"]');
                    if (hayTalla.length > 0) {
                        if (hayMedida.length > 0) {
                            generarPostData(); //Recaba información y la envia(AJAX) después de que el formulario este validado
                        } else {
                            $('#errorMedidaNinguna').modal('show');
                        }

                    } else {
                        $('#errorMedida').modal('show');
                    }

                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();