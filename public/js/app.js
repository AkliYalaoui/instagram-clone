import Form from "./classes/forms.js";

const arrayOfInputs = Array.from(document.querySelectorAll('[data-focus]'));
Form.onFocus(arrayOfInputs);

const profile_menu = document.getElementById('profile_menu');
if(profile_menu){
    profile_menu.addEventListener('click',function (){
       this.nextElementSibling.classList.toggle('open');
    });
}
