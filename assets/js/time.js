const upHoursI = document.querySelectorAll('.empresaAtencion-horas div.hoursInicio span.upInicio');
const hTextsI = document.querySelectorAll('.empresaAtencion-horas div.hoursInicio span.hourI');
const downHoursI = document.querySelectorAll('.empresaAtencion-horas div.hoursInicio span.downInicio');
const upMinsI = document.querySelectorAll('.empresaAtencion-horas div.minutesInicio span.upInicio');
const mTextsI = document.querySelectorAll('.empresaAtencion-horas div.minutesInicio span.minuteI');
const downMinsI = document.querySelectorAll('.empresaAtencion-horas div.minutesInicio span.downInicio');

const upHoursF = document.querySelectorAll('.empresaAtencion-horas div.hoursFinal span.upFin');
const hTextsF = document.querySelectorAll('.empresaAtencion-horas div.hoursFinal span.hourF');
const downHoursF = document.querySelectorAll('.empresaAtencion-horas div.hoursFinal span.downFin');
const upMinsF = document.querySelectorAll('.empresaAtencion-horas div.minutesFinal span.upFin');
const mTextsF = document.querySelectorAll('.empresaAtencion-horas div.minutesFinal span.minuteF');
const downMinsF = document.querySelectorAll('.empresaAtencion-horas div.minutesFinal span.downFin');

//Hora inicial
for (let index = 0; index < upHoursI.length; index++) {
	const upHourI = upHoursI[index];
	const hTextI = hTextsI[index];
	upHourI.addEventListener('click',function(e){
		subeHoras(hTextI);
	});
}

for (let index = 0; index < upHoursI.length; index++) {
	const downHourI = downHoursI[index];
	const hTextI = hTextsI[index];
	downHourI.addEventListener('click',function(e){
		bajaHoras(hTextI);
	});
}

for (let index = 0; index < upMinsI.length; index++) {
	const upMinI = upMinsI[index];
	const mTextI = mTextsI[index];
	upMinI.addEventListener('click',function(e){
		subeMinutos(mTextI);
	});
}

for (let index = 0; index < upMinsI.length; index++) {
	const downMinI = downMinsI[index];
	const mTextI = mTextsI[index];
	downMinI.addEventListener('click',function(e){
		bajaMinutos(mTextI);
	});
}
//Hora final
for (let index = 0; index < upHoursF.length; index++) {
	const upHourF = upHoursF[index];
	const hTextF = hTextsF[index];
	upHourF.addEventListener('click',function(e){
		subeHoras(hTextF);
	});
}

for (let index = 0; index < upHoursF.length; index++) {
	const downHourF = downHoursF[index];
	const hTextF = hTextsF[index];
	downHourF.addEventListener('click',function(e){
		bajaHoras(hTextF);
	});
}

for (let index = 0; index < upMinsF.length; index++) {
	const upMinF = upMinsF[index];
	const mTextF = mTextsF[index];
	upMinF.addEventListener('click',function(e){
		subeMinutos(mTextF);
	});
}

for (let index = 0; index < upMinsF.length; index++) {
	const downMinF = downMinsF[index];
	const mTextF = mTextsF[index];
	downMinF.addEventListener('click',function(e){
		bajaMinutos(mTextF);
	});
}



// upHourI.addEventListener('click',function(e){
// 	subeHoras(hTextI);
// });

// downHourI.addEventListener('click',function(e){
// 	bajaHoras(hTextI);
// });

// upMinI.addEventListener('click',function(e){
// 	subeMinutos(mTextI);
// });

// downMinI.addEventListener('click',function(e){
// 	bajaMinutos(mTextI);
// });

// upHourF.addEventListener('click',function(e){
// 	subeHoras(hTextF);
// });

// downHourF.addEventListener('click',function(e){
// 	bajaHoras(hTextF);
// });

// upMinF.addEventListener('click',function(e){
// 	subeMinutos(mTextF);
// });

// downMinF.addEventListener('click',function(e){
// 	bajaMinutos(mTextF);
// });

function subeHoras(objDom){
	let h = parseInt(objDom.textContent);
	let nh = 1;
	if(h < 9){
		h++;
		objDom.innerHTML = '0'+h;
	}else if(h==12){
		objDom.innerHTML = '0'+nh;
	}else{
		h++;
		objDom.textContent = h;
	}
}

function bajaHoras(objDom){
	let h = parseInt(objDom.textContent);
	let nh = 12;
	if(h == 1){
		objDom.textContent = nh;
	}else if(h<=10){
		h--;
		objDom.innerHTML = '0'+h;
	}else{
		h--;
		objDom.textContent = h;
	}
}

function subeMinutos(objDom){
	let m = parseInt(objDom.textContent);
	let nm = 00;
	if(m == 59){
		objDom.innerHTML = '00';
	}else if(m < 9){
		m++;
		objDom.innerHTML = '0'+m;
	}else{
		m++;
		objDom.textContent = m;
	}
}

function bajaMinutos(objDom){
	let m = parseInt(objDom.textContent);
	let nm = 59;
	if(m == 00){
		objDom.textContent = nm;
	}else if(m <= 10){
		m--;
		objDom.innerHTML = '0'+m;
	}else{
		m--;
		objDom.textContent = m;
	}
}





// $(document).ready(function(){
// 	$("div#hours span#upInicio").click(function(){
// 	  $(this).hide();
// 	});
//   });
