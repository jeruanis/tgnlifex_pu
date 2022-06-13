
import Latestnews from "../../../latestNews.js";
const news = new Latestnews('a', 'b');
const content = news.nav + news.news_content;
document.body.innerHTML = content;

$(document).ready(function(){
  let n = document.querySelectorAll(".n");
  if(window.matchMedia("(min-width:600px)").matches){
    n.forEach(
      function(n){
        n.classList.add('item-news');
       })
   }else{
    n.forEach(function(n){
      n.classList.add('col-sm-12','card-body', 'mb-2','text-white');
      n.style.background = 'black';
    })
   }
 });
