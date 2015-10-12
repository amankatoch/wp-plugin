<?php

class DispletRetsIdxToolbarController extends DispletRetsIdxPagesController {
	public static function maybe_add_search_properties( $wp_admin_bar ) {
		if ( ( current_user_can( self::$_capabilities['save_property'] ) || current_user_can( self::$_capabilities['save_search'] ) ) && !current_user_can( 'manage_options' ) ) {
            if ( !empty( self::$_model['search_results_page_url'] ) ) {
                $search_results_page_url = self::$_model['search_results_page_url'];
            }
            else {
                $search_results_page_url = get_permalink( self::$_options['search_results_page_id'] );
            }
    		$wp_admin_bar->add_node( array(
    			'id' => 'displetretsidx_search_properties_toolbar',
    			'title' => 'Search Properties',
    			'href' => $search_results_page_url
    		 ) );
    		$wp_admin_bar->add_node( array(
    			'id' => 'displetretsidx_search_properties_toolbar_SUB',
    			'title' => 'Search Properties',
    			'href' => $search_results_page_url,
    			'parent' => 'site-name'
    		 ) );
		}
	}

	public static function maybe_add_saved_properties( $wp_admin_bar ) {
		if ( current_user_can( self::$_capabilities['save_property'] ) && !current_user_can( 'manage_options' ) ) {
    		$wp_admin_bar->add_node( array(
    			'id' => 'displetretsidx_saved_properties_toolbar',
    			'title' => 'Saved Properties',
    			'href' => admin_url( 'admin.php?page=' . self::$_slugs['saved_properties_page'] )
    		 ) );
    		$wp_admin_bar->add_node( array(
    			'id' => 'displetretsidx_saved_properties_toolbar_sub',
    			'title' => 'Saved Properties',
    			'href' => admin_url( 'admin.php?page=' . self::$_slugs['saved_properties_page'] ),
    			'parent' => 'site-name'
    		 ) );
		}
	}

	public static function maybe_add_saved_searches( $wp_admin_bar ) {
		if ( current_user_can( self::$_capabilities['save_search'] ) && !current_user_can( 'manage_options' ) ) {
    		$wp_admin_bar->add_node( array(
    			'id' => 'displetretsidx_saved_searches_toolbar',
    			'title' => 'Saved Searches',
    			'href' => admin_url( 'admin.php?page=' . self::$_slugs['saved_searches_page'] )
    		 ) );
    		$wp_admin_bar->add_node( array(
    			'id' => 'displetretsidx_saved_searches_toolbar_sub',
    			'title' => 'Saved Searches',
    			'href' => admin_url( 'admin.php?page=' . self::$_slugs['saved_searches_page'] ),
    			'parent' => 'site-name'
    		 ) );
		}
	}

	public static function maybe_clean_up( $wp_admin_bar ) {
		if ( ( current_user_can( self::$_capabilities['save_property'] ) || current_user_can( self::$_capabilities['save_search'] ) ) && !current_user_can( self::$_capabilities['view_leads'] ) ) {
    		$wp_admin_bar->remove_node( 'wp-logo' );
    		$wp_admin_bar->remove_node( 'search' );
		}
	}
}

?>