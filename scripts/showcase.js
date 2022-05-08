document.querySelector('#showcase').addEventListener('click', (e) => {

    let postId = e.target.dataset.post
    let data = new FormData()
    data.append("postId", postId)

    fetch('ajax/save_showcase.php', {
        method: 'POST', // or 'PUT'
        body: data,
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
               if (data.showcase == 1) {
                    document.querySelector('#showcase').innerHTML = 'remove from showcase'
                } else {
                    document.querySelector('#showcase').innerHTML = 'add to showcase'
                }
                console.log(data)
            }


        })
        .catch((error) => {
            console.error('Error:', error);
        });

});