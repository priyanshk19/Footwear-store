<?php
session_start(); // Start session if not already started
require('connection.php');

// Function to safely retrieve data from $_POST
function get_safe_value($con, $str)
{
    if ($str != '') {
        $str = mysqli_real_escape_string($con, $str);
        return $str;
    }
    return '';
}

if (isset($_SESSION['USER_NAME'])) {
    $username = $_SESSION['USER_NAME'];
    $sql = "SELECT * FROM users WHERE name = '$username'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $name = $user['name'];
        $phoneNo = $user['mobile'];
        $email = $user['email'];
        // Password should not be fetched directly for security reasons
    } else {
        echo "<p>User not found.</p>";
        exit;
    }
} else {
    echo "<p>No user name provided.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = get_safe_value($con, $_POST['first_name']);
    $email = get_safe_value($con, $_POST['email']);
    $phoneNo = get_safe_value($con, $_POST['phone']);
    $userpassword = isset($_POST['userpassword']) ? get_safe_value($con, $_POST['userpassword']) : $user['password']; // Use existing password if not changed

    // Update query
    $sql = "UPDATE users SET name='$name', mobile='$phoneNo', email='$email', password='$userpassword' WHERE name='$username'";

    if (mysqli_query($con, $sql)) {
        $_SESSION['USER_NAME'] = $name; // Update session with new username if changed
        header("Location: index.php"); // Redirect to profile page after successful update
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            width: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #3498db;
            color: #fff;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .profile-header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        .profile-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .profile-details .row {
            display: flex;
            margin-bottom: 20px;
        }

        .profile-details .col {
            flex: 1;
            margin-right: 10px;
        }

        .profile-details .col:last-child {
            margin-right: 0;
        }

        .profile-details label {
            display: block;
            margin-bottom: 5px;
        }

        .profile-details input,
        .profile-details textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .profile-details button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .profile-details button:hover {
            background-color: #2980b9;
        }

        .progress-bar {
            background-color: #ecf0f1;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress {
            background-color: #2c3e50;
            height: 10px;
            width: 70%; /* Adjust according to the progress */
            border-radius: 5px 0 0 5px;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="sidebar">
            <h2>
                <?php
                if (isset($_SESSION['USER_NAME'])) {
                    echo htmlspecialchars($_SESSION['USER_NAME']); // Display the username
                }
                ?>
            </h2>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="profile-header">
                <h2>Profile</h2>
                <p>Joined Since 2024</p>
                <div class="progress-bar">
                    <div class="progress" style="width: 70%;"></div>
                </div>
            </div>
            <div class="profile-details">
                <form method="post">
                    <div class="row">
                        <div class="col">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                        <div class="col">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phoneNo); ?>" required>
                        </div>
                    </div>
                    
                    <button type="submit" id="update" class="update">Update Profile</button>
                    <button type="button" onclick="window.location.href='index.php';" class="back">Back</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
