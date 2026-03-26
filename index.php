<?php
include 'includes.php';

// Search customers by name (simple approach)
$zoek = '';
if (isset($_GET['zoek'])) {
    // simple escaping to avoid breaking the query string
    $zoek = $conn->real_escape_string($_GET['zoek']);
}

if ($zoek === '') {
    $result = $conn->query("SELECT * FROM klanten ORDER BY naam ASC LIMIT 100");
} else {
    $result = $conn->query("SELECT * FROM klanten WHERE naam LIKE '%" . $zoek . "%' ORDER BY naam ASC LIMIT 100");
}

// How many customers did we find?
$totaal = $result->num_rows;

// Page title
$title = 'Klantenbeheer';
?>
<?php include 'header.php'; ?>

<section class="py-5 text-center text-white" style="background:#111;">
  <div class="container">
    <h2>Welkom bij Klantenbeheer</h2>
    <p class="lead">Beheer je klanten snel en efficiënt.</p>
  </div>
</section>
<div class="container mt-5">
  <div class="card">
    <div class="card-body">

<h1>Klantenbeheer</h1>
<p class="text-muted">
    <?php 
    // Show the number of customers
    if(isset($_GET['zoek']) && $_GET['zoek'] !== '') {
        echo "Resultaten voor '" . h($_GET['zoek']) . "': " . $totaal;
    } else {
        echo "Aantal klanten: " . $totaal;
    }
    ?>
</p>

<!-- Search form -->
<form method="GET" class="mb-3">
    <input type="text" name="zoek" class="form-control" placeholder="Zoek op naam" 
           value="<?php if(isset($_GET['zoek'])) echo h($_GET['zoek']); ?>">
</form>

<a href="toevoegen.php" class="btn btn-primary mb-3"><i class="bi bi-plus-lg me-1"></i>Nieuwe klant</a>

<!-- Customers table -->
<table class="table table-striped">
<tr>
    <th>Naam</th>
    <th>Adres</th>
    <th>Woonplaats</th>
    <th>Datum toegevoegd</th>
    <th>Acties</th>
</tr>

<?php 
// Loop through all customers from the database
while($row = $result->fetch_assoc()) { 
?>
<tr>
    <td><?php echo h($row['naam']); ?></td>
    <td><?php echo mask_pii($row['adres'], 3); ?></td>
    <td><?php echo mask_pii($row['woonplaats'], 3); ?></td>
    <td><?php echo h($row['datum_toegevoegd']); ?></td>
    <td>
        <!-- Edit customer button -->
        <a href="bewerken.php?id=<?php echo h($row['id']); ?>" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i>
        </a>
        <!-- Delete customer button -->
        <a href="verwijderen.php?id=<?php echo h($row['id']); ?>" 
           onclick="return confirm('Weet je zeker dat je deze klant wilt verwijderen?')"
           class="btn btn-danger btn-sm">
            <i class="bi bi-trash"></i>
        </a>
    </td>
</tr>
<?php 
} 
?>

</table>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>