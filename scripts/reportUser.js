document.querySelector('#report').addEventListener('click', (e) => {

    let userId = e.target.dataset.userid;
    console.log(userId);
  let data = new FormData()
    data.append("userId", userId)

    fetch('ajax/report_user.php', {
        method: 'POST', // or 'PUT'
        body: data,
    })
        .then(response => response.json())
        .then(data => {
            if(data.status = "success"){
               console.log(data.message);
               document.querySelector('#reportButton').style.display = "none";

                let messageDiv = document.createElement('div');
                messageDiv.innerHTML = "you reported this user";
                messageDiv.classList.add('alert');
                messageDiv.classList.add('alert-success');
                messageDiv.style.position= 'static';
                messageDiv.classList.add("mt-3");

                document.querySelector("#container").prepend(messageDiv);

            }



        })
        .catch((error) => {
            console.error('Error:', error);
        });

});