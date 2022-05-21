document.querySelector(".warningLink").addEventListener("click", (e) => {
    e.preventDefault();
    document.querySelector(".warningAlert").classList.add("hidden");
    let userId = e.target.dataset.userId;
    let data = new FormData()
    data.append("userId", userId)

    fetch('ajax/dismissWarning.php', {
        method: 'POST', // or 'PUT'
        body: data,
    })
        .then(response => response.json())
        .then(data => {

            console.log(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });

});
