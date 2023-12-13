let displayDiv = document.getElementById('displayquestions');
let request = new XMLHttpRequest();
let questions;


setInterval(function(){
request.open('GET', '../public/questions.json');
request.onload=function(){

        questions = JSON.parse(request.responseText);
        displayData(questions);
    }
    request.send();
}, 30000);   


function displayData(data) {
    let html='';
    for(let i = 0; i < data.length ; i++ ){
    html+= '<div class="border border-primary position-relative display-flex m-3 p-3"><p class="mx-2">'+ data[i].date +' - <span class="text-success">'+ data[i].nom+'</span></p><div class="border border-secondary mx-5 mb-2"><p class="m-2">'+ data[i].question+'</p></div><a class="text-decoration-none float-left mx-5 end-0 " href="question.php?question_id='+data[i].id +'&question='+data[i].question+'">Reponses</a></div>';
    }
    displayDiv.innerHTML= html;
}

