
//Cambio de ventanas

$('#sigTab').click(function() {
    $('.nav-tabs .nav-item a[href="#data-company"]').tab('show')
});

function cambiaPestaña(){
    console.log("presionado el link");
}


/* Pestaña Datos de la empresa */
const sHelpImg = document.getElementById('imgHelp')
const pickImg = document.getElementById('chooseImg');
const previewContainerImg = document.getElementById('imgPreview');
const previewImage = previewContainerImg.querySelector('.image-preview__imagen');
const previewSpan = previewContainerImg.querySelector('.image-preview__default-text');
const btnNewSchedule = document.getElementById('newSchedule');
const formSchedule = document.getElementById('schedule1')
const btnEditSchedule = formSchedule.querySelector('div div button.edit');
const btnDeleteSchedule = formSchedule.querySelector('div div button.delete')

pickImg.addEventListener('change',function(e){
    const files = this.files;
    if(files.length === 0){
        previewSpan.textContent="Ningun archivo seleccionado";
    }else{
        previewSpan.classList.add("d-none");
        previewImage.classList.remove("d-none");
        for(const file of files){
            previewImage.src = URL.createObjectURL(file);
        }
    }
});

function seleccionaImagen(){
    pickImg.click();
    sHelpImg.classList.remove('d-none');
    sHelpImg.classList.add('d-block');
}

btnNewSchedule.addEventListener('click',function(e){
    restableceDatosModal();
});

btnDeleteSchedule.addEventListener('click',function(e){
    formSchedule.classList.add('d-none');
    btnNewSchedule.removeAttribute('disabled');
});

btnEditSchedule.addEventListener('click',function(e){
    restableceDatosModal();
    let hI = document.getElementById('horaI');
    let mI = document.getElementById('minutoI');
    let meI = document.getElementById('meridianoI');
    let hF = document.getElementById('horaF');
    let mF = document.getElementById('minutoF');
    let meF = document.getElementById('meridianoF');
    $( "div#hours span.hourI" ).text( hI.textContent );
    $( "div#minutes span.minuteI" ).text( mI.textContent );
    $( "div span.meridI" ).text( meI.textContent );
    $( "div#hours span.hourF" ).text( hF.textContent );
    $( "div#minutes span.minuteF" ).text( mF.textContent );
    $( "div span.meridF" ).text( meF.textContent );
    $( "div.modal-footer button.crearHorario" ).text( "Actualizar horario" );
    let dias = formSchedule.querySelectorAll('div p span.dia');
    dias.forEach(dia=>{
        if(dia.textContent){
            if(dia.textContent == "Lunes"){
                let dia = document.getElementById('diaE-Lunes');
                dia.classList.add('highlighted');
            }else if(dia.textContent == "Martes"){
                let dia = document.getElementById('diaE-Martes');
                dia.classList.add('highlighted');
            }else if(dia.textContent == "Miercoles"){
                let dia = document.getElementById('diaE-Miercoles');
                dia.classList.add('highlighted');
            }else if(dia.textContent == "Jueves"){
                let dia = document.getElementById('diaE-Jueves');
                dia.classList.add('highlighted');
            }else if(dia.textContent == "Viernes"){
                let dia = document.getElementById('diaE-Viernes');
                dia.classList.add('highlighted');
            }else if(dia.textContent == "Sabado"){
                let dia = document.getElementById('diaE-Sabado');
                dia.classList.add('highlighted');
            }else if(dia.textContent == "Domingo"){
                let dia = document.getElementById('diaE-Domingo');
                dia.classList.add('highlighted');
            }   
        }
    });
    $('#horaAtencion').modal('show');
});

function restableceDatosModal(){
    let diasLight = document.querySelectorAll('.schedule tbody tr td.highlighted');
    diasLight.forEach(dia=>{
        dia.classList.remove('highlighted');
    });
    $( "div.hoursInicio span.hourI" ).text( "06" );
    $( "div.minutesInicio span.minuteI" ).text( "00" );
    $( "div.hoursFinal span.hourF" ).text( "06" );
    $( "div.minutesFinal span.minuteF" ).text( "30" );
    $( "div.modal-footer button.crearHorario" ).text( "Agregar horario" );
}


/*Codigo para Modal Horario dentro de Datos de empresa */
const diasSemana = document.querySelectorAll('.schedule tbody tr td');
const meridianos = document.querySelectorAll('.empresaAtencion-horas div span.meridiano');
const btnCreaHorario = document.querySelector('div.modal-content div.modal-footer button#btnEmpresa-CrearHorario');

diasSemana.forEach(td=>{
    td.addEventListener('click',function(e){
        this.classList.toggle('highlighted');
    });
});

meridianos.forEach(meridiano=>{
    meridiano.addEventListener('click',function(e){
        this.textContent = (this.textContent=='AM') ? 'PM' : 'AM';
    });
});

btnCreaHorario.addEventListener('click',function(e){
    let diasVacios = validaDias();
    let horasCorrectas = validaHoras();
    if(!diasVacios && horasCorrectas){
        let horario = recabaDatos();
        inicializaHorario(horario);
        $('#horaAtencion').modal('hide');
        formSchedule.classList.remove('d-none');
        btnNewSchedule.setAttribute('disabled','');
    }    
});

function validaDias(){
    let vacios = true;
    diasSemana.forEach(dia=>{
        if(dia.classList.contains('highlighted')){
            vacios=false;
        }
    });

    if(vacios){
        $('.empresaAtencion-dias').popover("show");
    }else{
        $('.empresaAtencion-dias').popover("dispose");
    }

    return vacios;
}

function validaHoras(){
    let horaI = new Date();
    let horaF = new Date();
    let horasok = false;

    const hI = parseInt(
        document.querySelector('.empresaAtencion-horas div#hours span.hourI').textContent
    );
    const mI = parseInt(
        document.querySelector('.empresaAtencion-horas div#minutes span.minuteI').textContent
    );
    const hF = parseInt(
        document.querySelector('.empresaAtencion-horas div#hours span.hourF').textContent
    );
    const mF = parseInt(
        document.querySelector('.empresaAtencion-horas div#minutes span.minuteF').textContent
    );
    const meridianoI = document.querySelector('div span.meridI').textContent;
    const meridianoF = document.querySelector('div span.meridF').textContent;

    horaI.setMinutes(mI);
    horaF.setMinutes(mF);

    if(meridianoI == "PM"){
        switch (hI) {
            case 1:
                horaI.setHours(13);
                break;
            case 2:
                horaI.setHours(14);
                break;
            case 3:
                horaI.setHours(15);
                break;
            case 4:
                horaI.setHours(16);
                break;
            case 5:
                horaI.setHours(17);
                break;
            case 6:
                horaI.setHours(18);
                break;
            case 7:
                horaI.setHours(19);
                break;
            case 8:
                horaI.setHours(20);
                break;
            case 9:
                horaI.setHours(21);
                break;
            case 10:
                horaI.setHours(22);
                break;
            case 11:
                horaI.setHours(23);
                break;
            case 12:
                horaI.setHours(00);
                break;
            default:
                break;
        }
    }else{
        horaI.setHours(hI);
    }

    if(meridianoF == "PM"){
        switch (hF) {
            case 1:
                horaF.setHours(13);
                break;
            case 2:
                horaF.setHours(14);
                break;
            case 3:
                horaF.setHours(15);
                break;
            case 4:
                horaF.setHours(16);
                break;
            case 5:
                horaF.setHours(17);
                break;
            case 6:
                horaF.setHours(18);
                break;
            case 7:
                horaF.setHours(19);
                break;
            case 8:
                horaF.setHours(20);
                break;
            case 9:
                horaF.setHours(21);
                break;
            case 10:
                horaF.setHours(22);
                break;
            case 11:
                horaF.setHours(23);
                break;
            case 12:
                horaF.setHours(00);
                break;
            default:
                break;
        }
    }else{
        horaF.setHours(hF);
    }

    // if(horaI > horaF){
    //     console.log("Hora inicial es mayor");
    // }else{
    //     console.log("Hora inicial es menor");
    // }
    // console.log(horaI,horaF);

    horasok = (horaI > horaF)? false : true;

    if(!horasok){
        $('.empresaAtencion-horas').popover("show");
    }else{
        $('.empresaAtencion-horas').popover("dispose"); 
    }
    return horasok;
   

}

function recabaDatos(){
    const hI = document.querySelector('.empresaAtencion-horas div#hours span.hourI').textContent;
    const mI = document.querySelector('.empresaAtencion-horas div#minutes span.minuteI').textContent;
    const meridianoI = document.querySelector('div.empresaAtencion-horas div span.meridI').textContent;
    const hF = document.querySelector('.empresaAtencion-horas div#hours span.hourF').textContent;
    const mF = document.querySelector('.empresaAtencion-horas div#minutes span.minuteF').textContent;
    const meridianoF = document.querySelector('div.empresaAtencion-horas div span.meridF').textContent;
    let diasLight = document.querySelectorAll('#schedule tbody tr td.highlighted');
    let dias = new Array();
    diasLight.forEach(dia=>{
        if (dia.id == 'diaE-Lunes') {
            dias.push('Lunes');
        }else if(dia.id == 'diaE-Martes') {
            dias.push('Martes');
        }else if(dia.id == 'diaE-Miercoles') {
            dias.push('Miercoles');
        }else if(dia.id == 'diaE-Jueves') {
            dias.push('Jueves');
        }else if(dia.id == 'diaE-Viernes') {
            dias.push('Viernes');
        }else if(dia.id == 'diaE-Sabado') {
            dias.push('Sabado');
        }else if(dia.id == 'diaE-Domingo') {
            dias.push('Domingo');
        }
    });
    const horario = {
        diasLaborales: dias,
        hora: {
            horaI: hI,
            minutoI: mI,
            merI: meridianoI,
            horaF: hF,
            minutoF: mF,
            merF: meridianoF
        } 
    };
    return horario;
}

function inicializaHorario(horario){
    let hI = document.getElementById('horaI');
    let mI = document.getElementById('minutoI');
    let meI = document.getElementById('meridianoI');
    let hF = document.getElementById('horaF');
    let mF = document.getElementById('minutoF');
    let meF = document.getElementById('meridianoF');
    let diasForm = formSchedule.querySelectorAll('div.dias p span.dia');
    diasForm.forEach(spanDia=>{
        spanDia.textContent = '';
    });  
    for (let i=0; i<horario.diasLaborales.length; i++) {
        diasForm.item(i).textContent = horario.diasLaborales[i];   
    }
    hI.textContent = horario.hora.horaI
    mI.textContent = horario.hora.minutoI
    meI.textContent = horario.hora.merI
    hF.textContent = horario.hora.horaF
    mF.textContent = horario.hora.minutoF
    meF.textContent = horario.hora.merF
};

