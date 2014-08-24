<?php
$options = get_option('infinite_options');
$boxed_or_stretched = $options['boxed_or_stretched'];
$layout = $boxed_or_stretched;
if (isset($_GET["layout"])) 
{
    if ($_GET["layout"] == "stretched") $layout = "stretched" ;
    if ($_GET["layout"] == "boxed") $layout = "boxed" ; 
}

if ($layout == "stretched")
{
$page_template = get_page_template();
$path = pathinfo($page_template);
$page_template = $path['filename'];

?>
    
    <p id="back-top">
		<a href="#top"><span></span></a>
	</p>
</div><!-- END WRAPPER --> 
<?php
}
?> 
    
    
    <!-- START FOOTER -->
    
    <div id="footer">
        
        <div id="footer-content">
<!------->

<!------->

<?php
$all_sidebars = wp_get_sidebars_widgets();
if (count($all_sidebars["Footer_01"]) > 0 || count($all_sidebars["Footer_02"]) > 0 || count($all_sidebars["Footer_03"]) > 0)
{
?>                    
                <div id="footer-top" class="clear">
                    
                <div class="one-third">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_01") ) : endif; ?>
                </div><!--END one-third-->
                
                <div class="one-third">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_02") ) : endif; ?>
                </div><!--END one-third-->
                
                <div class="one-third last">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer_03") ) : endif;  ?>
                </div><!--END one-third last-->
                    
                </div><!--END FOOTER-TOP-->
<?php
}
?>         
            
                  
            
        </div><!--END FOOTER-CONTENT-->        
    
    </div><!--END FOOTER-->
    
    			<div id="footer-bottom" class="clear">
                     <div class="control-size clear">   
                         <div class="one">    
                            <div class="one-half">
                            <?php echo $options['footer_text']; ?>
                            </div>  
                                    
                            <div class="one-half last"> 
                                    <?php
                                    wp_nav_menu( array( 'theme_location' => 'footer_menu' , 
                                                        'container' => false, 
                                                        'menu_class' => 'menu', 
                                                        'menu_id' => '', 
                                                        'fallback_cb' => 'footer_fallback'
                                                        ) );
                                    ?>                
                            </div>
                            </div>
                    </div>
                </div><!--END FOOTER-BOTTOM-->  
                
    <!-- END FOOTER -->    
<?php
if ($layout == "boxed")
{
?>
</div><!-- END CONTENT-WRAPPER --> 

</div><!-- END WRAPPER --> 
<?php
}
?> 

<script type='text/javascript'>
jQuery(document).ready(function($){
<?php
$options = get_option('infinite_options'); 
$bg_global_custom = $options['bg_global_custom'];
$tile_image = $options['tile_image'];
$bg_image_global = $bg_global_custom['url'];
$tile_background_global = $tile_image;
$bg_image_local = get_post_meta(get_the_ID(), SYSTEM_VAR_PREFIX."background_image", true);

if ($bg_image_local != "")
{ 
    $bg_image = $bg_image_local;
    $image_id = MultiPostThumbnails::get_post_thumbnail_id( 'page', $bg_image, get_the_ID() );
    $page_bg_image = wp_get_attachment_image_src( $image_id, "page_" . $bg_image );
    $bg_image = $page_bg_image[0];
    $tile_background = get_post_meta(get_the_ID(), SYSTEM_VAR_PREFIX."tile_background", true);
}
else
{
    $bg_image = $bg_image_global;
    $tile_background = $tile_background_global;
}

if ($bg_image != "" && $tile_background == "1")
{
?>
    $("body").css("background", "url(<?php echo $bg_image; ?>) repeat");
<?php
}
if ($bg_image != "" && $tile_background != "1") 
{
?> 
    $.backstretch("<?php echo $bg_image; ?>");
<?php
}
?>
})
	<?php $options = get_option('infinite_options'); ?>
	<?php 

    //if(!empty($options['custom_javascript'])){
    if(trim($options['custom_javascript']) > ""){
        echo '' . $options['custom_javascript'] . ''; 
    }
  ?>
</script>
<?php
$options = get_option('infinite_options');
if ($options['panel_samples'] == "1")
{
?>
<!-- Theme Option --> 
<script type="text/javascript" src="<?php echo SYSTEM_ROOT."/javascript/theme-option.js" ; ?>"></script>

<div id="panel" style="margin-left:-210px;">
        
    <div id="panel-admin">
    	<h1>Style Switcher</h1><br /><br />
        <strong>Select background pattern</strong> <br />    
        <select id="background">
          <option value="">Blank</option>
          <option value="bg-1.png">Pattern 1</option>
          <option value="bg-2.png">Pattern 2</option>
          <option value="bg-3.png">Pattern 3</option>
          <option value="bg-4.png">Pattern 4</option>
          <option value="bg-5.png">Pattern 5</option>
          <option value="bg-6.png">Pattern 6</option>
          <option value="bg-7.png">Pattern 7</option>
          <option value="bg-8.png">Pattern 8</option>
          <option value="bg-9.png">Pattern 9</option>
          <option value="bg-10.png">Pattern 10</option>
          <option value="bg-11.png">Pattern 11</option>
          <option value="bg-12.png">Pattern 12</option>
          <option value="bg-13.png">Pattern 13</option>
          <option value="bg-14.png">Pattern 14</option>
          <option value="bg-15.png">Pattern 15</option>
          <option value="bg-16.png">Pattern 16</option>
          <option value="bg-17.png">Pattern 17</option>
          <option value="bg-18.png">Pattern 18</option>
        </select>
        
        <strong>Boxed or Stretched style</strong> <br />
        <select id="layout">
          <option value="">Default</option>
          <option value="streched">Wide</option>
          <option value="boxed">Boxed</option>
        </select>
        
        
<br /><br />
<p>
The Styling Options in this Preview show only a minimum of the tons of Customization Options available in Backend of FITNESS.
</p>

<br />

    </div><!--PANEL-ADMIN-->    
    
    <a class="open" href="#"></a>

</div><!--PANEL-->
<?php
}
?>
<?php $options = get_option('infinite_options'); ?>
<?php if ($options['custom_css'] != "")
{
?> 
<style type="text/css">
<!--
<?php echo $options['custom_css']; ?>
-->
</style>
<?php
}
?>
<?php wp_footer(); ?>
</body>
</html>