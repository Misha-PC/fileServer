var fileId = 0;
var selectFileId = -1;
var fileSelecded = false;

addEventListener("keyup", keyRemoveFile);

function keyRemoveFile(e){
    if(e.keyCode == 46)
        removeFile();
}


function getCookie(){
    alert(document.cookie);
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

function parseTime(unixTime){
    var date = new Date(unixTime);
    return(date.getDate() + "." + date.getUTCMonth() + "." + date.getFullYear());
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

function startFile(){
    if(selectFileId != -1){
    }
}
function downloadFile(){
    if(selectFileId != -1){
        
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

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function upload() {

    var inp = document.getElementById("f1");
    var file = inp.files[0];
    
    if (file) {
        console.log(file);
        var xhr = new XMLHttpRequest();
        
        document.getElementById('bar').classList.add("barShow");
        
        xhr.upload.onprogress = function(event) {
            progress =event.loaded /  event.total; 
            document.getElementById('progress').style.width = (progress)*100 + "%";
            if(progress == 1){
                let closeBar = setTimeout(function(){
                    document.getElementById('bar').classList.remove("barShow");
                }, 1600);
            }
        }


        xhr.onload = xhr.onerror = function() {
            if (this.status == 200) {
                console.log("success");
                // addFile()
            } 
            else {
                console.log("error " + this.status);
            }
        };

        form = new FormData();

        console.log(file);
                

        form.append("file", file);
        form.append("last_edit", parseTime( file['lastModified']));
        form.append("user_id", getCookie('id'));
        form.append("size", file['size']);

        xhr.open("post","file.php",true);
        xhr.send(form);
        var lastID = 0;
        xhr.onreadystatechange = function() {
            var id = xhr.responseText;
            if(id && id != lastID){
                lastID = id;
                console.log(id);
                addFile(id, file['name'], file['lastModified'], file['size']);
            }
        }
    }
}


function select(){

    document.getElementById("f1").click();

    oldFile = document.forms.uploader.userfile.name;



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
