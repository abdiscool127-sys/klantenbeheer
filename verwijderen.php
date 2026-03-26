<?php
include 'includes.php';

// Get customer ID from URL
$id = intval($_GET['id']);

// DELETE this customer from the database (CRUD: Delete)
$conn->query("DELETE FROM klanten WHERE id=" . $id);

// Redirect back to overview
header("Location: index.php");
exit();
?>