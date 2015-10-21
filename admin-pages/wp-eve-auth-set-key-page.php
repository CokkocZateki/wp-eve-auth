<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); // If file is called directly, die
/*
 * The set corp key page.
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
        <input type="text" name="vcode" id="vcode" class="input" value="<?php echo esc_attr( wp_unslash( $vcode ) ); ?>" size="50" /></label>
        <br/>
        <label for="key_id"><?php _e( 'key_id', 'eve_auth' ) ?><br />
        <input type="text" name="key_id" id="key_id" class="input" value="<?php echo esc_attr( wp_unslash( $key_id ) ); ?>" size="10" /></label>
    </p>
    <?php submit_button('Set Key', 'primary', 'newKey'); ?>
</form>
<?php
}