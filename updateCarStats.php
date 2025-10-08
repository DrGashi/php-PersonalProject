<?php
include_once('database/config.php');

if (isset($_POST['submit'])) {
    $appointment_id = $_POST['appointment_id'];
    $engine_type = $_POST['engine_type'];
    $horsepower = $_POST['horsepower'];
    $torque = $_POST['torque'];
    $transmission = $_POST['transmission'];
    $drivetrain = $_POST['drivetrain'];
    $fuel_type = $_POST['fuel_type'];
    $weight = $_POST['weight'];
    $description = $_POST['description'];

    // Check if a row exists in `cars` for this appointment
    $checkSql = "SELECT COUNT(*) FROM cars WHERE car_id = :car_id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':car_id', $appointment_id);
    $checkStmt->execute();
    $exists = $checkStmt->fetchColumn();

    if ($exists) {
        // UPDATE existing row
        $sql = "UPDATE cars SET 
                    engine_type = :engine_type,
                    horsepower = :horsepower,
                    torque = :torque,
                    transmission = :transmission,
                    drivetrain = :drivetrain,
                    fuel_type = :fuel_type,
                    weight = :weight,
                    description = :description
                WHERE car_id = :car_id";

        $stmt = $conn->prepare($sql);
    } else {
        // INSERT new row
        $sql = "INSERT INTO cars (
                    car_id, engine_type, horsepower, torque, transmission,
                    drivetrain, fuel_type, weight, description
                ) VALUES (
                    :car_id, :engine_type, :horsepower, :torque, :transmission,
                    :drivetrain, :fuel_type, :weight, :description
                )";

        $stmt = $conn->prepare($sql);
    }

    // Bind common parameters
    $stmt->bindParam(':car_id', $appointment_id);
    $stmt->bindParam(':engine_type', $engine_type);
    $stmt->bindParam(':horsepower', $horsepower);
    $stmt->bindParam(':torque', $torque);
    $stmt->bindParam(':transmission', $transmission);
    $stmt->bindParam(':drivetrain', $drivetrain);
    $stmt->bindParam(':fuel_type', $fuel_type);
    $stmt->bindParam(':weight', $weight);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        header("Location: workOnCar.php");
        exit;
    } else {
        echo "Error updating/inserting car stats.";
        print_r($stmt->errorInfo());
        exit;
    }
}
?>
