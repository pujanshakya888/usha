<?php 
session_start();
include_once 'include/validation.php';
// include_once 'include/config.php';
date_default_timezone_set('Asia/Kathmandu');
$date=date('d/m/Y h:i:s A');
// if(isset($_POST['add_deparment']))
// {
//     $depart=$_POST['department'];
//     $date=$_POST['date'];
//     if(!empty($_POST['department']))
//     {
//         $sql_insert="INSERT INTO department(depart_name, updated_at) VALUES('$dapart','$date')";
//         $run_sql=mysqli_query($conn,$sql_insert);
//         if($run_sql==true)
//         {
//             header("location:manageservices.php");
//         }
//     }
// }

include_once 'include/header.php'; ?>
    <div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-10 offset-md-1 mt-5 py-3 bg-white from-wrapper">
            <div class="container shadow-lg py-3">
            	<h3>Manage Department</h3><hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Department Id</th>
                            <th>Department Name</th>
                            <th>Date Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php  
                        $sql_depart="SELECT * FROM department";
                        $run_depart=mysqli_query($conn,$sql_depart);
                        if(mysqli_num_rows($run_depart))
                        {
                            while($deparment=mysqli_fetch_assoc($run_depart))
                            {
                            ?>
                              <tr>
                                    <td><?=$deparment['depart_id']?></td>
                                    <td><?=$deparment['depart_name']?></td>
                                    <td><?=$deparment['updated_at']?></td>
                                    <td>
                                    <a href="manageservices.php?update_id=<?=$deparment['depart_id']?>"><button class="btn btn-success">Edit</button></a>
                                    <a href="manageservices.php?delete_id=<?=$deparment['depart_id']?>"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                 </tr>
                            <?php
                            }
                        }
                        ?> -->

                        <tr>
                            <td>1</td>
                            <td>xyz</td>
                            <td>dd/mm/yyyy</td>
                            <td></td>
                        </tr>

                        <?php
                        if(isset($_GET['action'])&&$_GET['action']=='add_department')
                        {
                        ?>
                          <tr>
                          <form action="" method="post">
                           
                            <td>#</td>
                            <td class="align-middle">
                            <input type="text" class="form-control mt-0" placeholder="Enter Department Name" name="department"  >
                            </td>
                            <td>
                            <input type="text" class="form-control mt-0" placeholder="Date" name="date" value="<?=$date?>" readonly >
                            </td>
                            <td class="align-middle text-center">

                                <button class="btn btn-success"  type="submit" name="add_department" value="add_department">Add</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:window.location='manageservices.php';">Back</button>
                            </td>
                           </form>
                         </tr>
                        <?php
                        }
                        ?>
                        <!-- <tr>
                          <form action="" method="post">
                           
                            <td>#</td>
                            <td class="align-middle">
                            <input type="text" class="form-control mt-0" placeholder="Enter Department Name" name="department"  >
                            </td>
                            <td>
                            <input type="text" class="form-control mt-0" placeholder="Date" name="date"  >
                            </td>
                            <td class="align-middle text-center">

                                <button class="btn btn-success"  type="submit" name="add_department" value="add_department">Add</button>
                                <button class="btn btn-danger" type="button" onclick="javascript:window.location='manageservices.php';">Back</button>
                            </td>

                           </form>
                         </tr> -->
                    </tbody>                    
                </table>

                <a href="manageservices.php?action=add_department"><button class="btn btn-primary">Add Department</button></a>

            </div>
            
        </div>
    </div>  
</div>
     
<?php include_once 'include/footer.php'; ?>