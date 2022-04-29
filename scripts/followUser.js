let followerBtn = document.querySelector('.followBtn');

followerBtn.addEventListener("click", e => {
    e.preventDefault();

    let data = new FormData();
    if (followerBtn.innerHTML === "follow") {
        data.append("active", 1);
    }
    else if (followerBtn.innerHTML === "following") {
        data.append("active", 0);
    }
    data.append("targetUserId", followerBtn.dataset.targetUserId);
    data.append("sessionUserId", followerBtn.dataset.sessionUserId);

    fetch(`./scripts/ajax/followCheck.php`, {
        method: 'POST',
        body: data,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
})