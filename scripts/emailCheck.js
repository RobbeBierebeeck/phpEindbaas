document.querySelector(".email").addEventListener("change", () => {
    let mailBoxValue = document.querySelector(".email").value;

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.status == 200) {
            let textFeedback = document.querySelector(".email-validator");
            textFeedback.innerHTML = xmlhttp.responseText;

            if (xmlhttp.responseText == "this email is already in use") {
                textFeedback.classList.add("invalid-feedback");
                textFeedback.style.display = "inline-block";
            }
            if (xmlhttp.responseText == "email available") {
                textFeedback.classList.add("valid-feedback");
                textFeedback.style.display = "inline-block";
            }
            if (mailBoxValue == "") {
                textFeedback.classList.remove("invalid-feedback");
                textFeedback.classList.remove("valid-feedback");
                textFeedback.style.display = "none";
            }
        }
    }
    xmlhttp.open("GET", "./scripts/ajax/emailChecker.php?q=" + mailBoxValue);
    xmlhttp.send();
})