<?php

/***Register post types*****/
function landing_page_init()
{
	register_post_type(
		'landing_section',
		array(
			'description' => '',
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'page',
			'show_in_nav_menus' => true,
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array('title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes', 'post-formats'),
			'labels' => array(
				'name' => 'Landing Page Sections',
				'singular_name' => 'Landing Page Section',
				'menu_name' => 'Landing Page Sections',
				'add_new' => 'Add Landing Page Section',
				'add_new_item' => 'Add Landing Page Section',
				'edit' => 'Edit',
				'edit_item' => 'Edit Landing Page Section',
				'new_item' => 'New Landing Page Section',
				'view' => 'View Landing Page Section',
				'view_item' => 'View Landing Page Section',
				'search_items' => 'Search Landing Page Sections',
				'not_found' => 'No Landing Page Sections Found',
				'not_found_in_trash' => 'No Landing Page Sections Found in Trash',
				'parent' => 'Parent Landing Page Section',
			)
		)
	);
}

function success_stories_init()
{
	$args = array(
		'label' => 'Success Stories',
		'labels' => array('edit_item' => 'Edit Success story', 'add_new_item' => 'Add Success Story'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'success-stories'),
		'query_var' => true,
		'menu_icon' => 'dashicons-portfolio',
		'register_meta_box_cb' => 'add_metabox_success_stories',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('success-stories', $args);
	geography_taxonomy_init();
	industry_taxonomy_init();
}

function whitepaper_init()
{
	$args = array(
		'label' => 'Whitepaper',
		'labels' => array('edit_item' => 'Edit whitepaper', 'add_new_item' => 'Add Whitepaper'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'whitepaper'),
		'query_var' => true,
		'menu_icon' => 'dashicons-images-alt',
		'register_meta_box_cb' => 'add_metabox_whitepaper',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('whitepaper', $args);
}


function geography_taxonomy_init()
{
	$labels = array(
		'name'              => _x('Geography', '', 'kissflow'),
		'singular_name'     => _x('Geography', 'taxonomy singular name', 'kissflow'),
		'search_items'      => __('Search Geography', 'kissflow'),
		'all_items'         => __('All Geography', 'kissflow'),
		'parent_item'       => __('Parent Geography', 'kissflow'),
		'parent_item_colon' => __('Parent Geography:', 'kissflow'),
		'edit_item'         => __('Edit Geography', 'kissflow'),
		'update_item'       => __('Update Geography', 'kissflow'),
		'add_new_item'      => __('Add New Geography', 'kissflow'),
		'new_item_name'     => __('New Geography Name', 'kissflow'),
		'menu_name'         => __('Geography', 'kissflow'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'region'),
	);

	register_taxonomy('region', array('success-stories'), $args);
}

function industry_taxonomy_init()
{
	$labels = array(
		'name'              => _x('Industry', '', 'kissflow'),
		'singular_name'     => _x('Industry', 'taxonomy singular name', 'kissflow'),
		'search_items'      => __('Search Industry', 'kissflow'),
		'all_items'         => __('All Industry', 'kissflow'),
		'parent_item'       => __('Parent Industry', 'kissflow'),
		'parent_item_colon' => __('Parent Industry:', 'kissflow'),
		'edit_item'         => __('Edit Industry', 'kissflow'),
		'update_item'       => __('Update Industry', 'kissflow'),
		'add_new_item'      => __('Add New Industry', 'kissflow'),
		'new_item_name'     => __('New Industry Name', 'kissflow'),
		'menu_name'         => __('Industry', 'kissflow'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'industry'),
	);

	register_taxonomy('industry', array('success-stories'), $args);
}
function webinar_init()
{
	register_post_type(
		'webinars',
		array(
			'description' => 'Lists Webinars from Gotowebinar.com',
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'page',
			'menu_icon'           => 'dashicons-awards',
			'show_in_nav_menus' => true,
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array('title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes', 'post-formats'),
			'labels' => array(

				'menu_name' => 'Webinar List'
			)
		)
	);
}

function careers_init()
{
	$args = array(
		'label' => 'Careers KF',
		'labels' => array('edit_item' => 'Edit Job Details', 'add_new_item' => 'Add New Job'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'careers'),
		'query_var' => true,
		'menu_icon' => 'dashicons-controls-volumeon',
		'register_meta_box_cb' => 'add_careers_box',
		'supports' => array(
			'title',
			'editor',
			'custom-fields',
			// 'revisions',`
			'thumbnail',
			'author',
			'page-attributes'
		)
	);
	register_post_type('careers', $args);
}

function news_init()
{
	$args = array(
		'label' => 'News and Media',
		'labels' => array('edit_item' => 'Edit News Details', 'add_new_item' => 'Add New News'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'news-media'),
		'query_var' => true,
		'menu_icon' => 'dashicons-controls-volumeon',
		'register_meta_box_cb' => 'add_news_box',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array(
			'title',
			'editor',
			// 'custom-fields',
			// 'revisions',
			//'author',
			// 'page-attributes',
			'thumbnail'
		)
	);
	register_post_type('news-media', $args);
}
add_action('init', 'webinar_init');
add_action('init', 'whitepaper_init');
add_action('init', 'success_stories_init');
add_action('init', 'landing_page_init');
add_action('init', 'careers_init');
add_action('init', 'news_init');
