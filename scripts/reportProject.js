document.querySelector(".reportProject").addEventListener("click", (e) => {
    e.preventDefault();
    let projectId = e.target.dataset.projectId;
    let userId = e.target.dataset.userId;
    let data = new FormData();
    data.append("projectId", projectId);
    data.append("userId", userId);
    fetch('ajax/reportProject.php', {
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

