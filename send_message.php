<?php
require('connection.php');
require('function.php');
$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$subject=get_safe_value($con,$_POST['subject']);
$message=get_safe_value($con,$_POST['message']);
$added_on=date('Y-m-d h:i:s');
mysqli_query($con,"insert into contact_us(name,email,subject,message,added_on) values('$name','$email','$subject','$message','$added_on')");
?>