/*Codigo para Modal Fiscal dentro de Datos de empresa */
const formFiscal = document.getElementById('formFiscal');
const modalFisco = document.getElementById('dFiscal');
const selectEstadoFisco = modalFisco.querySelector('.modal-dialog .modal-body form .form-group select#estadoFiscal');
const divMunicipioFisco = modalFisco.querySelector('form div#divMunicipio-Fisco');
const selectMunicipioFisco = divMunicipioFisco.querySelector('#municipioFiscal');
const divCPFisco = modalFisco.querySelector('form div#divCP-Fisco');
const inputCPFisco = divCPFisco.querySelector('input#inputCP-Fisco');
const divCalleFisco = modalFisco.querySelector('form div#divCalle-Fisco');
const inputCalleFisco = divCalleFisco.querySelector('input#inputCalle-Fisco');
const divNIFisco = modalFisco.querySelector('form div#divNI-Fisco');
const divNEFisco = modalFisco.querySelector('form div#divNE-Fisco');
const inputNEFisco = divNEFisco.querySelector('div input#inputNE-Fiscal');
const btnAgregarDirFiscal = document.getElementById('btnAgregar-DirFiscal');
const btnCrearDirFiscal = document.getElementById('btnCrear-DirFiscal');
const divFiscalFill = document.getElementById('dFiscal-Fill');
const btnEditDirFiscal = divFiscalFill.querySelector('button#editFiscal');
const btnDeleteDirFiscal = divFiscalFill.querySelector('button#deleteFiscal');
let munOalc = {
    AGS: ["Aguascalientes","Asientos","Calvillo","Cosío","El Llano","Jesús María","Pabellón de Arteaga","Rincón de Romos","San Francisco de los Romo","San José de Gracia","Tepezalá"],
    BCN: ["Ensenada","Mexicali","Playas de Rosarito","Tecate","Tijuana"],
    BCS: ["Comondú","La Paz","Loreto","Los Cabos","Mulegé"],
    CAM: ["Calakmul","Calkiní","Campeche","Candelaria","Carmen","Champotón","Escárcega","Hecelchakán","Hopelchén","Palizada","Tenabo"],
    CDMX: ["Álvaro Obregón","Azcapotzalco","Benito Juárez","Coyoacán","Cuajimalpa de Morelos","Cuauhtémoc","Gustavo A. Madero","Iztacalco","Iztapalapa","La Magdalena Contreras","Miguel Hidalgo","Milpa Alta","Tláhuac","Tlalpan","Venustiano Carranza","Xochimilco"],
    CHP: ["Acacoyagua","Acala","Acapetahua","Aldama","Altamirano","Amatán","Amatenango de la Frontera","Amatenango del Valle","Angel Albino Corzo","Arriaga","Bejucal de Ocampo","Bella Vista",	"Benemérito de las Américas","Berriozábal","Bochil","Cacahoatán","Catazajá","Chalchihuitán","Chamula","Chanal","Chapultenango","Chenalhó","Chiapa de Corzo","Chiapilla","Chicoasén","Chicomuselo","Chilón","Cintalapa","Coapilla","Comitán de Domínguez","Copainalá","El Bosque","El Porvenir","Escuintla","Francisco León","Frontera Comalapa","Frontera Hidalgo","Huehuetán","Huitiupán","Huixtán","Huixtla","Ixhuatán","Ixtacomitán","Ixtapa","Ixtapangajoya","Jiquipilas","Jitotol","Juárez","La Concordia","La Grandeza","La Independencia","La Libertad","La Trinitaria","Larráinzar","Las Margaritas","Las Rosas","Mapastepec","Maravilla Tenejapa","Marqués de Comillas","Mazapa de Madero","Mazatán","Metapa","Mitontic","Montecristo de Guerrero","Motozintla","Nicolás Ruíz","Ocosingo","Ocotepec","Ocozocoautla de Espinosa","Ostuacán","Osumacinta","Oxchuc","Palenque","Pantelhó","Pantepec","Pichucalco","Pijijiapan","Pueblo Nuevo Solistahuacán","Rayón","Reforma","Sabanilla","Salto de Agua","San Andrés Duraznal","San Cristóbal de las Casas","San Fernando","San Juan Cancuc","San Lucas","Santiago el Pinar","Siltepec","Simojovel","Sitalá","Socoltenango","Solosuchiapa","Soyaló","Suchiapa","Suchiate","Sunuapa","Tapachula","Tapalapa","Tapilula","Tecpatán","Tenejapa","Teopisca","Tila","Tonalá","Totolapa","Tumbalá","Tuxtla Chico","Tuxtla Gutiérrez","Tuzantán","Tzimol","Unión Juárez","Venustiano Carranza","Villa Comaltitlán","Villa Corzo","Villaflores","Yajalón","Zinacantán"],
    CHI: ["Ahumada","Aldama","Allende","Aquiles Serdán","Ascensión","Bachíniva","Balleza","Batopilas","Bocoyna","Buenaventura","Camargo","Carichí","Casas Grandes","Chihuahua","Chínipas","Coronado","Coyame del Sotol","Cuauhtémoc","Cusihuiriachi","Delicias","Dr. Belisario Domínguez","El Tule","Galeana","Gómez Farías","Gran Morelos","Guachochi","Guadalupe","Guadalupe y Calvo","Guazapares","Guerrero","Hidalgo del Parral","Huejotitán","Ignacio Zaragoza","Janos","Jiménez","Juárez","Julimes","La Cruz","López","Madera","Maguarichi","Manuel Benavides","Matachí","Matamoros","Meoqui","Morelos","Moris","Namiquipa","Nonoava","Nuevo Casas Grandes","Ocampo","Ojinaga","Praxedis G. Guerrero","Riva Palacio","Rosales","Rosario","San Francisco de Borja","San Francisco de Conchos","San Francisco del Oro","Santa Bárbara","Santa Isabel","Satevó","Saucillo","Temósachic","Urique","Uruachi","Valle de Zaragoza"],
    COA: ["Abasolo","Acuña","Allende","Arteaga","Candela","Castaños","Cuatro Ciénegas","Escobedo","Francisco I. Madero","Frontera","General Cepeda","Guerrero","Hidalgo","Jiménez","Juárez","Lamadrid","Matamoros","Monclova","Morelos","Múzquiz","Nadadores","Nava","Ocampo","Parras","Piedras Negras","Progreso","Ramos Arizpe","Sabinas","Sacramento","Saltillo","San Buenaventura","San Juan de Sabinas","San Pedro","Sierra Mojada","Torreón","Viesca","Villa Unión","Zaragoza"],
    COL: ["Armería","Colima","Comala","Coquimatlán","Cuauhtémoc","Ixtlahuacán","Manzanillo","Minatitlán","Tecomán","Villa de Álvarez"],
    DUR: ["Canatlán","Canelas","Coneto de Comonfort","Cuencamé","Durango","El Oro","General Simón Bolívar","Gómez Palacio","Guadalupe Victoria","Guanaceví","Hidalgo","Indé","Lerdo","Mapimí","Mezquital","Nazas","Nombre de Dios","Nuevo Ideal","Ocampo","Otáez","Pánuco de Coronado","Peñón Blanco","Poanas","Pueblo Nuevo","Rodeo","San Bernardo","San Dimas","San Juan de Guadalupe","San Juan del Río","San Luis del Cordero","San Pedro del Gallo","Santa Clara","Santiago Papasquiaro","Súchil","Tamazula","Tepehuanes","Tlahualilo","Topia","Vicente Guerrero"],
    GTO: ["Abasolo","Acámbaro","Apaseo el Alto","Apaseo el Grande","Atarjea","Celaya","Comonfort","Coroneo","Cortazar","Cuerámaro","Doctor Mora","Dolores Hidalgo Cuna de la Independencia Nacional","Guanajuato","Huanímaro","Irapuato","Jaral del Progreso","Jerécuaro","León","Manuel Doblado","Moroleón","Ocampo","Pénjamo","Pueblo Nuevo","Purísima del Rincón","Romita","Salamanca","Salvatierra","San Diego de la Unión","San Felipe","San Francisco del Rincón","San José Iturbide","San Luis de la Paz","San Miguel de Allende","Santa Catarina","Santa Cruz de Juventino Rosas","Santiago Maravatío","Silao","Tarandacuao","Tarimoro","Tierra Blanca","Uriangato","Valle de Santiago","Victoria","Villagrán","Xichú","Yuriria"],
    GRO: ["Acapulco de Juárez","Acatepec","Ahuacuotzingo","Ajuchitlán del Progreso","Alcozauca de Guerrero","Alpoyeca","Apaxtla","Arcelia","Atenango del Río","Atlamajalcingo del Monte","Atlixtac","Atoyac de Álvarez","Ayutla de los Libres","Azoyú","Benito Juárez","Buenavista de Cuéllar","Chilapa de Álvarez","Chilpancingo de los Bravo","Coahuayutla de José María Izazaga","Cochoapa el Grande","Cocula","Copala","Copalillo","Copanatoyac","Coyuca de Benítez","Coyuca de Catalán","Cuajinicuilapa","Cualác","Cuautepec","Cuetzala del Progreso","Cutzamala de Pinzón","Eduardo Neri","Florencio Villarreal","General Canuto A. Neri","General Heliodoro Castillo","Huamuxtitlán","Huitzuco de los Figueroa","Iguala de la Independencia","Igualapa","Iliatenco","Ixcateopan de Cuauhtémoc","José Joaquín de Herrera","Juan R. Escudero","Juchitán","La Unión de Isidoro Montes de Oca","Leonardo Bravo","Malinaltepec","Marquelia","Mártir de Cuilapan","Metlatónoc","Mochitlán","Olinalá","Ometepec","Pedro Ascencio Alquisiras","Petatlán","Pilcaya","Pungarabato","Quechultenango","San Luis Acatlán","San Marcos","San Miguel Totolapan","Taxco de Alarcón","Tecoanapa","Técpan de Galeana","Teloloapan","Tepecoacuilco de Trujano","Tetipac","Tixtla de Guerrero","Tlacoachistlahuaca","Tlacoapa","Tlalchapa","Tlalixtaquilla de Maldonado","Tlapa de Comonfort","Tlapehuala","Xalpatláhuac","Xochihuehuetlán","Xochistlahuaca","Zapotitlán Tablas","Zihuatanejo de Azueta","Zirándaro","Zitlala"],
    HGO: ["Acatlán","Acaxochitlán","Actopan","Agua Blanca de Iturbide","Ajacuba","Alfajayucan","Almoloya","Apan","Atitalaquia","Atlapexco","Atotonilco de Tula","Atotonilco el Grande","Calnali","Cardonal","Chapantongo","Chapulhuacán","Chilcuautla","Cuautepec de Hinojosa","El Arenal","Eloxochitlán","Emiliano Zapata","Epazoyucan","Francisco I. Madero","Huasca de Ocampo","Huautla","Huazalingo","Huehuetla","Huejutla de Reyes","Huichapan","Ixmiquilpan","Jacala de Ledezma","Jaltocán","Juárez Hidalgo","La Misión","Lolotla","Metepec","Metztitlán","Mineral de la Reforma","Mineral del Chico","Mineral del Monte","Mixquiahuala de Juárez","Molango de Escamilla","Nicolás Flores","Nopala de Villagrán","Omitlán de Juárez","Pachuca de Soto","Pacula","Pisaflores","Progreso de Obregón","San Agustín Metzquititlán","San Agustín Tlaxiaca","San Bartolo Tutotepec","San Felipe Orizatlán","San Salvador","Santiago de Anaya","Santiago Tulantepec de Lugo Guerrero","Singuilucan","Tasquillo","Tecozautla","Tenango de Doria","Tepeapulco","Tepehuacán de Guerrero","Tepeji del Río de Ocampo","Tepetitlán","Tetepango","Tezontepec de Aldama","Tianguistengo","Tizayuca","Tlahuelilpan","Tlahuiltepa","Tlanalapa","Tlanchinol","Tlaxcoapan","Tolcayuca","Tula de Allende","Tulancingo de Bravo","Villa de Tezontepec","Xochiatipan","Xochicoatlán","Yahualica","Zacualtipán de Ángeles","Zapotlán de Juárez","Zempoala","Zimapán"],
    JAL: ["Acatic","Acatlán de Juárez","Ahualulco de Mercado","Amacueca","Amatitán","Ameca","Arandas","Atemajac de Brizuela","Atengo","Atenguillo","Atotonilco el Alto","Atoyac","Autlán de Navarro","Ayotlán","Ayutla","Bolaños","Cabo Corrientes","Cañadas de Obregón","Casimiro Castillo","Chapala","Chimaltitán","Chiquilistlán","Cihuatlán","Cocula","Colotlán","Concepción de Buenos Aires","Cuautitlán de García Barragán","Cuautla","Cuquío","Degollado","Ejutla","El Arenal","El Grullo","El Limón","El Salto","Encarnación de Díaz","Etzatlán","Gómez Farías","Guachinango","Guadalajara","Hostotipaquillo","Huejúcar","Huejuquilla el Alto","Ixtlahuacán de los Membrillos","Ixtlahuacán del Río","Jalostotitlán","Jamay","Jesús María","Jilotlán de los Dolores","Jocotepec","Juanacatlán","Juchitlán","La Barca","La Huerta","La Manzanilla de la Paz","Lagos de Moreno","Magdalena","Mascota","Mazamitla","Mexticacán","Mezquitic","Mixtlán","Ocotlán","Ojuelos de Jalisco","Pihuamo","Poncitlán","Puerto Vallarta","Quitupan","San Cristóbal de la Barranca","San Diego de Alejandría","San Gabriel","San Ignacio Cerro Gordo","San Juan de los Lagos","San Juanito de Escobedo","San Julián","San Marcos","San Martín de Bolaños","San Martín Hidalgo","San Miguel el Alto","San Pedro Tlaquepaque","San Sebastián del Oeste","Santa María de los Ángeles","Santa María del Oro","Sayula","Tala","Talpa de Allende","Tamazula de Gordiano","Tapalpa","Tecalitlán","Techaluta de Montenegro","Tecolotlán","Tenamaxtlán","Teocaltiche","Teocuitatlán de Corona","Tepatitlán de Morelos","Tequila","Teuchitlán","Tizapán el Alto","Tlajomulco de Zúñiga","Tolimán","Tomatlán","Tonalá","Tonaya","Tonila","Totatiche","Tototlán","Tuxcacuesco","Tuxcueca","Tuxpan","Unión de San Antonio","Unión de Tula","Valle de Guadalupe","Valle de Juárez","Villa Corona","Villa Guerrero","Villa Hidalgo","Villa Purificación","Yahualica de González Gallo","Zacoalco de Torres","Zapopan","Zapotiltic","Zapotitlán de Vadillo","Zapotlán del Rey","Zapotlán el Grande","Zapotlanejo"],
    MEX: ["Acambay de Ruíz Castañeda","Aculco","Almoloya de Alquisiras","Almoloya de Juárez","Almoloya del Río","Amanalco","Amatepec","Amecameca","Apaxco","Atenco","Atizapán","Atizapán de Zaragoza","Atlacomulco","Atlautla","Axapusco","Ayapango","Calimaya","Capulhuac","Chalco","Chapa de Mota","Chapultepec","Chiautla","Chicoloapan","Chiconcuac","Chimalhuacán","Coacalco de Berriozábal","Coatepec Harinas","Cocotitlán","Coyotepec","Cuautitlán","Cuautitlán Izcalli","Donato Guerra","Ecatepec de Morelos","Ecatzingo","El Oro","Huehuetoca","Hueypoxtla","Huixquilucan","Isidro Fabela","Ixtapaluca","Ixtapan de la Sal","Ixtapan del Oro","Ixtlahuaca","Jalatlaco","Jaltenco","Jilotepec","Jilotzingo","Jiquipilco","Jocotitlán","Joquicingo","Juchitepec","La Paz","Lerma","Luvianos","Malinalco","Melchor Ocampo","Metepec","Mexicaltzingo","Morelos","Naucalpan de Juárez","Nextlalpan","Nezahualcóyotl","Nicolás Romero","Nopaltepec","Ocoyoacac","Ocuilan","Otumba","Otzoloapan","Otzolotepec","Ozumba","Papalotla","Polotitlán","Rayón","San Antonio la Isla","San Felipe del Progreso","San José del Rincón","San Martín de las Pirámides","San Mateo Atenco","San Simón de Guerrero","Santo Tomás","Soyaniquilpan de Juárez","Sultepec","Tecámac","Tejupilco","Temamatla","Temascalapa","Temascalcingo","Temascaltepec","Temoaya","Tenancingo","Tenango del Aire","Tenango del Valle","Teoloyucan","Teotihuacán","Tepetlaoxtoc","Tepetlixpa","Tepotzotlán","Tequixquiac","Texcaltitlán","Texcalyacac","Texcoco","Tezoyuca","Tianguistenco","Timilpan","Tlalmanalco","Tlalnepantla de Baz","Tlatlaya","Toluca","Tonanitla","Tonatico","Tultepec","Tultitlán","Valle de Bravo","Valle de Chalco Solidaridad","Villa de Allende","Villa del Carbón","Villa Guerrero","Villa Victoria","Xonacatlán","Zacazonapan","Zacualpan","Zinacantepec","Zumpahuacán","Zumpango"],
    MIC: ["Acuitzio","Aguililla","Álvaro Obregón","Angamacutiro","Angangueo","Apatzingán","Aporo","Aquila","Ario","Arteaga","Briseñas","Buenavista","Carácuaro","Charapan","Charo","Chavinda","Cherán","Chilchota","Chinicuila","Chucándiro","Churintzio","Churumuco","Coahuayana","Coalcomán de Vázquez Pallares","Coeneo","Cojumatlán de Régules","Contepec","Copándaro","Cotija","Cuitzeo","Ecuandureo","Epitacio Huerta","Erongarícuaro","Gabriel Zamora","Hidalgo","Huandacareo","Huaniqueo","Huetamo","Huiramba","Indaparapeo","Irimbo","Ixtlán","Jacona","Jiménez","Jiquilpan","José Sixto Verduzco","Juárez","Jungapeo","La Huacana","La Piedad","Lagunillas","Lázaro Cárdenas","Los Reyes","Madero","Maravatío","Marcos Castellanos","Morelia","Morelos","Múgica","Nahuatzen","Nocupétaro","Nuevo Parangaricutiro","Nuevo Urecho","Numarán","Ocampo","Pajacuarán","Panindícuaro","Paracho","Parácuaro","Pátzcuaro","Penjamillo","Peribán","Purépero","Puruándiro","Queréndaro","Quiroga","Sahuayo","Salvador Escalante","San Lucas","Santa Ana Maya","Senguio","Susupuato","Tacámbaro","Tancítaro","Tangamandapio","Tangancícuaro","Tanhuato","Taretan","Tarímbaro","Tepalcatepec","Tingambato","Tinguindín","Tiquicheo de Nicolás Romero","Tlalpujahua","Tlazazalca","Tocumbo","Tumbiscatío","Turicato","Tuxpan","Tuzantla","Tzintzuntzan","Tzitzio","Uruapan","Venustiano Carranza","Villamar","Vista Hermosa","Yurécuaro","Zacapu","Zamora","Zináparo","Zinapécuaro","Ziracuaretiro","Zitácuaro"],
    MOR: ["Amacuzac","Atlatlahucan","Axochiapan","Ayala","Coatlán del Río","Cuautla","Cuernavaca","Emiliano Zapata","Huitzilac","Jantetelco","Jiutepec","Jojutla","Jonacatepec","Mazatepec","Miacatlán","Ocuituco","Puente de Ixtla","Temixco","Temoac","Tepalcingo","Tepoztlán","Tetecala","Tetela del Volcán","Tlalnepantla","Tlaltizapán de Zapata","Tlaquiltenango","Tlayacapan","Totolapan","Xochitepec","Yautepec","Yecapixtla","Zacatepec","Zacualpan"],
    NAY: ["Acaponeta","Ahuacatlán","Amatlán de Cañas","Bahía de Banderas","Compostela","Del Nayar","Huajicori","Ixtlán del Río","Jala","La Yesca","Rosamorada","Ruíz","San Blas","San Pedro Lagunillas","Santa María del Oro","Santiago Ixcuintla","Tecuala","Tepic","Tuxpan","Xalisco"],
    NLE: ["Abasolo","Agualeguas","Allende","Anáhuac","Apodaca","Aramberri","Bustamante","Cadereyta Jiménez","Cerralvo","China","Ciénega de Flores","Doctor Arroyo","Doctor Coss","Doctor González","El Carmen","Galeana","García","General Bravo","General Escobedo","General Terán","General Treviño","General Zaragoza","General Zuazua","Guadalupe","Hidalgo","Higueras","Hualahuises","Iturbide","Juárez","Lampazos de Naranjo","Linares","Los Aldamas","Los Herreras","Los Ramones","Marín","Melchor Ocampo","Mier y Noriega","Mina","Montemorelos","Monterrey","Parás","Pesquería","Rayones","Sabinas Hidalgo","Salinas Victoria","San Nicolás de los Garza","San Pedro Garza García","Santa Catarina","Santiago","Vallecillo","Villaldama"],
    OAX: ["Abejones","Acatlán de Pérez Figueroa","Ánimas Trujano","Asunción Cacalotepec","Asunción Cuyotepeji","Asunción Ixtaltepec","Asunción Nochixtlán","Asunción Ocotlán","Asunción Tlacolulita","Ayoquezco de Aldama","Ayotzintepec","Calihualá","Candelaria Loxicha","Capulálpam de Méndez","Chahuites","Chalcatongo de Hidalgo","Chiquihuitlán de Benito Juárez","Ciénega de Zimatlán","Ciudad Ixtepec","Coatecas Altas","Coicoyán de las Flores","Concepción Buenavista","Concepción Pápalo","Constancia del Rosario","Cosolapa","Cosoltepec","Cuilápam de Guerrero","Cuyamecalco Villa de Zaragoza","El Barrio de la Soledad","El Espinal","Eloxochitlán de Flores Magón","Fresnillo de Trujano","Guadalupe de Ramírez","Guadalupe Etla","Guelatao de Juárez","Guevea de Humboldt","Heroica Ciudad de Ejutla de Crespo","Heroica Ciudad de Huajuapan de León","Heroica Ciudad de Juchitán de Zaragoza","Heroica Ciudad de Tlaxiaco","Heroica Villa Tezoatlán de Segura y Luna, Cuna de la Independencia de Oaxaca","Huautepec","Huautla de Jiménez","Ixpantepec Nieves","Ixtlán de Juárez","La Compañía","La Pe","La Reforma","La Trinidad Vista Hermosa","Loma Bonita","Magdalena Apasco","Magdalena Jaltepec","Magdalena Mixtepec","Magdalena Ocotlán","Magdalena Peñasco","Magdalena Teitipac","Magdalena Tequisistlán","Magdalena Tlacotepec","Magdalena Yodocono de Porfirio Díaz","Magdalena Zahuatlán","Mariscala de Juárez","Mártires de Tacubaya","Matías Romero Avendaño","Mazatlán Villa de Flores","Mesones Hidalgo","Miahuatlán de Porfirio Díaz","Mixistlán de la Reforma","Monjas","Natividad","Nazareno Etla","Nejapa de Madero","Nuevo Zoquiápam","Oaxaca de Juárez","Ocotlán de Morelos","Pinotepa de Don Luis","Pluma Hidalgo","Putla Villa de Guerrero","Reforma de Pineda","Reyes Etla","Rojas de Cuauhtémoc","Salina Cruz","San Agustín Amatengo","San Agustín Atenango","San Agustín Chayuco","San Agustín de las Juntas","San Agustín Etla","San Agustín Loxicha","San Agustín Tlacotepec","San Agustín Yatareni","San Andrés Cabecera Nueva","San Andrés Dinicuiti","San Andrés Huaxpaltepec","San Andrés Huayápam","San Andrés Ixtlahuaca","San Andrés Lagunas","San Andrés Nuxiño","San Andrés Paxtlán","San Andrés Sinaxtla","San Andrés Solaga","San Andrés Teotilálpam","San Andrés Tepetlapa","San Andrés Yaá","San Andrés Zabache","San Andrés Zautla","San Antonino Castillo Velasco","San Antonino el Alto","San Antonino Monte Verde","San Antonio Acutla","San Antonio de la Cal","San Antonio Huitepec","San Antonio Nanahuatípam","San Antonio Sinicahua","San Antonio Tepetlapa","San Baltazar Chichicápam","San Baltazar Loxicha","San Baltazar Yatzachi el Bajo","San Bartolo Coyotepec","San Bartolo Soyaltepec","San Bartolo Yautepec","San Bartolomé Ayautla","San Bartolomé Loxicha","San Bartolomé Quialana","San Bartolomé Yucuañe","San Bartolomé Zoogocho","San Bernardo Mixtepec","San Blas Atempa","San Carlos Yautepec","San Cristóbal Amatlán","San Cristóbal Amoltepec","San Cristóbal Lachirioag","San Cristóbal Suchixtlahuaca","San Dionisio del Mar","San Dionisio Ocotepec","San Dionisio Ocotlán","San Esteban Atatlahuca","San Felipe Jalapa de Díaz","San Felipe Tejalápam","San Felipe Usila","San Francisco Cahuacuá","San Francisco Cajonos","San Francisco Chapulapa","San Francisco Chindúa","San Francisco del Mar","San Francisco Huehuetlán","San Francisco Ixhuatán","San Francisco Jaltepetongo","San Francisco Lachigoló","San Francisco Logueche","San Francisco Nuxaño","San Francisco Ozolotepec","San Francisco Sola","San Francisco Telixtlahuaca","San Francisco Teopan","San Francisco Tlapancingo","San Gabriel Mixtepec","San Ildefonso Amatlán","San Ildefonso Sola","San Ildefonso Villa Alta","San Jacinto Amilpas","San Jacinto Tlacotepec","San Jerónimo Coatlán","San Jerónimo Silacayoapilla","San Jerónimo Sosola","San Jerónimo Taviche","San Jerónimo Tecóatl","San Jerónimo Tlacochahuaya","San Jorge Nuchita","San José Ayuquila","San José Chiltepec","San José del Peñasco","San José del Progreso","San José Estancia Grande","San José Independencia","San José Lachiguiri","San José Tenango","San Juan Achiutla","San Juan Atepec","San Juan Bautista Atatlahuca","San Juan Bautista Coixtlahuaca","San Juan Bautista Cuicatlán","San Juan Bautista Guelache","San Juan Bautista Jayacatlán","San Juan Bautista Lo de Soto","San Juan Bautista Suchitepec","San Juan Bautista Tlachichilco","San Juan Bautista Tlacoatzintepec","San Juan Bautista Tuxtepec","San Juan Bautista Valle Nacional","San Juan Cacahuatepec","San Juan Chicomezúchil","San Juan Chilateca","San Juan Cieneguilla","San Juan Coatzóspam","San Juan Colorado","San Juan Comaltepec","San Juan Cotzocón","San Juan de los Cués","San Juan del Estado","San Juan del Río","San Juan Diuxi","San Juan Evangelista Analco","San Juan Guelavía","San Juan Guichicovi","San Juan Ihualtepec","San Juan Juquila Mixes","San Juan Juquila Vijanos","San Juan Lachao","San Juan Lachigalla","San Juan Lajarcia","San Juan Lalana","San Juan Mazatlán","San Juan Mixtepec -Dto. 08 -","San Juan Mixtepec -Dto. 26 -","San Juan Ñumí","San Juan Ozolotepec","San Juan Petlapa","San Juan Quiahije","San Juan Quiotepec","San Juan Sayultepec","San Juan Tabaá","San Juan Tamazola","San Juan Teita","San Juan Teitipac","San Juan Tepeuxila","San Juan Teposcolula","San Juan Yaeé","San Juan Yatzona","San Juan Yucuita","San Lorenzo","San Lorenzo Albarradas","San Lorenzo Cacaotepec","San Lorenzo Cuaunecuiltitla","San Lorenzo Texmelúcan","San Lorenzo Victoria","San Lucas Camotlán","San Lucas Ojitlán","San Lucas Quiaviní","San Lucas Zoquiápam","San Luis Amatlán","San Marcial Ozolotepec","San Marcos Arteaga","San Martín de los Cansecos","San Martín Huamelúlpam","San Martín Itunyoso","San Martín Lachilá","San Martín Peras","San Martín Tilcajete","San Martín Toxpalan","San Martín Zacatepec","San Mateo Cajonos","San Mateo del Mar","San Mateo Etlatongo","San Mateo Nejápam","San Mateo Peñasco","San Mateo Piñas","San Mateo Río Hondo","San Mateo Sindihui","San Mateo Tlapiltepec","San Mateo Yoloxochitlán","San Mateo Yucutindó","San Melchor Betaza","San Miguel Achiutla","San Miguel Ahuehuetitlán","San Miguel Aloápam","San Miguel Amatitlán","San Miguel Amatlán","San Miguel Chicahua","San Miguel Chimalapa","San Miguel Coatlán","San Miguel del Puerto","San Miguel del Río","San Miguel Ejutla","San Miguel el Grande","San Miguel Huautla","San Miguel Mixtepec","San Miguel Panixtlahuaca","San Miguel Peras","San Miguel Piedras","San Miguel Quetzaltepec","San Miguel Santa Flor","San Miguel Soyaltepec","San Miguel Suchixtepec","San Miguel Tecomatlán","San Miguel Tenango","San Miguel Tequixtepec","San Miguel Tilquiápam","San Miguel Tlacamama","San Miguel Tlacotepec","San Miguel Tulancingo","San Miguel Yotao","San Nicolás","San Nicolás Hidalgo","San Pablo Coatlán","San Pablo Cuatro Venados","San Pablo Etla","San Pablo Huitzo","San Pablo Huixtepec","San Pablo Macuiltianguis","San Pablo Tijaltepec","San Pablo Villa de Mitla","San Pablo Yaganiza","San Pedro Amuzgos","San Pedro Apóstol","San Pedro Atoyac","San Pedro Cajonos","San Pedro Comitancillo","San Pedro Coxcaltepec Cántaros","San Pedro el Alto","San Pedro Huamelula","San Pedro Huilotepec","San Pedro Ixcatlán","San Pedro Ixtlahuaca","San Pedro Jaltepetongo","San Pedro Jicayán","San Pedro Jocotipac","San Pedro Juchatengo","San Pedro Mártir","San Pedro Mártir Quiechapa","San Pedro Mártir Yucuxaco","San Pedro Mixtepec -Dto. 22 -","San Pedro Mixtepec -Dto. 26 -","San Pedro Molinos","San Pedro Nopala","San Pedro Ocopetatillo","San Pedro Ocotepec","San Pedro Pochutla","San Pedro Quiatoni","San Pedro Sochiápam","San Pedro Tapanatepec","San Pedro Taviche","San Pedro Teozacoalco","San Pedro Teutila","San Pedro Tidaá","San Pedro Topiltepec","San Pedro Totolápam","San Pedro y San Pablo Ayutla","San Pedro y San Pablo Teposcolula","San Pedro y San Pablo Tequixtepec","San Pedro Yaneri","San Pedro Yólox","San Pedro Yucunama","San Raymundo Jalpan","San Sebastián Abasolo","San Sebastián Coatlán","San Sebastián Ixcapa","San Sebastián Nicananduta","San Sebastián Río Hondo","San Sebastián Tecomaxtlahuaca","San Sebastián Teitipac","San Sebastián Tutla","San Simón Almolongas","San Simón Zahuatlán","San Vicente Coatlán","San Vicente Lachixío","San Vicente Nuñú","Santa Ana","Santa Ana Ateixtlahuaca","Santa Ana Cuauhtémoc","Santa Ana del Valle","Santa Ana Tavela","Santa Ana Tlapacoyan","Santa Ana Yareni","Santa Ana Zegache","Santa Catalina Quierí","Santa Catarina Cuixtla","Santa Catarina Ixtepeji","Santa Catarina Juquila","Santa Catarina Lachatao","Santa Catarina Loxicha","Santa Catarina Mechoacán","Santa Catarina Minas","Santa Catarina Quiané","Santa Catarina Quioquitani","Santa Catarina Tayata","Santa Catarina Ticuá","Santa Catarina Yosonotú","Santa Catarina Zapoquila","Santa Cruz Acatepec","Santa Cruz Amilpas","Santa Cruz de Bravo","Santa Cruz Itundujia","Santa Cruz Mixtepec","Santa Cruz Nundaco","Santa Cruz Papalutla","Santa Cruz Tacache de Mina","Santa Cruz Tacahua","Santa Cruz Tayata","Santa Cruz Xitla","Santa Cruz Xoxocotlán","Santa Cruz Zenzontepec","Santa Gertrudis","Santa Inés de Zaragoza","Santa Inés del Monte","Santa Inés Yatzeche","Santa Lucía del Camino","Santa Lucía Miahuatlán","Santa Lucía Monteverde","Santa Lucía Ocotlán","Santa Magdalena Jicotlán","Santa María Alotepec","Santa María Apazco","Santa María Atzompa","Santa María Camotlán","Santa María Chachoápam","Santa María Chilchotla","Santa María Chimalapa","Santa María Colotepec","Santa María Cortijo","Santa María Coyotepec","Santa María del Rosario","Santa María del Tule","Santa María Ecatepec","Santa María Guelacé","Santa María Guienagati","Santa María Huatulco","Santa María Huazolotitlán","Santa María Ipalapa","Santa María Ixcatlán","Santa María Jacatepec","Santa María Jalapa del Marqués","Santa María Jaltianguis","Santa María la Asunción","Santa María Lachixío","Santa María Mixtequilla","Santa María Nativitas","Santa María Nduayaco","Santa María Ozolotepec","Santa María Pápalo","Santa María Peñoles","Santa María Petapa","Santa María Quiegolani","Santa María Sola","Santa María Tataltepec","Santa María Tecomavaca","Santa María Temaxcalapa","Santa María Temaxcaltepec","Santa María Teopoxco","Santa María Tepantlali","Santa María Texcatitlán","Santa María Tlahuitoltepec","Santa María Tlalixtac","Santa María Tonameca","Santa María Totolapilla","Santa María Xadani","Santa María Yalina","Santa María Yavesía","Santa María Yolotepec","Santa María Yosoyúa","Santa María Yucuhiti","Santa María Zacatepec","Santa María Zaniza","Santa María Zoquitlán","Santiago Amoltepec","Santiago Apoala","Santiago Apóstol","Santiago Astata","Santiago Atitlán","Santiago Ayuquililla","Santiago Cacaloxtepec","Santiago Camotlán","Santiago Chazumba","Santiago Choápam","Santiago Comaltepec","Santiago del Río","Santiago Huajolotitlán","Santiago Huauclilla","Santiago Ihuitlán Plumas","Santiago Ixcuintepec","Santiago Ixtayutla","Santiago Jamiltepec","Santiago Jocotepec","Santiago Juxtlahuaca","Santiago Lachiguiri","Santiago Lalopa","Santiago Laollaga","Santiago Laxopa","Santiago Llano Grande","Santiago Matatlán","Santiago Miltepec","Santiago Minas","Santiago Nacaltepec","Santiago Nejapilla","Santiago Niltepec","Santiago Nundiche","Santiago Nuyoó","Santiago Pinotepa Nacional","Santiago Suchilquitongo","Santiago Tamazola","Santiago Tapextla","Santiago Tenango","Santiago Tepetlapa","Santiago Tetepec","Santiago Texcalcingo","Santiago Textitlán","Santiago Tilantongo","Santiago Tillo","Santiago Tlazoyaltepec","Santiago Xanica","Santiago Xiacuí","Santiago Yaitepec","Santiago Yaveo","Santiago Yolomécatl","Santiago Yosondúa","Santiago Yucuyachi","Santiago Zacatepec","Santiago Zoochila","Santo Domingo Albarradas","Santo Domingo Armenta","Santo Domingo Chihuitán","Santo Domingo de Morelos","Santo Domingo Ingenio","Santo Domingo Ixcatlán","Santo Domingo Nuxaá","Santo Domingo Ozolotepec","Santo Domingo Petapa","Santo Domingo Roayaga","Santo Domingo Tehuantepec","Santo Domingo Teojomulco","Santo Domingo Tepuxtepec","Santo Domingo Tlatayápam","Santo Domingo Tomaltepec","Santo Domingo Tonalá","Santo Domingo Tonaltepec","Santo Domingo Xagacía","Santo Domingo Yanhuitlán","Santo Domingo Yodohino","Santo Domingo Zanatepec","Santo Tomás Jalieza","Santo Tomás Mazaltepec","Santo Tomás Ocotepec","Santo Tomás Tamazulapan","Santos Reyes Nopala","Santos Reyes Pápalo","Santos Reyes Tepejillo","Santos Reyes Yucuná","Silacayoápam","Sitio de Xitlapehua","Soledad Etla","Tamazulápam del Espíritu Santo","Tanetze de Zaragoza","Taniche","Tataltepec de Valdés","Teococuilco de Marcos Pérez","Teotitlán de Flores Magón","Teotitlán del Valle","Teotongo","Tepelmeme Villa de Morelos","Tlacolula de Matamoros","Tlacotepec Plumas","Tlalixtac de Cabrera","Totontepec Villa de Morelos","Trinidad Zaachila","Unión Hidalgo","Valerio Trujano","Villa de Chilapa de Díaz","Villa de Etla","Villa de Tamazulápam del Progreso","Villa de Tututepec de Melchor Ocampo","Villa de Zaachila","Villa Díaz Ordaz","Villa Hidalgo","Villa Sola de Vega","Villa Talea de Castro","Villa Tejúpam de la Unión","Yaxe","Yogana","Yutanduchi de Guerrero","Zapotitlán Lagunas","Zapotitlán Palmas","Zimatlán de Álvarez"],
    PUE: ["Acajete","Acateno","Acatlán","Acatzingo","Acteopan","Ahuacatlán","Ahuatlán","Ahuazotepec","Ahuehuetitla","Ajalpan","Albino Zertuche","Aljojuca","Altepexi","Amixtlán","Amozoc","Aquixtla","Atempan","Atexcal","Atlequizayan","Atlixco","Atoyatempan","Atzala","Atzitzihuacán","Atzitzintla","Axutla","Ayotoxco de Guerrero","Calpan","Caltepec","Camocuautla","Cañada Morelos","Caxhuacan","Chalchicomula de Sesma","Chapulco","Chiautla","Chiautzingo","Chichiquila","Chiconcuautla","Chietla","Chigmecatitlán","Chignahuapan","Chignautla","Chila","Chila de la Sal","Chilchotla","Chinantla","Coatepec","Coatzingo","Cohetzala","Cohuecan","Coronango","Coxcatlán","Coyomeapan","Coyotepec","Cuapiaxtla de Madero","Cuautempan","Cuautinchán","Cuautlancingo","Cuayuca de Andrade","Cuetzalan del Progreso","Cuyoaco","Domingo Arenas","Eloxochitlán","Epatlán","Esperanza","Francisco Z. Mena","General Felipe Ángeles","Guadalupe","Guadalupe Victoria","Hermenegildo Galeana","Honey","Huaquechula","Huatlatlauca","Huauchinango","Huehuetla","Huehuetlán el Chico","Huehuetlán el Grande","Huejotzingo","Hueyapan","Hueytamalco","Hueytlalpan","Huitzilan de Serdán","Huitziltepec","Ixcamilpa de Guerrero","Ixcaquixtla","Ixtacamaxtitlán","Ixtepec","Izúcar de Matamoros","Jalpan","Jolalpan","Jonotla","Jopala","Juan C. Bonilla","Juan Galindo","Juan N. Méndez","La Magdalena Tlatlauquitepec","Lafragua","Libres","Los Reyes de Juárez","Mazapiltepec de Juárez","Mixtla","Molcaxac","Naupan","Nauzontla","Nealtican","Nicolás Bravo","Nopalucan","Ocotepec","Ocoyucan","Olintla","Oriental","Pahuatlán","Palmar de Bravo","Pantepec","Petlalcingo","Piaxtla","Puebla","Quecholac","Quimixtlán","Rafael Lara Grajales","San Andrés Cholula","San Antonio Cañada","San Diego la Mesa Tochimiltzingo","San Felipe Teotlalcingo","San Felipe Tepatlán","San Gabriel Chilac","San Gregorio Atzompa","San Jerónimo Tecuanipan","San Jerónimo Xayacatlán","San José Chiapa","San José Miahuatlán","San Juan Atenco","San Juan Atzompa","San Martín Texmelucan","San Martín Totoltepec","San Matías Tlalancaleca","San Miguel Ixitlán","San Miguel Xoxtla","San Nicolás Buenos Aires","San Nicolás de los Ranchos","San Pablo Anicano","San Pedro Cholula","San Pedro Yeloixtlahuaca","San Salvador el Seco","San Salvador el Verde","San Salvador Huixcolotla","San Sebastián Tlacotepec","Santa Catarina Tlaltempan","Santa Inés Ahuatempan","Santa Isabel Cholula","Santiago Miahuatlán","Santo Tomás Hueyotlipan","Soltepec","Tecali de Herrera","Tecamachalco","Tecomatlán","Tehuacán","Tehuitzingo","Tenampulco","Teopantlán","Teotlalco","Tepanco de López","Tepango de Rodríguez","Tepatlaxco de Hidalgo","Tepeaca","Tepemaxalco","Tepeojuma","Tepetzintla","Tepexco","Tepexi de Rodríguez","Tepeyahualco","Tepeyahualco de Cuauhtémoc","Tetela de Ocampo","Teteles de Avila Castillo","Teziutlán","Tianguismanalco","Tilapa","Tlachichuca","Tlacotepec de Benito Juárez","Tlacuilotepec","Tlahuapan","Tlaltenango","Tlanepantla","Tlaola","Tlapacoya","Tlapanalá","Tlatlauquitepec","Tlaxco","Tochimilco","Tochtepec","Totoltepec de Guerrero","Tulcingo","Tuzamapan de Galeana","Tzicatlacoyan","Venustiano Carranza","Vicente Guerrero","Xayacatlán de Bravo","Xicotepec","Xicotlán","Xiutetelco","Xochiapulco","Xochiltepec","Xochitlán de Vicente Suárez","Xochitlán Todos Santos","Yaonáhuac","Yehualtepec","Zacapala","Zacapoaxtla","Zacatlán","Zapotitlán","Zapotitlán de Méndez","Zaragoza","Zautla","Zihuateutla","Zinacatepec","Zongozotla","Zoquiapan","Zoquitlán"],
    QRO: ["Amealco de Bonfil","Arroyo Seco","Cadereyta de Montes","Colón","Corregidora","El Marqués","Ezequiel Montes","Huimilpan","Jalpan de Serra","Landa de Matamoros","Pedro Escobedo","Peñamiller","Pinal de Amoles","Querétaro","San Joaquín","San Juan del Río","Tequisquiapan","Tolimán"],
    ROO: ["Bacalar","Benito Juárez","Cozumel","Felipe Carrillo Puerto","Isla Mujeres","José María Morelos","Lázaro Cárdenas","Othón P. Blanco","Solidaridad","Tulum"],
    SLP: ["Ahualulco","Alaquines","Aquismón","Armadillo de los Infante","Axtla de Terrazas","Cárdenas","Catorce","Cedral","Cerritos","Cerro de San Pedro","Charcas","Ciudad del Maíz","Ciudad Fernández","Ciudad Valles","Coxcatlán","Ebano","El Naranjo","Guadalcázar","Huehuetlán","Lagunillas","Matehuala","Matlapa","Mexquitic de Carmona","Moctezuma","Rayón","Rioverde","Salinas","San Antonio","San Ciro de Acosta","San Luis Potosí","San Martín Chalchicuautla","San Nicolás Tolentino","San Vicente Tancuayalab","Santa Catarina","Santa María del Río","Santo Domingo","Soledad de Graciano Sánchez","Tamasopo","Tamazunchale","Tampacán","Tampamolón Corona","Tamuín","Tancanhuitz","Tanlajás","Tanquián de Escobedo","Tierra Nueva","Vanegas","Venado","Villa de Arista","Villa de Arriaga","Villa de Guadalupe","Villa de la Paz","Villa de Ramos","Villa de Reyes","Villa Hidalgo","Villa Juárez","Xilitla","Zaragoza"],
    SIN: ["Ahome","Angostura","Badiraguato","Choix","Concordia","Cosalá","Culiacán","El Fuerte","Elota","Escuinapa","Guasave","Mazatlán","Mocorito","Navolato","Rosario","Salvador Alvarado","San Ignacio","Sinaloa"],
    SON: ["Aconchi","Agua Prieta","Alamos","Altar","Arivechi","Arizpe","Atil","Bacadéhuachi","Bacanora","Bacerac","Bacoachi","Bácum","Banámichi","Baviácora","Bavispe","Benito Juárez","Benjamín Hill","Caborca","Cajeme","Cananea","Carbó","Cucurpe","Cumpas","Divisaderos","Empalme","Etchojoa","Fronteras","General Plutarco Elías Calles","Granados","Guaymas","Hermosillo","Huachinera","Huásabas","Huatabampo","Huépac","Imuris","La Colorada","Magdalena","Mazatán","Moctezuma","Naco","Nácori Chico","Nacozari de García","Navojoa","Nogales","Onavas","Opodepe","Oquitoa","Pitiquito","Puerto Peñasco","Quiriego","Rayón","Rosario","Sahuaripa","San Felipe de Jesús","San Ignacio Río Muerto","San Javier","San Luis Río Colorado","San Miguel de Horcasitas","San Pedro de la Cueva","Santa Ana","Santa Cruz","Sáric","Soyopa","Suaqui Grande","Tepache","Trincheras","Tubutama","Ures","Villa Hidalgo","Villa Pesqueira","Yécora"],
    TAB: ["Balancán","Cárdenas","Centla","Centro","Comalcalco","Cunduacán","Emiliano Zapata","Huimanguillo","Jalapa","Jalpa de Méndez","Jonuta","Macuspana","Nacajuca","Paraíso","Tacotalpa","Teapa","Tenosique"],
    TAM: ["Abasolo","Aldama","Altamira","Antiguo Morelos","Burgos","Bustamante","Camargo","Casas","Ciudad Madero","Cruillas","El Mante","Gómez Farías","González","Guerrero","Gustavo Díaz Ordaz","Güémez","Hidalgo","Jaumave","Jiménez","Llera","Mainero","Matamoros","Méndez","Mier","Miguel Alemán","Miquihuana","Nuevo Laredo","Nuevo Morelos","Ocampo","Padilla","Palmillas","Reynosa","Río Bravo","San Carlos","San Fernando","San Nicolás","Soto la Marina","Tampico","Tula","Valle Hermoso","Victoria","Villagrán","Xicoténcatl"],
    TLX: ["Acuamanala de Miguel Hidalgo","Altzayanca","Amaxac de Guerrero","Apetatitlán de Antonio Carvajal","Apizaco","Atlangatepec","Benito Juárez","Calpulalpan","Chiautempan","Contla de Juan Cuamatzi","Cuapiaxtla","Cuaxomulco","El Carmen Tequexquitla","Emiliano Zapata","Españita","Huamantla","Hueyotlipan","Ixtacuixtla de Mariano Matamoros","Ixtenco","La Magdalena Tlaltelulco","Lázaro Cárdenas","Mazatecochco de José María Morelos","Muñoz de Domingo Arenas","Nanacamilpa de Mariano Arista","Natívitas","Panotla","Papalotla de Xicohténcatl","San Damián Texóloc","San Francisco Tetlanohcan","San Jerónimo Zacualpan","San José Teacalco","San Juan Huactzinco","San Lorenzo Axocomanitla","San Lucas Tecopilco","San Pablo del Monte","Sanctórum de Lázaro Cárdenas","Santa Ana Nopalucan","Santa Apolonia Teacalco","Santa Catarina Ayometla","Santa Cruz Quilehtla","Santa Cruz Tlaxcala","Santa Isabel Xiloxoxtla","Tenancingo","Teolocholco","Tepetitla de Lardizábal","Tepeyanco","Terrenate","Tetla de la Solidaridad","Tetlatlahuca","Tlaxcala","Tlaxco","Tocatlán","Totolac","Tzompantepec","Xaloztoc","Xaltocan","Xicohtzinco","Yauhquemehcan","Zacatelco","Ziltlaltépec de Trinidad Sánchez Santos"],
    VER: ["Acajete","Acatlán","Acayucan","Actopan","Acula","Acultzingo","Agua Dulce","Álamo Temapache","Alpatláhuac","Alto Lucero de Gutiérrez Barrios","Altotonga","Alvarado","Amatitlán","Amatlán de los Reyes","Angel R. Cabada","Apazapan","Aquila","Astacinga","Atlahuilco","Atoyac","Atzacan","Atzalan","Ayahualulco","Banderilla","Benito Juárez","Boca del Río","Calcahualco","Camarón de Tejeda","Camerino Z. Mendoza","Carlos A. Carrillo","Carrillo Puerto","Castillo de Teayo","Catemaco","Cazones de Herrera","Cerro Azul","Chacaltianguis","Chalma","Chiconamel","Chiconquiaco","Chicontepec","Chinameca","Chinampa de Gorostiza","Chocamán","Chontla","Chumatlán","Citlaltépetl","Coacoatzintla","Coahuitlán","Coatepec","Coatzacoalcos","Coatzintla","Coetzala","Colipa","Comapa","Córdoba","Cosamaloapan de Carpio","Cosautlán de Carvajal","Coscomatepec","Cosoleacaque","Cotaxtla","Coxquihui","Coyutla","Cuichapa","Cuitláhuac","El Higo","Emiliano Zapata","Espinal","Filomeno Mata","Fortín","Gutiérrez Zamora","Hidalgotitlán","Huatusco","Huayacocotla","Hueyapan de Ocampo","Huiloapan de Cuauhtémoc","Ignacio de la Llave","Ilamatlán","Isla","Ixcatepec","Ixhuacán de los Reyes","Ixhuatlán de Madero","Ixhuatlán del Café","Ixhuatlán del Sureste","Ixhuatlancillo","Ixmatlahuacan","Ixtaczoquitlán","Jalacingo","Jalcomulco","Jáltipan","Jamapa","Jesús Carranza","Jilotepec","José Azueta","Juan Rodríguez Clara","Juchique de Ferrer","La Antigua","La Perla","Landero y Coss","Las Choapas","Las Minas","Las Vigas de Ramírez","Lerdo de Tejada","Los Reyes","Magdalena","Maltrata","Manlio Fabio Altamirano","Mariano Escobedo","Martínez de la Torre","Mecatlán","Mecayapan","Medellín","Miahuatlán","Minatitlán","Misantla","Mixtla de Altamirano","Moloacán","Nanchital de Lázaro Cárdenas del Río","Naolinco","Naranjal","Naranjos Amatlán","Nautla","Nogales","Oluta","Omealca","Orizaba","Otatitlán","Oteapan","Ozuluama de Mascareñas","Pajapan","Pánuco","Papantla","Paso de Ovejas","Paso del Macho","Perote","Platón Sánchez","Playa Vicente","Poza Rica de Hidalgo","Pueblo Viejo","Puente Nacional","Rafael Delgado","Rafael Lucio","Río Blanco","Saltabarranca","San Andrés Tenejapan","San Andrés Tuxtla","San Juan Evangelista","San Rafael","Santiago Sochiapan","Santiago Tuxtla","Sayula de Alemán","Sochiapa","Soconusco","Soledad Atzompa","Soledad de Doblado","Soteapan","Tamalín","Tamiahua","Tampico Alto","Tancoco","Tantima","Tantoyuca","Tatahuicapan de Juárez","Tatatila","Tecolutla","Tehuipango","Tempoal","Tenampa","Tenochtitlán","Teocelo","Tepatlaxco","Tepetlán","Tepetzintla","Tequila","Texcatepec","Texhuacán","Texistepec","Tezonapa","Tierra Blanca","Tihuatlán","Tlachichilco","Tlacojalpan","Tlacolulan","Tlacotalpan","Tlacotepec de Mejía","Tlalixcoyan","Tlalnelhuayocan","Tlaltetela","Tlapacoyan","Tlaquilpa","Tlilapan","Tomatlán","Tonayán","Totutla","Tres Valles","Tuxpan","Tuxtilla","Ursulo Galván","Uxpanapa","Vega de Alatorre","Veracruz","Villa Aldama","Xalapa","Xico","Xoxocotla","Yanga","Yecuatla","Zacualpan","Zaragoza","Zentla","Zongolica","Zontecomatlán de López y Fuentes","Zozocolco de Hidalgo"],
    YUC: ["Abalá","Acanceh","Akil","Baca","Bokobá","Buctzotz","Cacalchén","Calotmul","Cansahcab","Cantamayec","Celestún","Cenotillo","Chacsinkín","Chankom","Chapab","Chemax","Chichimilá","Chicxulub Pueblo","Chikindzonot","Chocholá","Chumayel","Conkal","Cuncunul","Cuzamá","Dzán","Dzemul","Dzidzantún","Dzilam de Bravo","Dzilam González","Dzitás","Dzoncauich","Espita","Halachó","Hocabá","Hoctún","Homún","Huhí","Hunucmá","Ixil","Izamal","Kanasín","Kantunil","Kaua","Kinchil","Kopomá","Mama","Maní","Maxcanú","Mayapán","Mérida","Mocochá","Motul","Muna","Muxupip","Opichén","Oxkutzcab","Panabá","Peto","Progreso","Quintana Roo","Río Lagartos","Sacalum","Samahil","San Felipe","Sanahcat","Santa Elena","Seyé","Sinanché","Sotuta","Sucilá","Sudzal","Suma","Tahdziú","Tahmek","Teabo","Tecoh","Tekal de Venegas","Tekantó","Tekax","Tekit","Tekom","Telchac Pueblo","Telchac Puerto","Temax","Temozón","Tepakán","Tetiz","Teya","Ticul","Timucuy","Tinum","Tixcacalcupul","Tixkokob","Tixmehuac","Tixpéhual","Tizimín","Tunkás","Tzucacab","Uayma","Ucú","Umán","Valladolid","Xocchel","Yaxcabá","Yaxkukul","Yobaín"],
    ZAC: ["Apozol","Apulco","Atolinga","Benito Juárez","Calera","Cañitas de Felipe Pescador","Chalchihuites","Concepción del Oro","Cuauhtémoc","El Plateado de Joaquín Amaro","El Salvador","Fresnillo","Genaro Codina","General Enrique Estrada","General Francisco R. Murguía","General Pánfilo Natera","Guadalupe","Huanusco","Jalpa","Jerez","Jiménez del Teul","Juan Aldama","Juchipila","Loreto","Luis Moya","Mazapil","Melchor Ocampo","Mezquital del Oro","Miguel Auza","Momax","Monte Escobedo","Morelos","Moyahua de Estrada","Nochistlán de Mejía","Noria de Ángeles","Ojocaliente","Pánuco","Pinos","Río Grande","Sain Alto","Santa María de la Paz","Sombrerete","Susticacán","Tabasco","Tepechitlán","Tepetongo","Teúl de González Ortega","Tlaltenango de Sánchez Román","Trancoso","Trinidad García de la Cadena","Valparaíso","Vetagrande","Villa de Cos","Villa García","Villa González Ortega","Villa Hidalgo","Villanueva","Zacatecas"]    
}
selectEstadoFisco.addEventListener('change',function(e){
    if(this.value != ""){
        let municipios = munOalc[this.value];
        inicializaMunicipio(municipios)
        .then(respuesta=>{
            divCPFisco.classList.remove('d-none');
            inputCPFisco.setAttribute('required','');
            divCalleFisco.classList.remove('d-none');
            inputCalleFisco.setAttribute('required','');
            divNEFisco.classList.remove('d-none');
            divNIFisco.classList.remove('d-none');
            inputNEFisco.setAttribute('required','');
        }).catch(err=>{console.log(err)});
    }
});

