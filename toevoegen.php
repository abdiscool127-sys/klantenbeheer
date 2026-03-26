<?php
include 'includes.php';

// When user clicks 'Save'
if(isset($_POST['opslaan'])){

    // Get form data
    $naam = trim($_POST['naam']);
    $adres = trim($_POST['adres']);
    $woonplaats = trim($_POST['woonplaats']);

    // Basic validation
    if(empty($naam) || empty($adres) || empty($woonplaats)){
        $error = "Please fill in all fields.";
    } else {
        // INSERT new customer into database
        $conn->query("INSERT INTO klanten (naam, adres, woonplaats) VALUES ('" . $conn->real_escape_string($naam) . "', '" . $conn->real_escape_string($adres) . "', '" . $conn->real_escape_string($woonplaats) . "')");

        // Redirect back to overview
        header("Location: index.php");
        exit();
    }
}

$title = 'New customer';
?>
<?php include 'header.php'; ?>

<div class="container mt-5">
  <div class="card">
    <div class="card-body">

<h2>Nieuwe klant toevoegen</h2>

<!-- Show error message if something goes wrong -->
<?php 
if(isset($error)) {
    echo "<div class='alert alert-danger'>" . $error . "</div>";
}
?>

<!-- Form to add a new customer -->
<form method="POST">
    <input type="text" name="naam" class="form-control mb-2" placeholder="Naam">
    <input type="text" name="adres" class="form-control mb-2" placeholder="Adres">
    <input type="text" name="woonplaats" class="form-control mb-2" placeholder="Woonplaats">
    <button type="submit" name="opslaan" class="btn btn-success"><i class="bi bi-save me-1"></i>Opslaan</button>
    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Terug</a>
</form>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>