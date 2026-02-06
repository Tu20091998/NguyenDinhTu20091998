
<!DOCTYPE html>
<html lang='vi'>
<head>
    <meta charset='UTF-8'>
    <title>Upload File</title>
    <link rel='stylesheet' href='public/css/upload.css'>
</head>
<body>
    <div class='container'>
        <h2>Upload File</h2>

        <?= $message ?>

        <form method='POST' action='upload' enctype='multipart/form-data'>
            <input type='file' name='receipt' required>
            <button type='submit'>Upload</button>
        </form>
    </div>
</body>
</html>
