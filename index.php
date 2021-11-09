<?php
/**
 * @package hippoapi
 * @version 1.0.0
 */
/*
Plugin Name: Hippo Api
Plugin URI: https://github.com/robertcypk
Description: Hippo Api
Version: 1.0.0
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include(dirname(__FILE__) . '/optionshippo.php');
include(dirname(__FILE__) . '/statesUs.php');
$json_states_us = json_decode($json_states_us);
$GLOBALS['jsondecode'] = $json_states_us;


function hippoapi_styles() {
    wp_enqueue_style( 'hippoapi',  plugin_dir_url( __FILE__ ) . 'css/style.css');
}
add_action( 'wp_enqueue_scripts', 'hippoapi_styles' );

function hippo_form() {
$rs = '<option value=""></option>';
foreach ($GLOBALS['jsondecode']  as $key => $value) {
   $rs .= '<option value="'.$key.'">'.$value.'</option>';
}
$authtoken_text = get_option( 'authtoken_text' );
$apiurl_text = get_option( 'apiurl_text' );

  $form = '<div class="formhippo">
          <form id="formhippo" action="'.$apiurl_text.$authtoken_text.'" method="GET" >'.
          '<div class="formhippo_a">'.
          '<div class="input_hippo col1"><label>First Name</label><input name="firstname" class="inputcustom3" value=""></div>'.
          '<div class="input_hippo col1"><label>Middle Name</label><input name="middlename" class="inputcustom3" value=""></div>'.
          '<div class="input_hippo col1"><label>Last Name</label><input name="lastname" class="inputcustom3" value=""></div>'.
          '</div>'.
          '<div class="formhippo_b">'.
          '<div class="input_hippo col2"><label>Street Address</label><input name="address" class="inputcustom1" value=""></div>'.
          '<div class="input_hippo col3"><label>Unit #</label><input name="unit" class="inputcustom3" value=""></div>'.
          '</div>'.
          '<div class="formhippo_c">'.
          '<div class="input_hippo col4"><label>City</label><input name="city" value=""></div>'.
          '<div class="input_hippo col4"><label>State</label><select name="state">'.$rs.'</select></div>'.
          '<div class="input_hippo col4"><label>Zipcode</label><input name="zip" value=""></div>'.
          '</div>'.
          '<div class="formhippo_d">'.
          '<div class="input_hippo col2">Date of birth<p><input name="city" type="date" class="inputcustom4" value=""></div>'.
          '</div>'.
          '<div class="formhippo_e">'.
          '<div class="input_hippo col5">Phone number<p><input name="phone" class="inputcustom5" value=""></div>'.
          '<div class="input_hippo col5">Email Address<p><input name="email" class="inputcustom5" value=""></div>'.
          '</div>'.
          '<div class="formhippo_f">'.
          '<div class="input_hippo col6 border1">
          <div class="scol1">
                      <h1 class="h1color1">house</h1>
                      This may be a single-family
                      home, towhouse or duplex
                      youn own and live in
          </div>
          <div class="scol2"><input type="radio" class="radiohippo" name="living" value="house" /></div>
          </div>'.
          '<div class="input_hippo col6 border1">
          <div class="scol1">
                      <h1 class="h1color2">Condo</h1>
                      This is likely a multi-family
                      building or complex in which
                      you own a unit
          </div>
          <div class="scol2"><input type="radio" class="radiohippo" name="living" value="condo" /></div>
          </div>'.
          '<div class="input_hippo col6 border1">
          <div class="scol1">
                      <h1 class="h1color3">HO5</h1>
                      The HO5 is an open perils
                      insurance policy for a sinle-
                      family home or duplex.
          </div>
          <div class="scol2"><input type="radio" class="radiohippo" name="living" value="ho5" /></div>
          </div>'.
          '</div>'.
          '<div class="formhippo_g"><input type="submit" class="submithippo" value="Submit"></div>'.
          '</form>
          </div>';
   return $form;
}
add_shortcode('hippo_form','hippo_form');
?>
