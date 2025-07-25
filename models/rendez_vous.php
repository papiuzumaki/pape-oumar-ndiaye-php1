<?php
class RendezVous {
    private int $id;
    private DateTime $date;
    private string $statut;
    private int $patientId;
    private int $medecinId;

    public function getId(): int { return $this->id; }
    public function setId(int $id): RendezVous { $this->id = $id; return $this; }

    public function getDate(): DateTime { return $this->date; }
    public function setDate(DateTime $date): RendezVous { $this->date = $date; return $this; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $statut): RendezVous { $this->statut = $statut; return $this; }

    public function getPatientId(): int { return $this->patientId; }
    public function setPatientId(int $id): RendezVous { $this->patientId = $id; return $this; }

    public function getMedecinId(): int { return $this->medecinId; }
    public function setMedecinId(int $id): RendezVous { $this->medecinId = $id; return $this; }

    public static function toRendezVous(array $row): RendezVous {
        $rv = new RendezVous();
        $rv->setId($row['id']);
        $rv->setDate(new DateTime($row['date']));
        $rv->setStatut($row['statut']);
        $rv->setPatientId($row['patient_id']);
        $rv->setMedecinId($row['medecin_id']);
        return $rv;
    }
}
