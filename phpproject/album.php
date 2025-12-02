<?php
include 'connect.php';

$query = "SELECT * FROM `tbl_album`";
$result = mysqli_query($con, $query);
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}

include 'add_header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Management - Music Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <style>
        .album-cover {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        a.btn-link {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="content">
            <section id="album-section" class="content-section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Album Management</h2>
                        <button class="btn btn-primary">
                            <a href="add_album.php" class="btn-link">Add New Album</a>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="categoryTable" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cover</th>
                                    <th>Album Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($arr as $a) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><img src="<?= htmlspecialchars($a['Apic']) ?>" class="album-cover"
                                                alt="Album Cover"></td>
                                        <td><?= htmlspecialchars($a['Aname']) ?></td>
                                        <td>
                                            <a href="update_album.php?id=<?= $a['Aid'] ?>"
                                                class="action-btn edit-btn">Edit</a>
                                            <a href="delete_album.php?id=<?= $a['Aid'] ?>" class="action-btn delete-btn"
                                                onclick="return confirm('Are you sure you want to delete this album?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#categoryTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        });
    </script>
</body>

</html>