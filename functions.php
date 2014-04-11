<?php 
/* remove useless line from 404-page */
function pinboard_404() { ?>
	<article class="post hentry column onecol" id="post-0">
		<h2 class="entry-title"><?php _e( 'Content not found', 'pinboard' ) ?></h2>
		<div class="entry-content">
			<?php _e( 'The content you are looking for could not be found.', 'pinboard' ); ?></p>
			<!--<?php if( is_active_sidebar( 7 ) ) : ?>
				<?php _e( 'Use the information below or try to seach to find what you\'re looking for:', 'pinboard' ); ?></p>
			<?php endif; ?> -->
			<?php dynamic_sidebar( 7 ); ?>
		</div><!-- .entry-content -->
	</article><!-- .post -->
	<div class="clear"></div>
<?php
}

/* add read-more link to entries */
function excerpt_read_more_link($output) {
 global $post;
 return $output . ' <a href="'. get_permalink($post->ID) . '">Mehr…</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

/* show favicon \o/ */
function show_favicon(){
	?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" /><?
}
add_action('wp_head', 'show_favicon');
?>