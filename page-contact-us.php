<?php 
/*
Template Name: Custom Wordpress Test Form
*/

error_reporting(-1);

$response = "";
$YEAR = date("Y");

global $userdata;
global $wpdb;
//wp_enqueue_script("h5validate", SYSTEM_ROOT."/javascript/jquery.h5validate.js");
  //function to generate response
  function registration_form_response($type, $message){

    global $response;
    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }

  //response messages
  $not_human            = "Human verification incorrect.";
  $missing_content      = "Please supply all information.";
  $email_invalid        = "Email Address Invalid.";
  $cardnumber_invalid   = "Please enter valid cardnumber";
  $cvv_invalid          = "Please enter CVV code";
  $month_invalid        = "Please Select Month";
  $year_invalid         = "Please Select Year";
  $password_invalid     = "Password and Confirm Password not match";
  $message_unsent       = "Message was not sent. Try Again.";
  $user_exists          =  "Username Already In Use!";
  $message_sent         = "Thanks! Your message has been sent.";




//user posted variables
$arrUserPost['user_login'] = $arrUserPost['full_name'] = $arrUserPost['display_name'] = trim($_POST['fullName']);
$arrUserPost['user_email'] = trim($_POST['email']);
$arrUserPost['user_pass'] = trim($_POST['password']);
  $confirmPassword = trim($_POST['confirmPassword']);
  $cardNum = trim($_POST['cardNum']);
  $cvv = trim($_POST['cvv']);
  $expirationMonth = trim($_POST['expirationMonth']);
  $expirationYear = trim($_POST['expirationYear']);
  $message_human  = trim($_POST['message_human']);
  $human  = trim($_POST['submitted']);

  //php mailer variables
  $to = get_option('admin_email');
  $subject = "Someone sent a message from ".get_bloginfo('name');
  $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

// Insert into Query Running Successfully
/*    $wpdb->insert(
  'wp_users',
  array(
    'user_login' => $name,
    'user_email' => $email,
    'user_pass' => wp_hash_password($password)
  ),
  array(
    "%s",
    "%s",
    "%s"
  )
);*/


/*$username = 'admin';
       if ( username_exists( $username ) )
           echo "Username In Use!";
       else
           echo "Username Not In Use!";*/

//Select Query Running
/*$sql = "SELECT * FROM wp_users ";
$result = $wpdb->get_results($sql) or die(mysql_error());

    foreach( $result as $results ) {

        $test[] =  $results;
    }

*/


  //if(!$human == 0){
 /* if($human){
    if($message_human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {
      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($arrUserPost['user_login'])){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
          //$sent = wp_mail($to, $subject, strip_tags($message), $headers);
          $sent = mail($to, $subject, strip_tags($message), $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
          if ( username_exists( $username ))
            my_contact_form_generate_response("error", $user_exists);
        }

        if((empty($password) || empty($confirmPassword)) || ($password != $confirmPassword)){
            my_contact_form_generate_response("error", $password_invalid);
        }


      }
      

    }
  }
  else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);*/
/*|| !isset($arrUserPost['email'])      || 
      !isset($arrUserPost['password'])   || !isset($confirmPassword)           ||
      !isset($cardNum)                   || !isset($cvv)*/
if(!$human == 0){
  /*if(!isset($arrUserPost['user_login'])){
        registration_form_response("error","If".$missing_content);
    }
    else if(isset($arrUserPost['user_login'])){

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            registration_form_response("error", $email_invalid);
            return false;
        }
         if (username_exists($arrUserPost['user_login']))
            registration_form_response("error", $user_exists); 
            return false;

        if($arrUserPost['user_pass'] != $confirmPassword){
           registration_form_response("error", $password_invalid); 
           return false;
        }
        if($message_human!=2){
          registration_form_response("error",$not_human);  
        }
          
          registration_form_response("success","Your details saved Successfully");

    }*/
    if(empty($arrUserPost['user_login']) || empty($arrUserPost['user_email']) || empty($arrUserPost['user_pass']) || 
       empty($confirmPassword) || empty($cardNum) || empty($cvv)){
          registration_form_response("error","If".$missing_content);              // Blank Fields
    } else if(!filter_var($arrUserPost['user_email'], FILTER_VALIDATE_EMAIL)){
        registration_form_response("error", $email_invalid);                      // Invalid Email address
    } else if (username_exists($arrUserPost['user_login'])){                      
            registration_form_response("error", $user_exists);                    // Username exisits
    } else if($arrUserPost['user_pass'] != $confirmPassword){
           registration_form_response("error", $password_invalid);                // Password and confirm password not match
    } else if($message_human!=2){
          registration_form_response("error",$not_human);                         // Invalid answer
    } else if(strlen($cardNum)<11){
          registration_form_response("error","Invalid card number");              //Invlid Card Number
    } else{
       registration_form_response("success","Your details saved Successfully");   // Success Save details
    }

}else if ($_POST['submitted']) registration_form_response("error", "Else".$missing_content);




get_header(); 
global $PAGE_ID;
$options = get_option('infinite_options');
?>

