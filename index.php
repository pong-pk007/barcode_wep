<?php
include './config/connection.php';
?>

<html>
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="refresh" content="1800">
        <link rel="icon" href="./images/google_firebase.png" />
        <title>CSP INVENTORY</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous">

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!--                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>-->
                    <a class="navbar-brand" href="#">CSP INVENTORY</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2>กรุณากรอกรหัสสินค้า หรือ ยิงบาร์โค้ดจากตัวสินค้า</h2>
            <span id='alert_action'></span>
            <div class="row">

                <div id="search_area" class="form-group col-md-12">
                    <label class="control-label" for="txt_std_name">กรอกรหัสสินค้า</label>
                    <input class="form-control" type="text" name="txt_std_name" id="txt_std_name" placeholder="EX.885xxxxxxx">
                </div>

                <div class="col-md-12">
                    <div id="std_data"></div>
                </div>
                

            </div>

        </div>


        <script>
                $(document).ready(function () {
                    function load_data(query, typehead_search = 'yes') {
                        $.ajax({
                            url: "fetch_data.php",
                            method: "POST",
                            data: {query: query, typehead_search: typehead_search},
                            success: function (data)
                            {
                                $('#std_data').html(data);
                            }
                        });
                    }

                    $('#txt_std_name').typeahead({
                        source: function (query, result) {
                            $.ajax({
                                url: "fetch_data.php",
                                method: "POST",
                                data: {query: query},
                                dataType: "json",
                                success: function (data) {
                                    result($.map(data, function (item) {
                                        return item;
                                    }));
                                    load_data(query, 'yes');
                                }
                            });
                        }
                    });


                    $(document).on('click', 'li', function () {
                        var query = $(this).text();
                        load_data(query);
                    });

                });
        </script>
        
        
        <div id="productModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="product_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มจำนวนสินค้า</h4>
                        </div>
                        <div class="modal-body">  
                            
                            <Div class="product_details" id="product_details"></Div>
                            <p id="pd_code"></p>
                            <p id="pd_name"></p>
                            <p id="pd_qty"></p>
                            <p id="pd_unit"></p>
                            <p id="last_update"></p>
                            
                            <div class="form-group">
                                <label>ระบุจำนวนที่ต้องการเพิ่ม</label>
                                <input type="number" name="product_number" id="product_number" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="pd_id" id="pd_id" />
                            <input type="hidden" name="pd_old_stock" id="pd_old_stock" />
                            <input type="hidden" name="btn_action" id="btn_action" />
                            <button type="submit" name="action" id="action" class="btn btn-info" value="Edit">เพิ่มจำนวน</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        
        <div id="productModalMinus" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="product_form_m">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-minus"></i> ลดจำนวนสินค้า</h4>
                        </div>
                        <div class="modal-body">  
                            
                            <Div class="product_details" id="product_details"></Div>
                            <p id="pd_code_m"></p>
                            <p id="pd_name_m"></p>
                            <p id="pd_qty_m"></p>
                            <p id="pd_unit_m"></p>
                            <p id="last_update_m"></p>
                            
                            <div class="form-group">
                                <label>ระบุจำนวนที่ต้องการลบ</label>
                                <input type="number" name="product_number_m" id="product_number_m" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="pd_id_m" id="pd_id_m" />
                            <input type="hidden" name="pd_old_stock_m" id="pd_old_stock_m" />
                            <input type="hidden" name="btn_action" id="btn_action_m" />
                            <button type="submit" name="action_m" id="action_m" class="btn btn-info" value="Minus">ลดจำนวน</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        

        <!--my modal add edit zone-->
