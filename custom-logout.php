<?php 
/*
Template Name: Custom Wordpress Logout
*/
wp_clear_auth_cookie();
wp_safe_redirect(home_url());
?>