<?php
//if "email" variable is filled out, send email
  if (isset($_POST['submit']))  {
  
  //Email information
  $tutor_email = "ilyos_kagan@mail.ru";
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $question = $_POST['question'];
  
  //send email
  mail($tutor_email, "$subject", $question, "From:" . $email);
  
  //Email response
  echo "Your message is sent!";
  }
  
  //if "email" variable is not filled out, display the form
  else  {
?>

 <form method="post">
  Email: <input name="email" type="text" /><br />
  Subject: <input name="subject" type="text" /><br />
  Question:<br />
  <textarea name="question" rows="8" cols="60"></textarea><br />
  <input type="submit" name="submit" value="Send" />
  </form>
  
<?php
  }
?>