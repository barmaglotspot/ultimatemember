<?php
namespace um\core;

// Exit if executed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'um\core\AJAX_Common' ) ) {


	/**
	 * Class AJAX_Common
	 * @package um\core
	 */
	class AJAX_Common {


		/**
		 * AJAX_Common constructor.
		 */
		function __construct() {
			// UM_EVENT => nopriv
			$ajax_actions = array(
				'router'   => false
			);

			foreach ( $ajax_actions as $action => $nopriv ) {

				add_action( 'wp_ajax_um_' . $action, array( $this, $action ) );

				if ( $nopriv )
					add_action( 'wp_ajax_nopriv_um_' . $action, array( $this, $action ) );

			}

			add_action( 'wp_ajax_um_remove_file', array( UM()->files(), 'ajax_remove_file' ) );
			add_action( 'wp_ajax_um_delete_profile_photo', array( UM()->profile(), 'ajax_delete_profile_photo' ) );
			add_action( 'wp_ajax_um_delete_cover_photo', array( UM()->profile(), 'ajax_delete_cover_photo' ) );
			add_action( 'wp_ajax_um_select_options', array( UM()->form(), 'ajax_select_options' ) );
			add_action( 'wp_ajax_um_ajax_paginate', array( UM()->query(), 'ajax_paginate' ) );
			add_action( 'wp_ajax_um_muted_action', array( UM()->form(), 'ajax_muted_action' ) );

			add_action( 'wp_ajax_nopriv_um_remove_file', array( UM()->files(), 'ajax_remove_file' ) );
			add_action( 'wp_ajax_um_remove_file', array( UM()->files(), 'ajax_remove_file' ) );			
			
			add_action( 'wp_ajax_nopriv_um_fileupload', array( UM()->files(), 'ajax_file_upload' ) );
			add_action( 'wp_ajax_um_fileupload', array( UM()->files(), 'ajax_file_upload' ) );
			
			add_action( 'wp_ajax_nopriv_um_imageupload', array( UM()->files(), 'ajax_image_upload' ) );
			add_action( 'wp_ajax_um_imageupload', array( UM()->files(), 'ajax_image_upload' ) );
			
			add_action( 'wp_ajax_nopriv_um_resize_image', array( UM()->files(), 'ajax_resize_image' ) );
			add_action( 'wp_ajax_um_resize_image', array( UM()->files(), 'ajax_resize_image' ) );
			

			/**
			 * Fallback for ajax urls
			 * @uses action hooks: wp_head, admin_head
			 */
			//add_action( 'wp_head', array( $this, 'ultimatemember_ajax_urls' ) );
			//add_action( 'admin_head', array( $this, 'ultimatemember_ajax_urls' ) );

		}


		/**
		 * Router method
		 */
		function router() {
			$router = new Router();
			$router->backend_requests();
		}
	}
}