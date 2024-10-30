<?php
/*
Plugin Name: Menu-item-ancestor
Plugin URI: http://supersonic.lt
Description: Ads a menu-item-ancestor class to every menu item that has descendants
Version: 1.1
Author: Valentinas Bakaitis
Author URI: http://supersonic.lt
License: GPL2
*/

function add_ancestor_class($classlist, $item){
	global $wp_query, $wpdb;
	//get the ID of the object, to which menu item points
	$id = get_post_meta($item->ID, '_menu_item_object_id', true);
	//get first menu item that is a child of that object
	$children = $wpdb->get_var('SELECT post_id FROM '.$wpdb->postmeta.' WHERE meta_key like "_menu_item_menu_item_parent" AND meta_value='.$item->ID.' LIMIT 1');
	//if there is at least one item, then $children variable will contain it's ID (which is of course more than 0)
	if($children>0)
		//in that case - add the CSS class
		$classlist[]='menu-item-ancestor';
	//return class list
	return $classlist;
}

//add filter to nav_menu_css_class list
add_filter('nav_menu_css_class', 'add_ancestor_class', 2, 10)

?>