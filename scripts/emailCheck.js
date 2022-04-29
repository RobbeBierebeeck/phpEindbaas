document.querySelector(".email").addEventListener("change", () => {
    let mailBoxValue = document.querySelector(".email").value;
    console.log(mailBoxValue);

    let data = new FormData();
    data.append("email", mailBoxValue);

    let textFeedback = document.querySelector(".email-validator");
    let box = document.querySelector(".email");

    if (mailBoxValue.indexOf('@') > -1 && mailBoxValue.indexOf('.thomasmore.be') > -1) {
        fetch(`./scripts/ajax/emailChecker.php`, {
            method: 'POST',
            body: data,
        })
            .then(response => response.json())
            .then((data) => {
                console.log(data.message);

                textFeedback.innerHTML = data.message;

                if (data.message == "this email is already in use") {
                    textFeedback.classList.add("invalid-feedback");
                    textFeedback.style.display = "inline-block";
                    textFeedback.classList.remove("valid-feedback");
                    box.classList.remove("is-valid");
                    box.classList.add("is-invalid");
                }
                if (data.message == "email available") {
                    textFeedback.classList.add("valid-feedback");
                    textFeedback.style.display = "inline-block";
                    textFeedback.classList.remove("invalid-feedback");
                    box.classList.add("is-valid");
                    box.classList.remove("is-invalid");
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    } else {
        textFeedback.classList.add("invalid-feedback");
        textFeedback.style.display = "inline-block";
        textFeedback.innerHTML = "use your Thomas More email for registration";
        box.classList.add("is-invalid");
    }

    if (mailBoxValue.length == 0) {
        console.log("empty")
        textFeedback.style.display = "none";
        textFeedback.classList.remove("invalid-feedback");
        textFeedback.classList.remove("valid-feedback");
        box.classList.remove("is-valid");
        box.classList.remove("is-invalid");
    }
})