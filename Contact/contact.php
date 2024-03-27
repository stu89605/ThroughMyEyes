<?php
// Verbinding maken met de database (vereist een actieve databaseverbinding)
$servername = "localhost"; // verander dit naar jouw database hostnaam
$username = "ftp089605"; // verander dit naar jouw database gebruikersnaam
$password = "Uukiavr2303!"; // verander dit naar jouw database wachtwoord
$dbname = "fotogalerij"; // verander dit naar de naam van jouw database

// Verbinding maken met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleren op fouten in de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verwerken van het formulier wanneer het wordt ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de ingevulde formuliergegevens
    $voornaam = $_POST["voornaam"];
    $achternaam = $_POST["achternaam"];
    $onderwerp = $_POST["onderwerp"];
    $email = $_POST["email"];
    $telefoon = $_POST["telefoon"];
    $bericht = $_POST["bericht"];

    // Voeg de gegevens toe aan de database
    $sql = "INSERT INTO contact_form (voornaam, achternaam, onderwerp, email, telefoon, bericht) 
            VALUES ('$voornaam', '$achternaam', '$onderwerp', '$email', '$telefoon', '$bericht')";

    if ($conn->query($sql) === TRUE) {
        // Verstuur de e-mail
        $to = "urosgucul@gmail.com"; // verander dit naar jouw e-mailadres
        $subject = "Nieuw contactformulier ingediend";
        $message = "Een nieuw contactformulier is ingediend:\n\nNaam: $voornaam $achternaam\nOnderwerp: $onderwerp\nE-mail: $email\nTelefoon: $telefoon\nBericht: $bericht";
        $headers = "From: $email";

        mail($to, $subject, $message, $headers);

        echo "Bedankt voor het indienen van het formulier. We zullen zo snel mogelijk contact met je opnemen.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Sluit de databaseverbinding
    $conn->close();
}
?>
