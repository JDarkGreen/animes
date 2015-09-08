<?php
/**
 * Plugin Name: WP Admin Color Schemes
 * Description: Adds even more admin color schemes to WordPress.
 * Author: Kumar Abhisek
 * Author URI: http://increasy.com/
 * Version: 1.0.1
 * Text Domain: wpacs-admin-schemes
 * License: GPL2
 *
 * Copyright 2015 Kumar Abhisek
 */

/**
* Register the color schemes
*/
    function wpacs_add_color_schemes() {
		$rtlsuff = is_rtl() ? '-rtl' : '';

		wp_admin_css_color(
			'blood',
			__( 'Blood', 'wpacs-admin-schemes' ),
			plugins_url( "blood/colors$rtlsuff.css", __FILE__ ),
			array( '#bf0000', '#fc4141', '#222222', '#b03f3f' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'babyblue',
			__( 'Baby Blue', 'wpacs-admin-schemes' ),
			plugins_url( "babyblue/colors$rtlsuff.css", __FILE__ ),
			array( '#6bc4ff', '#0077ff', '#034799', '#08a8cc' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'fresh',
			__( 'Fresh', 'wpacs-admin-schemes' ),
			plugins_url( "fresh/colors$rtlsuff.css", __FILE__ ),
			array( '#71bd00', '#a7e051', '#426e00', '#7f9959' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'pumpkin',
			__( 'Pumpkin', 'wpacs-admin-schemes' ),
			plugins_url( "pumpkin/colors$rtlsuff.css", __FILE__ ),
			array( '#c99300', '#edbc34', '#7a5900', '#ccb064' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'night',
			__( 'Night', 'wpacs-admin-schemes' ),
			plugins_url( "night/colors$rtlsuff.css", __FILE__ ),
			array( '#222222', '#444444', '#666666', '#333333' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'facebook',
			__( 'Facebook', 'wpacs-admin-schemes' ),
			plugins_url( "facebook/colors$rtlsuff.css", __FILE__ ),
			array( '#2a4994', '#3763d4', '#252661', '#132142' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'tiranga',
			__( 'Tiranga', 'wpacs-admin-schemes' ),
			plugins_url( "tiranga/colors$rtlsuff.css", __FILE__ ),
			array( '#ff9933', '#128807', '#000088', '#94510d' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'remix',
			__( 'Remix', 'wpacs-admin-schemes' ),
			plugins_url( "remix/colors$rtlsuff.css", __FILE__ ),
			array( '#aa9d88', '#627c83', '#59524c', '#e14d43' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'modern',
			__( 'Modern', 'wpacs-admin-schemes' ),
			plugins_url( "modern/colors$rtlsuff.css", __FILE__ ),
			array( '#009688', '#ffc107', '#212121', '#00796b' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'elegance',
			__( 'Elegance', 'wpacs-admin-schemes' ),
			plugins_url( "elegance/colors$rtlsuff.css", __FILE__ ),
			array( '#568259', '#4a4238', '#00120b', '#3f6142' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'simplicity',
			__( 'Simplicity', 'wpacs-admin-schemes' ),
			plugins_url( "simplicity/colors$rtlsuff.css", __FILE__ ),
			array( '#9e9e9e', '#cddc39', '#616161', '#98a80c' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);

		wp_admin_css_color(
			'chocolate',
			__( 'Chocolate', 'wpacs-admin-schemes' ),
			plugins_url( "chocolate/colors$rtlsuff.css", __FILE__ ),
			array( '#5d4037', '#795548', '#362620', '#422d26' )
			//array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
		);
	}

add_action( 'admin_init' , 'wpacs_add_color_schemes' );