<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); // If file is called directly, die
/* Create new form elements */
add_action( 'register_form', 'wp_eve_auth_reg_form' );
function wp_eve_auth_reg_form() {
    $vcode = ( ! empty( $_POST['vcode'] ) ) ? trim( $_POST['vcode'] ) : '';
    $key_id = ( ! empty( $_POST['key_id'] ) ) ? trim( $_POST['key_id'] ) : '';

    ?>
    <p>
        Include an API key to auth for this site.
    </p>
    <p>
        <label for="vcode"><?php _e( 'vcode', 'eve_auth' ) ?><br />
            <input type="text" name="vcode" id="vcode" class="input" value="<?php echo esc_attr( wp_unslash( $vcode ) ); ?>" size="50" /></label>
            <br/>
        <label for="key_id"><?php _e( 'key_id', 'eve_auth' ) ?><br />
            <input type="text" name="key_id" id="key_id" class="input" value="<?php echo esc_attr( wp_unslash( $key_id ) ); ?>" size="50" /></label>
    </p>
    <?php
}

/* Add validation. */
add_filter( 'registration_errors', 'wp_eve_auth_registration_errors', 10, 3 );
function wp_eve_auth_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    if ( empty( $_POST['vcode'] ) || ! empty( $_POST['vcode'] ) && trim( $_POST['vcode'] ) == '' ) {
        $errors->add( 'vcode_error', __( '<strong>ERROR</strong>: You must include a vcode.', 'eve_auth' ) );
    }
    if ( empty( $_POST['key_id'] ) || ! empty( $_POST['key_id'] ) && trim( $_POST['key_id'] ) == '' ) {
        $errors->add( 'key_id_error', __( '<strong>ERROR</strong>: You must include a key_id.', 'eve_auth' ) );
    }

    return $errors;
}

/* Save extra registration user meta. */
add_action( 'user_register', 'wp_eve_auth_user_register' );
function wp_eve_auth_user_register( $user_id ) {
    if ( ! empty( $_POST['vcode'] ) ) {
        update_user_meta( $user_id, 'vcode', trim( $_POST['vcode'] ) );
    }
    if ( ! empty( $_POST['key_id'] ) ) {
        update_user_meta( $user_id, 'key_id', trim( $_POST['key_id'] ) );
    }
}

