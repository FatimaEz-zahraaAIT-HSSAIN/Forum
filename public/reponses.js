let displayDiv = document.getElementById('displayreponses');
let request = new XMLHttpRequest();
let Reponses;


setInterval(function(){
request.open('GET', '../public/responses.json');
request.onload=function(){

        Reponses = JSON.parse(request.responseText);
        displayData(Reponses);
    }
    request.send();
},30000);   


function displayData(data) {
    let html='';
    for(let i = 0; i < data.length ; i++ ){
    html+= '<div class="border border-primary position-relative display-flex m-3 p-3"><p class="mx-2">'+ data[i].date +'- <span class="text-success">'+ data[i].nom+'</span></p><div class="border border-secondary mx-5 mb-2"><p class="m-2">'+ data[i].response+'</p></div></div>';
    }
    displayDiv.innerHTML= html;
}
