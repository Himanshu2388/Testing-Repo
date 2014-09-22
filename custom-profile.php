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



$arrMeasurementsDataTypes = array(
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
	                            "%s",
	                            "%s",
	                            "%s",
	                            "%d",
	                    );
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
                IF YES -->  (1) fetch data from wp_measuements
                            (2) import this data into wp_measurements_history
                            (3) update current wp_measurements with new values

                If NO --> insert data in wp_measurements;

                */



                if($_POST['measureHeight'] == "feet-inch"){
                    $intHeightUnit1 = isset($_POST['height_ft'])    ? $_POST['height_ft']   : ""; 
                    $intHeightUnit2 = isset($_POST['height_inch'])  ? $_POST['height_inch'] : "";  
                }else{
                    $intHeightUnit1 = isset($_POST['height_meter']) ? $_POST['height_meter'] : ""; 
                    $intHeightUnit2 = isset($_POST['height_cm'])    ? $_POST['height_cm']    : "";  
                }

                /*Array for inserting values in 'wp_measurements' Table */
                $arrInsertMeasurementData = array();
                $arrInsertMeasurementData['height_unit']            = trim($_POST['measureHeight']);
                $arrInsertMeasurementData['height_value1']          = $intHeightUnit1;
                $arrInsertMeasurementData['height_value2']          = $intHeightUnit2;
                $arrInsertMeasurementData['weight_unit']            = trim($_POST['measureWeightUnit']);
                $arrInsertMeasurementData['weight_value']           = trim($_POST['measureWeight']);
                $arrInsertMeasurementData['bmi_type']           	= trim($_POST['bmiType']);
                $arrInsertMeasurementData['bmi_value']           	= trim($_POST['bmiValue']);
                $arrInsertMeasurementData['neck_unit']              = trim($_POST['measureNeckUnit']);
                $arrInsertMeasurementData['neck_value']             = trim($_POST['measureNeck']);
                $arrInsertMeasurementData['chest_unit']             = trim($_POST['measureChestUnit']);
                $arrInsertMeasurementData['chest_value']            = trim($_POST['measureChest']);
                $arrInsertMeasurementData['arms_unit']              = trim($_POST['measureArmsUnit']);
                $arrInsertMeasurementData['arms_value']             = trim($_POST['measureArms']);
                $arrInsertMeasurementData['waist_unit']             = trim($_POST['measureWaistUnit']);
                $arrInsertMeasurementData['waist_value']            = trim($_POST['measureWaist']);
                $arrInsertMeasurementData['stomach_belly_unit']     = trim($_POST['measureStomachUnit']);
                $arrInsertMeasurementData['stomach_belly_value']    = trim($_POST['measureStomach']);
                $arrInsertMeasurementData['hips_unit']              = trim($_POST['measureHipsUnit']);
                $arrInsertMeasurementData['hips_value']             = trim($_POST['measureHips']);
                $arrInsertMeasurementData['shirt_waist_unit']       = trim($_POST['shirtSizeWaistUnit']);
                $arrInsertMeasurementData['shirt_waist_value']      = trim($_POST['shirtSizeWaist']);
                $arrInsertMeasurementData['shirt_height_unit']      = trim($_POST['shirtSizeHeightUnit']);
                $arrInsertMeasurementData['shirt_height_value']     = trim($_POST['shirtSizeHeight']);
                $arrInsertMeasurementData['pants_waist_unit']       = trim($_POST['pantsSizeWaistUnit']);
                $arrInsertMeasurementData['pants_waist_value']      = trim($_POST['pantsSizeWaist']);
                $arrInsertMeasurementData['pants_height_unit']      = trim($_POST['pantsSizeHeightUnit']);
                $arrInsertMeasurementData['pants_height_value']     = trim($_POST['pantsSizeHeight']);
                $arrInsertMeasurementData['user_id']                = $userId;

                $boolCheck = checkBeforeInsert($userId);
                if(isset($boolCheck->user_id) && $boolCheck->user_id !=""){
                    createMeasurementsHistory($userId);
                    udpateMeasurements($arrInsertMeasurementData);
                }else{
                  //Insert Query goes here                    
	                $wpdb->insert(
	                        'wp_measurements',
	                        $arrInsertMeasurementData,
	                        $arrMeasurementsDataTypes
	                );
                }
                
                
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

    /**
     * Function to generate Measuerement Units
     * @name generateMeasurements
     * @return void
     * @param strType
     **/
    function generateMeasurements($strType, $currentVal=0)
    {

        switch ($strType) {

            case 'feet':
                    for($i=0; $i<=7; $i++) 
                    { 
                        if($currentVal == $i){
                            echo "<option value = '$i' selected > $i </option>";
                        }
                        else{
                            echo "<option value = '$i' > $i </option>";
                        }    
                    }
                break;

            case 'inch':
                    for($i=0; $i<=11; $i++) 
                    { 
                        if($currentVal == $i){
                            echo "<option value = '$i' selected > $i </option>";
                        }
                        else{
                            echo "<option value = '$i' > $i </option>";
                        }  
                    }
                break;

            case 'meter':
                    /*echo "<option value = '0' selected=selected disabled=disabled> 0 </option>";*/
                    for($i=0; $i<=2; $i++){
                        
                        if($currentVal == $i){
                            echo "<option value = '$i' selected > $i </option>";
                        }
                        else{
                            echo "<option value = '$i' > $i </option>";
                        }  
                    }
                break;

            case 'cm':
                    echo "<option value = '0' selected=selected> 0 </option>";
                    for($i=1; $i<=99; $i++) {

                        if($currentVal == $i){
                            echo "<option value = '$i' selected > $i </option>";
                        }
                        else{
                            echo "<option value = '$i' > $i </option>";
                        }
                    }
                break;

            case 'kgAndLbs':
                     if($currentVal == "Lbs" ){
                        echo "<option value = 'Lbs' selected> Lbs  </option>";
                        echo "<option value = 'Kg'> Kg </option>";
                     }
                     else{
                        echo "<option value = 'Lbs'> Lbs  </option>";
                        echo "<option value = 'Kg' selected> Kg </option>";
                     } 
                break;

            case 'inchAndCm':
                if($currentVal == "feet-inch"){
                    /*echo "<option value = 'Inch' selected> Inch  </option>";
                    echo "<option value = 'Cm'> Cm </option>";*/
                    echo "<option value = 'feet-inch' selected>  Feet - Inch  </option>";
                    echo "<option value = 'meter-cm'>  Meter - Cm  </option>";
                }
                else{
                    echo "<option value = 'feet-inch'>  Feet - Inch  </option>";
                    echo "<option value = 'meter-cm' selected>  Meter - Cm  </option>";
                }

                break;
            default :
               //## code-- 
                break;
        }
    }

    /**
     * inputValueCheck function
     *
     * @return void
     * @param value of input filed 
     **/
    function inputValueCheck($value)
    {
        if(isset($value) && $value > 0){
            echo $value;
        }
    }


