<?php
$error_array = array();
if (isset($_POST['reset-request-submit'])) {
    function validateFormDataLog($formData)
    {
        $formData = trim(stripslashes(htmlspecialchars(strip_tags(str_replace(array( '(', ')', ' ' ), '_', $formData)), ENT_QUOTES)));
        return $formData;
    }

    if (!$_POST["email"]) {
    } elseif (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        array_push($error_array, "Invalid email format..<br>");
    } else {
        $userEmail = validateFormDataLog($_POST["email"]);
    }

    $emailTo = $userEmail;
    include("../../../configuration/config.php");

    $retrieve_users = mysqli_query($conn, "SELECT email FROM users");
    while ($row = mysqli_fetch_array($retrieve_users)) {
        $emailHassed = $row['email'];
        $emailDecoded =  decryptthis($emailHassed, $key);
        if ($emailTo == $emailDecoded) {
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = "www.tgnlife.com/tgnlifex/myapps/userlogin/create_new_password?selector=" . $selector . "&validator=" . bin2hex($token);
            $expires = date("U") + 1800;
            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                array_push($error_array, "There was an error..<br>");
            } else {
                mysqli_stmt_bind_param($stmt, "s", $userEmail)  ;
                mysqli_stmt_execute($stmt);
            }
            $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                array_push($error_array, "There was an error..<br>");
            } else {
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires)  ;
                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            $to = $emailTo;
            $subject = "Password Reset";
            $headers = "From: TGNLIFE <admin@tgnlife.com>";
            $message = "We received a password reset request.\n";
            $message .= "To create new password press the link below:\n\n";
            $message .= $url;

            if (mail($to, $subject, $message, $headers)) {
                header("Location: reset-password?resetpwdlink=sent");
            } else {
             echo'
                  <script>
                    $(document).ready(function(){
                         $("#myInput").click();
                     });
                  </script>
                  <div class="modal" tabindex="-1" role="dialog" id="myModal">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>There was an error in sending the link</p>
                      </div>
                      <div class="modal-footer">
                        <a href="registration_signup_page" class="btn btn-primary">Ok</a>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" data-toggle="modal" data-target="#myModal" id="myInput"/>';
                }

        } else {
            array_push($error_array, "This email is not registered..<br>");
        }
    }
}
