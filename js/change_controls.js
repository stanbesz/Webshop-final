function showBlock(buttonCall) {
  var showInsert = document.getElementById("insertContainer");
  var showPromo = document.getElementById("promoContainer");
  var showRemove = document.getElementById("removeContainer"); 
  switch (buttonCall) {
    case "insert":
      showPromo.style.display = "none";
      showRemove.style.display = "none";
      showInsert.style.display = "block";
      localStorage.setItem("lastShow", "insert");
      break;
    case "promo":
      showPromo.style.display = "block";
      showRemove.style.display = "none";
      showInsert.style.display = "none";
      localStorage.setItem("lastShow", "promo");
      break;
    case "remove":
      showPromo.style.display = "none";
      showRemove.style.display = "block";
      showInsert.style.display = "none";
      localStorage.setItem("lastShow", "remove");
      break;
    default:
    showInsert.style.display = "block";
  }
}
var lastShow  = localStorage.getItem("lastShow");
if(!lastShow){
window.onLoad=showBlock("insert");
}
else{
  window.onLoad=showBlock(lastShow);
}