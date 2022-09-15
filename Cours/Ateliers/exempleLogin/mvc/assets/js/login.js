function usernameExist() {

    let username = document.querySelector('#username').value;
    let data = new FormData();
    data.append('username', username);
    fetch('/exempleLogin/mvc/?controller=api&action=userexist', {
        method: 'post',
        body: data
    })
        .then(reponse => {
            if(reponse.ok) {
                console.log("Exite deja");
            }
            else {
                console.log("Exite pas");
            }
        })
}
document.querySelector('#username').addEventListener('blur', usernameExist);