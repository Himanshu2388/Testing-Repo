<?php 
/*
Template Name: Custom Wordpress NuFit Profile
*/

$response = "";
$YEAR = date("Y");

global $userdata;
global $wpdb;
global $current_user;


if (!is_user_logged_in()) { 
  wp_safe_redirect(home_url());
}

$userId = get_current_user_id();

$programAction = isset($_POST['action']) ? $_POST['action'] : "";

if($programAction!=""){
    switch($programAction){
        case "updatePersonalDetailsAct": {

            break;
        }

        case "updateMeasurementAction": {

                /*
                check if data row exists in wp_measurements for this user_id....
                IF YES --> (1) fetch data from wp_measuements
                            (2) import this data into wp_measurements_history
                            (3) update current wp_measurements with new values

                If NO --> insert data in wp_measurements;

                */

                $arrInsertMeasurementData = array();
                $arrInsertMeasurementData['height']           = trim($_POST['measureHeight']);
                $arrInsertMeasurementData['weight']           = trim($_POST['measureWeight']);
                $arrInsertMeasurementData['neck']             = trim($_POST['measureNeck']);
                $arrInsertMeasurementData['chest']            = trim($_POST['measureChest']);
                $arrInsertMeasurementData['arms']             = trim($_POST['measureArms']);
                $arrInsertMeasurementData['waist']            = trim($_POST['measureWaist']);
                $arrInsertMeasurementData['stomach_belly']    = trim($_POST['measureStomach']);
                $arrInsertMeasurementData['hips']             = trim($_POST['measureHips']);
                $arrInsertMeasurementData['shirt_waist']      = trim($_POST['shirtSizeWaist']);
                $arrInsertMeasurementData['shirt_height']     = trim($_POST['shirtSizeHeight']);
                $arrInsertMeasurementData['pants_waist']      = trim($_POST['pantsSizeWaist']);
                $arrInsertMeasurementData['pants_height']     = trim($_POST['pantsSizeHeight']);
                $arrInsertMeasurementData['user_id']          = $userId;
                $wpdb->insert(
                        'wp_measurements',
                        $arrInsertMeasurementData,
                        array(
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%s",
                            "%d",
                    )
                );
                
            break;
        }
    }
}

  //function to generate response
  function registration_form_response($type, $message){

    global $response;
    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }

  //response messages
/*  $not_human            = "Human verification incorrect.";
  $missing_content      = "Please supply all information.";
  $email_invalid        = "Email Address Invalid.";
  $cardnumber_invalid   = "Please enter valid cardnumber";
  $cvv_invalid          = "Please enter CVV code";
  $month_invalid        = "Please Select Month";
  $year_invalid         = "Please Select Year";
  $password_invalid     = "Password and Confirm Password not match";
  $message_unsent       = "Message was not sent. Try Again.";
  $user_exists          =  "Username Already In Use!";
  $message_sent         = "Thanks! Your message has been sent.";*/


//user posted variables
/*  $arrUserPost['user_login'] = $arrUserPost['full_name'] = $arrUserPost['display_name'] = trim($_POST['fullName']);
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
    'Reply-To: ' . $email . "\r\n";*/

/*$username = 'admin';
       if ( username_exists( $username ) )
           echo "Username In Use!";
       else
           echo "Username Not In Use!";*/

//Select Query Running
if (is_user_logged_in()){
  $sql = "SELECT * FROM wp_users ";
  $result = $wpdb->get_results($sql) or die(mysql_error());

      foreach( $result as $results ) {

          $arrUserData[] =  $results;
      }


$arrUserDetails['name'] =" ";// isset($current_user->user_login) ? $current_user->user_login : '';
}


