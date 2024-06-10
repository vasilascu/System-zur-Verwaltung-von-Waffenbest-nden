<?php

class Bestellungen
{
    public int $bestell_id;
    public DateTime $bestelldatum;
    public int $menge;
    public int $product_id;

    /**
     * @param int $bestell_id
     * @param Date $bestelldatum
     * @param int $menge
     * @param int $product_id
     */
    public function __construct(int $bestell_id, Date $bestelldatum, int $menge, int $product_id)
    {
        $this->bestell_id = $bestell_id;
        $this->bestelldatum = $bestelldatum;
        $this->menge = $menge;
        $this->product_id = $product_id;
    }

    public function getBestellId(): int
    {
        return $this->bestell_id;
    }

    public function setBestellId(int $bestell_id): void
    {
        $this->bestell_id = $bestell_id;
    }

    public function getBestelldatum(): Date
    {
        return $this->bestelldatum;
    }

    public function setBestelldatum(Date $bestelldatum): void
    {
        $this->bestelldatum = $bestelldatum;
    }

    public function getMenge(): int
    {
        return $this->menge;
    }

    public function setMenge(int $menge): void
    {
        $this->menge = $menge;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }



}