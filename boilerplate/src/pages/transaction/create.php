<?php
require_once '../../../config/Database.php';
require_once '../../../app/Transaction.php';

$database = new Database();
$db = $database->dbConnection();

$transaksi = new Transaction($db);

if(isset($_POST['tambah'])){
    $transaksi->user_id = $_POST['user_id'];
    $transaksi->game_id = $_POST['game_id'];
    $transaksi->amount = $_POST['amount'];
    $transaksi->transaction_date = $_POST['transaction_date'];
    
    $transaksi->store(); 
    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Data</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" name="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="game_id">Game ID:</label>
                <input type="text" name="game_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="transaction_date">Transaction Date:</label>
                <input type="date" name="transaction_date" class="form-control" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
</html>