function inicializaMunicipio(municipios){
    return new Promise(function(resolve,reject){
        /* Vaciar municipios */
        selectMunicipioFisco.querySelectorAll('option').forEach(opt=>selectMunicipioFisco.removeChild(opt));
        /*Settear la opcion por default */
        let option = document.createElement('option');
        option.setAttribute('value','');
        option.setAttribute('disabled','');
        option.setAttribute('selected','');
        option.textContent = 'Selecciona una opcion';
        selectMunicipioFisco.appendChild(option);
        /*Añadir la validacion de vacio */
        selectMunicipioFisco.setAttribute('required','');
        /* Settear el resto de opciones */
        for(let i=0; i<municipios.length; i++){
            option = document.createElement('option');
            option.setAttribute('value',municipios[i]);
            option.textContent = municipios[i];
            selectMunicipioFisco.appendChild(option);
        }
        divMunicipioFisco.classList.remove('d-none');
        resolve(true);
    });
}

btnAgregarDirFiscal.addEventListener('click',function(e){
    // $("#estadoFiscal").val('');
    selectEstadoFisco.value = '';
    divMunicipioFisco.classList.add('d-none');
    selectMunicipioFisco.removeAttribute('required');
    divCPFisco.classList.add('d-none');
    inputCPFisco.removeAttribute('required','');
    divCalleFisco.classList.add('d-none');
    inputCalleFisco.removeAttribute('required','');
    divNEFisco.classList.add('d-none');
    divNIFisco.classList.add('d-none');
    inputNEFisco.removeAttribute('required','');
});

