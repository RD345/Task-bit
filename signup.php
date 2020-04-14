<?php
// Include config file
require_once "Model/database.php";
 
// Define variables and initialize with empty values
$fname = $lname = $college = $major = $username = $password = $confirm_password = "";
$fname_err = $lname_err = $college_err = $major_err = $username_err = $password_err = $confirm_password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	// Validate First Name
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter your first name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT fname FROM accounts WHERE fname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_fname);
            
            // Set parameters
            $param_fname = trim($_POST["fname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(!preg_match("/^[a-zA-Z ]*$/", $param_fname)){
                    $fname_err = "That is not a valid first name.";
                } else{
                    $fname = trim($_POST["fname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
	
	// Validate Last Name
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter your last name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT lname FROM accounts WHERE lname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_lname);
            
            // Set parameters
            $param_lname = trim($_POST["lname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(!preg_match("/^[a-zA-Z ]*$/", $param_lname)){
                    $lname_err = "That is not a valid last name.";
                } else{
                    $lname = trim($_POST["lname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
	
	// Validate College
    if(empty(trim($_POST["college"]))){
        $college_err = "Please enter your college.";
    } else{
        // Prepare a select statement
        $sql = "SELECT college FROM accounts WHERE college = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_college);
            
            // Set parameters
            $param_college = trim($_POST["college"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(!preg_match("/^[a-zA-Z ]*$/", $param_college)){
                    $college_err = "That is not a valid college.";
                } else{
                    $college = trim($_POST["college"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

	// Validate Major
    if(empty(trim($_POST["major"]))){
        $major_err = "Please enter your major.";
    } else{
        // Prepare a select statement
        $sql = "SELECT major FROM accounts WHERE major = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_major);
            
            // Set parameters
            $param_major = trim($_POST["major"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(!preg_match("/^[a-zA-Z ]*$/", $param_major)){
                    $major_err = "That is not a valid major.";
                } else{
                    $major = trim($_POST["major"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM accounts WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else if (!preg_match("/\S+@\S+\.\S+/", $param_username)){
					$username_err = "That is not a valid a username.";
				} else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($college_err) && empty($major_err) 
		&& empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO accounts (email, password, fname, lname, college, major) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_fname, $param_lname, $param_college, $param_major);
           
			
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_fname = $fname;
            $param_lname = $lname;
			$param_college = $college;
			$param_major = $major;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
			<div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" placeholder = "i.e John" value="<?php echo $fname; ?>">
                <span class="help-block"><?php echo $fname_err; ?></span>
            </div> 
			
			<div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" placeholder = "i.e Appleseed" value="<?php echo $lname; ?>">
                <span class="help-block"><?php echo $lname_err; ?></span>
            </div> 
			
			<div class="form-group <?php echo (!empty($college_err)) ? 'has-error' : ''; ?>">
                <label>College</label>
                <input type="text" name="college" class="form-control" placeholder = "i.e New Jersey Institute of Technology" value="<?php echo $college; ?>">
                <span class="help-block"><?php echo $college_err; ?></span>
            </div> 
			
			<div class="form-group <?php echo (!empty($major_err)) ? 'has-error' : ''; ?>">
                <label>Major</label>
                <input type="text" name="major" class="form-control" placeholder = "i.e Information Systems" value="<?php echo $major; ?>">
                <span class="help-block"><?php echo $major_err; ?></span>
            </div> 
			
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder = "i.e johnappleseed@njit.edu" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 
			
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder = "i.e abc123" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>