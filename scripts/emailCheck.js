document.querySelector(".email").addEventListener("change", () => {
    let mailBoxValue = document.querySelector(".email").value;

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.status == 200) {
            let textFeedback = document.querySelector(".email-validator");
            let box = document.querySelector(".email");
            textFeedback.innerHTML = xmlhttp.responseText;

            if (xmlhttp.responseText == "this email is already in use") {
                textFeedback.classList.add("invalid-feedback");
                textFeedback.style.display = "inline-block";
                box.classList.add("is-invalid");
            }
            if (xmlhttp.responseText == "email available") {
                textFeedback.classList.add("valid-feedback");
                textFeedback.style.display = "inline-block";
                box.classList.add("is-valid");
            }
            if (mailBoxValue == "") {
                textFeedback.classList.remove("invalid-feedback");
                textFeedback.classList.remove("valid-feedback");
                box.classList.remove("is-valid");
                box.classList.remove("is-invalid");
                textFeedback.style.display = "none";
            }
        }
    }
    xmlhttp.open("GET", "./scripts/ajax/emailChecker.php?q=" + mailBoxValue);
    xmlhttp.send();
})