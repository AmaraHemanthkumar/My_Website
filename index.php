<!DOCTYPE html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style type="text/css">
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-size : cover;
    }
    .header {
        font-size: 50px;
        font-family: timesroman;
        margin-top: 2vh;
        margin-bottom: 0vh;
        text-shadow: 4px 8px 12px #aaa;
        font-style: italic;     
    }
    .form-box {
        display: flex;
        flex-direction: column;
        font-size: 20px;
        padding: 20px 20px;
        margin-top: 0vh;
        border: 0.2px groove black; 
        box-shadow: 8px 12px 12px #aaa;

    }
    .form-box input {
        padding: 5px 10px;
        font-size: 20px;

    }
    .btn {
        margin-top: 20px;
        width: 50%;
        align-self: center;
    }
    .error {
        margin-top: 5vh;
        font-size: 20px;
        color: #eee;
        background-color: #dc143c;
        padding: 10px 10px;
        border-radius: 5px 5px 5px 5px 5px;
        box-shadow: 4px 8px 12px #aaa;
    }
    
</style>

<body background ="user_images\1.jpg">    
   <h2 <p style="color:gold" class="header"> Welcome to website of Shamik & Amara Construction Exports<p></h2>
    <h2 <p style="color:white" class="header">Please login here<p></h2>

        <form class="form-box" action method="post" >
            <h2> <p style="color:white" >Username   <p> </h2>
                <input type="text" id="uname" name="uname" id="uname" />
            <h2><p style="color:white">Password<p></h2>
                <input type="password" name="password" id="password" />
            <input  class="btn" type="submit" name="submit" value="Login" />
        </form>
   
</body>
</html>
    <?php
        // Initialize the session
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $db_name = "construct";
        $conn = mysqli_connect($hostname, $username, $password, $db_name);
        
        if(!$conn) {
            die("Unable to Connect");
        }

        if($_POST) 
        {
            $uname = $_POST['uname'];
            $pass = $_POST['password'];
            
            //making sure that SQL injection doesn't work
            
            $uname = mysqli_real_escape_string($conn, $uname);
            $pass = mysqli_real_escape_string($conn, $pass);
            $uname = stripcslashes($uname);
            $pass = stripcslashes($pass);
            $stmt = $conn->prepare("SELECT name, password FROM employee WHERE name=? AND password=? LIMIT 1");
            $stmt->bind_param('ss', $uname, $pass);
            $stmt->execute();
             $stmt->store_result();
           $stmt-> bind_result($uname,$pass);
           
            if($stmt->num_rows >= 1) //To check if the row exists
            {
            while($stmt->fetch()) //fetching the contents of the row
            echo "Welcome user";           
            
            header("Location: http://localhost/isaproject/dashboard.php?uname=$uname",true,301);
            }
            else {
                echo "INVALID USERNAME/PASSWORD Combination!";
            }
            $stmt->close();
            

            
            // for SQL injection
           

            /*
            $sql = "SELECT email FROM employee WHERE name='$uname' AND password='$pass'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) >= 1) 
            {
                echo "Welcome user";

                // Fix for URL Manipulation Attack
                // setcookie("uname", "$uname");  
                
                header("Location: http://localhost/isaproject/dashboard.php?uname=$uname",true,301);
            } 
            
            else 
            {
                echo "<h2 class='error'>Wrong credentials</h2>";
            }
            */
        }


    ?>

