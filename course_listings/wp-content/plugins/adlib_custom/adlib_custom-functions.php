<?php
/**
 * Plugin Name: Ad Lib Custom Functions
 * Plugin URI: http://adlibunlimited.com
 * Description: Custom Event Post Type
 * Author: SK
 * Version: 0.1.0
 */
 

/******Start Event Custom Post Type*****/

add_action('init', 'comp_events_register');
 
function comp_events_register() {
 
	$labels = array(
		'name' => _x('Events', 'post type general name'),
		'singular_name' => _x('Event', 'post type singular name'),
		'add_new' => _x('Add Event', 'event'),
		'add_new_item' => __('Add New Event'),
		'edit_item' => __('Edit Event'),
		'new_item' => __('New Event'),
		'view_item' => __('View Event'),
		'search_items' => __('Search Events'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail')
	  ); 
 
	register_post_type( 'event' , $args );
}

add_action("admin_init", "admin_init");
add_action('save_post', 'save_details');
 
function admin_init(){
  add_meta_box("event_info", "Event Info", "event_info", "event", "normal", "low");
}
 
function event_info() {
  global $post;
  $custom = get_post_custom($post->ID);
  $presenter = $custom["presenter"][0];
  $date = $custom["date"][0];
  $location = $custom["location"][0];
  $ceus = $custom["ceus"][0];
  $hours = $custom["hours"][0];
  $tution = $custom["tution"][0];
  $seminar_description = $custom["seminar_description"][0];
  $presenter_bio = $custom["presenter_bio"][0];

  ?>
  <p><label>PRESENTER:</label><br />
  <textarea cols="50" rows="1" name="presenter"><?php echo $presenter; ?></textarea></p>
  <p><label>DATE & TIMES:</label><br />
  <textarea cols="80" rows="1" name="date"><?php echo $date; ?></textarea></p>
  <p><label>LOCATION:</label><br />
  <textarea cols="50" rows="3" name="location"><?php echo $location; ?></textarea></p>
  <p><label>CEU'S:</label><br />
  <textarea cols="50" rows="1" name="ceus"><?php echo $ceus; ?></textarea></p>
  <p><label>CONTACT HOURS:</label><br />
  <textarea cols="50" rows="1" name="hours"><?php echo $hours; ?></textarea></p>
  <p><label>TUITION:</label><br />
  <textarea cols="50" rows="1" name="tution"><?php echo $tution; ?></textarea></p>
  <p><label>SEMINAR DESCRIPTION:</label><br />
  <textarea cols="100" rows="8" name="seminar_description"><?php echo $seminar_description; ?></textarea></p>
  <p><label>PRESENTER BIO:</label><br />
  <textarea cols="100" rows="8" name="presenter_bio"><?php echo $presenter_bio; ?></textarea></p>
  <?php
}


function save_details(){
  global $post;
 
  update_post_meta($post->ID, "presenter", $_POST["presenter"]);
  update_post_meta($post->ID, "date", $_POST["date"]);
  update_post_meta($post->ID, "location", $_POST["location"]);
  update_post_meta($post->ID, "ceus", $_POST["ceus"]);
  update_post_meta($post->ID, "hours", $_POST["hours"]);
  update_post_meta($post->ID, "tution", $_POST["tution"]);
  update_post_meta($post->ID, "seminar_description", $_POST["seminar_description"]);
  update_post_meta($post->ID, "presenter_bio", $_POST["presenter_bio"]);

}

add_action("manage_posts_custom_column",  "events_custom_columns");
add_filter("manage_edit-event_columns", "events_edit_columns");
 
function events_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Seminar Title",
    "presenter" => "Presenter",
    "date" => "Date",
  );
 
  return $columns;
}
function events_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "presenter":
      $custom = get_post_custom();
      echo $custom["presenter"][0];
      break;
	case "date":
      $custom = get_post_custom();
      echo $custom["date"][0];
      break;
    //case "skills":
    // echo get_the_term_list($post->ID, 'Skills', '', ', ','');
    //break;
	  
  }
}

/******End Event Custom Post Type*****/

?>