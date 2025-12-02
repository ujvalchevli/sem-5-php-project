<?php
include 'connect.php';

$query = "SELECT * FROM `tbl_audio`";
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
    <title>Audio Files</title>
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
</head>

<body>
    <div class="main-content">
        <div class="content">
            <section id="audio-section" class="content-section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Audio Files</h2>
                        <button class="btn btn-primary">
                            <a href="add_audio.php" class="btn-link" style="color: white; text-decoration: none;">Upload
                                Audio</a>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="categoryTable" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Picture</th>
                                    <th>Singer</th>
                                    <th>Actor</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($arr as $a) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= htmlspecialchars($a['name']) ?></td>
                                        <td><img src="<?= htmlspecialchars($a['pic']) ?>" height="120" width="120"
                                                alt="Audio Pic"></td>
                                        <td><?= htmlspecialchars($a['singername']) ?></td>
                                        <td><?= htmlspecialchars($a['actorname']) ?></td>
                                        <td>
                                            <a href="update_audio.php?id=<?= $a['id'] ?>"
                                                class="action-btn edit-btn">Edit</a>
                                            <a href="delete_audio.php?id=<?= $a['id'] ?>"
                                                class="action-btn delete-btn">Delete</a>
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