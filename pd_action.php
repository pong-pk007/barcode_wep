<?php
include './config/connection.php';
if(isset($_POST['btn_action']))
{
    
    if($_POST['btn_action'] == 'Add')
	{
        $pd_code = $_POST["pd_code"];
        $pd_name = $_POST["pd_name"];
        $pd_stock = $_POST["pd_stock"];
        $pd_qty = $_POST["pd_qty"];
        
         $sql_chk = "SELECT * FROM `tbl_product` where pd_code = '$pd_code'";
        $rs_chk = mysqli_query($conn, $sql_chk);
        $numrow = mysqli_num_rows($rs_chk);
        
        if($numrow > 0){
            echo 'รหัสสินค้านี้ถูกใช้งานแล้ว -> '. $numrow. 'ตัว กรุณาใช้รหัสอื่นที่ไม่ซ้ำกัน';
            ?>
        <script>
                alert("รหัสสินค้านี้ ถูกใช้งานแล้วโปรดใช้รหัสอื่น");
        </script>
            <?php
            
        }else{
                $query = "INSERT INTO `tbl_product` (`pd_id`, `pd_code`, `pd_name`, `pd_stock`, `pd_qty`, `date_update`) VALUES (NULL, '$pd_code', '$pd_name', '$pd_stock', '$pd_qty', CURRENT_TIMESTAMP)";
		
		$result = mysqli_query($conn, $query);
		if(isset($result))
		{
			echo 'เพิ่มสินค้าเสร็จสิ้น';
                }else{
                    echo 'เพิ่มสินค้าไม่สำเร็จ!';
                }
        }
        
		
	}
    
    if($_POST['btn_action'] == 'fetch_single'){
        
        $pd_id = $_POST["product_id"];
        $sql_pd_single = "SELECT * FROM `tbl_product` 
                       WHERE pd_id = $pd_id";
        
        $rs = mysqli_query($conn, $sql_pd_single);
        
                while ($row = mysqli_fetch_array($rs)) {
                        $output['pd_id'] = $row['pd_id'];
                        $output['pd_code'] = $row['pd_code'];
                        $output['pd_name'] = $row['pd_name'];
                        $output['pd_stock'] = $row['pd_stock'];
                        $output['pd_qty'] = $row['pd_qty'];
                        $output['last_update'] = $row['date_update'];
                }
                
                echo json_encode($output);
        
        }
        
        if($_POST['btn_action'] == 'Edit'){
            
            $pd_id = $_POST["pd_id"];
            $pd_stock = $_POST["product_number"];
            $pd_old_stock = $_POST["pd_old_stock"];
         
            $sum_stock = $pd_stock + $pd_old_stock;
            
		$query = "UPDATE tbl_product SET tbl_product.pd_stock = $sum_stock , tbl_product.date_update = CURRENT_TIMESTAMP() WHERE tbl_product.pd_id = $pd_id";
                
		$result = mysqli_query($conn, $query);
                
		if(isset($result)){
			echo 'เพิ่มจำนวนสินค้าแล้วเป็น = '.$sum_stock;
                }else{
                    echo 'error!';
                }
	}
        
        if($_POST['btn_action'] == 'Edit_pd'){
            
            $pd_id = $_POST["pd_id"];
            $pd_name = $_POST["pd_name"];
            $pd_qty = $_POST["pd_qty"];
            
		$query = "UPDATE tbl_product SET tbl_product.pd_name = '$pd_name' , tbl_product.pd_qty = '$pd_qty' , tbl_product.date_update = CURRENT_TIMESTAMP() WHERE tbl_product.pd_id = $pd_id";
                
		$result = mysqli_query($conn, $query);
                
		if(isset($result)){
			echo 'แก้ไขข้อมูลสินค้าเสร็จสิ้น!'. 'ชื่อสินค้า: ' . $pd_name . ', หน่วยนับ: ' . $pd_qty;
                }else{
                    echo 'error!';
                }
	}
        
        
        if($_POST['btn_action'] == 'Minus'){
            
            $pd_id = $_POST["pd_id_m"];
            $pd_stock = $_POST["product_number_m"];
            $pd_old_stock = $_POST["pd_old_stock_m"];
         
            $del_stock = $pd_old_stock - $pd_stock;
            
		$query = "UPDATE tbl_product SET tbl_product.pd_stock = $del_stock , tbl_product.date_update = CURRENT_TIMESTAMP() WHERE tbl_product.pd_id = $pd_id";
                
		$result = mysqli_query($conn, $query);
                
		if(isset($result)){
			echo 'ลดจำนวนเสร็จแล้วคงเหลือ = '.$del_stock;
                }else{
                    echo 'error!';
                }
	}
}
?>
