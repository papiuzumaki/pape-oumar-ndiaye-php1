<?php
class Patient {
    private int $id;
    private string $nom;
    private string $email;

    public function getId(): int { return $this->id; }
    public function setId(int $id): Patient { $this->id = $id; return $this; }

    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): Patient { $this->nom = $nom; return $this; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): Patient { $this->email = $email; return $this; }

    public static function toPatient(array $row): Patient {
        $p = new Patient();
        $p->setId($row['id']);
        $p->setNom($row['nom']);
        $p->setEmail($row['email']);
        return $p;
    }
}
