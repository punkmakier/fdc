<?php
    require_once('library/init.php');

    $con = new config();
    $con->openConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'library/designs.php'; ?>
    <title>Document</title>
</head>
<body>

    <div class="container mt-5">
        <div style="text-align: center;">
        <h1>Basic Setup of PHP Project by Mark Allan Carba</h1>
        <p>With Bootstrap 5, Ajax, Jquery, Sweet Alert, Fontawesome, DataTable<br>OOP using PDO and MYSQL with database handler</p>
        </div>

    <table class="table table-striped" id="myTable">
        <thead class="table-dark">
            <th>Username</th>
            <th>Qoutes</th>
        </thead>
        <tbody>
            <tr>
                <td>Makier</td>
                <td>You only live once!</td>
            </tr>
            <tr>
                <td>Allan</td>
                <td>Follow your dreams!</td>
            </tr>
        </tbody>
    </table>


    </div>

    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>

    <script>
        Swal.fire(
        "Hooray!',
        'This is your basic setup project!',
        'success'
        )
    </script>
</body>
</html>
