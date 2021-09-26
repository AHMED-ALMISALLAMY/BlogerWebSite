<?php
include('include/navbar.php');
include('include/connection.php');


$AddCategory = $_POST['AddCategory'];
$add = $_POST['add'];

if( isset($_POST['add']) )
{

    if(empty($AddCategory)){
        echo "الرجاء ملء الحقل";
    }

    elseif( strlen($AddCategory ) > 100)
    {
        echo "أسم التصنيف كبير جدا";
    }

    else {

        $query = "INSERT INTO categories(categoryName) VALUE ('$AddCategory')";
        mysqli_query($connect , $query);
        echo "تمت الاضافه بنجاح";


        // if (mysqli_query($connect, $query)) {
        //     echo "تمت إضافة التصنيف";
        // } 

        // else 
        // {
        //     echo "Error: " . $sql . " " . mysqli_error($connect);
        // }

        // mysqli_close($connect);
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
                        <a href="#">
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
                <div class="add-category">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group"> 
                            <label for="category">اضافه تصنيف جديد</label>
                            <input type="text" id="category" name="AddCategory" class="form-control">
                        </div>
                        <button class="btn-custom" name="add">أضافه</button>
                    </form>
                </div>

                <!-- Display Categories -->
                <div class="display-category mt-5">
                    <table class="table table-borderd">
                        <tr>
                            <th>رقم الفقه</th>
                            <th>اسم الفقه</th>
                            <th>التاريخ </th>
                        </tr>
                        <?php 
                            $query = "SELECT * FROM categories ORDER BY id DESC";
                            $result = mysqli_query($connect , $query);
                            $number = 0;
                            while ($row = mysqli_fetch_assoc($result) ) 
                            {
                                $number++;
                                echo '<tr>';
                                echo '<td>' . $number . '</td>'; 
                                echo '<td>' . $row['categoryName'] . '</td>';
                                echo '<td>' . $row['categoryDate'] . '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End content -->


<?php 
include('include/footer.php')
?>