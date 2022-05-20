let comments = document.querySelector(".comments")
document.querySelector("#submitComment").addEventListener("click", e => {
    e.preventDefault();
    // text uitlezen
    let comment = document.querySelector("#comment");
    let postId = e.target.dataset.post;

    // comment toevoegen aan de database
    let data = new FormData();
    data.append("comment", comment.value);
    data.append("postId", postId);

    fetch('ajax/saveComment.php', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(result => {
            let picture = result.data.userData.profile_image
            let name = result.data.userData.firstname
            let lastName = result.data.userData.lastname
            let commentData = result.data.comment
            comment.value = ""

            let comments = document.querySelector("#comments")

            let commentDiv = `
               <div class='card-body border-bottom'>
                                    <div class='d-flex justify-content-between'>
                                        <div class='d-flex flex-row align-items-center'>
                                            <img src=${picture} alt='avatar' width='25' height='25' />
                                            <p class='small mb-0 ms-2'> ${name}</p>
                                        </div>
                                    </div>
                                    <p class='test'>${commentData}</p>
                                </div>`
            console.log(commentDiv)
            //comments.innerHTML += commentDiv
            comments.innerHTML += commentDiv
            /* let commentDiv = document.createElement("div");
             commentDiv.classList.add("card-body border-bottom");

             let commentDiv2 = document.createElement("div");
             commentDiv2.classList.add("d-flex");
             commentDiv2.classList.add("justify-content-between");

             let commentDiv3 = document.createElement("div");
             commentDiv3.classList.add("d-flex");
             commentDiv3.classList.add("flex-row");
             commentDiv3.classList.add("align-items-center");

             let image   = document.createElement("img");
             image.src = picture;
             image.alt = "avatar";
             image.width = 25;
             image.height = 25;

             let nameDiv = document.createElement("p");
             nameDiv.classList.add("small");
             nameDiv.classList.add("mb-0");
             nameDiv.classList.add("ms-2");
             nameDiv.innerHTML = name + " " + lastName;

             let commentDiv4 = document.createElement("p");
             commentDiv4.classList.add("test");
             commentDiv4.innerHTML = comment;

             commentDiv3.appendChild(image);
             commentDiv3.appendChild(nameDiv);

             commentDiv2.appendChild(commentDiv3);


             commentDiv.appendChild(commentDiv2);
             commentDiv.appendChild(commentDiv4);*/


            // comments.appendChild(commentDiv);


            // comment toevoegen aan de pagina
            console.log(picture)
            console.log(name)
            console.log(comment)
            console.log(result);

        }).catch((error) => {
        console.log('Error:', error)
    })

})