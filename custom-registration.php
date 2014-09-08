<?php 
/*
Template Name: Custom Wordpress NuFit Registration
*/

$response = "";
$YEAR = date("Y");

global $userdata;
global $wpdb;

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


if(!$human == 0){
    if(empty($arrUserPost['user_login']) || empty($arrUserPost['user_email']) || empty($arrUserPost['user_pass']) || 
       empty($confirmPassword) || empty($cardNum) || empty($cvv)){
          registration_form_response("error",$missing_content);              // Blank Fields
    } else if(!filter_var($arrUserPost['user_email'], FILTER_VALIDATE_EMAIL)){
        registration_form_response("error", $email_invalid);                      // Invalid Email address
    } else if (username_exists($arrUserPost['user_login'])){                      
            registration_form_response("error", $user_exists);                    // Username exisits
    } else if(email_exists( $arrUserPost['user_email'] )){
            registration_form_response('error', "Email already exisits!");        //Email exisits
    } else if($arrUserPost['user_pass'] != $confirmPassword){
           registration_form_response("error", $password_invalid);                // Password and confirm password not match
    } else if($message_human!=2){
          registration_form_response("error",$not_human);                         // Invalid answer
    } else if(strlen($cardNum)<11){
          registration_form_response("error","Invalid card number");              //Invlid Card Number
    }else if(($expirationMonth ==0 || $expirationYear ==0) || ($expirationMonth < date('m') && $expirationYear < $YEAR)){
       registration_form_response("error","Invalid Card Date");                   // Invalid card date
    } else{
      // Insert into Query Running Successfully
      $arrUserPost['user_registered'] = date('Y-m-d H:i:s');
      $arrUserPost['user_pass'] = wp_hash_password($arrUserPost['user_pass']);
        $wpdb->insert(
        'wp_users',
          $arrUserPost,
        array(
          "%s",
          "%s",
          "%s",
          "%s",
          "%s",
          "%s",
          "%s"
        )
      );

       registration_form_response("success","Your details saved successfully");   // Success Save details
       $arrUserPost= array();
       $_POST['fullName'] = $_POST['email'] = $_POST['email'] = $_POST['cardNum'] = "";
    }

}else if ($_POST['submitted']) registration_form_response("error", $missing_content);




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

<div class="one">
  <form action ="<?php the_permalink(); ?>" method="Post" id="registrationForm"  name="registrationForm">
    <?php echo $response; ?> <br>
    <h2 class="title">Basic Details</h2>
    <div class="divider" style="height: 30px;"></div>
    <div class="clear"></div>
    <div class="one-half"></div>
    <div class="one-half last"></div>
    <div class="one-fourth">
      <span class="font-bold">Full Name </span><span class="required">*</span>
    </div>
  <div class="one-fourth">
    <input name="fullName" type="text" id="fullName" placeholder="Full Name" value="<?php echo esc_attr($_POST['fullName']); ?>">
  </div>
  <div class="one-fourth">
    <span class="font-bold">E-mail</span><span class="required">*</span>
  </div>
  <div class="one-fourth last">
    <input name="email" id="email" type="email" placeholder="sample@example.com" title = "Please enter valid email" value="<?php echo esc_attr($_POST['email']); ?>">
  </div>
  <div class="one-half"></div>
  <div class="one-half last"></div>
  <div class="one-fourth"></div>
  <div class="one-fourth"></div>
  <div class="one-fourth"></div>
  <div class="one-fourth last"></div>
  <div class="one-half"></div>
  <div class="one-half last"></div>
  <div class="one-fourth">
    <span class="font-bold">Password</span><span class="required">*</span>
  </div>
  <div class="one-fourth">
    <input name="password" type="password" id="password" placeholder="Password">
  </div>
  <div class="one-fourth">
    <span class="font-bold">Confirm Password</span><span class="required">*</span>
  </div>
  <div class="one-fourth last">
    <input name="confirmPassword" type="password" id="confirmPassword" placeholder="Confirm Password">
  </div>
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
  <div class="one-fourth">
    <span class="font-bold">Card Number</span><span class="required">*</span>
  </div>
  <div class="one-fourth">
    <input maxlength="16" name="cardNum" id="cardNum" size="30" type="number" placeholder="Card Number" value="<?php echo esc_attr($_POST['cardNum']); ?>">
  </div>
  <div class="one-fourth">
    <span class="font-bold">CVV</span><span class="required">*</span>
  </div>
  <div class="one-fourth last">
    <input maxlength="4" name="cvv" id="cvv" type="password" placeholder="CVV">
  </div>
  <div class="one-fourth">
    <span class="font-bold">Expiration Month / Year </span> <span class="required">*</span>&nbsp;
  </div>
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
  <div class="one-fourth">
      <span class="font-bold">Human Verification</span><span class="required">*</span>
  </div>
  <div class="one-fourth">
    <input name="message_human" type="text" id="message_human " placeholder="X"> +3= 5
  </div>
  <div class="one-fourth">
    <input type="hidden" name="submitted" value="1">
  </div>
  <div class="one-fourth last"></div>
  <div class="one">
    <input type="checkbox" id="privacyPolicy"> <label for="privacyPolicy">I agree to and have read and understood the 
    <a href="<?php echo home_url().'/privacy-policy'?>" target="_blank"> Privacy Policy </a>
  </div>
  <div class="one">
    <input name="submit" id="registerNow" class="btn-disbaled" type="submit" value="Register Now" disabled>
  </div>
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
<script>
  //$("#privacyPolicy").not("")
  $=jQuery;
  $("#privacyPolicy").on("change", function(){
    if($(this).is(":checked")){
      $("#registerNow").removeAttr("disabled");
      $("#registerNow").removeClass("btn-disbaled");
    }
    else{
      $("#registerNow").attr("disabled","disabled");
      $("#registerNow").addClass("btn-disbaled");
    }
  })
</script>
<?php get_footer(); ?>
			