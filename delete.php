<?php

include 'db.php';

try {

    if(isset($_GET['id'])){

        $id = intval($_GET['id']);

        $selectStmt = $conn->prepare(
            "SELECT * FROM gymnasts WHERE id = ?"
        );

        $selectStmt->bind_param("i", $id);

        $selectStmt->execute();

        $result = $selectStmt->get_result();

        $gymnast = $result->fetch_assoc();

        // Delete record
        $deleteStmt = $conn->prepare(
            "DELETE FROM gymnasts WHERE id = ?"
        );

        $deleteStmt->bind_param("i", $id);

        if($deleteStmt->execute()){

            $logMessage =
                "Deleted Gymnast: " .
                $gymnast['full_name'] .
                " | Membership ID: " .
                $gymnast['membership_id'] .
                " | Deleted On: " .
                date("Y-m-d H:i:s") .
                PHP_EOL;

            file_put_contents(
                "deleted_records.txt",
                $logMessage,
                FILE_APPEND
            );

            header("Location: dashboard.php");

        } else {

            echo "Delete failed.";

        }

    }

} catch(Exception $e){

    echo "Error: " . $e->getMessage();

}

?>