var openflag = 0;
function openNav() {
  if(openflag==0){
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    openflag=1;
   
  }
  else if(openflag==1){
        document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    openflag=0;

  }
}

