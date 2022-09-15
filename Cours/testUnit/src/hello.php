<?php
/**
 * @var $error string
 * @var $products []product
 */

?>

<input id="text"/>
<button id="btn">Générer</button>
<br>
<img id="img" src="gd.php?text=Cegep" width='500px' height='500px'>
<script>
    document.querySelector('#btn').addEventListener('click', e => {
        let img = document.querySelector('#img');
        let txt = document.querySelector('#text');
        img.setAttribute('src', '/src/gd.php?text=' + txt.value + '&d=' + new Date().getTime());
    });
</script>