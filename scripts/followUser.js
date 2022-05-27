let followerBtn = document.querySelector('.followBtn');

followerBtn.addEventListener("click", e => {
    e.preventDefault();

    let data = new FormData();
    data.append("targetUserId", followerBtn.dataset.targetUserId);

    fetch(`./ajax/followCheck.php`, {
        method: 'POST',
        body: data,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            followerBtn.innerHTML = data.followStatus;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
})