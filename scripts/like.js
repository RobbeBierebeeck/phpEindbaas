document.querySelector('#like').addEventListener("click", (e)=>{
    e.preventDefault()
    let postId = e.target.dataset.post
    let data = new FormData()
    data.append("postId", postId)

    fetch('ajax/save_like.php', {
        method: 'POST', // or 'PUT'
        body: data,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success'){
                document.querySelector('#like').innerHTML = `<i class="bi bi-heart-fill"></i> Liked`
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
})