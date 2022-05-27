let modBtn = document.querySelector('.moderatorBtn');

modBtn.addEventListener("click", e => {
    e.preventDefault();

    let data = new FormData();
    data.append("userId", modBtn.dataset.targetUserId);

    fetch(`./ajax/saveModerator.php`, {
        method: 'POST',
        body: data,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            modBtn.innerHTML = data.modStatus;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
})