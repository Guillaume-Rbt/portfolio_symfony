/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';


// start the Stimulus application
import './bootstrap';

const inputFile = document.getElementById("project_image");
const preview = document.getElementById("preview");

inputFile.addEventListener('change', function () {
    var fileName = inputFile.value;
    var filesList = inputFile.files;
    var imageType = /^image\//

    var file = filesList[0];
    if (!imageType.test(file.type)) {
        var message = document.createElement("div");
        message.classList.add("alert-danger", "m-2", "p-2");
        message.textContent = "Veuillez sélectionner une image"
        message.id = 'alertFile';
        message = inputFile.parentNode.parentNode.insertBefore(message, inputFile.parentNode);
    } else {
        if (document.getElementById("alertFile")) {
            document.getElementById("alertFile").remove();
        }
    }
    var parts = fileName.split("\\");
    document.querySelector("input[type='file']+label").innerHTML = parts.pop();
     preview.innerHTML="";
     var img = document.createElement("img");
     img.file = file;
     preview.appendChild(img); 
     var reader = new FileReader();
     reader.onload = ( function(aImg) { 
     return function(e) { 
     aImg.src = e.target.result; 
     };
    })(img);

    reader.readAsDataURL(file);
})

if (inputFile.dataset.file) {
    var fileName = inputFile.dataset.file;
    var parts = fileName.split("\\");
    document.querySelector("input[type='file']+label").innerHTML = parts.pop();
}

