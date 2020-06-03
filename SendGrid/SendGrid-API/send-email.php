<?php
/*SendGrid Library*/
require_once ('vendor/autoload.php');

/*Post Data*/

/*Content*/
$from = new SendGrid\Email("Yash Gupta", "itsyashgupta.18@gmail.com");
$subject = "SUBJECT";
$to = new SendGrid\Email("shubham", "patidarshubham12345@gmail.com");
$content = new SendGrid\Content("text/html", "<h1>hello</h1>");

/*Send the mail*/
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = ('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');
$sg = new \SendGrid($apiKey);

/*Response*/
$response = $sg->client->mail()->send()->post($mail);
?>

<!--Print the response-->
<pre>
    <?php
    var_dump($response);
    ?>
</pre>
