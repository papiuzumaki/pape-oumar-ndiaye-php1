<?php
class PatientController {
    public function demanderRendezVous(string $specialite, string $date, int $patientId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM medecin WHERE specialite = ? LIMIT 1");
        $stmt->execute([$specialite]);
        $medecin = $stmt->fetch();

        if ($medecin) {
            $stmt = $db->prepare("INSERT INTO rendez_vous (patient_id, medecin_id, date, statut)
                                  VALUES (?, ?, ?, 'en_attente')");
            $stmt->execute([$patientId, $medecin['id'], $date]);
            echo "Rendez-vous demandé.";
        } else {
            echo "Aucun médecin disponible.";
        }
    }

    public function voirMesRendezVous(int $patientId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM rendez_vous WHERE patient_id = ?");
        $stmt->execute([$patientId]);
        $rows = $stmt->fetchAll();

        $rvs = [];
        foreach ($rows as $row) {
            $rvs[] = RendezVous::toRendezVous($row);
        }

        include '../views/patient/mes_rv.php';
    }

    public function demanderAnnulation(int $idRv, int $patientId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM rendez_vous WHERE id = ? AND patient_id = ?");
        $stmt->execute([$idRv, $patientId]);
        $row = $stmt->fetch();

        if ($row) {
            $dateRv = new DateTime($row['date']);
            $now = new DateTime();
            $diff = $now->diff($dateRv);
            if ($diff->days >= 2 && $now < $dateRv) {
                $stmt = $db->prepare("UPDATE rendez_vous SET statut = 'annulation_demandee' WHERE id = ?");
                $stmt->execute([$idRv]);
                echo "Demande d'annulation envoyée.";
            } else {
                echo "Impossible : moins de 48h avant le rendez-vous.";
            }
        }
    }
}
