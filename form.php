<?php

// Only process POST reqeusts.

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include $_SERVER['DOCUMENT_ROOT'] . "/assets/inc/variables.php";

  $email_content = "";
  $email = "";
  $name = "";

  // Get the form fields and remove whitespace.
  foreach ($_POST as $key => $post) {
    if (filter_var($post, FILTER_VALIDATE_EMAIL)) {
      $email = filter_var(trim($post), FILTER_SANITIZE_EMAIL);
      $email_content .=  "<b>" . $key . "</b>: " . filter_var(trim($post), FILTER_SANITIZE_EMAIL) . "<br /><br />";
    } else {
      if ($key != 'undefined') {
        $email_content .=  "<b>" . $key . "</b>: " . strip_tags($post) . "<br /><br />";
      }
    }
  }

  $email_content .= "<b>Page" . "</b>: " . $_SERVER["HTTP_REFERER"] . "<br/><br/>";

  //BAD OR NO EMAIL
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode('{"message": "That is an invalid email address."}');
    exit;
  }

  //BUILD EMAIL

  $subject = "New Contact for $sitename from $email";
  $body = "";

  include $_SERVER['DOCUMENT_ROOT'] . "/assets/vendor/sendgrid-php/sendgrid-php.php";


  $sendgridemail = new \SendGrid\Mail\Mail();
  $sendgridemail->setFrom("noreply@$sitedomain");
  $sendgridemail->setReplyTo($email);
  $sendgridemail->setSubject($subject);

  if ($_POST["ZipCode"] != "") {
    $sendgridemail->addTo("spam@influxmarketing.com", "");
  } else {
    $sendgridemail->addTo("$leadsemail", "");

    foreach ($bccemails as $bccemail) {
      $sendgridemail->addBcc($bccemail, "");
    }
  }

  foreach ($_FILES as $file) {
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/';
    $newname = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    //some checking to make sure uploaded file is an image, not some malicious php script
    if (!in_array(strtolower($extension), array('jpg', 'jpeg', 'png', 'gif'))) {
      http_response_code(500);
      die();
    }
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($file['tmp_name']);
    if (!in_array($detectedType, $allowedTypes)) {
      http_response_code(500);
      die();
    }
    $uploadfile = $uploaddir . $newname;
    if (move_uploaded_file($file['tmp_name'], $uploadfile)) {


      $attachment = new \SendGrid\Mail\Attachment();
      $attachment->setContent(file_get_contents($uploadfile));
      $attachment->setType(mime_content_type($uploadfile));
      $attachment->setFilename($newname);
      $attachment->setDisposition("attachment");
      $attachment->setContentId($newname);
      $sendgridemail->addAttachment($attachment);


      // $email_content .= "<img src='http://" . $_SERVER['SERVER_NAME'] . "/assets/uploads/" . $newname . "' />";


    } else {
    }
  }

  
  $emailtemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/email/lead.html');  
  $emailtemplate = str_replace('{{email_content}}', $email_content, $emailtemplate);
  
  $sendgridemail->addContent("text/html", $emailtemplate);

  $sendgrid = new \SendGrid($sendgridkey);

  try {
    $response = $sendgrid->send($sendgridemail);
    echo json_encode($response->body());
    http_response_code($response->statusCode());
  } catch (Exception $e) {
    echo json_encode('Caught exception: ' .  $e->getMessage() . "\n");
    http_response_code(400);
  }
} else {
  echo json_encode('Invalid submission');
  http_response_code(400);
}

function findURLTurnToClickableLink($string)
{

  $containslink = true;


  if (strpos($string, "http") == false) {
    $containslink = false;
  }

  return $containslink;
}