<!--        <div  class="modal fade bs-example-modal-lg" id="modal_detail">
            <div class="modal-dialog modal-lg" role="document">
                <form name="frmMain" action="" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="good_title">รายละเอียดความดี</h4>
                        </div>
                        <div class="modal-body">

                            <h4 class="text-center">detail<br/><p id="gst_title"></p></h4>

                            <div class="row">
                                hgfdhghfg
                                <input type="hidden" id="gst_id" name="gst_id" value=""/>
                            </div>

                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>-->

        <script>
            $(document).ready(function () {

                $('.open_detail').click(function () {
                    $("#modal_detail").modal('show');
                });
                
                
                $(document).on('click', '.plus', function(){
                    var product_id = $(this).attr("id");
                    var btn_action = 'fetch_single';
                    $.ajax({
                        url:"pd_action.php",
                        method:"POST",
                        data:{product_id:product_id, btn_action:btn_action},
                        dataType:"json",
                        success:function(data){
                            console.log("data: " + JSON.stringify(data));
                            $('#productModal').modal('show');
                            $('#pd_name').text("ชื่อสินค้า: "+data.pd_name);
                            $('#pd_code').text("รหัสสินค้า: " + data.pd_code);
                            $('#pd_id').text(data.pd_id);
                            $('#pd_qty').text("จำนวนเดิม: " + data.pd_stock);
                            $('#pd_unit').text("หน่วยนับ: " + data.pd_qty);
                            $('#last_update').text("ปรับปรุงล่าสุดเมื่อ: " + data.last_update)
                           
                            $('#pd_old_stock').val(data.pd_stock);
                            $('#action').val("Edit");
                            $('#btn_action').val("Edit");
                            $('#pd_id').val(data.pd_id);
                        }
                    })
                });
                
                
                $(document).on('click', '.minus', function(){
                    var product_id = $(this).attr("id");
                    var btn_action = 'fetch_single';
                    $.ajax({
                        url:"pd_action.php",
                        method:"POST",
                        data:{product_id:product_id, btn_action:btn_action},
                        dataType:"json",
                        success:function(data){
//                            console.log("data: " + JSON.stringify(data));
                            for(i in data){
                                console.log(i + " : " + data[i]); 
                            }

                            $('#productModalMinus').modal('show');
                            $('#pd_name_m').text("ชื่อสินค้า: "+data.pd_name);
                            $('#pd_code_m').text("รหัสสินค้า: " + data.pd_code);
                            $('#pd_id_m').text(data.pd_id);
                            $('#pd_qty_m').text("จำนวนเดิม: " + data.pd_stock);
                            $('#pd_unit_m').text("หน่วยนับ: " + data.pd_qty);
                            $('#last_update_m').text("ปรับปรุงล่าสุดเมื่อ: " + data.last_update)
                           
                            $('#pd_old_stock_m').val(data.pd_stock);
                            $('#action_m').val("Minus");
                            $('#btn_action_m').val("Minus");
                            $('#pd_id_m').val(data.pd_id);
                        }
                    })
                });
                
                
                $(document).on('submit', '#product_form_m', function(event){
                    event.preventDefault();
                    $('#action_m').attr('disabled', 'disabled');
                    var form_data = $(this).serialize();
                    $.ajax({
                        url:"pd_action.php",
                        method:"POST",
                        data:form_data,
                        success:function(data)
                        {
                            $('#product_form_m')[0].reset();
                            $('#productModalMinus').modal('hide');
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                            $('#action_m').attr('disabled', false);
                            setTimeout(function (){
                                location.reload();
                            },1000);
                        }
                    })
                });
                
                $(document).on('submit', '#product_form', function(event){
                    event.preventDefault();
                    $('#action').attr('disabled', 'disabled');
                    var form_data = $(this).serialize();
                    $.ajax({
                        url:"pd_action.php",
                        method:"POST",
                        data:form_data,
                        success:function(data)
                        {
                            $('#product_form')[0].reset();
                            $('#productModal').modal('hide');
                            $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                            $('#action').attr('disabled', false);
                            setTimeout(function (){
                                location.reload();
                            },1000);
                        }
                    })
                });
                
                
                
            });
        </script>

    </body>
</html>

