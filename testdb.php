<?php
echo "<h3>PostgreSQL PDO Test</h3>";

// Check available PDO drivers
$drivers = PDO::getAvailableDrivers();
echo "<pre>Available PDO drivers: " . implode(", ", $drivers) . "</pre>";

if (!in_array('pgsql', $drivers)) {
    die("<p style='color:red;'>❌ The PDO PostgreSQL driver ('pgsql') is not available. Please install/enable it.</p>");
}

// Load env vars
$host     = getenv('PGHOST');
$port     = getenv('PGPORT');
$dbname   = getenv('PGDATABASE');
$user     = getenv('PGUSER');
$password = getenv('PGPASSWORD');

echo "<pre>Host:     {$host}\nPort:     {$port}\nDatabase: {$dbname}\nUser:     {$user}</pre>";

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname};sslmode=require";

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:green;'>✅ Connected successfully to PostgreSQL!</p>";
} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
