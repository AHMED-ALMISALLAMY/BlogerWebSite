<?php
include('include/connection.php');
include('include/navbar.php');

$postTitle = $_POST['postTitle'];
$postCategory = $_POST['postCategory'];
$postContent = $_POST['postContent'];
$postAuthor = "Ahmed";
$add = $_POST['add'];

// Image
$imageName = $_FILES['postImage']['name'];
$imageTmp = $_FILES['postImage']['tmp_name'];


if ( isset($add) ) 
{
    if ( empty($postTitle) || empty($postContent) ) {
        echo "الرجاء ملء الحقول";
    }

    elseif (strlen($postContent) > 10000) {
        echo "أسم كبير جدا";
    }

    else 
    {
        $postImage = rand(0 , 1000).'_'.$imageName;
        move_uploaded_file($imageTmp , "./uploads/\\".$postImage);
        $query = "INSERT INTO posts(postTitle , postCategory , postImage , postContent , postAuthor) VALUES('$postTitle' , '$postCategory' , '$postImage' , '$postContent' , '$postAuthor') ";
        $result = mysqli_query($connect , $query);

        if ( isset($result) ) {
            echo "تمت الاضافه بنجاح";
        } 
        else 
            echo "error";
    }
}

?>


<!-- start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-area">
                <h4>لوحه التحكم</h4>
                <ul>
                    <li>
                        <a href="categories.php">
                            <span class="fas fa-tags"></span>
                            <span>التصنيفات</span>
                        </a>
                    </li>

                    <!-- Articles -->
                    <li data-toggle="collapse" data-target="#menu">
                        <a href="#">
                            <span><i class="fas fa-newspaper"></i></span>
                            <span>المقالات</span>
                        </a>
                    </li>

                    <ul class="collapse" id="menu">
                        <li>
                            <a href="new-post.php">
                                <span><i class="fas fa-edit"></i></span>
                                <span>مقال جديد</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span><i class="fas fa-th-large"></i></span>
                                <span>كل المقالات</span>
                            </a>
                        </li>
                    </ul>

                    <li>
                        <a href="#">
                            <span><i class="fas fa-window-restore"></i></span>
                            <span>عرض الموقع</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span class="fas fa-tags"></span>
                            <span>تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10" id="main-area">
                <button class="btn btn-custom">مقال جديد</button>
                <div class="add-category">
                    <form action="<?php $_SERVER['PHP-SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <!-- post title -->
                        <div class="form-group"> 
                            <label for="category">اضافه مقال</label>
                            <input type="text" id="category" name="postTitle" class="form-control">
                        </div>
                        <!-- End post title -->

                        <!-- select category -->
                        <div class="form-group"> 
                            <label for="list">تصنيف</label>
                            <select name="postCategory" id="list" class="form-control">
                                <?php 
                                    $query = "SELECT * FROM categories";
                                    $result = mysqli_query($connect , $query);
                                    while ( $row = mysqli_fetch_assoc($result) ) {
                                        ?>
                                        <option value="" name="postCategory">
                                            <?php echo $row['categoryName'] ?>
                                        </option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- End selection -->

                        <!-- img -->
                        <div class="form-group">
                            <label for="image">اضافه صوره للمقال</label>
                            <input type="file" id="image" name="postImage" class="form-control"> 
                        </div>
                        <!-- End img -->

                        <!-- content -->
                        <div class="form-group">
                            <label for="content">نص المقال</label>
                            <textarea name="postContent" id="content" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <!-- End Content -->

                        <button class="btn-custom" name="add">أضافه</button>
                    </form>
                </div>
            </div>
        </div>  
    </div>   
</div>   
<!-- Jquery and Bootstrap -->
<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



<?php 
include('include/footer.php')
?>