<?php
header('Content-Type: application/json');

// Legge i dati JSON inviati dal JavaScript
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Dati non validi']);
    exit;
}

$to = 'servizihorizon@gmail.com';
$subject = 'Nuova Prenotazione Global Tour - ' . $input['packageName'];

$message = "Dettagli Prenotazione:\n\n";
$message .= "Pacchetto: " . $input['packageName'] . "\n";
$message .= "Prezzo Totale: € " . $input['totalPrice'] . "\n";
$message .= "Link Origine (Staff): " . $input['sourceUrl'] . "\n\n";
$message .= "Dati Cliente:\n";
$message .= "Nome: " . $input['nome'] . " " . $input['cognome'] . "\n";
$message .= "Email: " . $input['email'] . "\n";
$message .= "Telefono: " . $input['phone'] . "\n";
$message .= "Data di Nascita: " . $input['dob'] . "\n";
$message .= "Documento: " . $input['doc'] . "\n";
$message .= "Indirizzo: " . $input['address'] . "\n";
$message .= "Note: " . $input['notes'] . "\n";

$headers = 'From: ' . $input['email'] . "\r\n" .
           'Reply-To: ' . $input['email'] . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Invio dell'email tramite il server
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Errore del server durante l\'invio della mail']);
}
?>