/**
 * wpCheckDBError function
 * Function to show if exception occured
 * @return void
 * @param strSource 
 **/
function wpCheckDBError($strSource)
{
    global $wpdb;
    if($wpdb->last_error){
        echo "<h3> An exception occured </h3>";
        echo "<br> <b> <i> Please contact the System Administrator with the following details:  </i></b> <br>";
        echo "<br> <b>Reason: </b>",$wpdb->last_error;
        echo "<br> <b>Source: </b>",$strSource;
        die;
    }
}

/**
 * check for User record 'Before Inserting' in ' wp_measurment '
 * @name checkBeforeInsert
 * @return boolFlag
 * @param intUserId 
 **/
function checkBeforeInsert($intUserId){
    global $wpdb;
    $strQuery = "SELECT * FROM wp_measurements WHERE user_id=".$intUserId;

    $arrResult = $wpdb->get_results($strQuery);
    wpCheckDBError('CustomProfile / checkBeforeInsert');

    foreach( $arrResult as $arrValues ) {
        $arrResponse[] =  $arrValues;
    }
    return reset($arrResponse);
}

/**
 * createMeasurementsHistory function
 * Function to current measurement record to measurement history
 * @return void
 * @param intUserId
 **/
function createMeasurementsHistory($intUserId)
{
    global $wpdb;
    $strQuery = "INSERT INTO `wp_measurements_history` (SELECT * FROM `wp_measurements` WHERE user_id=".$intUserId.")";
    
    $arrResult = $wpdb->query($strQuery);
    wpCheckDBError('CustomProfile / createMeasurementsHistory');
}


