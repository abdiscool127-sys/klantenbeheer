<?php
include 'includes.php';

// Get customer ID from URL
$id = $_GET['id'];

// Retrieve this customer's data (use WHERE and LIMIT)
$result = $conn->query("SELECT * FROM klanten WHERE id=" . intval($id) . " LIMIT 1");
$klant = $result->fetch_assoc();

// When user clicks 'Update'
if(isset($_POST['update'])){
    // Get updated values from form
    $naam = trim($_POST['naam']);
    $adres = trim($_POST['adres']);
    $woonplaats = trim($_POST['woonplaats']);

    // Basic validation
    if(empty($naam) || empty($adres) || empty($woonplaats)){
        $error = "Please fill in all fields.";
    } else {
        // UPDATE the customer in the database
        $conn->query("UPDATE klanten SET naam='" . $conn->real_escape_string($naam) . "', adres='" . $conn->real_escape_string($adres) . "', woonplaats='" . $conn->real_escape_string($woonplaats) . "' WHERE id=" . intval($id));

        // Redirect back to overview
        header("Location: index.php");
        exit();
    }
}

$title = 'Edit customer';
?>
<?php include 'header.php'; ?>

<div class="container mt-5">
  <div class="card">
    <div class="card-body">

<h2>Klant bewerken</h2>

<!-- Show error message if something goes wrong -->
<?php 
if(isset($error)) {
    echo "<div class='alert alert-danger'>" . $error . "</div>";
}
?>

<!-- Form to edit customer details -->
<form method="POST">
    <input type="text" name="naam" class="form-control mb-2" value="<?php echo h($klant['naam']); ?>">
    <input type="text" name="adres" class="form-control mb-2" value="<?php echo h($klant['adres']); ?>">
    <input type="text" name="woonplaats" class="form-control mb-2" value="<?php echo h($klant['woonplaats']); ?>">
    <button type="submit" name="update" class="btn btn-success"><i class="bi bi-pencil-square me-1"></i>Bijwerken</button>
    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Terug</a>
</form>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>