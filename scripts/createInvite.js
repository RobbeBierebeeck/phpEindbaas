document.querySelector("#createLink").addEventListener("click", (e) => {
    e.preventDefault();

    let code = document.querySelector("#code").value;
    console.log(code);

    let data = new FormData();
    data.append("code", code);

    fetch(`./ajax/createInvite.php`, {
        method: 'POST',
        body: data,
    })
        .then(response => response.json())
        .then((data) => {
            console.log(data);

            let link = document.createElement("p");
            link.innerHTML = `here is your unique invite link: ${data.link}`;
            document.querySelector(".table-responsive").appendChild(link);

        })
        .catch((error) => {
            console.error('Error:', error);
        });

})