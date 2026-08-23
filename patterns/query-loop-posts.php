<?php
/**
 * Title: List of posts
 * Slug: aki-hamano-blog/query-loop-posts
 * Categories: query
 * Block Types: core/query
 *
 * @package Aki_Hamano_Blog
 */

?>
<!-- wp:query {"queryId":1,"query":{"perPage":10,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"enhancedPagination":true,"layout":{"type":"default"}} -->
<div class="wp-block-query">
	<!-- wp:group {"align":"full","layout":{"type":"default"}} -->
	<div class="wp-block-group alignfull">
		<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p>No posts were found.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
		<!-- wp:post-template {"layout":{"type":"default"}} -->
			<!-- wp:post-title {"isLink":true,"style":{"layout":{"selfStretch":"fill","flexSize":null},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} /-->
			<!-- wp:post-date {"format":"en","style":{"layout":{"selfStretch":"fixed","flexSize":"15em"}}} /-->
		<!-- /wp:post-template -->
		<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|80"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--80)">
			<!-- wp:query-pagination {"paginationArrow":"chevron","layout":{"type":"flex"}} -->
				<!-- wp:query-pagination-previous /-->
				<!-- wp:query-pagination-numbers /-->
				<!-- wp:query-pagination-next /-->
			<!-- /wp:query-pagination -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:query -->
