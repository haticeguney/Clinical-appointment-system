<?php require('header.php');
include("dbconnection.php");
?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="./index.php">Home</a>
            </li>
            <li>
                <a href="./appointment.php">Appointments</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> All Appointments</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <div class="alert alert-info">You can check all appointments from this page. If you want to add new appointment <a href="./makeappointment.php" target="_blank">click here</a></div>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Appointment Date</th>
        <th>Patient Name</th>
        <th>Doctor</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <? 
        $appointment = mysqli_query($link,"SELECT * FROM appointment");
        while($row = mysqli_fetch_array($appointment))
        {
            $patient = mysqli_query($link,"SELECT * FROM patient WHERE id='$row[patientid]'");
            $doctor = mysqli_query($link,"SELECT * FROM doctor WHERE id='$row[doctorid]'");

            echo "<td class='center'>".$row['appdate']."</td>";

            while ($patientrow = mysqli_fetch_array($patient)) {
                echo "<td>".$patientrow['name']." ".$patientrow['surname']."</td>";
                
            }

            while ($doctorrow = mysqli_fetch_array($doctor)) {
                echo "<td>".$doctorrow['name']." ".$doctorrow['surname']."</td>";
                
            }

            $status = trim($row['appstatus']);
                switch ($status) {
                    case "cancel":
                        $class = "label-danger label label-default";
                        $message = 'Canceled';
                        break;
                    case "active":
                        $class = "label-success label label-default";
                        $message = 'Actived';
                        break;
                    default:
                        $class = "label-success label label-default";
                        $message = 'Active';
                        break;
                }

            echo "<td class='center'>";
            echo "<span class='".$class."'>".$message."</span>";
            echo "</td>";

            json_encode($doctor);

        }
        ?>
        <td class="center">
            <a class="btn btn-success" href="#">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                View
            </a>
            <a class="btn btn-info" href="#">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            <a class="btn btn-danger" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Cancel
            </a>
        </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->

    <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-calendar"></i> Calendar</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">


                <div id="calendar"></div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div><!--/row-->


<?php require('footer.php'); ?>