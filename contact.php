<?php
/* Set e-mail recipient */
$myemail  = "productorestayasanmarcos@gmail.com";

/* Check all form inputs using check_input function */
$yourname = check_input($_POST['name'], "Enter your name");
$surname = check_input($_POST['surname'], "Enter your surname");
$subject  = check_input($_POST['subject'], "Write a subject");
$email    = check_input($_POST['email']);
$comments = check_input($_POST['message'], "Write your comments");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}



/* Let's prepare the message for the e-mail */
$message = "Hola administrador de APT!

Un visitante de su página web necesita contactarse con usted:

Nombre del visitante: $yourname  $surname

E-mail/Correo: $email

Dejó el mensaje: $comments

Gracias por su trabajo!

(Si quiere modificar esta estrucuta comuníquese con ©Developer Bravo's - hbravos.info@gmail.com)
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: index.html#thanks');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
    ?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
    <?php
    exit();
}
?>