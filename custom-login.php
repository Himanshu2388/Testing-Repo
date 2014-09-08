<?php 
/*
Template Name: Custom Wordpress Login Form
*/


$response = "";

global $userdata;
global $wpdb;
global $wp_session;

  //function to generate response
  function login_form_response($type, $message){

    global $response;
    if($type == "success") $response = "<div class='success'>{$message}</div>";
      else $response = "<div class='error'>{$message}</div>";

  }
  //response messages
  $email_invalid            = "Invalid Email or Password.";
  $field_blank_message      = "Please enter email id and password.";
  
  //user posted variables
  $arrUserPost['user_email'] = trim($_POST['email']);
  $arrUserPost['user_pass'] = trim($_POST['password']);
  $human  = trim($_POST['submitted']);

if(!$human == 0){
	if($arrUserPost['user_email']!="" && $arrUserPost['user_pass']!=""){
		  $strUserName = getUserNameFromEmail($arrUserPost['user_email']);      // Get user detials from email
		  $arrAuthenticate = wp_authenticate($strUserName, $arrUserPost['user_pass']);
      if(isset($arrAuthenticate->errors['incorrect_password'][0]) || isset($arrAuthenticate->errors['invalid_username'][0])){
        login_form_response("error",$email_invalid);
      }else{
        $strResponse = custom_login($strUserName,$arrUserPost['user_pass']);
        wp_safe_redirect(home_url()."/profile/");     //Redirect to profile page on successful login
      }
	 }else{
	   login_form_response("error",$field_blank_message);   
	}
}else if ($_POST['submitted']) login_form_response("error", $email_invalid);

/*
    Function to get User Details
*/
  function getUserNameFromEmail($strUserEmail) {
   $user = get_user_by_email($strUserEmail);
   if(!empty($user->user_login))  // if the email exists for a user return
   $strUserEmail = $user->user_login; // user_login or else the same string is
   return $strUserEmail; // returned for verification
  }

function custom_login($strLoginName, $strPassword) {
  $creds = array();
  $creds['user_login'] = $strLoginName;
  $creds['user_password'] = $strPassword;
  $creds['remember'] = true;
  $user = wp_signon( $creds, false );
  if ( is_wp_error($user) )
    return $user->get_error_message();
}
// run it before the headers and cookies are sent
add_action( 'after_setup_theme', 'custom_login' );

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
              <form action ="<?php the_permalink(); ?>" method="Post" id="loginForm"  name="loginForm">
                 <?php echo $response; ?> <br>
                <h2 class="title">Login Details</h2>
                <div class="divider" style="height: 30px;"></div>
                <div class="clear"></div>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"><span class="font-bold">E-mail </span><span class="required">*</span></div>
                <div class="one-fourth"><input name="email" id="email" type="email" placeholder="sample@example.com" title = "Please enter valid email" value="<?php echo esc_attr($_POST['email']); ?>"></div>
                <div class="one-fourth"><span class="font-bold"></div>
                <div class="one-fourth last"></div>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth last"></div>
                <br><br><br>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"><span class="font-bold">Password</span><span class="required">*</span></div>
                <div class="one-fourth"><input name="password" type="password" id="password" placeholder="Password"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth last"></div>
                <div class="one-half"></div>
                <div class="one-half last"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth last"></div>
                <div class="divider" style="height: 10px;"></div>
                <div class="clear"></div>
              <div class="one-fourth last"></div>
              <div class="one-fourth"></div>
                <div class="one-fourth"></div>
                <div class="one-fourth"><input type="hidden" name="submitted" value="1"></div>
                <div class="one-fourth last"></div>
              <div class="one"><input name="submit" type="submit" value="Login Now"></div>
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
			