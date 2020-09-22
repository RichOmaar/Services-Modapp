const form  = document.getElementById('checkForm');
const email = document.getElementById("usuario");
const emailError = document.querySelector('#usuario + span.error');

email.addEventListener('input',function(event){
  if(email.validity.valid) {
    emailError.innerHTML = ''; // Restablece el contenido del mensaje
  } else if(email.validity.typeMismatch){
    emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico.';
  }
});

form.addEventListener('submit', function (event) {
  if(!email.validity.valid) {
    showError();
    event.preventDefault();
  }
});
