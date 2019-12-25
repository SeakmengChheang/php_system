function con_firm(message){
    var r = confirm(message);
    if(r == true){
        return true;
    }
    else{
        return false;
    }
}