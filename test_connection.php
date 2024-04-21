<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Database Connection</title>
</head>
<body>
    <h1>Testing Database Connection</h1>

    <?php
    // Include the connection file
    require_once 'backend/config/connect.php';
    
    try {
        // Sample SQL query to select data from an existing table (e.g., Admin)
        $sql = "SELECT * FROM Admin"; // Replace 'Admin' with the actual table name
        $stmt = $conn->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Output fetched data
        var_dump($rows);
        
    } catch(PDOException $e) {
        // If an exception occurs, it will be caught here
        echo "<p style='color: red;'>Connection failed: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>

