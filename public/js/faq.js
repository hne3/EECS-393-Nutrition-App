$(function(){ 
  $('.faq .answer').css('display','none');
  $('.faq').click(toggleQuestion); 
});

function toggleQuestion(event){
  event.preventDefault();
  var answer;
  elements = event.currentTarget.children;
  for(i = 0; i < elements.length; i++){
    element = elements[i];
    if(element.className == "answer"){
      answer = element;
    }
  }
  if(answer.style.display == "none"){
    answer.style.display = "";
  }
  else{
    answer.style.display = "none";
  }
}