btnCrearDirFiscal.addEventListener('click',function(e){
    //Para enviar formulario al back
    // this.setAttribute('type','submit');
    this.setAttribute('form','formFiscal');
});

formFiscal.addEventListener('submit',function(e){
    e.preventDefault();
    $('#dFiscal').modal('hide');
    btnAgregarDirFiscal.setAttribute('disabled','');
    divFiscalFill.classList.remove('d-none');
});

btnEditDirFiscal.addEventListener('click',function(e){
    $('#dFiscal').modal('show');
});

btnDeleteDirFiscal.addEventListener('click',function(e){
    btnAgregarDirFiscal.removeAttribute('disabled','');
    divFiscalFill.classList.add('d-none');
});

/*Codigo para  Sucursales  */

/**Formulario Branch */
const formBranch = document.getElementById('formBranchWhole');
const inputNameBranch = formBranch.querySelector('div#parteName-Branch #nameBranch');
const selectEstadoSucursal = formBranch.querySelector('div#parteDireccion-Branch div#divEstadoBranch select#estadoBranch');
const selectMunicipioSucursal = formBranch.querySelector('div#parteDireccion-Branch div#divMunicipioBranch select#municipioBranch');
const phoneBranch = formBranch.querySelector('#phoneBranch')
const inputPaginaBranch = formBranch.querySelector('#paginaBranch')
let invalidF_phone = formBranch.querySelector('#phoneBranch + .invalid-feedback');
const btnNewScheduleBranch = formBranch.querySelector('div#parteHorario-Branch button#btnModalHorario-Branch');
const btnCrearBranch = document.getElementById('btnCrear-Branch');

