<?php
// Allow CORS so frontend (e.g., GitHub Pages) can call this
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// Set content type to JSON for output
header('Content-Type: application/json');

// PayU merchant key and salt
$key = "b1n0dl";  // Replace with your PayU Key
$salt = "g13SQQHh2IOLuI6bPBjrobBbO0Qi9b6i";    // Replace with your PayU Salt

// Read POST data (e.g., from fetch in JavaScript)
$data = json_decode(file_get_contents("php://input"), true);

// Extract values from request
$txnid     = $data['txnid'];
$amount    = $data['amount'];
$productinfo = $data['productinfo'];
$firstname = $data['firstname'];
$email     = $data['email'];
$udf1 = $data['udf1'] ?? '';
$udf2 = $data['udf2'] ?? '';
$udf3 = $data['udf3'] ?? '';
$udf4 = $data['udf4'] ?? '';
$udf5 = $data['udf5'] ?? '';

// Format as required by PayU
$hash_string = "$key|$txnid|$amount|$productinfo|$firstname|$email|$udf1|$udf2|$udf3|$udf4|$udf5||||||$salt";

// Create SHA512 hash
$hash = hash("sha512", $hash_string);

// Respond with the hash
echo json_encode([
    "success" => true,
    "hash" => $hash
]);
?>
