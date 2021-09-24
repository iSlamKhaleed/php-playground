<?php include "includes/header.php"; ?>
<?php
$emailSent = false;

if (isset($_POST['body']))
    $emailSent = SendEmail();

?>
<!-- Navigation -->

<?php include "includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-xs-10">
            <div class="form-wrap">
                <h1>Contact us</h1>
                <form action="" method="POST" enctype="multipart/form-data" id="frmSendEmail">
                    <div class="form-group form-row p-5">
                        <label for="email" class="col-sm-3 col-form-label">Email address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email">
                            <p class="error hidden" id="errEml">Please enter a valid email</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="subject" class="col-sm-3 col-form-label">Subject</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="subject" id="subject">
                            <p class="error hidden" id="errSbjct">Please enter a valid subject</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="body" class="col-sm-3 col-form-label">Email Content</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="body" id="body" rows="15"></textarea>
                            <p class="error hidden" id="errBdy">Please enter a email body</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class=" row text-center m-5">
        <div class="col-sx-10">
            <Button id="btnSendEmail" class="btn btn-primary btn-lg btn-block mt-5">Send Email</Button>
            <p id="lblResult" class="success <?php echo $emailSent ? '' : 'hidden' ?>">Email was sent</p>
        </div>
    </div>
</div>
<?php include "includes/footer.php";

function SendEmail()
{
    mail('islaam.khaleed@outlook.com', $_POST['subject'], wordwrap($_POST['body'], 70));
    return true;
}
?>
<script src="js/contact.js"></script>