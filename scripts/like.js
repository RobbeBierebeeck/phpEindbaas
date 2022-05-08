
document.querySelectorAll(".like").forEach((e)=>{
    e.addEventListener(("click"),(e)=> {
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
                    if (data.status === 'success') {
                        let likes =  e.target.nextElementSibling.children[0].children[1]
                        if(data.like === 1){
                            e.target.innerHTML = `<i class="bi bi-heart-fill"></i>  Liked`


                            likes.innerText = parseInt(likes.innerText) + 1
                        }
                        else{
                            e.target.innerHTML = `<i class="bi bi-heart"></i>  Like`
                            likes.innerText = parseInt(likes.innerText) - 1

                        }

                        console.log(data)
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

    });
})

