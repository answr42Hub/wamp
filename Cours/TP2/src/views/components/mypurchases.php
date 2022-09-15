<?php
if(!empty($_SESSION['purchases'])) {
    $articles = $_SESSION['purchases'];
    foreach ($articles as $article) {
        if($article->sold) {
            echo "
        
        <div class='card mx-3 my-3 col-sm-6 col-md-4 col-lg-2' style='width: 18rem;'>
            <img src='" . HOME_PATH . "/src/assets/img/" . $article->image . "' class='card-img-top' alt=''>
            <div class='card-body'>
                <h5 class='card-title>Card'>" . $article->name . "</h5>
                <p class='card-text'>" . $article->desc . "</p>
                <p class='card-text'><b>" . $article->price . " $</b></p>
                <p>Mise en vente le " . date('Y-m-d', $article->creationdate) . "</p>
                <div class='btn-group'>
                    <a href='" . HOME_PATH . "/store/refund?articleid=" . $article->id . "' class='btn btn-primary'>Rembourser</a>
                </div>
            </div>
        </div>
        
    ";
        }
    }
}
else {
    echo "

    <div>
        <p>Vous n'avez rien acheté ;(...</p>
    </div>

";
}
