<?php
require('top.php');


$name = '';
$email = '';

if(isset($_SESSION['USER_ID'])) {
    $user_id = $_SESSION['USER_ID'];

    $result = mysqli_query($con, "select name, email FROM users where id = $user_id");

   
    if($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $name = $user['name'];
        $email = $user['email'];
    }
}
?>

<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="contact-form-wrap mt--60">
                <div class="col-xs-12">
                    <div class="contact-title">
                        <h2 class="title__line--6">SEND A MESSAGE</h2>
                    </div>
                </div>
                <div class="col-xs-12">
                    <form id="contact-form"  method="post">
                        <div class="single-contact-form">
                            <div class="contact-box name">
                                <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Your Name*">
                                <input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="Mail*">
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box subject">
                                <input type="text" id="subject" name="subject" placeholder="Subject*">
                                <span class="field_error" id="subject_error"></span>
                            </div>
                        </div>
                        <div class="single-contact-form">
                            <div class="contact-box message">
                                
                            <textarea name="message" id="message" placeholder="Your Message"></textarea>
                            <span class="field_error" id="message_error"></span>

                        </div>
                        </div>
                        <div class="contact-btn">
                            <button type="button"  onclick="send_message()" class="fv-btn">Send MESSAGE</button>
                        </div>
                    </form>
                    <div class="form-output contact_msg">
                        <p class="form-messege field_error"></p>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<?php
require('footer.php');
?>
