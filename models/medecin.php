<?php
class Medecin {
    private int $id;
    private string $nom;
    private string $specialite;

    public function getId(): int { return $this->id; }
    public function setId(int $id): Medecin { $this->id = $id; return $this; }

    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): Medecin { $this->nom = $nom; return $this; }

    public function getSpecialite(): string { return $this->specialite; }
    public function setSpecialite(string $specialite): Medecin { $this->specialite = $specialite; return $this; }
}