selectEstadoSucursal.addEventListener('change',function(e){
    if(this.value != ""){
        let municipios = munOalc[this.value];
        inicializaSelectMunicipio(selectMunicipioSucursal,municipios)
        .then(respuesta=>{
            formBranch.querySelector('div#parteDireccion-Branch div#divMunicipioBranch').classList.remove("d-none");
        }).catch(err=>{console.log(err)});
    }
});

function inicializaSelectMunicipio(selectLlenar,municipios){
    return new Promise(function(resolve,reject){
        /* Vaciar municipios */
        selectLlenar.querySelectorAll('option').forEach(opt=>selectLlenar.removeChild(opt));
        /*Settear la opcion por default */
        let option = document.createElement('option');
        option.setAttribute('value','');
        option.setAttribute('disabled','');
        option.setAttribute('selected','');
        option.textContent = 'Selecciona una opcion';
        /*Añadir la validacion de vacio */
        selectLlenar.appendChild(option);
        selectLlenar.setAttribute('required','');
        /* Settear el resto de opciones */
        for(let i=0; i<municipios.length; i++){
            option = document.createElement('option');
            option.setAttribute('value',municipios[i]);
            option.textContent = municipios[i];
            selectLlenar.appendChild(option);
        }
        resolve(true);
    });
}

