<?php
/*
Plugin Name: Tamil Thirukural
Description: Display a random <a href="https://en.wikipedia.org/wiki/Kural" title="Thirukkural is a classic Tamil text in the form of couplets dealing with the everyday virtues of an individual."> Thirukkural</a> in Tamil along with chapter, section and explanations.
Version: 4.0
Author: Hareesh Pillai
Author URI: https://profiles.wordpress.org/hareesh-pillai/
License: GPL2
*/

/*  Copyright 2019 Hareesh Pillai (email: hareesh.hsr289 at gmail.com)

	This plugin was originally written by Sandeep Ramamoorthy. It is now adopted and being maintained by Hareesh.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once plugin_dir_path( __FILE__ ) .'Thirukural-widget.php';

function thirukural_uninstall() {
	global $wpdb;
	$thirukural_table = $wpdb->prefix . "thirukural";
	$explanation_table = $wpdb->prefix . "thirukural_explanation";

	$sql = "DROP TABLE IF EXISTS $thirukural_table;";
	$wpdb->query( $sql );
	$sql = "DROP TABLE IF EXISTS $explanation_table;";
	$wpdb->query( $sql );
}

function thirukural_install() {
	global $wpdb;
	$thirukural_table = $wpdb->prefix . "thirukural";
	$explanation_table = $wpdb->prefix . "thirukural_explanation";

	//Drop tables of previous versions
	thirukural_uninstall();

	//Creating the tables ... fresh!
	$sql = "CREATE TABLE " . $thirukural_table . " (
		id INTEGER NOT NULL,
		section_name VARCHAR(50),
		chapter_name VARCHAR(50),
		kural TEXT,
		PRIMARY KEY(id)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$results = $wpdb->query( $sql );

	// Im lazy. I did not make this a child table...
	$sql = "CREATE TABLE " . $explanation_table . " (
		kural_id INTEGER NOT NULL,
		kalaignar_version TEXT,
		varatharasanar_version TEXT,
		solomonpapaiya_version TEXT
		)ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$results = $wpdb->query( $sql );

	$thirukural_file_name = "data/thirukural.txt";
	$thirukural_file_path = "'" . plugin_dir_path( __FILE__ ) . $thirukural_file_name . "'";
	$thirukural_insert_query = "LOAD DATA LOCAL INFILE $thirukural_file_path INTO TABLE $thirukural_table CHARACTER SET UTF8 COLUMNS TERMINATED BY '\t' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n'";
	$result = $wpdb->query( $thirukural_insert_query );

	$explanation_file_name = "data/thirukural_explanation.txt";
	$explanation_file_path = "'" . plugin_dir_path( __FILE__ ) . $explanation_file_name  . "'";
	$explanation_query = "LOAD DATA LOCAL INFILE $explanation_file_path INTO TABLE $explanation_table CHARACTER SET UTF8 COLUMNS TERMINATED BY '\t' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n'";
	$result = $wpdb->query( $explanation_query );
}

function wp_enqueue_thirukural_css() {
	if ( !is_admin() ) {
		wp_enqueue_style( 'thirukural', plugins_url( 'styles/thirukural.css', __FILE__ ), false, null );
	}
 }

add_action( 'wp_enqueue_scripts', 'wp_enqueue_thirukural_css' );

register_activation_hook( __FILE__, 'thirukural_install' );
register_deactivation_hook( __FILE__, 'thirukural_uninstall' );
