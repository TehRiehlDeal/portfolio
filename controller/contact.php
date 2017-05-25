<?php
    $isValid = true;

    // Check for empty fields
    if(!empty($_POST['name']))
    {
        $name = strip_tags(htmlspecialchars($_POST['name']));
    }
    else
    {
        $isValid = false;
    }
    if (!empty($_POST['email']))
    {
        $email_address = strip_tags(htmlspecialchars($_POST['email']));
    }
    else
    {
        $isValid = false;
    }
    if (!empty($_POST['message']))
    {
        $messageBody = strip_tags(htmlspecialchars($_POST['message']));
    }
    else
    {
        $isValid = false;
    }


    if ($isValid == true)
    {
        sendMessage($name, $email_address, $messageBody);
    }


    // Create the email and send the message
    function sendMessage($name, $email_address, $messageBody)
    {

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance('theriehldeal.com',
        993)
        ->setUsername('kevin@theriehldeal.com')
        ->setPassword('UFx68mHLSd2B');

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        $content = "<p>Email Address: ".$email_address."</p>".
        "<p>Name: ".$name."</p>".
        "<p>Feedback: ".$messageBody."</p>";

        // Create the message
        $message = Swift_Message::newInstance()
        ->setSubject('Made In Kent User Feedback')
        ->setFrom(array("kevin@theriehldeal.com" => "Admin"))
        ->setTo(array('kevin@theriehldeal.com' => 'Made In Kent Admin'))
        ->setBody($content, 'text/html');

        // Send the message
        $mailer->send($message);

        echo 1;
    }
?>