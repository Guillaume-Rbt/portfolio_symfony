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

if (document.getElementById("project_image")) {
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
        preview.innerHTML = "";
        var img = document.createElement("img");
        img.file = file;
        preview.appendChild(img);
        var reader = new FileReader();
        reader.onload = (function (aImg) {
            return function (e) {
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

}


if (document.getElementById("config_photo")) {
    var inputPhoto = document.getElementById("config_photo");
    inputPhoto.addEventListener("change", function () {
        var fileName = inputPhoto.value;
        var parts = fileName.split("\\");
        document.querySelector("#config_photo+label").innerHTML = parts.pop();
    })

    var inputCv  = document.getElementById("config_CV");
    inputCv.addEventListener("change", function () {
        var fileName = inputCv.value;
        var parts = fileName.split("\\");
        document.querySelector("#config_CV+label").innerHTML = parts.pop();
    })


    if (inputPhoto.dataset.file) {
        var fileName = inputPhoto.dataset.file;
        var parts = fileName.split("\\");
        document.querySelector("#config_photo+label").innerHTML = parts.pop();
    }

    if (inputCv.dataset.file) {
        var fileName = inputCv.dataset.file;
        var parts = fileName.split("\\");
        document.querySelector("#config_CV+label").innerHTML = parts.pop();

    }
}


if(document.getElementById("navbar")) {
    var sections = document.querySelectorAll("section");
    var duration;
    var controller = new ScrollMagic.Controller()
    for ( var i = 0 ; i < sections.length ; i++ ) {
        var sectionId = sections[i].getAttribute("id");
        duration = sections[i].offsetHeight;
        var link = document.querySelector("li[data-link='" + sectionId + "']").getAttribute("id")
        new ScrollMagic.Scene({triggerElement: '#'+ sectionId, "duration":duration})
					.setClassToggle('#' + link, "active")
                    .addTo(controller);
}}


if(document.getElementById("portfolio")) {
    var closes = document.querySelectorAll(".close");
    var popups = document.querySelectorAll(".popup");
 
    for( close of closes) {
        close.addEventListener("click", function (e) {
            
            e.preventDefault()
            var scroll = window.scrollY;
            window.location.href = "#";
                window.scrollTo({
                top: scroll,
                left:0,
            })

        })
    }
}



var iconMenu = document.querySelector(".menu-icon");

iconMenu.addEventListener("click" , function () {
    document.querySelector("body").classList.toggle("with-menu"); 
})

window.addEventListener("resize" , function() {
    if(window.innerWidth > 700) {
        document.querySelector("body").classList.remove("with-menu"); 

    }
})
