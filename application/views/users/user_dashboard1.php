<?php include 'header.php'; ?>

<body>
<?php
        $conn = mysqli_connect("localhost", "root","", "project_two");
        if (isset($_POST["import"])) {
            $fileName = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) { 
                $file = fopen($fileName, "r");
                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $sqlInsert = "INSERT into user_files (first_name, last_name, phone, email)
                        values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "')";
                    $result = mysqli_query($conn, $sqlInsert);
                    
                    if (! empty($result)) {
                        $type = "success";
                        $message = "CSV Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing CSV Data";
                    }
                }
            }
        }
    ?>
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="#menu-toggle" id="menu-toggle">welcome <?php echo $this->session->userdata('username'); echo $this->session->userdata('id'); ?></a>
                    <?php if($this->session->userdata('id')):?>
                    <a href="<?php base_url('admin/logout');?>" class="btn btn-danger float-right">Logout</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                
                <li>
                    <a href="#"><i class="fa fa-home" style="margin-right: 10px;"></i>Home</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user"  style="margin-right: 10px;"></i>Profile</a>
                </li>
                
                <li>
                    <a href="#"><i class="fa fa-list" style="margin-right: 10px;"></i>Login History</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file" style="margin-right: 10px;"></i>Support Guide</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
    </div>

    <div class="container">
    
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM user_files";
            $result = mysqli_query($conn, $sqlSelect);
            
            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>

                </tr>
            </thead>
<?php
                
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['first_name']; ?></td>
                    <td><?php  echo $row['last_name']; ?></td>
                    <td><?php  echo $row['phone']; ?></td>
                    <td><?php  echo $row['email']; ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>
    </div>
<?php include 'footer.php'; ?>