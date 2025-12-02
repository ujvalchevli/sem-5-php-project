<?php
include 'connect.php';
$id = $_GET['id'];
$query = "SELECT * FROM tbl_catagory WHERE cat_id = $id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>
<?php
include 'add_header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin-top: 40px;
            margin-left: 280px;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .file-upload {
            position: relative;
            margin-bottom: 20px;
        }

        .file-upload-input {
            display: none;
        }

        .file-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            border: 2px dashed #3498db;
            border-radius: 6px;
            background-color: #f8fafc;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload-label:hover {
            background-color: #e8f4fe;
        }

        .file-upload-icon {
            font-size: 48px;
            color: #3498db;
            margin-bottom: 15px;
        }

        .file-upload-text {
            text-align: center;
        }

        .file-upload-text h3 {
            color: #3498db;
            margin-bottom: 5px;
        }

        .file-upload-text p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .file-preview {
            margin-top: 20px;
            text-align: center;
        }

        .file-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-reset {
            background-color: #e74c3c;
            margin-left: 10px;
        }

        .btn-reset:hover {
            background-color: #c0392b;
        }

        .form-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .message {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: none;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
                margin: 20px auto;
            }

            .card {
                padding: 20px;
            }

            .form-footer {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div id="message" class="message"></div>

        <div class="card">
            <form id="categoryForm" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" id="categoryName" name="categoryName" placeholder="Enter category name"
                        value="<?= $row['cat_name'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Category Image</label>
                    <div class="file-upload">
                        <input type="file" id="categoryImage" name="categoryImage" class="file-upload-input"
                            accept="image/*" value="<?= $row['cat_pic'] ?>">
                        <img src="<?= $row['cat_pic'] ?>" alt="Current Image"
                            style="max-width: 100px; display: block; margin-bottom: 10px;">
                        <label for="categoryImage" class="file-upload-label">
                            <div class="file-upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="file-upload-text">
                                <h3>Click to Upload</h3>
                                <p>PNG, JPG, GIF up to 5MB</p>
                            </div>
                        </label>
                    </div>
                    <div class="file-preview">
                        <img id="imagePreview" src="#" alt="Image Preview">
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn" name="btnsubmit"><i class="fas fa-plus-circle"></i> Add
                        Category</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>

<?php
if (isset($_POST['btnsubmit'])) {

    $category_name = $_POST['categoryName'];
    $temp_name = $_FILES['categoryImage']['tmp_name'];
    $name = "images/" . $_FILES['categoryImage']['name'];

    if (empty($temp_name)) {
        $name = $row['cat_pic']; // Use existing image if no new file is uploaded
    } else {
        move_uploaded_file($temp_name, $name);
    }

    if (empty($category_name)) {
        echo "<script>alert('Please fill all fields');</script>";
    } else {
        include 'connect.php';
        $query = "UPDATE `tbl_catagory` 
                  SET `cat_name` = '$category_name', `cat_pic` = '$name' 
                  WHERE `tbl_catagory`.`cat_id` = $id";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>alert('Category updated successfully');</script>";
            echo "<script>window.location.href='category.php';</script>";
        } else {
            echo "<script>alert('Error updating category');</script>";
        }
    }
}
?>