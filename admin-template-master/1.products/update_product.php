<?php
session_start();
require_once "./../pdo/pdo.php";
$id = $_GET['ma_sp'];
$sql_1= "SELECT * FROM loai_hang";
$data_1= pdo_query($sql_1);

$sql_2= "SELECT * FROM san_pham WHERE ma_sp = ?";
$data_2 = pdo_query_one($sql_2,$id);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Product</title>
    <link href="./../css/bootstrap.min.css" rel="stylesheet">
	<link href="./../css/font-awesome.min.css" rel="stylesheet">
	<link href="./../css/datepicker3.css" rel="stylesheet">
	<link href="./../css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php require_once "./../side_bar/side_bar.php"; ?>
    <!--/.sidebar-->



    <!-- Main -->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Hàng hóa</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cập nhật hàng hóa</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="panel panel-default">

            <div class="panel-body">
                <div class="col-8 ">
                    <form action="\du_an_1\admin-template-master\1.products\handle.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input type="text" class="form-control" value="<?=$id?>" readonly name="ma_sp">
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" value="<?=$data_2['ten_sp']?>"placeholder="Tên..." name="ten_sp">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" class="form-control" value="<?=$data_2['so_luong']?>"placeholder="Số lượng..." name="so_luong">
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="number" class="form-control" value="<?=$data_2['gia_sp']?>"placeholder="Giá..." name="gia_sp">
                            </div>
                            <div class="form-group">
                                <label>Giá khuyến mãi</label>
                                <input type="number" class="form-control" value="<?=$data_2['gia_km']?>"placeholder="Giá km..." name="gia_km">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <div style="display: flex;">
                                    <input type="file" class="form-control" name="img">
                                    <input type="hidden" name="hinh_sp" value="<?=$data_2['hinh_sp']?>">
                                    <img src="<?=$data_2['hinh_sp']?>" alt="" width="50px" height="45px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="4" name="mo_ta"><?=$data_2['mo_ta']?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Loại hàng</label>
                                <select class="form-control" name="ma_loai">
                                    <?php foreach($data_1 as $loai) : ?>
                                    <option value="<?=$loai['ma_loai']?>" <?=($loai['ma_loai'] == $data_2['ma_loai']) ? "selected" : "" ?> ><?=$loai['ten_loai']?></option>
                                    <?php endforeach ; ?>
                                </select>
                            </div>
                        </div>
                        
                        <?php if (isset($_SESSION["error_check"])) { ?>
                            <div class="mb-3 fw-bold text-center text-danger">
                                <?=$_SESSION["error_check"]; unset($_SESSION["error_check"]) ?>
                            </div>
                        <?php } ?>
                        
                        <div class="modal-footer">
                            <a href="./products.html" class="btn btn-default">Hủy</a>
                            <button type="submit" class="btn btn-primary" name="sua">Lưu thay đổi</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
    <!--/.main-->

    <script src="https://kit.fontawesome.com/0101500cc8.js" crossorigin="anonymous"></script>
    <script src="./../js/jquery-1.11.1.min.js"></script>
    <script src="./../js/bootstrap.min.js"></script>
    <script src="./../js/chart.min.js"></script>
    <script src="./../js/chart-data.js"></script>
    <script src="./../js/easypiechart.js"></script>
    <script src="./../js/easypiechart-data.js"></script>
    <script src="./../js/bootstrap-datepicker.js"></script>
    <script src="./../js/custom.js"></script>
    <script>
        $("#confirm-delete").on("show.bs.modal", function (e) {
            $(this).find(".btn-ok").attr("href", $(e.relatedTarget).data("href"));
        });
    </script>
    <script>
        $("#checkAl").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        uncheckAll = document.getElementById('remove-checkAll');
        uncheckAll.addEventListener('click', function () {
            document.getElementById('form_product').reset();
        })

    </script>

</body>

</html>