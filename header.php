<!DOCTYPE html>
<?php
	$options = get_option('infinite_options');
	
	$boxed_or_stretched = $options['boxed_or_stretched'];
	$call = $options['call'];
	$email = $options['email'];
	$network = $options['network'];
	$hsn_aim = $options['hsn_aim'];
	$hsn_apple = $options['hsn_apple'];
	$hsn_behance = $options['hsn_behance'];
	$hsn_blogger = $options['hsn_blogger'];
	$hsn_cargo = $options['hsn_cargo'];
	$hsn_delicious = $options['hsn_delicious'];
	$hsn_deviantart = $options['hsn_deviantart'];
	$hsn_digg = $options['hsn_digg'];
	$hsn_dopplr = $options['hsn_dopplr'];
	$hsn_dribbble = $options['hsn_dribbble'];
	$hsn_ember = $options['hsn_ember'];
	$hsn_evernote = $options['hsn_evernote'];
	$hsn_facebook = $options['hsn_facebook'];
	$hsn_flickr = $options['hsn_flickr'];
	$hsn_forrst = $options['hsn_forrst'];
	$hsn_github = $options['hsn_github'];
	$hsn_google = $options['hsn_google'];
	$hsn_googleplus = $options['hsn_googleplus'];
	$hsn_gowalla = $options['hsn_gowalla'];
	$hsn_groveshark = $options['hsn_groveshark'];
	$hsn_html5 = $options['hsn_html5'];
	$hsn_icloud = $options['hsn_icloud'];
	$hsn_lastfm = $options['hsn_lastfm'];
	$hsn_linkedin = $options['hsn_linkedin'];
	$hsn_metacafe = $options['hsn_metacafe'];
	$hsn_mixx = $options['hsn_mixx'];
	$hsn_myspace = $options['hsn_myspace'];
	$hsn_netvibes = $options['hsn_netvibes'];
	$hsn_newsvine = $options['hsn_newsvine'];
	$hsn_orkut = $options['hsn_orkut'];
	$hsn_paypal = $options['hsn_paypal'];
	$hsn_picasa = $options['hsn_picasa'];
	$hsn_pinterest = $options['hsn_pinterest'];
	$hsn_plurk = $options['hsn_plurk'];
	$hsn_posterous = $options['hsn_posterous'];
	$hsn_reddit = $options['hsn_reddit'];
	$hsn_rss = $options['hsn_rss'];
	$hsn_skype = $options['hsn_skype'];
	$hsn_stumbleupon = $options['hsn_stumbleupon'];
	$hsn_technorati = $options['hsn_technorati'];
	$hsn_tumblr = $options['hsn_tumblr'];
	$hsn_twitter = $options['hsn_twitter'];
	$hsn_vimeo = $options['hsn_vimeo'];
	$hsn_wordpress = $options['hsn_wordpress'];
	$hsn_yahoo = $options['hsn_yahoo'];
	$hsn_yelp = $options['hsn_yelp'];
	$hsn_youtube = $options['hsn_youtube'];
	$hsn_zerply = $options['hsn_zerply'];
	$hsn_zootool = $options['hsn_zootool'];
	
$PAGE_ID = get_the_ID();
$layout = $boxed_or_stretched;
if (isset($_GET["layout"])) 
{
    if ($_GET["layout"] == "stretched") $layout = "stretched" ;
    if ($_GET["layout"] == "boxed") $layout = "boxed" ;
} 
$page_template = get_page_template();
$path = pathinfo($page_template);
$page_template = $path['filename'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
	<?php
	$options = get_option('infinite_options'); 
	?>
	<link rel='stylesheet' type='text/css' data-name="demo-style" href="<?php echo home_url(); ?>/?theme-styles=css" />
	<?php $logo_top = $options['logo_top']; ?>
    <?php $logo_scroll = $options['logo_scroll']; ?>
    <?php $google_fonts = $options['google_fonts']; ?>
    <?php $google_fonts_url = $options['google_fonts_url']; ?>
    <?php $custom_analytics = $options['custom_analytics']; ?>
    <?php $favicon_set = $options['favicon_set']; ?>
	
	<title><?php system_titles(); ?></title>
    <meta name="SYSTEM_VAR_PREFIX" content="<?php echo SYSTEM_VAR_PREFIX; ?>" />
    <meta name="SYSTEM_THEME" content="<?php echo SYSTEM_THEME; ?>" />  
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel='start' href='<?php echo home_url(); ?>'>
    <link rel='alternate' href='<?php echo $logo_scroll['url']; ?>'>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <meta name="viewport" content="width=device-width" /> 
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo $favicon_set['url']; ?>" />	
	<?php if (is_search()) { ?><meta name="robots" content="noindex, nofollow" /><?php } ?>
    
    
    <?php echo $google_fonts_url?>
    <style type="text/css">
    <!--
    h1, h2, h3, h4, h5, h6 ul.products li.product h3, h1.title, h2.title, h3.title, h4.title, h5.title, h6.title, #primary-menu ul li a, .section-title .title, .section-title .title a, .section-title h1.title span, .section-title p, #footer h3, .services h2, .item-info h3, .item-info-overlay h3, #contact-intro h1.title, #contact-intro p, .widget h3.title, .post-title h2.title, .post-title h2.title a {
        <?php echo $google_fonts?>
    }
    -->
    </style>
    
	
    
