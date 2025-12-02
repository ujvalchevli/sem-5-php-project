<?php
include 'connect.php';

$query = "SELECT * FROM tbl_catagory";
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
    <title>Categories</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
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
            <section id="category-section" class="content-section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Categories</h2>
                        <button class="btn btn-primary">
                            <a href="add_category.php" style="color:white;text-decoration:none">Add New Category</a>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="categoryTable" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($arr as $a) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $a['cat_name'] ?></td>
                                        <td><img src="<?= $a['cat_pic'] ?>" height="80" width="80"></td>
                                        <td>
                                            <a href="update_category.php?id=<?= $a['cat_id'] ?>"
                                                class="action-btn edit-btn">Edit</a>
                                            <a href="delete_category.php?id=<?= $a['cat_id'] ?>"
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