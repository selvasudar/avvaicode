<?php
add_action('init', 'staff_init');
add_action('init', 'alumni_init');
add_action('init','achieve_init');
/*
* Creating a function to create our CPT
*/

function staff_init()
{

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x('Staff', 'Post Type General Name', 'Myschool'),
		'singular_name'       => _x('Staff', 'Post Type Singular Name', 'Myschool'),
		'menu_name'           => __('Staff', 'Myschool'),
		'all_items'           => __('All Staff', 'Myschool'),
		'view_item'           => __('View Staff', 'Myschool'),
		'add_new_item'        => __('Add New Staff', 'Myschool'),
		'add_new'             => __('Add New', 'Myschool'),
		'edit_item'           => __('Edit Staff Profile', 'Myschool'),
		'update_item'         => __('Update Staff Profile', 'Myschool'),
		'search_items'        => __('Search Staff Profile', 'Myschool'),
		'not_found'           => __('Profile Not Found', 'Myschool'),
		'not_found_in_trash'  => __('Staff Profile Not found in Trash', 'Myschool'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('Staff', 'Myschool'),
		'description'         => __('Staff news and reviews', 'Myschool'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'editor'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('genres'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type('Staff', $args);
}

function alumni_init()
{

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x('Alumni', 'Post Type General Name', 'Myschool'),
		'singular_name'       => _x('Alumni', 'Post Type Singular Name', 'Myschool'),
		'menu_name'           => __('Alumni', 'Myschool'),
		'all_items'           => __('All Alumni', 'Myschool'),
		'view_item'           => __('View Alumni', 'Myschool'),
		'add_new_item'        => __('Add New Alumni', 'Myschool'),
		'add_new'             => __('Add New', 'Myschool'),
		'edit_item'           => __('Edit Alumni Profile', 'Myschool'),
		'update_item'         => __('Update Alumni Profile', 'Myschool'),
		'search_items'        => __('Search Alumni Profile', 'Myschool'),
		'not_found'           => __('Profile Not Found', 'Myschool'),
		'not_found_in_trash'  => __('Alumni Profile Not found in Trash', 'Myschool'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('Alumni', 'Myschool'),
		'description'         => __('Alumni news and reviews', 'Myschool'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'editor'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('genres'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type('alumni', $args);
}

function achieve_init()
{

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x('Achievement', 'Post Type General Name', 'Myschool'),
		'singular_name'       => _x('Achievement', 'Post Type Singular Name', 'Myschool'),
		'menu_name'           => __('Achievement', 'Myschool'),
		'all_items'           => __('All Achievements', 'Myschool'),
		'view_item'           => __('View Achievement', 'Myschool'),
		'add_new_item'        => __('Add New Achievement', 'Myschool'),
		'add_new'             => __('Add New', 'Myschool'),
		'edit_item'           => __('Edit Achievement Details', 'Myschool'),
		'update_item'         => __('Update Achievement Details', 'Myschool'),
		'search_items'        => __('Search Achievement', 'Myschool'),
		'not_found'           => __('Achievement Not Found', 'Myschool'),
		'not_found_in_trash'  => __('Achievement Not found in Trash', 'Myschool'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label' => 'Achievements',
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'achievement'),
		'query_var' => true,
		'menu_icon' => 'dashicons-controls-volumeon',
		// 'register_meta_box_cb' => 'add_achievement',
		// 'taxonomies' => array('category', 'post_tag'),
		'supports' => array(
			'title',
			'editor',
			// 'custom-fields',
			// 'revisions',
			//'author',
			// 'page-attributes',
			// 'thumbnail'
		)
	);
	// Registering your Custom Post Type
	register_post_type('achievement', $args);
}