<?php echo $custom_analytics; ?>
    

<?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>

<?php
if ($layout == "boxed")
{
?>
<div id="wrapper">    

<div class="content-wrapper clear"> 
<?php
}
?>
    <!-- START HEADER -->
    
    <div id="header-wrapper">
    		
            <div class="contact-us-wrapper">
            	<div class="control-size clear">
                    <div class="one">
                        <div class="header-contacts one-half">
                        <!-- Himanshu Changes -->
                        <!--<span>Phone: <?php echo $call; ?></span> - Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>-->
			<span> &nbsp; </span> &nbsp;
                        </div> 
                        <div class="header-social-icons-container one-half last">
                            <ul>
                            <?php if (!empty($options['hsn_zootool'])){ ?>
                                <li><a href="<?php echo $hsn_zootool; ?>" target="_blank" title="zootool" class="social-zootool social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_zerply'])){ ?>
                                <li><a href="<?php echo $hsn_zerply; ?>" target="_blank" title="zerply" class="social-zerply social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_youtube'])){ ?>
                                <li><a href="<?php echo $hsn_youtube; ?>" target="_blank" title="youtube" class="social-youtube social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_yelp'])){ ?>
                                <li><a href="<?php echo $hsn_yelp; ?>" target="_blank" title="yelp" class="social-yelp social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_yahoo'])){ ?>
                                <li><a href="<?php echo $hsn_yahoo; ?>" target="_blank" title="yahoo" class="social-yahoo social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_wordpress'])){ ?>
                                <li><a href="<?php echo $hsn_wordpress; ?>" target="_blank" title="wordpress" class="social-wordpress social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_vimeo'])){ ?>
                                <li><a href="<?php echo $hsn_vimeo; ?>" target="_blank" title="vimeo" class="social-vimeo social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_twitter'])){ ?>
                                <li><a href="<?php echo $hsn_twitter; ?>" target="_blank" title="twitter" class="social-twitter social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_tumblr'])){ ?>
                                <li><a href="<?php echo $hsn_tumblr; ?>" target="_blank" title="tumblr" class="social-tumblr social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_technorati'])){ ?>
                                <li><a href="<?php echo $hsn_technorati; ?>" target="_blank" title="technorati" class="social-technorati social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_stumbleupon'])){ ?>
                                <li><a href="<?php echo $hsn_stumbleupon; ?>" target="_blank" title="stumbleupon" class="social-stumbleupon social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_skype'])){ ?>
                                <li><a href="<?php echo $hsn_skype; ?>" target="_blank" title="skype" class="social-skype social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_rss'])){ ?>
                                <li><a href="<?php echo $hsn_rss; ?>" target="_blank" title="rss" class="social-rss social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_reddit'])){ ?>
                                <li><a href="<?php echo $hsn_reddit; ?>" target="_blank" title="reddit" class="social-reddit social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_posterous'])){ ?>
                                <li><a href="<?php echo $hsn_posterous; ?>" target="_blank" title="posterous" class="social-posterous social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_plurk'])){ ?>
                                <li><a href="<?php echo $hsn_plurk; ?>" target="_blank" title="plurk" class="social-plurk social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_pinterest'])){ ?>
                                <li><a href="<?php echo $hsn_pinterest; ?>" target="_blank" title="pinterest" class="social-pinterest social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_picasa'])){ ?>
                                <li><a href="<?php echo $hsn_picasa; ?>" target="_blank" title="picasa" class="social-picasa social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_paypal'])){ ?>
                                <li><a href="<?php echo $hsn_paypal; ?>" target="_blank" title="paypal" class="social-paypal social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_orkut'])){ ?>
                                <li><a href="<?php echo $hsn_orkut; ?>" target="_blank" title="orkut" class="social-orkut social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_newsvine'])){ ?>
                                <li><a href="<?php echo $hsn_newsvine; ?>" target="_blank" title="newsvine" class="social-newsvine social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_netvibes'])){ ?>
                                <li><a href="<?php echo $hsn_netvibes; ?>" target="_blank" title="netvibes" class="social-netvibes social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_myspace'])){ ?>
                                <li><a href="<?php echo $hsn_myspace; ?>" target="_blank" title="myspace" class="social-myspace social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_mixx'])){ ?>
                                <li><a href="<?php echo $hsn_mixx; ?>" target="_blank" title="mixx" class="social-mixx social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_metacafe'])){ ?>
                                <li><a href="<?php echo $hsn_metacafe; ?>" target="_blank" title="metacafe" class="social-metacafe social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_linkedin'])){ ?>
                                <li><a href="<?php echo $hsn_linkedin; ?>" target="_blank" title="linkedin" class="social-linkedin social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_lastfm'])){ ?>
                                <li><a href="<?php echo $hsn_lastfm; ?>" target="_blank" title="lastfm" class="social-lastfm social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_icloud'])){ ?>
                                <li><a href="<?php echo $hsn_icloud; ?>" target="_blank" title="icloud" class="social-icloud social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_html5'])){ ?>
                                <li><a href="<?php echo $hsn_html5; ?>" target="_blank" title="html5" class="social-html5 social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_grooveshark'])){ ?>
                                <li><a href="<?php echo $hsn_grooveshark; ?>" target="_blank" title="grooveshark" class="social-grooveshark social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_gowalla'])){ ?>
                                <li><a href="<?php echo $hsn_gowalla; ?>" target="_blank" title="gowalla" class="social-gowalla social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_googleplus'])){ ?>
                                <li><a href="<?php echo $hsn_googleplus; ?>" target="_blank" title="googleplus" class="social-googleplus social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_google'])){ ?>
                                <li><a href="<?php echo $hsn_google; ?>" target="_blank" title="google" class="social-google social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_github'])){ ?>
                                <li><a href="<?php echo $hsn_github; ?>" target="_blank" title="github" class="social-github social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_forrst'])){ ?>
                                <li><a href="<?php echo $hsn_forrst; ?>" target="_blank" title="forrst" class="social-forrst social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_flickr'])){ ?>
                                <li><a href="<?php echo $hsn_flickr; ?>" target="_blank" title="flickr" class="social-flickr social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_facebook'])){ ?>
                                <li><a href="<?php echo $hsn_facebook; ?>" target="_blank" title="facebook" class="social-facebook social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_evernote'])){ ?>
                                <li><a href="<?php echo $hsn_evernote; ?>" target="_blank" title="evernote" class="social-evernote social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_ember'])){ ?>
                                <li><a href="<?php echo $hsn_ember; ?>" target="_blank" title="ember" class="social-ember social-global"></a></li>
                            <?php } ?>
                            <?php if (!empty($options['hsn_dribbble'])){ ?>
                                <li><a href="<?php echo $hsn_dribbble; ?>" target="_blank" title="dribbble" class="social-dribbble social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_dopplr'])){ ?>
                                <li><a href="<?php echo $hsn_dopplr; ?>" target="_blank" title="dopplr" class="social-dopplr social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_digg'])){ ?>
                                <li><a href="<?php echo $hsn_digg; ?>" target="_blank" title="digg" class="social-digg social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_deviantart'])){ ?>
                                <li><a href="<?php echo $hsn_deviantart; ?>" target="_blank" title="deviantart" class="social-deviantart social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_delicious'])){ ?>
                                <li><a href="<?php echo $hsn_delicious; ?>" target="_blank" title="delicious" class="social-delicious social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_cargo'])){ ?>
                                <li><a href="<?php echo $hsn_cargo; ?>" target="_blank" title="cargo" class="social-cargo social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_blogger'])){ ?>
                                <li><a href="<?php echo $hsn_blogger; ?>" target="_blank" title="blogger" class="social-blogger social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_behance'])){ ?>
                                <li><a href="<?php echo $hsn_behance; ?>" target="_blank" title="behance" class="social-behance social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_apple'])){ ?>
                                <li><a href="<?php echo $hsn_apple; ?>" target="_blank" title="apple" class="social-apple social-global"></a></li>
                            <?php } ?> 
                            <?php if (!empty($options['hsn_aim'])){ ?>
                                <li><a href="<?php echo $hsn_aim; ?>" target="_blank" title="aim" class="social-aim social-global"></a></li>
                            <?php } ?> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="header clear">     
                <div id="logo">
                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo_top['url']; ?>" alt="" /></a>
                </div><!--END LOGO-->
            
                <div id="primary-menu">

                <?php

                    if (is_user_logged_in()){
                        wp_nav_menu( array(
                        'menu' => "LoggedInUserMenu",
                        'theme_location' => 'primary-menu',
                        'container' => false, 
                        'menu_class' => 'menu', 
                        'menu_id' => '',
                        'fallback_cb' => 'header_fallback' 
                        ));
                    } 
                    else {
                        wp_nav_menu( array( 'theme_location' => 'primary-menu' , 
                                    'container' => false, 
                                    'menu_class' => 'menu', 
                                    'menu_id' => '', 
                                    'fallback_cb' => 'header_fallback'
                                    ) );
                    }

                /*Default Menu from Theme */
                /*wp_nav_menu( array( 'theme_location' => 'primary-menu' , 
                                    'container' => false, 
                                    'menu_class' => 'menu', 
                                    'menu_id' => '', 
                                    'fallback_cb' => 'header_fallback'
                                    ) );*/
                ?>                
                </div><!--END PRIMARY MENU-->
                
            </div><!--END HEADER-->    
        		<?php if (get_post_meta(get_the_ID(), SYSTEM_VAR_PREFIX."hide_title", true) != "yes") { ?>
                    <div class="section-title">
                    	<div class="control-size rewidth-subtitle">
                            <div class="two-third">
                                <h1 class="title-header">
									<?php $title_page = get_post_meta(get_the_ID(), SYSTEM_VAR_PREFIX."title_page", true);
									
									if (is_month()) 
									{
										$title = __("Monthly archive", SYSTEM_THEME_SHORT);
										$subtitle = __("for ", SYSTEM_THEME_SHORT) . single_month_title('', false);
										if ($paged > 1) $subtitle .= " - " . __("page", SYSTEM_THEME_SHORT) . " " . $paged;
										echo $title; ?> <span><?php echo $subtitle; ?></span> <?php
									}
									
									elseif (is_search()) 
									{
										$title = __("Search results", SYSTEM_THEME_SHORT);
										$subtitle = __("for ", SYSTEM_THEME_SHORT) . $_GET["s"];
										if ($paged > 1) $subtitle .= " - " . __("page", SYSTEM_THEME_SHORT) . " " . $paged;
										echo $title; ?> <span><?php echo $subtitle; ?></span> <?php
                                        
									}
									
									elseif (is_tag()) 
									{
										$title = __("Tag archive", SYSTEM_THEME_SHORT);
										$subtitle = __("for ", SYSTEM_THEME_SHORT) . single_tag_title('', false);
										if ($paged > 1) $subtitle .= " - " . __("page", SYSTEM_THEME_SHORT) . " " . $paged;
										echo $title; ?> <span><?php echo $subtitle; ?></span> <?php
									}
									
									elseif (is_category()) 
									{
										$title = __("Archive", SYSTEM_THEME_SHORT);
										$subtitle = __("for ", SYSTEM_THEME_SHORT) . single_cat_title('', false);
										if ($paged > 1) $subtitle .= " - " . __("page", SYSTEM_THEME_SHORT) . " " . $paged;
										echo $title; ?> <span><?php echo $subtitle; ?></span> <?php
									}
									
									elseif (is_home()) 
									{
										$title = get_option('blogname');
										$subtitle = get_option('blogdescription');
										if ($paged > 1) $subtitle .= " - " . __("page", SYSTEM_THEME_SHORT) . " " . $paged;
										echo $title; ?> <span><?php echo $subtitle; ?></span> <?php
									}
									
									elseif(!empty($title_page)){ echo $title_page; }
									
									else { the_title(); }
									
									?>
                                    
								</h1>
                            </div>
                            
                            <div class="close-container">
                            <a class="close" target="_self" href="<?php echo site_url(); ?>"></a>
                            </div>
                        </div>               
                    </div><!--END SECTION TITLE-->
                <?php } ?>
    </div><!--END HEADER-WRAPPER-->   
    <?php $slider = get_post_meta(get_the_ID(), SYSTEM_VAR_PREFIX."slider", true); ?>
	<?php if($slider){
    ?>
    <div id="header-banner"><?php putRevSlider( "$slider" ) ?></div>     
    <?php } ?>
    <!-- END HEADER -->
<?php
if ($layout == "stretched")
{
    if ($page_template == "page-contact-2") $class = "class='fullwidth clear'"; else $class = "class='clear'";
?>
<div id="wrapper"  <?php echo $class; ?>>    

<?php
if ($page_template != "page-contact-2")
{
?>
<div class="content-wrapper clear">
<?php
}
}
