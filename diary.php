<?php include_once("mysql_info.php"); ?>

<?php $sidebar=4 ?>
<?php include_once("_site_header.php"); ?>

<div class="container marketing">
    <h1>捐血日誌</h1>
    <p>本資料將由台灣血液基金會網站取得，目前仍在與該基金會洽商中...</p>

    <?php 


    if (isset($_SESSION['MM_UserID'])){
        $user_id = $_SESSION['MM_UserID'];
        $sql = "SELECT * from `user` where `fb_id` = '$user_id'"; //在資料表中選擇所有欄位
        $result = mysqli_query($link,$sql); // 執行SQL查詢
        $row = mysqli_fetch_assoc($result);
        $today = date('Y-m-d');
      
    

    ?>
        <div class="row">
            <div class="col-md-6">
                <h2>基本資料</h2>
                <table class="table">
                    <tr>
                        <th>姓名:</th>
                        <td><?php echo $row['name'];?></td>
                        <th>E-mail</th>
                        <td><?php echo $row['email'];?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <form action="logout.php">
                    <button class="btn btn-danger" type="submit" value="登出">登出</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                
                <h2>捐血總表</h2>
                <table class="table table-stripe">
                    <thead>
                        <th>#</th>
                        <th>捐血時間</th>
                        <th>捐血地點</th>
                        <th>全血捐血量</th>
                        <th>分離術捐血量</th>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>總計</td>
                            <td></td>
                            <td></td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2"  style="text-align:center">
                <div class="panel panel-success">
                    <div class="panel-heading">捐血次數</div>
                    <div class="panel-body">
                        <p><span style="font-size:50px"><?php echo $row['donate_times'];?></span>次</p>

                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">捐血量</div>
                    <div class="panel-body">
                        <p><span style="font-size:50px"><?php echo $row['donate_volume'];?></span>cc</p>

                    </div>
                </div>
            </div>
            <div class="col-md-3"  style="text-align:center">
                <div class="panel panel-success">
                    <div class="panel-heading">下次建議捐血時間</div>
                    <div class="panel-body">
                        <p><span style="font-size:30px"><?php echo (($row['next_donate_date']=='0000-00-00')?$today:$row['next_donate_date']);?></span></p>

                    </div>
                </div>
            </div>
        </div>
            

<?php } else { ?>

        <div style="text-align:center">
            <h2>請先用FB帳號登入</h2>
            <a class="btn btn-default btn-lg" href="fbconfig.php" style="background-color:#3a5795;color:#fff;font-size:30px">
                Facebook
                <!-- <img src="images/fbsignin.png" width="320px"> -->
            </a>
<!--             <h2><a href="http://collegebazaar.tw/NTUHackthon/diary.php">因Azure網頁問題，請先用備用網站測試</a></h2>
 -->        </div>

<?php } ?>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
