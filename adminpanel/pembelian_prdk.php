<?php
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Pembelian Produk</title>
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
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
            <h1>Pembelian Ke Supplier</h1>
        </div>
        <div class="table-responsive">

            <table border="1" cellpadding="4" id="printTable">
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Productr Price</th>
                    <th>Detail Product</th>
                    <th>Jumlah Beli</th>
                    <th>Status</th>

                </tr>
                <?php
                // Connect to your database
                require "../connection.php";

                // Retrieve data from the database
                $sql = "SELECT nama, kode_beli, harga, detail, jumlah FROM pembelian_prdk";
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
                        echo "<td>" . $row['jumlah'] . "</td>";
                        echo '<td><a href="pembelian_detail.php?p=' . $row['kode_beli'] . '" class="btn btn-warning">'."Detail".'</a></td>';
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
        <a href="index.php" class="btn"> Back </a> 
        <button onclick="imprimir()" class="warna2" style="font-size: 20px; padding: 5px 20px;" >Print Table</button>
    </div>


</body>

</html>