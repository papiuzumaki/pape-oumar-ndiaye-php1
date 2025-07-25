<?php
require_once '../config/database.php';
require_once '../models/Patient.php';
require_once '../models/Medecin.php';
require_once '../models/RendezVous.php';
require_once '../controllers/PatientController.php';

$patientId = 1;

$action = $_GET['action'] ?? null;

$controller = new PatientController();

if ($action === 'demander') {
    $controller->demanderRendezVous("Dentaire", "2025-08-01 10:00:00", $patientId);
} elseif ($action === 'mesrv') {
    $controller->voirMesRendezVous($patientId);
} elseif ($action === 'annuler' && isset($_GET['id'])) {
    $controller->demanderAnnulation((int)$_GET['id'], $patientId);
} else {
    echo "<h2>Bienvenue</h2>";
    echo "<a href='?action=demander'> Demander un RV</a><br>";
    echo "<a href='?action=mesrv'> Voir mes RV</a>";
}
