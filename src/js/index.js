var fileId = 0;
var selectFileId = -1;

addEventListener("keyup", keyRemoveFile);

function keyRemoveFile(e){
    if(e.keyCode == 46)
        removeFile();
}


function getCookie(){
    alert(document.cookie);
    // parseCookieName(document.cookie);  
    // parseCookieName_V2();

}

function parseCookieName_V2(){
    arr = [];
    var two = document.cookie.split(';');
    while(name = two.pop()) 
        arr[arr.length] = name.split('=')[0]    
    console.log(arr);
    
    return(arr);
}

function parseCookieName(cookie){
    
    arr = [];
    word = "";    
    boolKey = true;

    for(i = 0; i < cookie.length; i++){
        current = cookie[i];
        if(boolKey){
            if(current == "="){
                arr[arr.length] = word;
                word = "";
                boolKey = false;
            }
            else if(current != ""){
                word += current;
            }
        }
        else if(current == ";"){
            boolKey = true;
        }
    }
    return(arr);
}

function setCookie(){
    document.cookie = "user=Misha;";
}

function createFileDiv(inArr){
    inArr.forEach(function(item, i, arr) {
        console.log(item);
        addFile(item[0], item[1], item[2], item[3]);
    });    
}

function clearCookie_(){
    // document.cookie.clearCookie();
    document.cookie.clearCookie;
    getCookie();
}


function out(){
    document.cookie = "id=-1";    
    window.location = "login.php";
}

function selectFile(id){
    // console.log("old:" + selectFileId + "   new:" + id);
    
    if(selectFileId == id){
        document.getElementById('file_'+selectFileId).classList.remove('selected');
        selectFileId = -1;
        // console.log("diselected");
        return;
    }
    else if(selectFileId != -1){
        // console.log("diselected 1");
        document.getElementById('file_'+selectFileId).classList.remove('selected');
    }
    selectFileId = id;
    // console.log("selected");
    document.getElementById('file_'+id).classList.add('selected');
}

function removeFile(){
    if(selectFileId != -1){
        if(removeFileFromServer() == "true"){
            document.getElementById('file_'+selectFileId).remove();
            selectFileId = -1;
        }
    }
}

function removeFileFromServer(){
    var xmlHttp = new XMLHttpRequest();
    var url = "remove.php?id=" + selectFileId;
    xmlHttp.open( "GET", url, false ); // false for synchronous request
    xmlHttp.send( null );
    console.log(xmlHttp.responseText);
    
    return xmlHttp.responseText;
}


function upload(file) {

    var xhr = new XMLHttpRequest();
  
    // обработчик для отправки
    xhr.upload.onprogress = function(event) {
      console.log(event.loaded + ' / ' + event.total);
    }
  
    // обработчики успеха и ошибки
    // если status == 200, то это успех, иначе ошибка
    xhr.onload = xhr.onerror = function() {
      if (this.status == 200) {
        console.log("success");
      } else {
        console.log("error " + this.status);
      }
    };
  
    xhr.open("POST", "file.php", true);
    // xhr.open("POST", "file.js", true);
    xhr.send(file);
  
}

function select(){
    document.getElementById("f1").click();

    var inp = document.forms.uploader.userfile;
    while(document.forms.uploader.userfile == 0){}
    // var inp = document.getElementById();
    var file = inp.files[0];
    console.log(file);
    if (file) {
        upload(file);
    }

    document.forms.uploader.userfile.files[0] = 0;
    console.log("teeesst:: " + document.forms.uploader.userfile.files[0]);
    
}

function addFile(id, name, edit, size){
    // var id = fileId++;
    
    let tr = document.createElement('tr');
    tr.classList.add('file');
    tr.id = "file_"+id;
    tr.onclick = function(){ selectFile(id)};

    let td = document.createElement('td');    
    td.classList.add('fileName');
    td.title = 'File name';
    td.innerText = name;
    tr.append(td);

    td = document.createElement('td');    
    td.classList.add('fileOvner');
    td.title = 'Ovner';
    td.innerText = 'Я';
    tr.append(td);

    td = document.createElement('td');    
    td.classList.add('fileLastEdit');
    td.title = 'Last edit';
    td.innerText = edit;
    tr.append(td);

    td = document.createElement('td');    
    td.classList.add('fileSize');
    td.title = 'File size';
    td.innerText = size;
    tr.append(td);

    td = document.createElement('td');    
    td.classList.add('fileStart');
    td.title = 'Print';
    tr.append(td);


    document.getElementById('files').append(tr);
}
