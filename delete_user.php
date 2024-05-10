<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-literasi";

header('Access-Control-Allow-Origin: *'); 

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $userID = intval($_GET['id']); 

        
        $query = "DELETE FROM Pengguna WHERE User_ID = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $userID, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(["success" => true]); 
    } else {
        throw new Exception("ID pengguna tidak ditemukan.");
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
