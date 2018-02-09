<?php

include './config/connection.php';
if (isset($_POST["query"])) {
    $req = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM `tbl_product` 
                       WHERE pd_code = '" . $req . "' OR pd_name LIKE '%" . $req . "%'";
    $rs = mysqli_query($conn, $query);
    $data = array();
    $html = '';
    $html .= '
            <table class="table table-hover table-bordered table-striped">
             <tr>
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>จำนวน</th>
              <th>หน่วยนับ</th>
              <th colspan="2"><i class="fa fa-gear fa-fw"></i></th>
             </tr>
  ';
    if (mysqli_num_rows($rs) > 0) {
        while ($row = mysqli_fetch_array($rs)) {
            
            
            $pd_id = $row["pd_id"];
            $pd_name = $row["pd_name"];
            
            
            $data[] = $row["pd_code"];
            $data[] = $row["pd_name"];

            $html .= '
   <tr>
        <td>' . $row["pd_code"] . '</td>
        <td>' . $row["pd_name"] . $row["std_name"] . " " . $row["std_lname"] . '</td>
        <td>' . $row["pd_stock"] . '</td>
        <td>' . $row["pd_qty"] . '</td>
        <td><button type="button" name="plus" id="'.$row["pd_id"].'" class="btn btn-info btn-xs plus"><i class="fa fa-plus"><i/>&nbsp;เพิ่มจำนวน</button></td>
        <td><button type="button" name="minus" id="'.$row["pd_id"].'" class="btn btn-success btn-xs minus"><i class="fa fa-minus"><i/>&nbsp;ลดจำนวน</button></td>
   </tr>
   ';
        }
    } else {
        $data = 'No Data Found';
        $html .= '
   <tr>
        <td colspan="6">No Data Found</td>
   </tr>
   ';
    }
    $html .= '</table>';


    if (isset($_POST['typehead_search'])) {
        echo $html;
    } else {
        $data = array_unique($data);
        echo json_encode($data);
    }
}
?>


