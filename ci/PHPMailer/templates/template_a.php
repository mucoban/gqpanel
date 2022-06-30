<?php

function getTemplate($name, $email, $subject, $message) {
    return '<html>
<body>
<h3>New Message</h3>
<br>
<p><b>Name:</b>$name</p>
<p><b>Email:</b>$email</p>
<p><b>Subject:</b>$subject</p>
<p><b>Message:</b>$message</p>
</body>
</html>';
}