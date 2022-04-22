document.querySelector("#loadMore").addEventListener("click", (e)=>{
    //text uitlezen
    e.preventDefault()
    console.log("load more")
   /*let postId = 1;
    let comment = document.querySelector("#comment").value*/

    //via Ajax naar de server posten

    fetch('ajax/getPosts.php')
        .then(function(response) {
        return response.json();

    }).then(function(data) {
        console.log(data);
        let posts = data.posts;
        let html = "";
        posts.forEach(post =>{
            let postDiv = document.createElement("div");
            postDiv.classList.add("post");
            postDiv.innerHTML = `
            <div class="post-header">
                <div class="post-header-left">
                    <img src="#" alt="profile-pic">
                </div>
                <div class="post-header-right">
                    <h3>jow</h3>
                    <p>ja</p>
                </div>
            </div>
            <div class="post-body">
                <p>jow</p>
            </div>
            <div class="post-footer">
                <div class="post-footer-left">
                    <i class="far fa-heart"></i>
                    <i class="far fa-comment"></i>
                </div>
                <div class="post-footer-right">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
            </div>
            `;
            document.querySelector("#posts").appendChild(postDiv);
        });


        document.querySelector("#posts").innerHTML = html;
    });

})
