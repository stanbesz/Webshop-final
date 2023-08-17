
function ShowHideDiv() {
    var chkManu = document.getElementById("chkManu");
    var manuShow = document.getElementById("manuShow");
    manuShow.style.display = chkManu.checked ? "block" : "none";
    var manuInp = manuShow.querySelector('#manufacturerName');
    if(chkManu.checked){
        manuInp.setAttribute("required","");
    }
    else{
        manuInp.removeAttribute("required");
    }
    console.log(manuInp);
}