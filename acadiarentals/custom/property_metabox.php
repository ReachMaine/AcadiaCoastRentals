<?php
/* Metabox  */
/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function property_options_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function property_options_add_meta_box() {
	add_meta_box(
		'property_options-property-options',
		__( 'Property Options', 'property_options' ),
		'property_options_html',
		'post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'property_options_add_meta_box' );

function property_options_html( $post) {
	wp_nonce_field( '_property_options_nonce', 'property_options_nonce' ); ?>

	<div class="rwmb-meta-box">
    <div class="rwmb-field rwmb-text-wrapper">
      <div class="rwmb-label">
  		    <label for="property_options_subtitle"><?php _e( 'Subtitle', 'property_options' ); ?></label><br>
      </div>
      <div class="rwmb-input">
  	     <input style="width: 90%; min-width:130px;"type="text" with="40" name="property_options_subtitle" id="property_options_subtitle" value="<?php echo property_options_get_meta( 'property_options_subtitle' ); ?>">
      </div>
    </div> <!-- field end wrapper -->
	</div>
  <?php
}

function property_options_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['property_options_nonce'] ) || ! wp_verify_nonce( $_POST['property_options_nonce'], '_property_options_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['property_options_subtitle'] ) )
		update_post_meta( $post_id, 'property_options_subtitle', esc_attr( $_POST['property_options_subtitle'] ) );
}
add_action( 'save_post', 'property_options_save' );

/*
	Usage: property_options_get_meta( 'property_options_subtitle' )
*/