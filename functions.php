<?php
// CSSのエンキュー
function aki_hamano_blog_wp_enqueue_scripts() {
	wp_enqueue_style(
		'aki-hamano-blog-style',
		get_stylesheet_uri(),
		array(),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'aki_hamano_blog_wp_enqueue_scripts' );

//Bogo表示カスタマイズ
add_filter( 'bogo_use_flags', '__return_false' );

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

// ナビゲーションリンクのURLを英語版に変更
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
