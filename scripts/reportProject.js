document.querySelector(".reportProject").addEventListener("click", (e) => {
    e.preventDefault();
    let projectId = e.target.dataset.projectId;
    let data = new FormData()
    console.log(projectId)
    data.append("projectId", projectId)
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

