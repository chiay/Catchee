// When the user scrolls down 30px from the top of the document and screen width <960px,
// slide down the navbar

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
if (window.matchMedia("(max-width: 960px)").matches) {
   
  if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    document.getElementById("scroll").style.top = "35px";
  } else {
    document.getElementById("scroll").style.top = "-50px";
  }
}


}
function removeElement() {

  document.getElementById("scroll").style.display = "none";
} 