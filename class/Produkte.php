<?php

class Produkte
{
    public int $product_id;

    public string $name;
    public int $kategorien;
    public int $menge;
    public int $lieferant_id;

    /**
     * @param int $product_id
     * @param string $name
     * @param int $kategorien
     * @param int $menge
     * @param int $lieferant_id
     */
    public function __construct(int $product_id, string $name, int $kategorien, int $menge, int $lieferant_id)
    {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->kategorien = $kategorien;
        $this->menge = $menge;
        $this->lieferant_id = $lieferant_id;
    }



}