<?php

$host = 'localhost'; 
$dbname = 'your_database_name'; 
$username = 'root'; 
$password = 'your_password'; 


$name = $email = '';
$nameErr = $emailErr = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
    } else {
        $name = htmlspecialchars($_POST['name']);
    }

    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        $email = htmlspecialchars($_POST['email']);
    }

   
    if (empty($nameErr) && empty($emailErr)) {
        try {
          
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         
            $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);

           
            $stmt->execute();
            $successMessage = "Data inserted successfully!";
        } catch (PDOException $e) {
           
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
            text-align: center;
        }
        .container h1 {
            color: #f39c12;
        }
        .container p {
            font-size: 16px;
            line-height: 1.6;
        }
        .form-input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        .form-button {
            padding: 10px 20px;
            background-color: #f39c12;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-button:hover {
            background-color: #e67e22;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <?php if (isset($successMessage)): ?>
            <p class="success"><?= $successMessage; ?></p>
        <?php elseif (isset($errorMessage)): ?>
            <p class="error"><?= $errorMessage; ?></p>
        <?php endif; ?>

    </div>
</body>
</html>