btnNewScheduleBranch.addEventListener('click',function(e){
    restableceDatosModal();
    $('#btnModalHorario-Branch').popover("dispose");
});

btnCrearBranch.addEventListener('click',function(e){
    let horariosLlenados = $('div#parteHorario-Branch div#modalHorario div#horarios')
    .contents()
    .filter('div.llenado');
    if(horariosLlenados.length == 0){
        e.preventDefault();
        $('#btnModalHorario-Branch').popover("show");
    }else{
        invalidF_phone.textContent=phoneBranch.validationMessage;
        $('#btnModalHorario-Branch').popover("dispose");
    }
});

formBranch.addEventListener('submit',function(e){
    if(!this.checkValidity()){
        e.stopPropagation();
        e.preventDefault();
        this.classList.add('was-validated'); 
    }else{
        e.stopPropagation();
        e.preventDefault();

        //let aux = document.getElementById('nombre-sucursal-creada');
        //console.log(aux);
        //aux.value = inputNameBranch.value;
        $('#nombre-sucursal-creada').val(inputNameBranch.value)
        $('#link-sucursal-creada').val(inputPaginaBranch.value);
        $('#sucursalCreada').modal('show');
    }
});

btnModalSucursalCreada = document.getElementById("btnSucursalCreada");
btnModalSucursalCreada.addEventListener("click",function(){
    $('#sucursalCreada').modal('hide');
    formBranch.submit();
});

