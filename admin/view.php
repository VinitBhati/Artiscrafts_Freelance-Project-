<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Submission</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f7fa;
        margin: 0;
        padding: 20px;
        color: #333;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
    }
    .form-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        padding: 20px;
        margin: 30px auto;
        max-width: 900px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #3498db;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
    }
    tr:hover {
        background-color: #f1f9ff;
    }
    @media screen and (max-width: 768px) {
        th, td {
            padding: 10px;
            font-size: 12px;
        }
    }
    .back-link {
        display: block;
        text-align: center;
        margin: 20px 0;
        text-decoration: none;
        color: #2ecc71;
        font-weight: bold;
    }
    .back-link:hover {
        color: #27ae60;
    }
</style>
</head>
<body>

<?php
if(isset($_GET['id']) && isset($_GET['type'])) {

    $id = $_GET['id'];
    $formType = $_GET['type']; // 'query_form' or 'contact_form'

    $json_data = file_get_contents('../info.json');
    $data = json_decode($json_data, true);

    if(!empty($data[$formType])) {

        // Reverse order to show latest submissions first
        $entries = array_reverse($data[$formType]);

        $found = false;

        foreach($entries as $entry) {
            if($entry['serial_number'] === $id) {
                $found = true;

                echo '<div class="form-card">';
                echo '<h2>' . ucfirst(str_replace('_',' ',$formType)) . ' Submission</h2>';
                echo '<table>';

                foreach($entry as $key => $value) {
                    if($key === 'serial_number') continue; // Skip serial_number
                    echo '<tr>';
                    echo '<td>' . ucfirst(str_replace('_',' ',$key)) . '</td>';
                    echo '<td>' . ($value ?? '') . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';
                break; // Stop loop once the ID is found
            }
        }

        if(!$found){
            echo '<h2>No submission found for this ID</h2>';
        }

    } else {
        echo '<h2>No submissions found for this form type</h2>';
    }

    echo '<a href="dashboard.php" class="back-link">← Back to Dashboard</a>';

} else {
    echo '<h2>Invalid request. Missing ID or Form Type.</h2>';
    echo '<a href="dashboard.php" class="back-link">← Back to Dashboard</a>';
}
?>

</body>
</html>
