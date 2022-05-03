document.querySelector('#like').addEventListener("click", (e)=>{
    e.preventDefault()

    let postId = e.target.dataset.post
    let status = e.target.dataset.status
    let data = new FormData()
    data.append("postId", postId)
    if(status==="like") {
        fetch('ajax/save_like.php', {
            method: 'POST', // or 'PUT'
            body: data,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.querySelector('#like').innerHTML = `<i class="bi bi-heart-fill"></i> Liked`
                    e.target.dataset.status = "liked"
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }else {

        fetch('ajax/delete_like.php', {
            method: 'POST', // or 'PUT'
            body: data,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.querySelector('#like').innerHTML = `<i class="bi bi-heart pe-2"></i> Like`
                    e.target.dataset.status="like"
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });

    }
})