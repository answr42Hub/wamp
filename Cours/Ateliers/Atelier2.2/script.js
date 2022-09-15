document.querySelector('form').addEventListener('submit', e=> {
    e.preventDefault();
    let nb1 = document.querySelector('#nb1').value;
    let nb2 = document.querySelector('#nb2').value;
    let data = new FormData();
    data.append('nb1', nb1);
    data.append('nb2', nb2);
    fetch('api.php', {
        method: 'post',
        body: data
    })
        .then(response => {

            if (response.ok) {
                response.json().then(ar => {
                    document.querySelector('#ppcm').value = ar[1];
                    document.querySelector('#pgcd').value = ar[0];
                })
            } else {
                alert("Entrez des nombres !");
            }
        })
})