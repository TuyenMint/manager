<?php require('header.php'); ?> 
<?php
require_once('database.php');
//Lấy ra loại sản phẩm
$con = new database();
$sql = "SELECT * FROM mis_product_types";
$productTypes = $con->select_all_query($sql);


?> 
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Nhasach</p>
            <div class="list-group">                    
                <?php 
                
                foreach($productTypes as $productType) { ?>
                <a 
                href="productList.php?productTypeId=<?=$productType['id']?>" 
                class="list-group-item">
                    <?=$productType['name']?>
                </a>
                <?php 
                
                } ?>
            </div>
        </div>

         <div class="col-md-9">
               <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php @session_start();
                        if($_SESSION["gio_hang"]["tong_so"] > 0) {
                                $dsGioHang = $_SESSION["gio_hang"]["mat_hang"];
                                $tongTien = 0;
                                foreach($dsGioHang as $giohang) {
                                $tongTien += $giohang['so_luong']*$giohang['don_gia'];
                            ?>
                            <tr>
                                <td><?=$giohang['ten_hang']?></td>
                                <td><?=$giohang['so_luong']?></td>
                                <td><?=$giohang['don_gia']?></td>
                                <td><?=$giohang['so_luong']*$giohang['don_gia']?></td>
                            </tr>
                            <?php } //Đóng foreach ?> 
                                <tr>
                                    <td colspan="4">Tổng số tiền: <?=$tongTien?> </td>
                                </tr>
                            
                            <?php   }  else  { ?>
                            <tr>
                                <td colspan="4">Không có sản phẩm nào</td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4">
                                    <!-- Ở đây có hiện tượng ta dùng thẻ a như một cái nút -->
                                    <a href="thanh_toan.php" class="btn btn-success">Thanh toán</a>
                                </td>
                            </tr>
                    </tbody>
               </table>      
        </div>
    </div>
</div>


<?php require('footer.php'); ?>