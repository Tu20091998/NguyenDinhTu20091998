<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    <style>
        .filter-box {
            margin-top: 25px;
            padding: 15px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            max-width: 400px;
        }
    
        .filter-box label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
    
        .filter-box select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
            cursor: pointer;
        }
    </style>

<body>
    <div class="content">
        <?= $page_content; ?>
    </div>

    <div class="filter-box">
        <form method="get">
            <label>Chọn học kỳ</label>
            <select name="semester" onchange="this.form.submit()">
                <?php foreach ($list_of_courses as $key => $course_name): ?>
                    <option value="<?= $key ?>"
                        <?= (isset($_GET['semester']) && $_GET['semester'] == $key) ? 'selected' : '' ?>>
                        <?= $course_name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
</body>
</html>