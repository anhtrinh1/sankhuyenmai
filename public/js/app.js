function displayDetail(id) {

  if(document.getElementById(id).style.display == "none")

   document.getElementById(id).style.display = "block";
 else
   document.getElementById(id).style.display = "none";

}
 
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btnOnTop").style.display = "block";
        document.getElementById("menu-top").style.display = "none";
    } else {
        document.getElementById("btnOnTop").style.display = "none";
        document.getElementById("menu-top").style.display = "block";
    }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// show popup
function showPopup(id) {
    var popup = document.getElementById(id);
    popup.classList.add("show");
}
function hidPopup(id) {
    var popup = document.getElementById(id);
    popup.classList.remove("show");
}
 
 // riderct coupon
function getCoupon(id,url,ajxUrl) {
  var clipboard = new ClipboardJS('#coppy_'+id);
  clipboard.on('success', function(e) {
    alert("Đã Coppy Thành Công Mã: "+e.text);
    window.open(url,"_blank");
    updateClick(id,ajxUrl);
    e.clearSelection();
  });
}
function getLink(url) {
  window.open(url,"_blank");
}
function updateClick(id,url) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", url+id, true);
  xhttp.send();
}