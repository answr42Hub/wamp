document.getElementById('attack').addEventListener('click', function() {
    fetch('/1409427/game/attack')
        .then(response =>{
            if(response.ok) {
                return response.json()
                    .then(data =>{
                        document.querySelector('#enemyhp').innerText = data['current'];
                        document.querySelector('#events').append(document.createElement('p').innerText = data['message'] + " L'ennemi perd " + data['damage'] + ' hp');
                        document.querySelector('#events').append(document.createElement('br'));
                        document.querySelector('#events').append(document.createElement('br'));
                        if(data['damage']) {
                            let dice = Math.floor(Math.random()*(11) + 1)
                            if(dice > 6) {
                                passive();
                            }
                        }
                        if(!data['endfight']) {
                            handle();
                        }
                        else {
                            document.querySelector('#attack').disabled = true;
                            document.querySelector('#special').disabled = true;
                            document.querySelector("#winner").classList.remove('d-none');
                        }

                    });
            }
        })
});

document.getElementById('special').addEventListener('click', function() {
    fetch('/1409427/game/special')
        .then(response => {
            if (response.ok) {
                return response.json()
                    .then(data => {

                        document.querySelector('#enemyhp').innerText = data['currenten'];
                        document.querySelector('#herohp').innerText = data['currenthero'];
                        document.querySelector('#events').append(document.createElement('p').innerText = data['message'] + " L'ennemi perd " + data['damage'] + ' hp');
                        document.querySelector('#events').append(document.createElement('br'));
                        document.querySelector('#events').append(document.createElement('br'));

                        if(!data['specleft']) {
                            document.querySelector('#special').disabled = true;
                        }

                        if(!data['endfight']) {
                            handle();
                        }
                        else {
                            document.querySelector('#attack').disabled = true;
                            document.querySelector('#special').disabled = true;
                            document.querySelector("#winner").classList.remove('d-none');
                        }

                })
            }
        })
});

function handle() {
    fetch('/1409427/game/handle')
        .then(response =>{
            if(response.ok) {
                return response.json()
                    .then(data =>{
                        document.querySelector('#herohp').innerText = data['current'];
                        document.querySelector('#events').append(document.createElement('p').innerText = data['message'] + " Vous perdez " + data['damage'] + ' hp')
                        document.querySelector('#events').append(document.createElement('br'));
                        document.querySelector('#events').append(document.createElement('br'));

                        if(data['endfight']) {
                            document.querySelector('#attack').disabled = true;
                            document.querySelector('#special').disabled = true;
                            document.querySelector("#loser").classList.remove('d-none');
                        }
                    });
            }
        })
}

function passive() {
    fetch('/1409427/game/passive')
        .then(response => {
            if (response.ok) {
                return response.json()
                    .then(data => {
                        document.querySelector('#herohp').innerText = data['current'];
                        document.querySelector('#events').append(document.createElement('p').innerText = data['message']);
                        document.querySelector('#events').append(document.createElement('br'));
                        document.querySelector('#events').append(document.createElement('br'));

                        if(data['endfight']) {
                            document.querySelector('#attack').disabled = true;
                            document.querySelector('#special').disabled = true;
                            document.querySelector("#winner").classList.remove('d-none');
                        }
                    })
            }
        })
}
