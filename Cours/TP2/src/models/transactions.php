<?php

namespace models;

class transactions
{
    public int $id;
    public string $paymentid;
    public int $numfact;
    public int $usercustomer;
    public int $userseller;
    public int $article;
    public float $price;
    public bool $status;
    public int $datepayment;
}