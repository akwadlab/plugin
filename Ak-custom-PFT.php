<?php 
/**
 * Plugin Name: Akwadweb Custom Post Types , Taxonomies and Custom Fields 
 * Description: Simple Plugin that adds custom post types , taxonomies and Custom
 * Author: Akwadweb
 * Author URI: http://www.akwadweb.com
 * Version: 2.0.0
 * License: GPL2
 */

/*
    Copyright (C) 2018  Akwadweb  info@akwadweb.com

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

/**
 * Registers a new post type
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 */
	// $singlecpt = 'Employee';
	// $pluralcpt = 'Employees';
function akwadweb_custom_post_type($singlecpt, $pluralcpt, $dashicon) {

	$labels = array(
		'name'               => __( $pluralcpt, 'akwadcpt' ),
		'singular_name'      => __( $singlecpt, 'akwadcpt' ),
		'add_new'            => _x( 'Add New ' . $singlecpt , 'akwadcpt', 'akwadcpt' ),
		'add_new_item'       => __( 'Add New ' . $singlecpt, 'akwadcpt' ),
		'edit_item'          => __( 'Edit ' . $singlecpt, 'akwadcpt' ),
		'new_item'           => __( 'New ' . $singlecpt, 'akwadcpt' ),
		'view_item'          => __( 'View ' .$singlecpt, 'akwadcpt' ),
		'search_items'       => __( 'Search ' . $pluralcpt, 'akwadcpt' ),
		'not_found'          => __( 'No ' . $pluralcpt . ' found', 'akwadcpt' ),
		'not_found_in_trash' => __( 'No ' . $pluralcpt . ' found in Trash', 'akwadcpt' ),
		'parent_item_colon'  => __( 'Parent ' . $singlecpt . ':', 'akwadcpt' ),
		'menu_name'          => __( $pluralcpt, 'akwadcpt' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array( 'category', 'post_tag' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => $dashicon,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'menu_position'	      => 5,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			// 'editor',
			// 'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			// 'trackbacks',
			// 'comments',
			// 'revisions',
			// 'page-attributes',
			// 'post-formats',
		),
	);

	register_post_type( $singlecpt, $args );
}


add_action( 'akwadweb_custom_post_type_initt', 'akwadweb_custom_post_type', 10 , 3 );

// add_action('init','add_categories_to_cpt');
function add_categories_to_cpt(){
    register_taxonomy_for_object_type('category', 'employee');
}

// add_action( 'akwadweb_custom_post_type_initt', 'akwadweb_custom_post_type', 10 , 3 );

// function add_categories_to_cpt( $akcategory , $singlecpt){
//     register_taxonomy_for_object_type($akcategory, $singlecpt);
// }
// add_action('akwadweb_add_category_initt','add_categories_to_cpt', 10 ,2 );

// function my_rewrite_flush() {
//     // First, we "add" the custom post type via the above written function.
//     // Note: "add" is written with quotes, as CPTs don't get added to the DB,
//     // They are only referenced in the post_type column with a post entry, 
//     // when you add a post of this CPT.
//     akwadweb_custom_post_type($singlecpt, $pluralcpt, $dashicon);

//     // ATTENTION: This is *only* done during plugin activation hook in this example!
//     // You should *NEVER EVER* do this on every page load!!
//     flush_rewrite_rules();
// }
// register_activation_hook( __FILE__, 'my_rewrite_flush' );


// custom taxonomies

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function akwad_custom_taxonomies() {
	$singular = 'Location';
	$plural = 'Locations';
	$labels = array(
		'name'                  => _x( $plural , 'Taxonomy' . $plural, 'akwadcpt' ),
		'singular_name'         => _x( $singular, 'Taxonomy ' .$singular, 'akwadcpt' ),
		'search_items'          => __( 'Search' . $plural, 'akwadcpt' ),
		'popular_items'         => __( 'Popular' .  $plural, 'akwadcpt' ),
		'all_items'             => __( 'All ' .$plural, 'akwadcpt' ),
		'parent_item'           => __( 'Parent ' . $singular, 'akwadcpt' ),
		'parent_item_colon'     => __( 'Parent ' . $singular, 'akwadcpt' ),
		'edit_item'             => __( 'Edit ' .$singular, 'akwadcpt' ),
		'update_item'           => __( 'Update ' . $singular, 'akwadcpt' ),
		'add_new_item'          => __( 'Add New ' . $singular, 'akwadcpt' ),
		'new_item_name'         => __( 'New ' . $singular . ' Name', 'akwadcpt' ),
		'add_or_remove_items'   => __( 'Add or remove ' .$plural, 'akwadcpt' ),
		'choose_from_most_used' => __( 'Choose from most used ' . $plural, 'akwadcpt' ),
		'separate_items_with_commas'	=> 'Separate ' . $plural . ' with commas',
		'add_or_remove_items'		=> 'Add or remove ' . $singular,
		'menu_name'             => __( $plural, 'akwadcpt' ),
	);

	$args = array(
		'labels'             		=> $labels,
		'public'             		=> true,
		'show_in_nav_menus'  		=> true,
		'show_admin_column'  		=> false,
		'hierarchical'       		=> false, // update to true if we need to set updat post term count
		'update_count_callback'		=> '_update_post_term_count',
		'show_tagcloud'      		=> true,
		'show_ui'            		=> true,
		'query_var'          		=> true,
		'rewrite'            		=> true,
		'query_var'          		=> true,
		'capabilities'       		=> array(),
	);

	register_taxonomy( $singular , array( 'employee' ), $args );


	// another taxonomies
	$singular = 'site';
	$plural = 'sites';
	$labels = array(
		'name'                  => _x( $plural, 'Taxonomy ' . $plural, 'akwadcpt' ),
		'singular_name'         => _x( $singular, 'Taxonomy ' . $singular, 'akwadcpt' ),
		'search_items'          => __( 'Search ' . $plural, 'akwadcpt' ),
		'popular_items'         => __( 'Popular ' . $plural, 'akwadcpt' ),
		'all_items'             => __( 'All '. $plural, 'akwadcpt' ),
		'parent_item'           => __( 'Parent ' . $singular, 'akwadcpt' ),
		'parent_item_colon'     => __( 'Parent ' . $singular, 'akwadcpt' ),
		'edit_item'             => __( 'Edit ' . $singular, 'akwadcpt' ),
		'update_item'           => __( 'Update ' . $singular, 'akwadcpt' ),
		'add_new_item'          => __( 'Add New ' . $singular, 'akwadcpt' ),
		'new_item_name'         => __( 'New ' . $singular . ' Name', 'akwadcpt' ),
		'add_or_remove_items'   => __( 'Add or remove ' . $plural, 'akwadcpt' ),
		'choose_from_most_used' => __( 'Choose from most used ' . $plural, 'akwadcpt' ),
		'menu_name'             => __( $plural, 'akwadcpt' ),
	);

	$args = array(
		'labels'             	=> $labels,
		'public'             	=> true,
		'show_in_nav_menus'  	=> true,
		'show_admin_column'  	=> false,
		'hierarchical'       	=> true, // update to true if we need to set updat post term count
		// 'update_count_callback'	=> '_update_post_term_count',
		'show_tagcloud'      	=> true,
		'show_ui'            	=> true,
		'query_var'          	=> true,
		'rewrite'            	=> true,
		'query_var'          	=> true,
		'capabilities'       	=> array(),
	);

	register_taxonomy( $singular, array( 'testimonial' ), $args );
}

 add_action( 'init', 'akwad_custom_taxonomies' );
// 
  /**
 * [custom fields plugin]
 * @var string
 */

	
function Ak_add_custom_metabox(){
	$singularcf= 'employee';
	$field_name='employee';
	add_meta_box( 'Ak_meta', $field_name, 'Ak_meta_callback', $singularcf);
}

add_action('add_meta_boxes', 'Ak_add_custom_metabox');



function Ak_meta_callback($post){
$singularcf= 'employee';
	wp_nonce_field(basename(__FILE__), 'Ak_'.$singularcf.'_nonce' );
	$Ak_stored_meta = get_post_meta($post->ID);
	?>

	<div>	
		<div class="meta-row">
			<div class="meta-th">
				<label for="<?php echo $singularcf ?>-id" class"Ak_row_title"><?php echo $singularcf ?> Position</label>
			</div>
			<div class="meta-td">
				
				<input type="text" name="<?php echo $singularcf ?>_id" id="<?php echo $singularcf ?>-id" value="<?php if(! empty ($Ak_stored_meta[$singularcf.'_id'])) echo esc_attr($Ak_stored_meta[$singularcf.'_id']['0']); ?>"/>
			</div>
		</div>
	</div>

	</div>

	<?php

}

function Ak_meta_save($post_id){
	// check save status
$singularcf= 'employee';

	$is_autosave 	= wp_is_post_autosave($post_id );
	$is_revision	= wp_is_post_revision($post_id );
	$is_valid_nonce	= (isset ($_POST['Ak_'.$singularcf.'_nonce']) && wp_verify_nonce($_POST['Ak_'.$singularcf.'_nonce'], basename(__FILE__) )) ? 'true' : 'false';

	// Exit script depending on save status
	if($is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}

	if(isset($_POST[$singularcf.'_id'])){
		update_post_meta($post_id, $singularcf.'_id', sanitize_text_field($_POST[$singularcf.'_id'] ) );
	}
	if(isset($_POST['date-listed'])){
		update_post_meta($post_id, 'date-listed', sanitize_text_field($_POST['date-listed'] ) );
	}
	if(isset($_POST['application_deadline'])){
		update_post_meta($post_id, 'application_deadline', sanitize_text_field($_POST['application_deadline'] ) );
	}
	if(isset($_POST['principle_duties'])){
		update_post_meta($post_id, 'principle_duties', sanitize_text_field($_POST['principle_duties'] ) );
	}


}

add_action('save_post' , 'Ak_meta_save');// delete_option( "plugin_error" );
// 
add_action('activated_plugin','my_save_error');
function my_save_error()
{
file_put_contents(dirname(__file__).'/error_activation.txt', ob_get_contents());
}

