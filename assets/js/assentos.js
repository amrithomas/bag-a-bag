const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


let assentos = [];
let nmrAssento;
let passageiro = 0;

function envia(valor){
    
    //Gerador de Divs dentro do Selecionador de Assentos
    document.getElementById('ListaAssentos').innerHTML = 
    document.getElementById('ListaAssentos').innerHTML + 
    '<div id="assento'+valor+'" class="m-2 pt-2 rounded-1" style="border: solid 1px black">' +
    '<h6 class="text-start mx-1" id="passageiro'+valor+'"></h6>'+
    '<img src="../assets/img/poltrona_verde-sembg.png"  style="height: 50px; width: 50px;" alt=""></img>'+
    '<h6 id="assento'+valor+'" name="ast">Assento '+valor+'</h6>'+
    '<p>Valor: R$49,00</p>'+
    '</div>'
    //Fim do Gerador de Divs dentro do Selecionador de Assentos
    
    //Atualiza Número do Passageiro (id fica com o numero do assento)
    passageiro = passageiro + 1;
    document.getElementById('passageiro'+valor).innerHTML = 'Passageiro ' + passageiro;

    //Recebendo a Posição de Cada Poltrona                                                              
    nmrAssento = document.getElementById('poltrona' + valor).value;
    
    //Trocando a Cor da Poltrona, Após Selecionada
    document.getElementById('img' + valor).src = "../assets/img/poltrona_azul-sembg.png";
    
    //Desabilitando o botão, para quê não seja selecionado consecutivamente
    document.getElementById('poltrona' + valor).disabled = true;

    
    //Acumulador dos Assentos Selecionados
    assentos.push(nmrAssento);

    console.log(assentos);

    
}

let i;
let botao;

function remove(){
    
    //Reabilitando o botão
    i = (assentos.length);
    document.getElementById('poltrona' + assentos[i-1]).disabled = false;

    //Trocando a Cor da Poltrona, Após Desselecionada
    document.getElementById('img' + assentos[i-1]).src = "../assets/img/poltrona_verde-sembg.png";
    
    
    //Removendo o Card da Listagem de Assentos Escolhidos
    botao = document.getElementById('remover');
    pai = document.getElementById('ListaAssentos'); //div pai
    filho = document.getElementById('assento'+assentos[i-1]); //div filho
    pai.removeChild(filho);
    passageiro = passageiro - 1;
    

    //Removendo o ultimo assento selecionado do array
    assentos.pop();
    console.log(assentos);
}  

function enviadado(){
    //envia assentos
    document.getElementById("enviaArray").value = assentos;

}
    