/*if(!$human == 0){
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

}else if ($_POST['submitted']) registration_form_response("error", $missing_content);*/


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
                .active-state{
                    background: #D5E2AA;
                }
                .tab-link{
                    text-decoration: underline;
                    font-size: 17px;
                }

                  /* -----------------TABS-------------------------------- */

  #tabs {
    overflow: hidden;
    width: 100%;
    margin: 0;
    padding: 0;
    list-style: none;
  }

  #tabs li {
    float: left;
    margin: 0 -15px 0 0;
  }

  #tabs a {
    float: left;
    position: relative;
    padding: 0 40px;
    height: 0;
    line-height: 30px;
    text-transform: uppercase;
    text-decoration: none;
    color: #fff;      
    border-right: 30px solid transparent;
    border-bottom: 30px solid #0B5730;
    border-bottom-color: #777\9;
    opacity: .6;
    filter: alpha(opacity=30);      
  }

  #tabs a:hover,
  #tabs a:focus{
    border-bottom-color: #0B5730;
    opacity: 1;
    filter: alpha(opacity=100);
  }

  #tabs a:focus {
    outline: 0;
  }

  #tabs #current {
    z-index: 3;
    border-bottom-color: #0B5730;
    opacity: 1;
    filter: alpha(opacity=100);      
  }

  /* ----------- */
  #content {
      background: #fff;
      border-top: 2px solid #0B5730;
      padding: 2em;
      /*height: 220px;*/
  }

  #content h2,
    #content h3,
    #content p {
      margin: 0 0 15px 0;
  }


    .cd-left, .cd-right, .cd-left span, .cd-right span { background: url("<?php echo home_url(); ?>/wp-content/themes/fitness/images/switch.jpg") repeat-x; display: block; float: left; }
    .cd-left span, .cd-right span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
    .cd-left span { background-position: left -90px; padding: 0 10px; }
    .cd-right span { background-position: right -180px;padding: 0 10px; }

        /*    .cd-right.selected { background-position: 0 -30px; }
            .cd-right.selected span { background-position: right -210px; color: #fff; }*/


    .cd-right.selected { background-position: 0 -60px; }
    .cd-right.selected span { background-position: right -240px; color: #fff; }
    .cd-left.selected { background-position: 0 -60px; }
    .cd-left.selected span { background-position: left -150px; color: #fff; }
    .switch label { cursor: pointer; }
    .switch input { display: none; }

  .resize-none{
    resize:none;
  }
  .one-fourth-heading{
    font-weight: bold !important;
     padding-bottom: 2%;
  }

              </style>

<div class="one">
</div>
</div><!-- .entry-content -->
</article><!-- #post -->

<ul id="tabs">
    <li><a href="#" name="tab1">Personal Details</a></li>
    <li><a href="#" name="tab2">Measurements</a></li>
    <li><a href="#" name="tab3">Payment Details</a></li>
    <li><a href="#" name="tab4">Miscellaneous</a></li>    
</ul>

  <div id="content">
    <div id="tabTitle" class="one-fourth-heading"></div>
      <div id="tab1">
        <form id="personalDetials" name="personalDetails" action ="<?php the_permalink(); ?>" method="Post">
            <div class="one-fourth one-fourth-heading">Name <br> <input type='text' name="fullName" id="fullName" value="<?php echo '' ?>" ></div>
            <div class="one-fourth one-fourth-heading">DOB <br> <input id="datetimepicker" type="date" ></div>
            <div class="one-fourth one-fourth-heading">Gender <br>
                <p class="field switch">
                    <label for="radio1" class="cd-left selected"><span>Male</span></label>
                    <label for="radio2" class="cd-right"><span>Female</span></label>
                </p>
            <inpuy type="hidden" name="gender" id="gender" value="">
            </div>
            <div class="one-fourth last one-fourth-heading">Address <br> <textarea name="address" id="address" rows="4" cols="30" class="resize-none"></textarea></div>
            <div class="one-fourth"><input type="submit" id="personalDetialsSubmit" name="personalDetialsSubmit" value="Update Detials"></div>
        </form>
      </div>
      <div id="tab2">
          <form id="measurementDetials" name="measurementDetails" action ="<?php the_permalink(); ?>" method="Post">
            <div class="one-fourth one-fourth-heading">Height <br> <input type='text' name="measureHeight" id="measureHeight" value=""></div>
            <div class="one-fourth one-fourth-heading">Weight <br> <input id="measureWeight" name="measureWeight" type="text" ></div>
            <div class="one-fourth one-fourth-heading">Neck <br> <input id="measureNeck" name="measureNeck" type="text" ></div>
            <div class="one-fourth last one-fourth-heading">Chest <br> <input type='text' name="measureChest" id="measureChest" value=""></div>
            

            <div class="one-fourth one-fourth-heading">Arms <br> <input type='text' name="measureArms" id="measureArms" value=""></div>
            <div class="one-fourth one-fourth-heading">Waist <br> <input type='text' name="measureWaist" id="measureWaist" value=""></div>
            <div class="one-fourth one-fourth-heading"> Stomach(Belly-Button) <input type='text' name="measureStomach" id="measureStomach" value=""> </div>
            <div class="one-fourth last one-fourth-heading">Hips <br> <input type='text' name="measureHips" id="measureHips" value=""></div>

            <div class="one-fourth one-fourth-heading">Size of Shirt (Waist) <br> <input type='text' name="shirtSizeWaist" id="shirtSizeWaist" value=""></div>
            <div class="one-fourth one-fourth-heading">Size of Shirt (Height) <br> <input type='text' name="shirtSizeHeight" id="shirtSizeHeight" value=""></div>
            <div class="one-fourth one-fourth-heading">Size of Pants (Waist) <br> <input type='text' name="pantsSizeWaist" id="pantsSizeWaist" value=""></div>
            <div class="one-fourth last one-fourth-heading">Size of Pants(Height)  <br> <input type='text' name="pantsSizeHeight" id="pantsSizeHeight" value=""></div>
            
            <div class="one-fourth"><input type="button" value="Update Detials" id="measurementDetialsSubmit" name="measurementDetialsSubmit"></div>
          </form>
      </div>
      <div id="tab3">
          <form id="paymentDetials" name="paymentDetials" action ="<?php the_permalink(); ?>" method="Post">
            
          </form>
      </div>
      <div id="tab4">
          <form id="miscDetials" name="miscDetails" action ="<?php the_permalink(); ?>" method="Post">
            
          </form>
      </div>
  </div>

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
$=jQuery;
  $(document).ready(function(){
    $("#tab1").addClass('current');
     $("#content").find("[id^='tab']").hide(); // Hide all content
        $("#tabs li:first").attr("id","current"); // Activate the first tab
        $("#content #tab1").fadeIn(); // Show first tab's content
        
        $('#tabs a').click(function(e) {
            e.preventDefault();
            if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
             return;       
            }
            else{             
              $("#content").find("[id^='tab']").hide(); // Hide all content
              $("#tabs li").attr("id",""); //Reset id's
              $(this).parent().attr("id","current"); // Activate this
              $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
            }
        });
    $(".cd-left, .cd-right").click(function(){
        var parent = $(this).parents('.switch');
        if($(this).hasClass("cd-left")){
          $('.cd-right',parent).removeClass('selected');
        }
        else{
          $('.cd-left',parent).removeClass('selected');
        }
        $(this).addClass('selected');
        $("#gender").val($(this).text());
        // alert("next span val="+ $(this).text()); //To get the Swtich Value
    });

          $("#measurementDetialsSubmit").click(function(){
            strForm = $( "#measurementDetials" ).serialize();
            strForm += "&action="+encodeURIComponent("updateMeasurementAction");
            //var objMeasurement                = new Object();
            //objMeasurement.measureHeight = $("#measureHeight").val();
            $.ajax({
                url:"<?php echo the_permalink(); ?>",
                method:"POST",
                data: strForm,
            success:function(response){
                alert("SUCCESS");
              console.log("IN SUCCESS"+response);

            },
            error:function(err){
                alert("ERROR");
                console.log("ERROR"+err.toSource());
            }

       });
    });

  });
</script>
<?php get_footer(); ?>
