let modBtn = document.querySelector('.moderatorBtn');

modBtn.addEventListener("click", e => {
    e.preventDefault();
    let data = new FormData();
    if (modBtn.innerHTML === "set moderator") {
        data.append("role", "Moderator");
    }
    else if (modBtn.innerHTML === "remove from moderation") {
        data.append("role", "User");
    }
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