/**Codigo para modal horario de sucursales */
const btnCreaHorarioBranch = formBranch.querySelector('div#parteHorario-Branch div.modal div.modal-footer button#btnCrearHorario-Branch');
const horariosDiv = formBranch.querySelector('div#parteHorario-Branch div#modalHorario div#horarios');
const modalEditarHorarios = formBranch.querySelector("div#parteHorario-Branch div#modalHorario div#horaAtencion_Branch_Edit");

btnCreaHorarioBranch.addEventListener('click',function(e){
    let diasVacios = validaDias();
    let horasCorrectas = validaHorasBranch_ModalCrearHorario();
    if(!diasVacios && horasCorrectas){
        let horario = recabaDatosBranch_ModalCrearHorario();
        crearHorarioBranch(horario);
        $('#horaAtencion-Branch').modal('hide');
        horariosDiv.classList.remove('d-none');
    }    
});

function recabaDatosBranch_ModalCrearHorario(){
    const hI = document.querySelector('.empresaAtencion-horas div#hoursInicioBranch span.hourI').textContent;
    const mI = document.querySelector('.empresaAtencion-horas div#minutesInicioBranch span.minuteI').textContent;
    const meridianoI = document.querySelector('div#atencionBranch div.empresaAtencion-horas div span.meridI').textContent;
    const hF = document.querySelector('.empresaAtencion-horas div#hoursFinalBranch span.hourF').textContent;
    const mF = document.querySelector('.empresaAtencion-horas div#minutesFinalBranch span.minuteF').textContent;
    const meridianoF = document.querySelector('div#atencionBranch div.empresaAtencion-horas div span.meridF').textContent;
    let diasLight = document.querySelectorAll('#scheduleBranch tbody tr td.highlighted');
    let dias = new Array();
    diasLight.forEach(dia=>{
        if (dia.id == 'diaB-Lunes') {
            dias.push('Lunes');
        }else if(dia.id == 'diaB-Martes') {
            dias.push('Martes');
        }else if(dia.id == 'diaB-Miercoles') {
            dias.push('Miercoles');
        }else if(dia.id == 'diaB-Jueves') {
            dias.push('Jueves');
        }else if(dia.id == 'diaB-Viernes') {
            dias.push('Viernes');
        }else if(dia.id == 'diaB-Sabado') {
            dias.push('Sabado');
        }else if(dia.id == 'diaB-Domingo') {
            dias.push('Domingo');
        }
    });
    const horario = {
        diasLaborales: dias,
        hora: {
            horaI: hI,
            minutoI: mI,
            merI: meridianoI,
            horaF: hF,
            minutoF: mF,
            merF: meridianoF
        } 
    };
    return horario;
}

function validaHorasBranch_ModalCrearHorario(){
    let horaI = new Date();
    let horaF = new Date();
    let horasok = false;

    const hI = parseInt(
        document.querySelector('.empresaAtencion-horas div#hoursInicioBranch span.hourI').textContent
    );
    const mI = parseInt(
        document.querySelector('.empresaAtencion-horas div#minutesInicioBranch span.minuteI').textContent
    );
    const hF = parseInt(
        document.querySelector('.empresaAtencion-horas div#hoursFinalBranch span.hourF').textContent
    );
    const mF = parseInt(
        document.querySelector('.empresaAtencion-horas div#minutesFinalBranch span.minuteF').textContent
    );
    const meridianoI = document.querySelector('div#atencionBranch div span.meridI').textContent;
    const meridianoF = document.querySelector('div#atencionBranch div span.meridF').textContent;

    horaI.setMinutes(mI);
    horaF.setMinutes(mF);

    if(meridianoI == "PM"){
        switch (hI) {
            case 1:
                horaI.setHours(13);
                break;
            case 2:
                horaI.setHours(14);
                break;
            case 3:
                horaI.setHours(15);
                break;
            case 4:
                horaI.setHours(16);
                break;
            case 5:
                horaI.setHours(17);
                break;
            case 6:
                horaI.setHours(18);
                break;
            case 7:
                horaI.setHours(19);
                break;
            case 8:
                horaI.setHours(20);
                break;
            case 9:
                horaI.setHours(21);
                break;
            case 10:
                horaI.setHours(22);
                break;
            case 11:
                horaI.setHours(23);
                break;
            case 12:
                horaI.setHours(00);
                break;
            default:
                break;
        }
    }else{
        horaI.setHours(hI);
    }

    if(meridianoF == "PM"){
        switch (hF) {
            case 1:
                horaF.setHours(13);
                break;
            case 2:
                horaF.setHours(14);
                break;
            case 3:
                horaF.setHours(15);
                break;
            case 4:
                horaF.setHours(16);
                break;
            case 5:
                horaF.setHours(17);
                break;
            case 6:
                horaF.setHours(18);
                break;
            case 7:
                horaF.setHours(19);
                break;
            case 8:
                horaF.setHours(20);
                break;
            case 9:
                horaF.setHours(21);
                break;
            case 10:
                horaF.setHours(22);
                break;
            case 11:
                horaF.setHours(23);
                break;
            case 12:
                horaF.setHours(00);
                break;
            default:
                break;
        }
    }else{
        horaF.setHours(hF);
    }

    // if(horaI > horaF){
    //     console.log("Hora inicial es mayor");
    // }else{
    //     console.log("Hora inicial es menor");
    // }
    // console.log(horaI,horaF);

    horasok = (horaI > horaF)? false : true;

    if(!horasok){
        $('.empresaAtencion-horas').popover("show");
    }else{
        $('.empresaAtencion-horas').popover("dispose"); 
    }
    return horasok;
   

}

