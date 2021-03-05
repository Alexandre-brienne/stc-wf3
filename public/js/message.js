let send = document.querySelector('.btnjs');
let inputmessage = document.querySelector('textarea');

console.log(inputmessage);
console.log(userid);




async function message(){

    if(inputmessage.value !== "" ){
        let messagesaisie = inputmessage.value.trim();
        console.log(send);
        inputmessage.value ='';

        refreshAjax(messagesaisie);

    }

   
}
 
async function refreshAjax (messageSaisie){

    let formData = new FormData
    formData.append('message', messageSaisie);
    formData.append('userid', userid);
    let reponseServeur = await fetch(urlajax,{
        method: 'POST',
        body: formData
    });

    let contenuAjax = await reponseServeur.json();
    let boxmessage = document.querySelector('.message');
    boxmessage.innerHTML = '';
    for (let index = 0; index < contenuAjax.messages.length; index++) {
        const element = contenuAjax.messages[index]; 
        boxmessage.innerHTML += `<p>${element.message}</p>`;
    }
    console.log(contenuAjax);
}


send.addEventListener('click',message);