/**
 * udpateMeasurements function
 * Function to current measurement record to measurement history
 * @return void
 * @param arrMeasurementParms
 * Description 
 *				(!! Important Note while making update !!!)
 * 				The used parameters in Update query order is:
 *				- table name 				=> String ,
 *				- data 						=> Array,
 * 				- format or DataType 		=> Array,
 *				- where conditions 			=> Array,
 *				- where_format or DataType 	=> Array
 *
 **/
function udpateMeasurements($arrInsertMeasurementData)
{
	global $wpdb;
	global $arrMeasurementsDataTypes;
	$wpdb->update(
	    'wp_measurements',
	    $arrInsertMeasurementData,
	    array( 'user_id' => $arrInsertMeasurementData['user_id'] ),
	    $arrMeasurementsDataTypes,
	    array( '%d' )
	);
    wpCheckDBError('CustomProfile / udpateMeasurements');
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
/*if (is_user_logged_in()){
  $sql = "SELECT user_id FROM wp_measurements ";
  $result = $wpdb->get_results($sql) or die(mysql_error());

      foreach( $result as $results ) {

          $arrUserData[] =  $results;
      }


$arrUserDetails['name'] =" ";// isset($current_user->user_login) ? $current_user->user_login : '';
}
*/

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
    /*.error{
        padding: 5px 9px;
        border: 1px solid red;
        color: red;
        border-radius: 3px;
    }*/

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

    #content h2, #content h3,  #content p {
        margin: 0 0 15px 0;
    }

    .cd-left, .cd-right, .cd-left span, .cd-right span { 
        background: url("<?php echo home_url(); ?>/wp-content/themes/fitness/images/switch.jpg") 
        repeat-x; display: block; float: left;
    }

    .cd-left span, .cd-right span { 
        line-height: 30px; 
        display: block; 
        background-repeat: no-repeat; 
        font-weight: bold; }

    .cd-left span { 
        background-position: left -90px;
         padding: 0 10px; 
     }
    .cd-right span { 
        background-position: right -180px;
        padding: 0 10px; 
    }

    /*.cd-right.selected { background-position: 0 -30px; }
    .cd-right.selected span { background-position: right -210px; color: #fff; }*/


    .cd-right.selected { 
        background-position: 0 -60px; 
    }
    .cd-right.selected span { 
        background-position: right -240px; 
        color: #fff; 
    }
    .cd-left.selected { 
        background-position: 0 -60px; 
    }
    .cd-left.selected span { 
        background-position: left -150px; 
        color: #fff; 
    }
    .switch label { cursor: pointer; }
    .switch input { display: none; }

    .resize-none{
        resize:none;
    }
    .one-fourth-heading{
        font-weight: bold !important;
        padding-bottom: 2%;
    }
  /*-------------- For All Select DropDowns*/
    select{
        color:black;
    }
    .measuringUnit{
        font-style: italic;
    }
