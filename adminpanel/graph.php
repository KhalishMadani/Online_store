<?php
// Connect to your database
require "../connection.php";

// Check if a week range is selected
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    // Get the selected start and end dates
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Retrieve the data from your table for the selected week range
    $sql = "SELECT dibikin_pada, SUM(qty) AS total_qty FROM orders WHERE dibikin_pada BETWEEN '$start_date' AND '$end_date' GROUP BY dibikin_pada";
} else {
    // Retrieve the data from your table for the last 7 days
    $sql = "SELECT dibikin_pada, SUM(qty) AS total_qty FROM orders WHERE dibikin_pada >= CURDATE() - INTERVAL 6 DAY GROUP BY dibikin_pada";
}

$result = $conn->query($sql);

$data = array();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Loop through each row
    while ($row = $result->fetch_assoc()) {
        // Extract the relevant values from each row
        $label = $row['dibikin_pada'];
        $qty = $row['total_qty'];

        // Add the label and qty to the data array
        $data[] = array(
            'dibikin_pada' => $label,
            'total_qty' => $qty
        );
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div>
        <form method="post">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <button type="submit">Filter</button>
        </form>
    </div>

    <div style="max-width: 720px;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Get the chart canvas element
        const ctx = document.getElementById('myChart').getContext('2d');

        // Define the chart data
        const data = <?php echo json_encode($data); ?>;

        // Prepare the labels and chart data arrays
        const labels = data.map(item => item.dibikin_pada);
        const chartData = data.map(item => item.total_qty);

        // Create the chart
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Quantity',
                    data: chartData,
                    fill: true,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
        });

        // Function to print the chart
        function printChart() {
            // Create a data URL for the chart
            const chartDataURL = document.getElementById('myChart').toDataURL('image/png');

            // Create a new window
            const printWindow = window.open('', '_blank');

            // Write the content to the new window
            printWindow.document.write('<html><head><title>Print</title></head><body>');
            printWindow.document.write('<img src="' + chartDataURL + '" />');
            printWindow.document.write('<scr' + 'ipt>window.onload = function() { window.print(); }</scr' + 'ipt>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
        }

    </script>

    <button onclick="printChart()">Print</button>
    <div class="mt-5">
        <a href="index.php">Kembali</a>
    </div>


</body>

</html>