<?php

class Lieferanten
{
    private int $lieferant_id;
    private string $name;
    private string $kontakt;
    private string $adresse;

    /**
     * @param int $lieferant_id
     * @param string $name
     * @param string $kontakt
     * @param string $adresse
     */
    public function __construct(int $lieferant_id, string $name, string $kontakt, string $adresse)
    {
        $this->lieferant_id = $lieferant_id;
        $this->name = $name;
        $this->kontakt = $kontakt;
        $this->adresse = $adresse;
    }

    public function getLieferantId(): int
    {
        return $this->lieferant_id;
    }

    public function setLieferantId(int $lieferant_id): void
    {
        $this->lieferant_id = $lieferant_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getKontakt(): string
    {
        return $this->kontakt;
    }

    public function setKontakt(string $kontakt): void
    {
        $this->kontakt = $kontakt;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }


}