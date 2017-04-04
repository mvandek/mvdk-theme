<?php

// By default, Akismet tries to delete batches of 10,000 at a time.
// That's way too high. Let's set a more reasonable limit.
function wpcom_vip_akismet_delete_limit( $limit ) {
	return 100;
}
add_filter( 'akismet_delete_comment_limit', 'wpcom_vip_akismet_delete_limit' );

// Limit cache/alloptions invalidations when getting inundated with spam comments.
function wpcom_vip_akismet_spam_count_incr( $val ) {
	// if the blog has a small number of comments, increment the counter by 1 every time
	$current = get_option( 'akismet_spam_count' );
	if ( $current < 150 ) {
		return $val;
	}
	// If it has a large number of comments, increment it by 3 one third of the time
	$random = mt_rand( 1, 3 );
	if ( 3 === $random ) {
		return 3;
	}
	return 0;
}
add_filter( 'akismet_spam_count_incr', 'wpcom_vip_akismet_spam_count_incr' );

// Cleaner permalink options
add_filter( 'got_url_rewrite', '__return_true' );


/**
 * This is a list of performance tweaks that will become default for All VIP sites
 */
function wpcom_vip_enable_performance_tweaks() {
	/**
	 * Improves performance of all the wp-admin pages that load comment counts in the menu.
	 * 
	 * This caches them for 30 minutes. It does not impact the per page comment count, only
	 * the total comment count that shows up in the admin menu.
	 */
	if ( function_exists( 'wpcom_vip_enable_cache_full_comment_counts' ) ) {
		wpcom_vip_enable_cache_full_comment_counts();
	}

	// This disables the adjacent_post links in the header that are almost never beneficial and are very slow to compute.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	if ( function_exists( 'wpcom_vip_enable_old_slug_redirect_caching' ) ) {
		wpcom_vip_enable_old_slug_redirect_caching();
	}

	if ( function_exists( 'wpcom_vip_enable_maybe_skip_old_slug_redirect' ) ) {
		wpcom_vip_enable_maybe_skip_old_slug_redirect();
	}
}
add_action( 'after_setup_theme', 'wpcom_vip_enable_performance_tweaks' );

/**
 * Use this function to disable the loading of performance tweaks
 */
// function wpcom_vip_disable_performance_tweaks() {
//	remove_action( 'after_setup_theme', 'wpcom_vip_enable_performance_tweaks' );
// }

add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
});