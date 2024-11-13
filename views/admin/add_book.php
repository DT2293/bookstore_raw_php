<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sách Mới</title>
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4">Thêm Sách Mới</h1>
    
    <form action="index.php?controller=book&action=add" method="POST" enctype="multipart/form-data">
        <!-- Tiêu đề sách -->
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề Sách</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <!-- Tác giả -->
        <div class="mb-3">
            <label for="author" class="form-label">Tác Giả</label>
            <select class="form-select" id="author" name="author_id" required>
                <option value="" disabled selected>Chọn tác giả</option>
                <?php foreach ($authors as $author): ?>
                    <option value="<?php echo $author['AuthorID']; ?>"><?php echo htmlspecialchars($author['Name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Thể loại -->
        <div class="mb-3">
            <label for="category" class="form-label">Thể Loại</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="" disabled selected>Chọn thể loại</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['CategoryID']; ?>"><?php echo htmlspecialchars($category['Name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Giá -->
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <!-- Số lượng -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Số Lượng</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>

        <!-- Ngày xuất bản -->
        <div class="mb-3">
            <label for="published_date" class="form-label">Ngày Xuất Bản</label>
            <input type="date" class="form-control" id="published_date" name="published_date" required>
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <!-- Ảnh bìa -->
        <div class="mb-3">
            <label for="cover_image" class="form-label">Ảnh Bìa</label>
            <input type="file" class="form-control" id="cover_image" name="cover_image">
        </div>

        <!-- Nút gửi -->
        <button type="submit" class="btn btn-primary">Thêm Sách</button>
    </form>
</div>

</body>
</html>
