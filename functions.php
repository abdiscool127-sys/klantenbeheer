<?php
// Helper functions used across the application

// Escape a string for safe HTML output (prevents XSS)
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Mask personal data (PII) for display to help GDPR / AVG compliance.
// Shows the first N characters and replaces the rest with asterisks.
function mask_pii($value, $visible = 2) {
    $value = (string) $value;
    $len = strlen($value);
    if ($len <= $visible) return str_repeat('*', $len);
    return substr($value, 0, $visible) . str_repeat('*', $len - $visible);
}
?>
