<?php
session_start();
include('../includes/dbconn.php');

if (isset($_POST['submit'])) {
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $emailid = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    // Check if the registration number already exists
    $stmt = $mysqli->prepare("SELECT regNo FROM userRegistration WHERE regNo = ?");
    $stmt->bind_param('s', $regno);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Error: Registration number already exists!');</script>";
    } else {
        // Proceed with the registration if the registration number is not found
        $query = "INSERT INTO userRegistration(regNo, firstName, middleName, lastName, gender, contactNo, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssssss', $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $password);
        $stmt->execute();
        echo "<script>alert('Student has been Registered!');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script type="text/javascript">
    function valid(){
        if(document.registration.password.value!= document.registration.cpassword.value)
    {
        alert("Password and Confirm Password does not match");
        document.registration.cpassword.focus();
        return false;
    }
        return true;
    }
    </script>
    
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Student Registration Form</h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <form method="POST" name="registration" onSubmit="return valid();">

                    <div class="row">



                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Registration Number</h4>
                                    <div class="form-group">
                                        <input type="text" name="regno" placeholder="Enter Registration Number" id="regno" class="form-control" required oninput="checkRegNoAvailability()">
                                        <span id="regno-availability-status" style="font-size:12px;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">First Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" placeholder="Enter First Name" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Middle Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="mname" id="mname" placeholder="Enter Middle Name" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Last Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="lname" id="lname" placeholder="Enter Middle Name" required class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Gender</h4>
                                        <div class="form-group mb-4">
                                            <select class="custom-select mr-sm-2" id="gender" name="gender" required="required">
                                                <option selected>Choose...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Contact Number</h4>
                                        <div class="form-group">
                                            <input type="tel" name="contact" id="contact" placeholder="Your Contact" required="required" class="form-control" maxlength="10">
                                            <small id="contactError" class="text-danger" style="display: none;">Please enter a valid 10-digit contact number.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            document.getElementById("contact").addEventListener("input", function () {
                                const contact = this.value;
                                const error = document.getElementById("contactError");
                                const isValid = /^[0-9]{10}$/.test(contact);

                                if (!isValid) {
                                    error.style.display = "block";
                                    this.classList.add("is-invalid");
                                } else {
                                    error.style.display = "none";
                                    this.classList.remove("is-invalid");
                                }
                            });
                            </script>




                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Email ID</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" placeholder="Your Email" onBlur="checkAvailability()" required="required" class="form-control">
                                        <small id="emailError" class="text-danger" style="display: none;">Please enter a valid email address.</small><br>
                                        <span id="user-availability-status" style="font-size:12px;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

<script>
function checkAvailability() {
    const email = document.getElementById("email").value;
    const error = document.getElementById("emailError");
    const availability = document.getElementById("user-availability-status");
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Step 1: Check email format
    if (!regex.test(email)) {
        error.style.display = "block";
        availability.innerHTML = "";
        return;
    } else {
        error.style.display = "none";
    }

    // Step 2: Simulated AJAX check (replace this with real AJAX call)
    // Example: check if the email is already taken
    availability.style.color = "gray";
    availability.innerHTML = "Checking availability...";

    // Simulate delay
    setTimeout(() => {
        // Dummy logic: Let's say "test@example.com" is already taken
        if (email === "test@example.com") {
            availability.style.color = "red";
            availability.innerHTML = "This email is already in use.";
        } else {
            availability.style.color = "green";
            availability.innerHTML = "This email is available.";
        }
    }, 1000);
}
</script>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Password</h4>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="Enter Password" required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Confirm Password</h4>
                                        <div class="form-group">
                                            <input type="password" name="cpassword" id="cpassword" placeholder="Enter Confirmation Password" required="required" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>



                    </div>
                

                        <div class="form-actions">
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-success">Register</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                
                </form>


            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include '../includes/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!-- customs -->
    <script>
    function checkAvailability() {

        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'emailid='+$("#email").val(),
        type: "POST",
        success:function(data){
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
            },
                error:function ()
            {
                event.preventDefault();
                alert('error');
            }
        });
    }

    function checkRegNoAvailability() {
    const regno = document.getElementById("regno").value;
    const availability = document.getElementById("regno-availability-status");

    if (regno === "") {
        availability.innerHTML = "";
        return;
    }

    // Simulated AJAX check (replace this with real AJAX call)
    availability.style.color = "gray";
    availability.innerHTML = "Checking availability...";

    $.ajax({
        url: "check-regno.php", // Create this PHP file to handle the check
        type: "POST",
        data: { regno: regno },
        success: function(data) {
            if (data === "available") {
                availability.style.color = "green";
                availability.innerHTML = "This registration number is available.";
            } else {
                availability.style.color = "red";
                availability.innerHTML = "This registration number is already in use.";
            }
        },
        error: function() {
            availability.innerHTML = "Error checking availability.";
        }
    });
}
    </script>



</body>

</html>