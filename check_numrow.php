<?php
include ('./config/connection.php');

$pd_id = $_GET['id'];

        $sql_chk = "SELECT * FROM `tbl_product` where pd_code = ''";
        $rs_chk = mysqli_query($conn, $sql_chk);
        $numrow = mysqli_num_rows($rs_chk);
        
        if($numrow > 0){
            echo 'จำนวนสินค้า -> '. $numrow;
        }