<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Online Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="card.php">Shopping Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Online Store</h2>
                    <form action="insert.php" method="POST" enctype="multipart/form-data">
                        <div class="text-center mb-4">
                            <img src="./pic/online.PNG" alt="logo" class="img-fluid"
                                style="max-width: 100%; height: auto;">
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Product name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" class="form-control" placeholder="Put the price" required>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" id="file" class="form-control-file" required>
                            <label for="file" class="mt-2">Choose image for product</label>
                        </div>
                        <button type="submit" name="upload" class="btn btn-primary btn-block">Upload Product</button>
                        <br>
                        <a href="products.php" class="btn btn-secondary btn-block">View All Products</a>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-center mt-4">Developed By: Mahmoud Salah</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>