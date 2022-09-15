<?php
function PGCD(int $nb1, int $nb2): int {
    $greatest = max($nb1, $nb2);
    $lowest = min($nb2, $nb1);
    $div = $lowest;
    while ($div) {
        if (!($lowest % $div) && !($greatest % $div)) {
            return $div;
        } else {
            $div--;
        }
    }
    return 0;
}
function PPCM(int $nb1, int $nb2): int {
    $m1 = 1;
    $m2 = 1;
    while($nb1*$m1 != $nb2*$m2) {
        if($nb1*$m1 < $nb2*$m2)
            $m1++;
        else
            $m2++;
    }
    return $nb1*$m1;
}

if(isset($_POST['nb1']) && isset($_POST['nb2'])) {
    $nb1 = $_POST['nb1'];
    $nb2 = $_POST['nb2'];
    if(is_numeric($nb1) && is_numeric($nb2)){
        http_response_code(200);
        $response =  array(PGCD($nb1, $nb2), PPCM($nb1, $nb2));
        echo json_encode($response);
    }
    else
        http_response_code(400);
}
