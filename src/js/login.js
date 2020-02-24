
var state = true;


function swap(){
    document.getElementById("reg").style.display = "block";
    log = document.getElementById("log");

    if(state){
        document.getElementById("reg").style.display = "block";
        document.getElementById("log").style.display = "none";
    }
    else{
        document.getElementById("reg").style.display = "none";
        document.getElementById("log").style.display = "block";
    }
    state = !state;
}