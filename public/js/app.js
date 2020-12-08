import Form from "./classes/forms.js";

const arrayOfInputs = Array.from(document.querySelectorAll('[data-focus]'));
Form.onFocus(arrayOfInputs);

const profile_menu = document.getElementById('profile_menu');
if(profile_menu){
    profile_menu.addEventListener('click',function (){
       this.nextElementSibling.classList.toggle('open');
    });
}

const show_all_comments = document.querySelectorAll('[data-id="show-all-comments"]');

if (show_all_comments){
    show_all_comments.forEach(btn => {
        btn.addEventListener('click',function () {
            this.parentElement.nextElementSibling.classList.toggle('show');
            let tmp = this.textContent;
            this.textContent = this.dataset.text;
            this.setAttribute('data-text', tmp);
        })
    });
}
