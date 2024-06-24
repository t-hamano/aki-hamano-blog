<?php
// Enqueue front end styles and scripts.
function aki_hamano_blog_wp_enqueue_scripts() {
	wp_enqueue_style(
		'aki-hamano-blog-prism',
		get_stylesheet_directory_uri() . '/assets/lib/prism/prism.css',
		array(),
	);

	wp_enqueue_style(
		'aki-hamano-blog',
		get_stylesheet_uri(),
		array(),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);

	wp_enqueue_script(
		'aki-hamano-blog',
		get_stylesheet_directory_uri() . '/assets/lib/prism/prism.js',
		array(),
	);
}
add_action( 'wp_enqueue_scripts', 'aki_hamano_blog_wp_enqueue_scripts' );

function aki_hamano_blog_after_setup_theme() {
	add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'aki_hamano_blog_after_setup_theme' );

// Enforce English date formatting in the Post Date block if the format is `en`.
function aki_hamano_blog_render_block_core_post_date( $block_content, $block ) {
	if ( isset( $block['attrs']['displayType'] ) && 'modified' === $block['attrs']['displayType'] ) {
		return $block_content;
	}

	if ( ! isset( $block['attrs']['format'] ) ) {
		return $block_content;
	}

	if ( 'en' !== $block['attrs']['format'] ) {
		return $block_content;
	}

	$formatted_date = get_post_time( 'F j, Y' );
	return preg_replace( '/(<time[^>]*>)(.*?)(<\/time>)/i', '$1' . $formatted_date . '$3', $block_content );
}
add_filter( 'render_block_core/post-date', 'aki_hamano_blog_render_block_core_post_date', 10, 2 );

// Wrap the code block in a figure element and inject the anchor as the figcaption.
function aki_hamano_blog_render_block_core_code( $block_content, $block ) {
	$processor = new WP_HTML_Tag_Processor( $block_content );
	if ( $processor->next_tag( 'pre' ) ) {
		$id = $processor->get_attribute( 'id' );
		if ( $id ) {
			$processor->set_attribute( 'data-label', $id );
			$block_content = $processor->get_updated_html();
		}
	}

	return $block_content;
}
add_filter( 'render_block_core/code', 'aki_hamano_blog_render_block_core_code', 10, 2 );

// Don't display flags in Bogo plugin.
add_filter( 'bogo_use_flags', '__return_false' );

// Change the language switcher links in Bogo plugin.
function aki_hamano_blog_bogo_language_switcher_links( $links ) {
	foreach ( $links as &$link ) {
		if ( 'ja' === $link['locale'] ) {
			$link['native_name'] = 'JP';
		}
		if ( 'en_US' === $link['locale'] ) {
			$link['native_name'] = ' EN';
		}
	}
	return $links;
}
add_filter( 'bogo_language_switcher_links', 'aki_hamano_blog_bogo_language_switcher_links' );

// Support custom post type with bogo.
function aki_hamano_blog_bogo_localizable_post_types( $localizable ) {
	$localizable[] = 'event';
	return $localizable;
}
add_filter( 'bogo_localizable_post_types', 'aki_hamano_blog_bogo_localizable_post_types', 10 );

// Change URLs of navigation links to English version.
function aki_hamano_blog_block_core_navigation_render_inner_blocks( $rendered_blocks ) {
	foreach ( $rendered_blocks as $key => $block ) {
		if ( ! isset( $rendered_blocks[ $key ]->parsed_block['attrs']['url'] ) ) {
			continue;
		}
		if ( get_locale() !== 'en_US' ) {
			continue;
		}
		$rendered_blocks[ $key ]->parsed_block['attrs']['url'] = preg_replace( '/(https?:\/\/[^\/]+)(\/.*)/', '$1/en$2', $rendered_blocks[ $key ]->parsed_block['attrs']['url'] );
	}
	return $rendered_blocks;
}
add_filter( 'block_core_navigation_render_inner_blocks', 'aki_hamano_blog_block_core_navigation_render_inner_blocks' );
