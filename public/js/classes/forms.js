export default class Form{

    static onFocus(inputs = []){
        inputs = Array.from(inputs);
        inputs.forEach(input =>{
            if (input instanceof Element && input.tagName === "INPUT"){

                input.addEventListener('focus',function (){
                    this.previousElementSibling.classList.add('focused');
                });
                input.addEventListener('blur',function (){
                    this.previousElementSibling.classList.remove('focused');
                });
            }
        });
    }

}
