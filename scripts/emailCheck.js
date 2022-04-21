document.querySelector(".email").addEventListener("change", () => {
    let mailBoxValue = document.querySelector(".email").value;

    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = () => {
        responseObject = xmlhttp.responseText;
        console.log(responseObject);
    }
    xmlhttp.open("GET", "./scripts/ajax/emailChecker.php?q=" + mailBoxValue);
    xmlhttp.send();
})