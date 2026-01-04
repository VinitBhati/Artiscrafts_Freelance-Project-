<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f7fa;
        margin: 0;
        padding: 20px;
        color: #333;
    }
    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }
    .dashboard-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 25px;
        max-width: 900px;
        margin: 20px auto;
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
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
    .action a {
        text-decoration: none;
        background-color: #2ecc71;
        color: #fff;
        padding: 6px 12px;
        border-radius: 6px;
        transition: background-color 0.3s;
    }
    .action a:hover {
        background-color: #27ae60;
    }
    @media screen and (max-width: 768px) {
        th, td {
            font-size: 13px;
            padding: 10px;
        }
    }
</style>
</head>
<body>

<h1>Dashboard</h1>

<div class="dashboard-card">
<?php
$json_data = file_get_contents('../info.json');
$data = json_decode($json_data, true);

$serial = 1;

echo '<table style="width:100%; border-collapse:collapse;">';
echo '<tr style="background:#3498db; color:#fff;">
        <th>Serial Number</th>
        <th>Client Name</th>
        <th>Form Type</th>
        <th>Action</th>
      </tr>';

foreach (['query_form', 'contact_form'] as $formType) {
    if(!empty($data[$formType])) {
        foreach($data[$formType] as $entry) {
            echo '<tr>';
            echo '<td>' . $serial . '</td>';
            echo '<td>' . ($entry['name'] ?? 'N/A') . '</td>';
            echo '<td>' . ucfirst(str_replace('_',' ',$formType)) . '</td>';
            echo '<td>
                    <a href="view.php?id=' . $entry['serial_number'] . '&type=' . $formType . '" 
                       style="text-decoration:none;background:#2ecc71;color:#fff;padding:6px 12px;border-radius:6px;">
                       View
                    </a>
                  </td>';

            echo '</tr>';
            $serial++;
        }
    }
}
echo '</table>';
?>

</div>

</body>
</html>
