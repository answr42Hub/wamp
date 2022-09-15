<?php

namespace controllers;
use models\articles;
use models\transactions;
use repositories\userrepository;
use repositories\storerepository;
use Stripe\Exception\ApiErrorException;

class storecontroller
{
    function home() {

        $storeRepo = new storerepository();
        $articles = $storeRepo->getAllArticles();

        if($articles) {
            $_SESSION['articles'] = $articles;
        }

        // if a user is connected
        if(isset($_SESSION["user"])) {
            session_regenerate_id(true);//a regenerer tous les X min.
            require __DIR__ . "/../views/store/connected_home.php";
            die();
        }
        // if the user is remembered
        elseif(isset($_COOKIE['remember'])) {
            session_regenerate_id(true);
            $token = $_COOKIE['remember'];
            unset($_SESSION['user']);
            session_destroy();
            $_SESSION = [];
            session_start();
            $userRepo = new userrepository();
            $user = $userRepo->getOne($token);
            if($user) {
                if($user->expremember - time() > 0) {
                    $_SESSION['user'] = $user;
                }
            }
            header('Location: ' . HOME_PATH . '/store/home');
            die();
        }
        require __DIR__ . "/../views/store/home.php";
    }

    function add() {
        if(!empty($_SESSION['csrf']) && !empty($_POST['csrf'])) {
            if($_SESSION['csrf'] == $_POST['csrf']) {
                if(isset($_POST['name'])) {
                    if(isset($_POST['desc'])) {
                        if(isset($_POST['price'])) {
                            if(!empty($_FILES['img'])) {
                                if(mime_content_type($_FILES['img']['tmp_name']) == 'image/jpeg' &&
                                    str_ends_with($_FILES['img']['name'], '.jpg') ||
                                    str_ends_with($_FILES['img']['name'], '.jpeg') ||
                                    mime_content_type($_FILES['img']['tmp_name']) == 'image/png' &&
                                    str_ends_with($_FILES['img']['name'], '.png')) {

                                    $img = imagecreatefromstring(file_get_contents($_FILES['img']['tmp_name']));

                                    $width = imagesx($img);
                                    $height = imagesy($img);
                                    $newimg = imagecreatetruecolor(500, 500);
                                    $offset = ($width - $height) / 2;
                                    imagecopyresized($newimg, $img, 0, 0, $offset, 0, 500, 500, $height, $height);

                                    $fontsize = 80;
                                    $font = __DIR__ . '/../assets/img/Paul-le1V.ttf';

                                    $text = 'DRUM !!';
                                    $offset = 150;
                                    list($x1, $y1, $x2, $y2) = imageftbbox($fontsize, 0, $font, $text);
                                    imagefttext($newimg, $fontsize, 15, 500 - $x2 - $offset, $fontsize + $offset, 0, $font, $text);
                                    if (mime_content_type($_FILES['img']['tmp_name']) == 'image/png')
                                        imagepng($newimg, __DIR__ . '/../assets/img/' . $_FILES['img']['name'], 1);
                                    else
                                        imagejpeg($newimg, __DIR__ . '/../assets/img/' . $_FILES['img']['name'], 90);

                                    $strimg = $_FILES['img']['name'];
                                    $name = $_POST['name'];
                                    $desc = $_POST['desc'];
                                    $price = $_POST['price'];
                                    $user = $_SESSION['user'];

                                    $storeRepo = new storerepository();
                                    $article = new articles();
                                    $article->name = $name;
                                    $article->desc = $desc;
                                    $article->price = $price;
                                    $article->image = $strimg;
                                    $article->seller = $user->id;
                                    $storeRepo->addArticle($article);

                                    $successMsg = "Votre article a été ajouter !";
                                }
                                else {
                                    $errorMsg = "L'image n'est pas valide !";
                                }
                            }
                            else {
                                $errorMsg = "Ajoutez une image !";
                            }
                        }
                        else {
                            $errorMsg = "Entrez un prix !";
                        }
                    }
                    else {
                        $errorMsg = "Entrez une description !";
                    }
                }
                else {
                    $errorMsg = "Entrez un nom d'article !";
                }
            }
            else {
                $this->error();
                die();
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "addarticle");
        require __DIR__ . "/../views/store/addarticle.php";
    }

    function edit() {
        if(!empty($_GET['articleid'])) {
            $storeRepo = new storerepository();
            $article = $storeRepo->getOne($_GET['articleid']);
            if(!empty($_SESSION['csrf']) && !empty($_POST['csrf'])) {
                if($_SESSION['csrf'] == $_POST['csrf']) {
                    if(isset($_POST['name'])) {
                        if(isset($_POST['desc'])) {
                            if(isset($_POST['price'])) {
                                if(!empty($_FILES['img']['tmp_name'])) {
                                    if(mime_content_type($_FILES['img']['tmp_name']) == 'image/jpeg' &&
                                        str_ends_with($_FILES['img']['name'], '.jpg') ||
                                        str_ends_with($_FILES['img']['name'], '.jpeg') ||
                                        mime_content_type($_FILES['img']['tmp_name']) == 'image/png' &&
                                        str_ends_with($_FILES['img']['name'], '.png')) {

                                        $img = imagecreatefromstring(file_get_contents($_FILES['img']['tmp_name']));

                                        $width = imagesx($img);
                                        $height = imagesy($img);
                                        $newimg = imagecreatetruecolor(500, 500);
                                        $offset = ($width - $height) / 2;
                                        imagecopyresized($newimg, $img, 0, 0, $offset, 0, 500, 500, $height, $height);

                                        $fontsize = 80;
                                        $font = __DIR__ . '/../assets/img/Paul-le1V.ttf';

                                        $text = 'DRUM !!';
                                        $offset = 150;
                                        list($x1, $y1, $x2, $y2) = imageftbbox($fontsize, 0, $font, $text);
                                        imagefttext($newimg, $fontsize, 15, 500 - $x2 - $offset, $fontsize + $offset, 0, $font, $text);
                                        if (mime_content_type($_FILES['img']['tmp_name']) == 'image/png')
                                            imagepng($newimg, __DIR__ . '/../assets/img/' . $_FILES['img']['name'], 1);
                                        else
                                            imagejpeg($newimg, __DIR__ . '/../assets/img/' . $_FILES['img']['name'], 90);
                                        $strimg = $_FILES['img']['name'];
                                        $article->image = $strimg;
                                    }
                                    else {
                                        $errorMsg = "L'image n'est pas valide !";
                                    }
                                }
                                $name = $_POST['name'];
                                $desc = $_POST['desc'];
                                $price = $_POST['price'];
                                $user = $_SESSION['user'];
                                $article->name = $name;
                                $article->desc = $desc;
                                $article->price = $price;
                                $article->seller = $user->id;
                                $storeRepo->editArticle($article);

                                $successMsg = "Votre article a été modifié !";
                            }
                            else {
                                $errorMsg = "Entrez un prix !";
                            }
                        }
                        else {
                            $errorMsg = "Entrez une description !";
                        }
                    }
                    else {
                        $errorMsg = "Entrez un nom d'article !";
                    }
                }
                else {
                    $this->error();
                    die();
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "editarticle");
        require __DIR__ . "/../views/store/editarticle.php";
    }

    function buy() {
        if(!empty($_GET['articleid'])) {
            $storeRepo = new storerepository();
            $article = $storeRepo->getOne($_GET['articleid']);
            $valid = true;
            if(!empty($_SESSION['csrf']) && !empty($_POST['csrf'])) {
                if($_SESSION['csrf'] == $_POST['csrf']) {
                    if(empty($_POST['name']) || empty($_POST['adress']) || empty($_POST['city']) ||
                        empty($_POST['zipcode']) || empty($_POST['country']) || empty($_POST['cardnum']) ||
                        empty($_POST['mthexp']) || empty($_POST['yrexp']) || empty($_POST['cvv'])) {
                        $errorMsg = "Une erreur est survenue, veillez à remplir tous les champs correctement.";
                    }
                    else {
                        $user = $_SESSION['user'];
                        $fullname = $_POST['name'];
                        $adress = $_POST['adress'];
                        $city = $_POST['city'];
                        $zip = $_POST['zipcode'];
                        $country = $_POST['country'];
                        $card = $_POST['cardnum'];
                        $mthexp = $_POST['mthexp'];
                        $yrexp = $_POST['yrexp'];
                        $cvv = $_POST['cvv'];
                        //real price
                        $price = ($article->price)*1.14975;
                        $numfact = $user->id*1000000 + rand(1000, 9999);
                        //TODO make the transaction with stripe
                        try {
                            $stripe = new \Stripe\StripeClient("sk_test_51Kz2EqLroMkRydhedvthkBM4s2PVDoK2m7FPx0Rv8MyayVSNyRXcKcQ5C1Lyn096ziUV77vSwBAYLsamEkD3qYnB00VRclex7t");
                            $payment = $stripe->paymentMethods->create([
                                'type' => 'card',
                                'card' => [
                                    'number' => $card,
                                    'exp_month' => $mthexp,
                                    'exp_year' => $yrexp,
                                    'cvc' => $cvv,
                                ]
                            ]);
                            $intent = $stripe->paymentIntents->create([
                                'amount' => intval($price * 100),                // Montant en sous
                                'currency' => 'cad',             // Devise
                                'confirm' => true,               // On facture immédiatement
                                'description' => 'Facture #' . $numfact . ' pour ' . $user->username,    // Description de la transaction dans notre dashboard stripe
                                'payment_method' => $payment->id // ID de la carte inséré précédement
                            ]);
                            $paymentid = $intent->id;
                        }
                        catch(\Stripe\Exception\CardException $e) {
                            $errorMsg = "Votre carte n'est pas valide !";
                            $valid = false;
                        }
                        catch (\Stripe\Exception\InvalidRequestException $e) {
                            $errorMsg = "Une erreur est survenue lors du paiement !";
                            $valid = false;
                        }
                        if($valid) {
                            $transaction = new transactions();
                            $transaction->paymentid = $paymentid;
                            $transaction->usercustomer = $user->id;
                            $transaction->userseller = $article->seller;
                            $transaction->article = $article->id;
                            $transaction->price = $price;
                            $transaction->numfact = $numfact;
                            $transaction->status = true;
                            $transaction->datepayment = time();
                            $storeRepo->addTransaction($transaction);
                            $article->sold = 1;
                            $storeRepo->editArticle($article);

                            $successMsg = "Transaction terminée !";
                        }
                    }
                }
                else {
                    $this->error();
                    die();
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "buyarticle");
        require __DIR__ . '/../views/store/buyarticle.php';
    }

    function refund() {
        if(!empty($_GET['articleid'])) {
            $storeRepo = new storerepository();
            $article = $storeRepo->getOne($_GET['articleid']);
            $user = $_SESSION['user'];
            $valid = true;
            if(!empty($_SESSION['csrf']) && !empty($_POST['csrf'])) {
                if ($_SESSION['csrf'] == $_POST['csrf']) {
                    $trans = $storeRepo->getMyTransaction($article->id, $user->id);
                    if($trans) {
                        try {
                            $stripe = new \Stripe\StripeClient("sk_test_51Kz2EqLroMkRydhedvthkBM4s2PVDoK2m7FPx0Rv8MyayVSNyRXcKcQ5C1Lyn096ziUV77vSwBAYLsamEkD3qYnB00VRclex7t");
                            $refund = $stripe->refunds->create([
                                'payment_intent' => $trans->paymentid,
                            ]);
                        } catch (ApiErrorException $e) {
                            $errorMsg = "Une erreur est survenu.";
                            $valid = false;
                        }
                        if($valid) {
                            $article->sold = 0;
                            $storeRepo->editArticle($article);
                            $storeRepo->cancelTransaction($trans->id);
                        }
                    }
                    else {
                        $errorMsg = "Cette transaction n'existe pas !";
                    }
                }
                else {
                    $this->error();
                    die();
                }
            }
        }
        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "editarticle");
        require __DIR__ . "/../views/store/refund.php";
    }

    function error() {
        require __DIR__ . '/../views/404.php';
    }
}