<?php while ( have_posts() ) : the_post(); 
$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
$featured_image = $featured_image_array[0];
$sidebar = get_post_meta(get_the_ID(), SYSTEM_VAR_PREFIX."select_sidebar", true);
?>
             <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
              <!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
            </header>

            <div class="entry-content">
              <?php the_content(); ?>

              <style type="text/css">
                .error{
                  padding: 5px 9px;
                  border: 1px solid red;
                  color: red;
                  border-radius: 3px;
                }

                .success{
                  padding: 5px 9px;
                  border: 1px solid green;
                  color: green;
                  border-radius: 3px;
                }

                .required{
                  color: red;
                }
              </style>

              <!-- <div id="respond">
                <?php echo $response; ?>
                <form action="<?php the_permalink(); ?>" method="post">
                  <p><label for="name">Name: <span>*</span> <br><input type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>"></label></p>
                  <p><label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>"></label></p>
                  <p><label for="message_text">Message: <span>*</span> <br><textarea type="text" name="message_text"><?php echo esc_textarea($_POST['message_text']); ?></textarea></label></p>
                  <p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
                  <input type="hidden" name="submitted" value="1">
                  <p><input type="submit"></p>
                </form>
              </div> -->
              <div class="one">
              <form action ="<?php the_permalink(); ?>" method="Post" id="registrationForm"  name="registrationForm">
                 <?php echo $response; ?> <br>
                <h2 class="title">Basic Details</h2>
                <div class="divider" style="height: 30px;"></div>
                <div class="clear"></div>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"><span class="font-bold">Full Name </span><span class="required">*</span></div>
                <div class="one-fourth"><input name="fullName" type="text" id="fullName" placeholder="Full Name" value="<?php echo esc_attr($_POST['fullName']); ?>"></div>
                <div class="one-fourth"><span class="font-bold">E-mail</span><span class="required">*</span></div>
                <div class="one-fourth last"><input name="email" id="email" type="email" placeholder="sample@example.com" title = "Please enter valid email" value="<?php echo esc_attr($_POST['email']); ?>"></div>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth last"></div>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"><span class="font-bold">Password</span><span class="required">*</span></div>
                <div class="one-fourth"><input name="password" type="password" id="password" placeholder="Password"></div>
                <div class="one-fourth"><span class="font-bold">Confirm Password</span><span class="required">*</span></div>
                <div class="one-fourth last"><input name="confirmPassword" type="password" id="confirmPassword" placeholder="Confirm Password"></div>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth last"></div>
                <div class="divider" style="height: 50px;"></div>
                <div class="clear"></div>
                <h2 class="title">Payment Details</h2>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"><span class="font-bold">Card Number</span><span class="required">*</span></div>
                <div class="one-fourth"><input maxlength="16" name="cardNum" id="cardNum" size="30" type="number" placeholder="Card Number" value="<?php echo esc_attr($_POST['cardNum']); ?>"></div>
                <div class="one-fourth"><span class="font-bold">CVV</span><span class="required">*</span></div>
                <div class="one-fourth last"><input maxlength="4" name="cvv" id="cvv" type="password" placeholder="CVV"></div>
                <div class="one-fourth"><span class="font-bold">Expiration Month / Year </span> <span class="required">*</span>&nbsp;</div>
                <div class="one-fourth">
                  <select name="expirationMonth" id="expirationMonth">
                    <option value="00" selected="selected" disabled="disabled"> Select Month</option>
                    <option value="01"> Jan </option>
                    <option value="02"> Feb </option>
                    <option value="03"> Mar </option>
                    <option value="04"> Apr </option>
                    <option value="05"> May </option>
                    <option value="06"> June </option>
                    <option value="07"> July </option>
                    <option value="08"> Aug </option>
                    <option value="09"> Sept </option>
                    <option value="10"> Oct </option>
                    <option value="11"> Nov </option>
                    <option value="12"> Dec </option>
                  </select>
              </div>
              <div class="one-fourth">
                <select name="expirationYear" id="expirationYear">
                  <option value="00" selected="selected" disabled="disabled"> Select Year</option>
                  <?php
                      for($intYear = $YEAR; $intYear < ($YEAR + 10); $intYear++)
                         echo "<option value=".$intYear."> ".$intYear." </option>"
                  ?>
                </select>
              </div>

              <div class="one-fourth last"></div>
              <div class="one-fourth"><span class="font-bold">Human Verification</span><span class="required">*</span></div>
                <div class="one-fourth"><input name="message_human" type="text" id="message_human " placeholder="X"> +3= 5</div>
                <div class="one-fourth"><input type="hidden" name="submitted" value="1"></div>
                <div class="one-fourth last"></div>
              <div class="one"><input name="submit" type="submit" value="Register Now"></div>
              </form>
            </div>
            </div><!-- .entry-content -->
          </article><!-- #post -->
<?php
if (get_post_meta(get_the_ID(), SYSTEM_VAR_PREFIX."add_class_title", true) != "no")
{
?>

<?php
}
if ($sidebar) get_sidebar(); 
?>

<?php endwhile; // end of the loop. ?> 
		
<?php get_footer(); ?>
			