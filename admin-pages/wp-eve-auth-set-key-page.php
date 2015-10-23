<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); // If file is called directly, die
/*
 * Form handling code
 * 
 * If form has been submitted:
 * Check api key is valid, 
 * if it is save values to the db
 */
if(isset($_POST['newKey'])){
    /*
     * Sanitize the input values
     * Then save them to variables
     */
    $vcode = sanitize_text_field($_POST['vcode']);
    $key_id = sanitize_text_field($_POST['key_id']);
    /*
     * Ask the api object for the corp sheet
     * corp sheet is returned as a SimpleXMLElement
     */
    $corp_sheet = $api->get_corp_sheet($vcode, $key_id);
    /*
     * Check for errors;
     * If error found save it to a string for display
     */
    $errors = (string) $corp_sheet->error[0];
    /*
     * If no errors, the key is good
     * Cache the corp data in the database
     * else
     * display the error
     */
    if ($errors === ''){
        update_option('corp_vcode', $vcode);
        update_option('corp_key_id', $key_id);
        update_option('corp_name', (string) $corp_sheet->result->corporationName);
        update_option('corp_id', (string) $corp_sheet->result->corporationID);
        update_option('corp_ticker', (string) $corp_sheet->result->ticker);
    } else {
        
        echo('error: ' . $errors);
    }
}

/*
 * The set key page.
 * We will use the corp key to get the corp data that all users will be compared to.
 */
function eve_auth_set_key(){
?>
<h2>EVE API Auth</h2>
<p> Ensure only corp mates can register on your site. </p>
<h2>Set corp API Key</h2>
<p> You must provide a corp API key. <br/>
    This key sets the official corporation of this site. Only members of that corp will be able to register</p>
<form method="post" action="">
    <p>
        <label for="vcode"><?php _e( 'vcode', 'eve_auth' ) ?><br />
        <input type="text" name="vcode" id="vcode" class="input" value="<?php echo esc_attr( wp_unslash( $vcode ) ); ?>" size="80" /></label>
        <br/>
        <label for="key_id"><?php _e( 'key_id', 'eve_auth' ) ?><br />
        <input type="text" name="key_id" id="key_id" class="input" value="<?php echo esc_attr( wp_unslash( $key_id ) ); ?>" size="10" /></label>
    </p>
    <?php submit_button('Set Key', 'primary', 'newKey'); ?>
</form>
<?php
}