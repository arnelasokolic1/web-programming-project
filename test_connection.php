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
        
        $sql = "SELECT * FROM Admin"; 
        $stmt = $conn->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Output fetched data
        var_dump($rows);
        
    } catch(PDOException $e) {
        
        echo "<p style='color: red;'>Connection failed: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>

