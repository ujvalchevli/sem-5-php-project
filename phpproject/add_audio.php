<?php

include 'connect.php';

$query = "SELECT * FROM `tbl_catagory`";
$result = mysqli_query($con, $query);
$carr = array();
while ($row = mysqli_fetch_assoc($result)) {
    $carr[] = $row;
}

?>
<?php

include 'connect.php';

$query = "SELECT * FROM `tbl_album`";
$result = mysqli_query($con, $query);
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}
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

        select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s;
            background-color: white;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 10px;
            cursor: pointer;
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
                    <label for="categoryName">Audio Name</label>
                    <input type="text" id="audioName" name="audioName" placeholder="Enter Audio Name" required>
                </div>
                <div class="form-group">
                    <label for="categoryName">Singer Name</label>
                    <input type="text" id="singerName" name="singerName" placeholder="Enter Singer Name" required>
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" id="duration" name="duration" placeholder="Enter Duration" required>
                </div>

                <div class="form-group">
                    <label for="category">Category Name</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <?php
                        foreach ($carr as $album) {
                            echo "<option value='" . $album['cat_name'] . "'>" . $album['cat_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="album">Album Name</label>
                    <select id="album" name="album" required>
                        <option value="">Select Album</option>
                        <?php
                        foreach ($arr as $album) {
                            echo "<option value='" . $album['id'] . "'>" . $album['Aname'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Audio Image</label>
                    <div class="file-upload">
                        <input type="file" id="audioImage" name="audioImage" class="file-upload-input" accept="image/*">
                        <label for="audioImage" class="file-upload-label">
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
                <div class="form-group">
                    <label>Audio File</label>
                    <div class="file-upload">
                        <input type="file" id="audiofile" name="audiofile" class="file-upload-input" accept="audio/*">
                        <label for="audiofile" class="file-upload-label">
                            <div class="file-upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="file-upload-text">
                                <h3>Click to Upload</h3>
                                <p>MP3, WAV up to 10MB</p>
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
include 'connect.php';

if (isset($_POST['btnsubmit'])) {
    $audioName = $_POST['audioName'];
    $singerName = $_POST['singerName'];
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $audio_albums = $_POST['album'];
    // File uploads
    $temp_audioImage = $_FILES['audioImage']['tmp_name'];
    $audioImage = "images/" . $_FILES['audioImage']['name'];



    $temp_audioFile = $_FILES['audiofile']['tmp_name'];
    $audioFile = "audio/" . $_FILES['audiofile']['name'];

    // Validation
    if (empty($audioName) || empty($singerName) || empty($category) || empty($temp_audioImage) || empty($temp_audioFile)) {
        echo "<script>alert('Please fill all fields and upload files');</script>";
    } else {
        $query = "INSERT INTO `tbl_audio` (`id`, `name`, `pic`, `singername`, `lyrices`, `singerpic`, `actorname`, `song_src`, `category`, `Albumname`, `uration`) VALUES ('', '$audioName', '$audioImage', '$singerName', '', '', '', ' $audioFile', '$category', '$audio_albums', ' $duration')";
        $result = mysqli_query($con, $query);

        if ($result) {
            move_uploaded_file($temp_audioImage, $audioImage);
            move_uploaded_file($temp_audioFile, $audioFile);
            move_uploaded_file($temp_singerPic, $singerPic);

            echo "<script>alert('Audio added successfully');</script>";
            echo "<script>window.location.href='audio.php';</script>";
        } else {
            echo "<script>alert('Error adding audio');</script>";
        }
    }
}
?>