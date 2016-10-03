function file_details(input_field,upload_file){

var x = document.getElementById(upload_file);
var txt = "";
if ('files' in x) {
    if (x.files.length == 0) {
        txt = "<span class='glyphicon glyphicon-remove-sign' ></span>";
    } else {
         for (var i = 0; i < x.files.length; i++) {
            //txt += "<br><strong>" + (i+1) + ". file</strong><br>";
            var file = x.files[i];
            if ('name' in file) {
                txt += "<span class='glyphicon glyphicon-ok-sign' ></span> " + file.name + "<br>";
            }
           }
        }
    }

document.getElementById (input_field).innerHTML = txt;


}
