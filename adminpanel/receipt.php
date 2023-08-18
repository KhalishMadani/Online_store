<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Table Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 15px;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh; /* Adjust the height as needed */
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        #printContainer {
            display: none;
            /* Hide by default */
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printContainer,
            #printContainer * {
                visibility: visible;
            }

            #printContainer {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 9999;
                display: block !important;
            }
        }
    </style>
</head>

<script>

    function imprimir() {
        var divToPrint = document.getElementById("ConsutaBPM");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    function goBack() {
    window.history.back();
  }

    $('button').on('click', function () {
        imprimir();
    })

</script>

<body>

    <div id="ConsutaBPM" style="width: 100%;">
        <div class="center">
            <h1>Barang</h1>
        </div>
        <div class="container">

            <table border="1" cellpadding="4" id="printTable">
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Productr Price</th>
                    <th>Detail Product</th>
                    <th>Stock</th>
                    <th>Status</th>

                </tr>
                <?php
                // Connect to your database
                require "../connection.php";

                // Retrieve data from the database
                $sql = "SELECT nama, harga, detail, stock, ketersediaan_stok FROM produk";
                $result = $conn->query($sql);

                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    $counter = 1;
                    // Loop through each row and output the data
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $counter ."</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['harga'] . "</td>";
                        echo "<td>" . $row['detail'] . "</td>";
                        echo "<td>" . $row['stock'] . "</td>";
                        echo "<td>" . $row['ketersediaan_stok'] . "</td>";
                        echo "</tr>";

                        //increment counter
                        $counter++;
                    }
                } else {
                    echo "<tr><td colspan='9'>No data found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </table>
        </div>
    </div>
    <div class="center">

        <button onclick="goBack()" class="warna4" style="font-size: 20px; padding: 5px 20px; margin-right: 20px;" >Go Back</button>
        <button onclick="imprimir()" class="warna2" style="font-size: 20px; padding: 5px 20px;" >Print Table</button>
    </div>


</body>

</html>