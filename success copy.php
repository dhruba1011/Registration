<?php
session_start();

// If no details in session, kick back to form
if (empty($_SESSION['reg_details'])) {
    header('Location: setting.php');
    exit;
}

// Pull out the details and then clear them
$d = $_SESSION['reg_details'];
unset($_SESSION['reg_details']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #28a745; }
        .details p { margin: 10px 0; }
        .details strong { width: 120px; display: inline-block; color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Successful!</h2>
        <div class="details">
            <?php foreach ($d as $key => $value): ?>
                <p>
                    <strong><?php echo ucfirst(str_replace('_',' ',$key)); ?>:</strong>
                    <?php echo htmlspecialchars($value); ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