function crearHorarioBranch(horario){
    // console.log(horariosDiv.children);

    //definiendo el id del objeto clonado
    let ultimoId = getUltimoId();
    let divHorario = horariosDiv.children.item(0).cloneNode(true);
    divHorario.classList.remove('d-none');
    divHorario.classList.add('llenado');
    divHorario.id = ultimoId;

    //definiendo cabecera del horario
    let p = divHorario.querySelector('div#botoneraHorario p');
    p.textContent = ultimoId;

    //definiendo los dias laborales
    let diasDivHorario = divHorario.querySelectorAll('div.dias p span.dia');
    diasDivHorario.forEach(spanDia=>{
        spanDia.textContent = '';
    });  
    for (let i=0; i<horario.diasLaborales.length; i++) {
        diasDivHorario.item(i).textContent = horario.diasLaborales[i];   
    }

    //definiendo horas laborales
    let hI = divHorario.querySelector('div#horasHorario p span.horaI');
    let mI = divHorario.querySelector('div#horasHorario p span.minutoI');
    let meI = divHorario.querySelector('div#horasHorario p span.meridianoI');
    let hF = divHorario.querySelector('div#horasHorario p span.horaF');
    let mF = divHorario.querySelector('div#horasHorario p span.minutoF');
    let meF = divHorario.querySelector('div#horasHorario p span.meridianoF');
    hI.textContent = horario.hora.horaI
    mI.textContent = horario.hora.minutoI
    meI.textContent = horario.hora.merI
    hF.textContent = horario.hora.horaF
    mF.textContent = horario.hora.minutoF
    meF.textContent = horario.hora.merF

    //definiendo metodos a los botones editar/eliminar
    let btnEditar = divHorario.querySelector('#botoneraHorario #botonesHorario .edit');
    let btnEliminar = divHorario.querySelector('#botoneraHorario #botonesHorario .delete');
    btnEditar.addEventListener('click',function(e){
        restableceDatosModal();
        llenarModalEditarHorario(divHorario,modalEditarHorarios);
        $('#horaAtencion_Branch_Edit').modal('show');
    });

    btnEliminar.addEventListener('click',function(e){
        let horarioEliminar = horariosDiv.querySelector('div#'+divHorario.id);
        horariosDiv.removeChild(horarioEliminar);
    });

    horariosDiv.append(divHorario);
}

function getUltimoId(){
    let ultimoElemento = horariosDiv.children.item(horariosDiv.children.length-1);
    let idArray = ultimoElemento.id.split('_');
    idArray[1] = parseInt(idArray[1])+1;
    return (idArray[0]+'_'+idArray[1]);
}

function llenarModalEditarHorario(divFuente, modalLlenar){
    let tituloModalEditar = modalLlenar.querySelector('div.modal-header h5#tituloModal');
    tituloModalEditar.textContent = "Editar "+divFuente.id;

    let btnModalEditar = modalLlenar.querySelector('div.modal-footer button#btnActualizarHorario_Branch')
    btnModalEditar.textContent = "Actualizar "+divFuente.id;

    let spanHoraI = modalLlenar.querySelector("div.modal-body div.empresaAtencion-horas div.hoursInicio span.hourI");
    spanHoraI.textContent = divFuente.querySelector('div.horas p span.horaI').textContent;

    let spanMinutoI = modalLlenar.querySelector("div.modal-body div.empresaAtencion-horas div.minutesInicio span.minuteI");
    spanMinutoI.textContent = divFuente.querySelector("div.horas p span.minutoI").textContent;

    let spanMeridianoI = modalLlenar.querySelector("div.modal-body div.empresaAtencion-horas span.meridI");
    spanMeridianoI.textContent = divFuente.querySelector("div.horas p span.meridianoI").textContent;

    let spanHoraF = modalLlenar.querySelector("div.modal-body div.empresaAtencion-horas div.hoursFinal span.hourF");
    spanHoraF.textContent = divFuente.querySelector("div.horas p span.horaF").textContent;

    let spanMinutoF = modalLlenar.querySelector("div.modal-body div.empresaAtencion-horas div.minutesFinal span.minuteF");
    spanMinutoF.textContent = divFuente.querySelector("div.horas p span.minutoF").textContent;

    let spanMeridianoF = modalLlenar.querySelector("div.modal-body div.empresaAtencion-horas span.meridF");
    spanMeridianoF.textContent = divFuente.querySelector("div.horas p span.meridianoF").textContent;

    let diasFuente = divFuente.querySelectorAll("div.dias p span.dia");
    diasFuente.forEach(dia=>{
        if(dia.textContent){ //cadena vacia es false
            //los span vacios se posicion hasta el fina, no es factible colocar clase por dia
            if(dia.textContent == "Lunes"){
                modalLlenar.querySelector('div.empresaAtencion-dias table.schedule td#diaEdit-Lunes').classList.add('highlighted');
            }else if(dia.textContent == "Martes"){
                modalLlenar.querySelector('div.empresaAtencion-dias table.schedule td#diaEdit-Martes').classList.add('highlighted');
            }else if(dia.textContent == "Miercoles"){
                modalLlenar.querySelector('div.empresaAtencion-dias table.schedule td#diaEdit-Miercoles').classList.add('highlighted');
            }else if(dia.textContent == "Jueves"){
                modalLlenar.querySelector('div.empresaAtencion-dias table.schedule td#diaEdit-Jueves').classList.add('highlighted');
            }else if(dia.textContent == "Viernes"){
                modalLlenar.querySelector('div.empresaAtencion-dias table.schedule td#diaEdit-Viernes').classList.add('highlighted');
            }else if(dia.textContent == "Sabado"){
                modalLlenar.querySelector('div.empresaAtencion-dias table.schedule td#diaEdit-Sabado').classList.add('highlighted');
            }else if(dia.textContent == "Domingo"){
                modalLlenar.querySelector('div.empresaAtencion-dias table.schedule td#diaEdit-Domingo').classList.add('highlighted');
            }
        }
    });

}

let btnActualizarHorario = modalEditarHorarios.querySelector("div.modal-footer button#btnActualizarHorario_Branch");

btnActualizarHorario.addEventListener('click',function(e){
    let idHorario = this.textContent.split(" ")[1];
    let horario_actualizar = horariosDiv.querySelector('#'+idHorario);
    let diasVacios = validaDias();
    let horasCorrectas = validaHoras_Generico(modalEditarHorarios);
    if(!diasVacios && horasCorrectas){
        let modalEditHorario = document.getElementById("horaAtencion_Branch_Edit");
        let horario = recabaDatosHorario_Generico(modalEditHorario);
        actualizarDivHorario(horario_actualizar,horario);
        $('#horaAtencion_Branch_Edit').modal('hide');
    } 
});

function validaHoras_Generico(elementoPadre){
    let horasok = false;
    let hI = elementoPadre.querySelector("div.empresaAtencion-horas div.hoursInicio span.hourI").textContent;
    let mI = elementoPadre.querySelector("div.empresaAtencion-horas div.minutesInicio span.minuteI").textContent;
    let meridianoI = elementoPadre.querySelector("div.empresaAtencion-horas span.meridI").textContent;
    let hF = elementoPadre.querySelector("div.empresaAtencion-horas div.hoursFinal span.hourF").textContent;
    let mF = elementoPadre.querySelector("div.empresaAtencion-horas div.minutesFinal span.minuteF").textContent;
    let meridianoF = elementoPadre.querySelector("div.empresaAtencion-horas span.meridF").textContent;
    // console.log("")
    // console.log("Inicio -> "+hI+":"+mI+" "+meridianoI)
    // console.log("Fin -> "+hF+":"+mF+" "+meridianoF)
    // console.log("I -> "+parseInt(hI)+":"+parseInt(mI)+" "+meridianoI)
    // console.log("F -> "+parseInt(hF)+":"+parseInt(mF)+" "+meridianoF)
    let horaI = new Date();
    let horaF = new Date();
    horaI.setMinutes(parseInt(mI));
    horaF.setMinutes(parseInt(mF));
    if(meridianoI == "PM" && hI<12){
        horaI.setHours(parseInt(hI)+12);
    }else if((meridianoI == "AM" && hI<12) || (meridianoI == "AM" && hI==12)){
        horaI.setHours(parseInt(hI));
    }else{
        horaI.setHours(00);
    }

    if(meridianoF == "PM" && hF<12){
        horaF.setHours(parseInt(hF)+12);
    }else if((meridianoF == "AM" && hF<12) || (meridianoF == "AM" && hF==12)){
        horaF.setHours(parseInt(hF));
    }else{
        horaF.setHours(00);
    }
    // console.log("");
    // console.log(horaI.getHours()+":"+horaI.getMinutes());
    // console.log(horaF.getHours()+":"+horaF.getMinutes())
    horasok = (horaI > horaF)? false : true;
    if(!horasok){
        $('.empresaAtencion-horas').popover("show");
    }else{
        $('.empresaAtencion-horas').popover("dispose"); 
    }
    return horasok;

}

function recabaDatosHorario_Generico(elementoFuente){
    // console.log(elementoFuente);
    const hI = elementoFuente.querySelector('.empresaAtencion-horas div.hoursInicio span.hourI').textContent;
    const mI = elementoFuente.querySelector('.empresaAtencion-horas div.minutesInicio span.minuteI').textContent;
    const meridianoI = elementoFuente.querySelector('.empresaAtencion-horas div span.meridI').textContent;
    const hF = elementoFuente.querySelector('.empresaAtencion-horas div.hoursFinal span.hourF').textContent;
    const mF = elementoFuente.querySelector('.empresaAtencion-horas div.minutesFinal span.minuteF').textContent;
    const meridianoF = elementoFuente.querySelector('.empresaAtencion-horas div span.meridF').textContent;
    let diasLight = elementoFuente.querySelectorAll('.empresaAtencion-dias tbody tr td.highlighted');
    let dias = new Array();
    diasLight.forEach(dia=>{
        if (dia.classList.contains("Lunes")) {
            dias.push('Lunes');
        }else if(dia.classList.contains("Martes")) {
            dias.push('Martes');
        }else if(dia.classList.contains("Miercoles")) {
            dias.push('Miercoles');
        }else if(dia.classList.contains("Jueves")) {
            dias.push('Jueves');
        }else if(dia.classList.contains("Viernes")) {
            dias.push('Viernes');
        }else if(dia.classList.contains("Sabado")) {
            dias.push('Sabado');
        }else if(dia.classList.contains("Domingo")) {
            dias.push('Domingo');
        }
    });
    const horario = {
        diasLaborales: dias,
        hora: {
            horaI: hI,
            minutoI: mI,
            merI: meridianoI,
            horaF: hF,
            minutoF: mF,
            merF: meridianoF
        } 
    };
    return horario;

}

function actualizarDivHorario(divHorario,horarioFuente){
    //console.log(divHorario);
    //console.log(horarioFuente);

    //definiendo los dias laborales
    let diasDivHorario = divHorario.querySelectorAll('div.dias p span.dia');
    diasDivHorario.forEach(spanDia=>{
        spanDia.textContent = '';
    });  
    for (let i=0; i<horarioFuente.diasLaborales.length; i++) {
        diasDivHorario.item(i).textContent = horarioFuente.diasLaborales[i];   
    }

    //definiendo horas laborales
    let hI = divHorario.querySelector('div#horasHorario p span.horaI');
    let mI = divHorario.querySelector('div#horasHorario p span.minutoI');
    let meI = divHorario.querySelector('div#horasHorario p span.meridianoI');
    let hF = divHorario.querySelector('div#horasHorario p span.horaF');
    let mF = divHorario.querySelector('div#horasHorario p span.minutoF');
    let meF = divHorario.querySelector('div#horasHorario p span.meridianoF');
    hI.textContent = horarioFuente.hora.horaI
    mI.textContent = horarioFuente.hora.minutoI
    meI.textContent = horarioFuente.hora.merI
    hF.textContent = horarioFuente.hora.horaF
    mF.textContent = horarioFuente.hora.minutoF
    meF.textContent = horarioFuente.hora.merF
}


/**********************************Codigo para  Subscripcion  */







