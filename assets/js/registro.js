const pwd = document.getElementById("password");
const spanwd = document.querySelector('#password + span.error');
const pwdC = document.getElementById("passwordC");
const spanwdC = document.querySelector('#passwordC + span.error');
const form = document.getElementById("registroForm");

pwd.addEventListener('blur',function(event){
    spanwd.classList.remove("d-none");
    spanwdC.classList.remove("d-none");
});

pwdC.addEventListener('input',e=>{
    // (e.target.value == pwdC.value) ? spanwd.classList.add("d-none"):spanwd.classList.add("d-none");
    if(e.target.value == pwd.value){
        spanwd.classList.add("d-none");
        spanwdC.classList.add("d-none");
    }
})

form.addEventListener('submit',function(event){
    if (form.checkValidity() === false || (pwd.value != pwdC.value)) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
});