/*---------------- For Validator Plugin displaying error message*/
    .error {
        border: 1px solid red;
        border-radius: 3px;
        color: red;
    }
    .bmi-text{
        font-size: 17px;
        text-align: center;
        font-weight: bold;
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
	<div id="wpdbErr">
		<?php 
			$arrCurrentUserValues = checkBeforeInsert($userId);
		?>
	</div>
	
	<!---------------------
	--- 	TAB 1		---
	----------------------->
	<div id="tab1">
		<form id="personalDetials" name="personalDetails" action ="<?php the_permalink(); ?>" method="Post">
			<div class="one-half">Name <br> <input type='text' name="fullName" id="fullName" value="<?php echo '' ?>" ></div>
			<div class="one-half last">DOB <br> <input id="datetimepicker" name="dob" type="date" ><br><br></div> 
			<div class="one-half">Gender <br>
				<p class="field switch">
					<label for="radio1" class="cd-left selected"><span>Male</span></label>
					<label for="radio2" class="cd-right"><span>Female</span></label>
				</p>
            <input type="hidden" name="gender" id="gender" value="">
            </div>
            <div class="one-half last">Address <br> <textarea name="address" id="address" rows="4" cols="30" class="resize-none"></textarea><br><br></div>
            <div class="one-half"><input type="submit" id="personalDetialsSubmit" name="personalDetialsSubmit" value="Update Detials"></div>
        </form>
	</div>
	
	<!-- ---------------------
	--- 	TAB 2		---
	--------------------- -->
	<div id="tab2">
		<div class='bmi-text' id="bmiText">
            <?php
                if(isset($arrCurrentUserValues->bmi_type) && isset($arrCurrentUserValues->bmi_value) 
                    && $arrCurrentUserValues->bmi_value > 0){
                    echo "Your calculated BMI is ". $arrCurrentUserValues->bmi_value . " (" . 
                        $arrCurrentUserValues->bmi_type . ")";
                }
            ?>
        </div>
		<form id="measurementDetials" name="measurementDetails" action ="<?php the_permalink(); ?>" method="Post">
			<div class='one-half'>
				Height<br>

				<select id = "measureHeight" name = "measureHeight" class="measuringUnit">
					<!-- <option value = "feet-inch">  Feet - Inch  </option>
					<option value = "meter-cm">  Meter - Cm  </option> -->
                    <?php generateMeasurements('inchAndCm',$arrCurrentUserValues->height_unit);  ?>
				</select>

				<select id = "height_ft" name = "height_ft">
					<?php generateMeasurements('feet',$arrCurrentUserValues->height_value1);  ?>
				</select>
				<select id = "height_inch" name = "height_inch">
					<?php generateMeasurements('inch',$arrCurrentUserValues->height_value2); ?>
				</select>

				<select id="height_meter" name="height_meter">
					<?php generateMeasurements('meter',$arrCurrentUserValues->height_value1); ?>
				</select>
				<select id="height_cm" name="height_cm">
					<?php generateMeasurements('cm',$arrCurrentUserValues->height_value2); ?>
				</select>
				<input type="hidden" name="bmiType" id="bmiType" value="<?php echo $arrCurrentUserValues->bmi_type ?>">
				<input type="hidden" name="bmiValue" id="bmiValue"
                                     value="<?php inputValueCheck($arrCurrentUserValues->bmi_value)?>">
			</div>
			<div class='one-half last'>
				Weight <br>
				<select id = "measureWeightUnit" name = "measureWeightUnit" class="measuringUnit">
					<?php generateMeasurements('kgAndLbs',$arrCurrentUserValues->weight_unit); ?>
				</select>
				<input id="measureWeight" name="measureWeight" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->weight_value)?>">
				<br><br>
			</div>
			<div class='one-half'>
				Neck<br> 
				<select id = "measureNeckUnit" name = "measureNeckUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->neck_unit); ?>
				</select>
				<input id="measureNeck" name="measureNeck" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->neck_value)?>">
			</div>

			<div class='one-half last'>
				Chest <br>
				<select id = "measureChestUnit" name = "measureChestUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->chest_unit); ?>
				</select>
				<input id="measureChest" name="measureChest" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->chest_value)?>">
				<br><br>
			</div>

			<div class='one-half'>
				Arms<br> 
				<select id = "measureArmsUnit" name = "measureArmsUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->arms_unit); ?>
				</select>
				<input id="measureArms" name="measureArms" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->arms_value)?>">
			</div>

			<div class='one-half last'>
				Waist <br>
				<select id = "measureWaistUnit" name = "measureWaistUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->waist_unit); ?>
				</select>
				<input id="measureWaist" name="measureWaist" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->waist_value)?>">
				<br><br>
			</div>

			<div class='one-half'>
				Stomach(Belly-Button)<br> 
				<select id = "measureStomachUnit" name = "measureStomachUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->stomach_belly_unit); ?>
				</select>
				<input id="measureStomach" name="measureStomach" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->stomach_belly_value)?>">
			</div>

			<div class='one-half last'>
				Hips <br>
				<select id = "measureHipsUnit" name = "measureHipsUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->hips_unit); ?>
				</select>
				<input id="measureHips" name="measureHips" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->hips_value)?>">
				<br><br>
			</div>

			<div class='one-half'>
				Size of Shirt (Waist)<br> 
				<select id = "shirtSizeWaistUnit" name = "shirtSizeWaistUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->shirt_waist_unit); ?>
				</select>
				<input id="shirtSizeWaist" name="shirtSizeWaist" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->shirt_waist_value)?>">
			</div>

			<div class='one-half last'>
				Size of Shirt (Height) <br>
				<select id = "shirtSizeHeightUnit" name = "shirtSizeHeightUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->shirt_height_unit); ?>
				</select>
				<input id="shirtSizeHeight" name="shirtSizeHeight" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->shirt_height_value)?>">
				<br><br>
			</div>

			<div class='one-half'>
				Size of Pants (Waist)<br> 
				<select id = "pantsSizeWaistUnit" name = "pantsSizeWaistUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->pants_waist_unit); ?>
				</select>
				<input id="pantsSizeWaist" name="pantsSizeWaist" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->pants_waist_value)?>">
			</div>

			<div class='one-half last'>
				Size of Pants (Height) <br>
				<select id = "pantsSizeHeightUnit" name = "pantsSizeHeightUnit" class="measuringUnit">
					<?php generateMeasurements('inchAndCm',$arrCurrentUserValues->pants_height_unit); ?>
				</select>
				<input id="pantsSizeHeight" name="pantsSizeHeight" type="text" size=3 
                                          value="<?php inputValueCheck($arrCurrentUserValues->pants_height_value)?>">
				<br><br>
			</div>

			<div class='one-half'>
				<input type="button" value="Update Details" id="measurementDetialsSubmit" name="measurementDetialsSubmit">
			</div>
			<div class='one-half last'>
				<br><br>
			</div>
			<div class="one">
				<h3> Measurements History </h3>
				<table>
					<tr>
						<th> Height </th>
						<th> Weight </th>
						<th> BMI </th>
						<th> Waist </th>
						<th> Chest </th>
						<th> Arms </th>
						<th> Stomach </th>
						<th> Hips </th>
						<th> Date/Time </th>
					</tr>
				</table>
			</div>
		</form>
	</div>
	
	<!-- --------------------
	--- 	TAB 3		---
	---------------------  -->
	<div id="tab3">
		<form id="paymentDetials" name="paymentDetials" action ="<?php the_permalink(); ?>" method="Post">
		</form>
	</div>
	
	<!-- --------------------
	--- 	TAB 4		---
	---------------------- -->
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
	var objBmiCalDetails = new Object();

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
	
		$("#measurementDetialsSubmit").on('click',(function(){
            
            if(!checkHeightWeight()){
                $("#bmiText").html("Please provide non-zero inputs for Height and Weight fields");
                return false;
            }
			$(this).prop('disabled',true);
			strForm = $( "#measurementDetials" ).serialize();
			strForm += "&action="+encodeURIComponent("updateMeasurementAction");
            if($("#measurementDetials").valid()){
				$.ajax({
					url:"<?php echo the_permalink(); ?>",
					method:"POST",
					data: strForm,
					context: this,
					success:function(response){
						alert("Your details saved successfully.");
						$(this).prop('disabled',false);
					},
					error:function(err){
						alert("Oops! There was some problem with your request. Please try again");
						$(this).prop('disabled',false);
					}
				});
			}
		}));
	
	
	
		$("#personalDetials").validate({
			rules: {
				fullName: { 
					alpha_space: true,
					required : true,
				},
				address:{
					required:true
				},
				dob:{
					required:true
				}
			},
		});
	
		$("#measurementDetials").validate({
			rules: {
				measureWeight: { 
					decimal: true,
					required : true,
				},
			}
		});
	
		$("#height_meter, #height_cm").hide();
		var objBmiCalDetails = new Object();
	
		$("#measureHeight").on("change",function(){
			if($(this).val() == "meter-cm"){
                $("#height_ft, #height_inch").hide();
                $("#height_meter, #height_cm").show();
                $("#height_meter, #height_cm").val(0).change();
			}
			else{
				$("#height_meter, #height_cm").hide();
                $("#height_ft, #height_inch").show();
				$("#height_ft, #height_inch").val(0).change();
			}
		});
	
		$("#height_meter, #height_cm, #height_ft, #height_inch, #measureWeightUnit, #measureWeight").on("change keyup blur", 
			function(){
				$("#bmiText").html("");
				$("#bmiType").val("");
				$("#bmiValue").val("");
				
                if(!$("#measurementDetials").valid() || !checkHeightWeight()){
                    $("#bmiText").html("Please provide non-zero inputs for Height and Weight fields");
                    return false;
                }

                
				/*objBmiCalDetails.heightUnit		= $("#measureHeight").val();
	
				if(objBmiCalDetails.heightUnit == "meter-cm"){
					objBmiCalDetails.heightVal1 = Number($("#height_meter").val()).toFixed(2);
					objBmiCalDetails.heightVal2 = Number($("#height_cm").val()).toFixed(2);
				}
				else{
					objBmiCalDetails.heightVal1 = Number($("#height_ft").val()).toFixed(2);
					objBmiCalDetails.heightVal2 = Number($("#height_inch").val()).toFixed(2);
				}
	
				objBmiCalDetails.weightUnit		= $("#measureWeightUnit").val();
				objBmiCalDetails.weightVal		= Number($("#measureWeight").val()).toFixed(2);
				
				if((objBmiCalDetails.heightVal1 == 0 && objBmiCalDetails.heightVal2 == 0)
							||
						objBmiCalDetails.weightVal == 0){
					return false;
				}
				else{
					calculateBMI(objBmiCalDetails);
				}*/
			}
		);

	});


    function checkHeightWeight(){
        objBmiCalDetails.heightUnit     = $("#measureHeight").val();
    
        if(objBmiCalDetails.heightUnit == "meter-cm"){
            objBmiCalDetails.heightVal1 = Number($("#height_meter").val()).toFixed(2);
            objBmiCalDetails.heightVal2 = Number($("#height_cm").val()).toFixed(2);
        }
        else{
            objBmiCalDetails.heightVal1 = Number($("#height_ft").val()).toFixed(2);
            objBmiCalDetails.heightVal2 = Number($("#height_inch").val()).toFixed(2);
        }

        objBmiCalDetails.weightUnit     = $("#measureWeightUnit").val();
        objBmiCalDetails.weightVal      = Number($("#measureWeight").val()).toFixed(2);
        
        if((objBmiCalDetails.heightVal1 == 0 && objBmiCalDetails.heightVal2 == 0)
                    ||
                objBmiCalDetails.weightVal == 0){
            return false;
        }
        else{
            calculateBMI(objBmiCalDetails);
             return true;
        }
    }

	function calculateBMI(objBmiCalDetails){
		var metric_weight = 0;
		var metric_height = 0;
		var bmi = 0;
		var bmi_type = "";
		
        if(objBmiCalDetails.weightUnit == "Kg"){
			metric_weight = Number(objBmiCalDetails.weightVal);
		}
		else{
			//Converting pound to kg        
			metric_weight = Number(objBmiCalDetails.weightVal / 2.2046);
		}

		if(objBmiCalDetails.heightUnit == "meter-cm"){
			metric_height = Number(objBmiCalDetails.heightVal1) + Number((objBmiCalDetails.heightVal2 / 100));
		}
		else{
			//Converting feet to meters
			//Lets first convert inches to cm
			cm2 = Number(Number(objBmiCalDetails.heightVal2) / Number(0.39370)).toFixed(2);        //Round off to 2 places
			//Now, convert feet to cm
			cm1 = Number(Number(objBmiCalDetails.heightVal1) / Number(0.032808)).toFixed(2);        //Round off to 2 places
			metric_height = (Number(cm1) + Number(cm2)) / Number(100);
		}

		bmi = Number(metric_weight / (metric_height * metric_height)).toFixed(2);    //Round off to 2 places

		switch(true){
			case (bmi >= 30):
				bmi_type = "Obese";
				break;
            
			case ((bmi <= 29.9) && (bmi >= 25)):
				bmi_type = "Overweight";
				break;

			case ((bmi <= 24.9) && (bmi >= 18.5)):
				bmi_type = "Normal";
				break;

			default:
				bmi_type = "Underweight";
				break;
		}
		//console.log("BMI TYPE = "+bmi_type+"\n bmi == "+bmi);
		$("#bmiType").val(bmi_type);
		$("#bmiValue").val(bmi);
		$("#bmiText").html("Your calculated BMI is " + bmi + " (" + bmi_type + ")");
	}
</script>

<script src = <?php echo home_url()."/wp-content/themes/fitness/javascript/jquery.validate.js" ?>></script>

<script>
    /*Jquery Custom Parsers*/

    //For Alpha and Spaces Only
    $.validator.addMethod("alpha_space", function(value, element) 
    {
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters and spaces only please");

    $.validator.addMethod('decimal', function(value, element) {
    	return this.optional(element) || /^\d+(\.\d{0,2})?$/.test(value); 
	}, "Only numbers please, format xxx.xx");
</script>

<script>
 
</script>
<?php get_footer(); ?>
