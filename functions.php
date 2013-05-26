<?php 

function pinboard_call_scripts() { ?>
<script>
/* <![CDATA[ */
	jQuery(document).ready(function($) {
		$('#access .menu > li > a').each(function() {
			var title = $(this).attr('title');
			if(typeof title !== 'undefined' && title !== false) {
				$(this).append('<br /> <span>'+title+'</span>');
				$(this).removeAttr('title');
			}
		});
		function pinboard_move_elements(container) {
			if( container.hasClass('onecol') ) {
				var thumb = $('.entry-thumbnail', container);
				if('undefined' !== typeof thumb)
					$('.entry-container', container).before(thumb);
				var video = $('.entry-attachment', container);
				if('undefined' !== typeof video)
					$('.entry-container', container).before(video);
				var gallery = $('.post-gallery', container);
				if('undefined' !== typeof gallery)
					$('.entry-container', container).before(gallery);
				var meta = $('.entry-meta', container);
				if('undefined' !== typeof meta)
					$('.entry-container', container).after(meta);
			}
		}
		function pinboard_restore_elements(container) {
			if( container.hasClass('onecol') ) {
				var thumb = $('.entry-thumbnail', container);
				if('undefined' !== typeof thumb)
					$('.entry-header', container).after(thumb);
				var video = $('.entry-attachment', container);
				if('undefined' !== typeof video)
					$('.entry-header', container).after(video);
				var gallery = $('.post-gallery', container);
				if('undefined' !== typeof gallery)
					$('.entry-header', container).after(gallery);
				var meta = $('.entry-meta', container);
				if('undefined' !== typeof meta)
					$('.entry-header', container).append(meta);
				else
					$('.entry-header', container).html(meta.html());
			}
		}
		if( ($(window).width() > 960) || ($(document).width() > 960) ) {
			// Viewport is greater than tablet: portrait
		} else {
			$('#content .post').each(function() {
				pinboard_move_elements($(this));
			});
		}
		$(window).resize(function() {
			if( ($(window).width() > 960) || ($(document).width() > 960) ) {
				<?php if( is_category( pinboard_get_option( 'portfolio_cat' ) ) || ( is_category() && cat_is_ancestor_of( pinboard_get_option( 'portfolio_cat' ), get_queried_object() ) ) ) : ?>
					$('#content .post').each(function() {
						pinboard_restore_elements($(this));
					});
				<?php else : ?>
					$('.page-template-template-full-width-php #content .post, .page-template-template-blog-full-width-php #content .post, .page-template-template-blog-four-col-php #content .post').each(function() {
						pinboard_restore_elements($(this));
					});
				<?php endif; ?>
			} else {
				$('#content .post').each(function() {
					pinboard_move_elements($(this));
				});
			}
			if( ($(window).width() > 760) || ($(document).width() > 760) ) {
				var maxh = 0;
				$('#access .menu > li > a').each(function() {
					if(parseInt($(this).css('height'))>maxh) {
						maxh = parseInt($(this).css('height'));
					}
				});
				$('#access .menu > li > a').css('height', maxh);
			} else {
				$('#access .menu > li > a').css('height', 'auto');
			}
		});
		if( ($(window).width() > 760) || ($(document).width() > 760) ) {
			var maxh = 0;
			$('#access .menu > li > a').each(function() {
				var title = $(this).attr('title');
				if(typeof title !== 'undefined' && title !== false) {
					$(this).append('<br /> <span>'+title+'</span>');
					$(this).removeAttr('title');
				}
				if(parseInt($(this).css('height'))>maxh) {
					maxh = parseInt($(this).css('height'));
				}
			});
			$('#access .menu > li > a').css('height', maxh);
			<?php if( pinboard_get_option( 'fancy_dropdowns' ) ) : ?>
				$('#access li').mouseenter(function() {
					$(this).children('ul').css('display', 'none').stop(true, true).fadeIn(250).css('display', 'block').children('ul').css('display', 'none');
				});
				$('#access li').mouseleave(function() {
					$(this).children('ul').stop(true, true).fadeOut(250).css('display', 'block');
				});
			<?php endif; ?>
		} else {
			$('#access li').each(function() {
				if($(this).children('ul').length)
					$(this).append('<span class="drop-down-toggle"><span class="drop-down-arrow"></span></span>');
			});
			$('.drop-down-toggle').click(function() {
				$(this).parent().children('ul').slideToggle(250);
			});
		}
		<?php if( ( is_home() && ! is_paged() ) || ( is_front_page() && ! is_home() ) || is_page_template( 'template-landing-page.php' ) ) : ?>
			$('#slider').flexslider({
				selector: '.slides > li',
				video: true,
                                slideshowSpeed: 10000,
				prevText: '&larr;',
				nextText: '&rarr;',
				pausePlay: true,
				pauseText: '||',
				playText: '>',
				before: function() {
					$('#slider .entry-title').hide();
				},
				after: function() {
					$('#slider .entry-title').fadeIn();
				}
			});
		<?php endif; ?>
		<?php if( ! is_singular() || is_page_template( 'template-blog.php' ) || is_page_template( 'template-blog-full-width.php' ) || is_page_template( 'template-blog-four-col.php' ) || is_page_template( 'template-blog-left-sidebar.php' ) || is_page_template( 'template-blog-no-sidebars.php' ) || is_page_template( 'template-blog-no-sidebars.php' ) || is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-right-sidebar.php' ) || is_page_template( 'template-portfolio-four-col.php' ) || is_page_template( 'template-portfolio-left-sidebar.php' ) || is_page_template( 'template-portfolio-no-sidebars.php' ) ) : ?>
			var $content = $('.entries');
			$content.imagesLoaded(function() {
				$content.masonry({
					itemSelector : '.post',
					columnWidth : function( containerWidth ) {
						return containerWidth / 12;
					},
				});
			});
			<?php if( ( ! is_singular() && ! is_paged() ) || ( ( is_page_template( 'template-blog.php' ) || is_page_template( 'template-blog-full-width.php' ) || is_page_template( 'template-blog-four-col.php' ) || is_page_template( 'template-blog-left-sidebar.php' ) || is_page_template( 'template-blog-no-sidebars.php' ) || is_page_template( 'template-blog-no-sidebars.php' ) || is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-portfolio-right-sidebar.php' ) || is_page_template( 'template-portfolio-four-col.php' ) || is_page_template( 'template-portfolio-left-sidebar.php' ) || is_page_template( 'template-portfolio-no-sidebars.php' ) ) && ! is_paged() ) ) : ?>
				<?php if( 'ajax' == pinboard_get_option( 'posts_nav' ) ) : ?>
					var nav_link = $('#posts-nav .nav-all a');
					if(!nav_link.length)
						var nav_link = $('#posts-nav .nav-next a');
					if(nav_link.length) {
						nav_link.addClass('ajax-load');
						nav_link.html('Load more posts');
						nav_link.click(function() {
							var href = $(this).attr('href');
							nav_link.html('<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" style="float: none; vertical-align: middle;" /> Loading more posts &#8230;');
							$.get(href, function(data) {
								var helper = document.createElement('div');
								helper = $(helper);
								helper.html(data);
								var content = $('#content .entries', helper);
								$('.entries').append(content.html());
								var nav_url = $('#posts-nav .nav-next a', helper).attr('href');
								if(typeof nav_url !== 'undefined') {
									nav_link.attr('href', nav_url);
									nav_link.html('Load more posts');
								} else {
									$('#posts-nav').html('<span class="ajax-load">There are no more posts to display.</span>');
								}
							});
							return false;
						});
					}
				<?php elseif( 'infinite' == pinboard_get_option( 'posts_nav' ) ) : ?>
					$('#content .entries').infinitescroll({
						debug           : false,
						nextSelector    : "#posts-nav .nav-all a, #posts-nav .nav-next a",
						loadingImg      : ( window.devicePixelRatio > 1 ? "<?php echo get_template_directory_uri(); ?>/images/ajax-loading_2x.gif" : "<?php echo get_template_directory_uri(); ?>/images/ajax-loading.gif" ),
						loadingText     : "Loading more posts &#8230;",
						donetext        : "There are no more posts to display.",
						navSelector     : "#posts-nav",
						contentSelector : "#content .entries",
						itemSelector    : "#content .entries .post",
					}, function(entries){
						var $entries = $( entries ).css({ opacity: 0 });
						$entries.imagesLoaded(function(){
							$entries.animate({ opacity: 1 });
							$content.masonry( 'appended', $entries, true );
						});
						if( ($(window).width() > 960) || ($(document).width() > 960) ) {
							// Viewport is greater than tablet: portrait
						} else {
							$('#content .post').each(function() {
								pinboard_move_elements($(this));
							});
						}
						$('audio,video').mediaelementplayer({
							videoWidth: '100%',
							videoHeight: '100%',
							audioWidth: '100%',
							alwaysShowControls: true,
							features: ['playpause','progress','tracks','volume'],
							videoVolume: 'horizontal'
						});
						$(".entry-attachment, .entry-content").fitVids({ customSelector: "iframe, object, embed"});
						<?php if( pinboard_get_option( 'lightbox' ) ) : ?>
							$('.entry-content a[href$=".jpg"],.entry-content a[href$=".jpeg"],.entry-content a[href$=".png"],.entry-content a[href$=".gif"],a.colorbox').colorbox();
						<?php endif; ?>
					});
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		$('audio,video').mediaelementplayer({
			videoWidth: '100%',
			videoHeight: '100%',
			audioWidth: '100%',
			alwaysShowControls: true,
			features: ['playpause','progress','tracks','volume'],
			videoVolume: 'horizontal'
		});
		$(".entry-attachment, .entry-content").fitVids({ customSelector: "iframe, object, embed"});
	});
	jQuery(window).load(function() {
		<?php if( pinboard_get_option( 'lightbox' ) ) : ?>
			jQuery('.entry-content a[href$=".jpg"],.entry-content a[href$=".jpeg"],.entry-content a[href$=".png"],.entry-content a[href$=".gif"],a.colorbox').colorbox();
		<?php endif; ?>
	});
/* ]]> */
</script>
<?php
}


function pinboard_current_location() {
	global $pinboard_page_template;
	if ( ! ( is_home() && ! is_paged() ) && ! is_singular() || isset( $pinboard_page_template ) ) {
		if( is_author() )
			$archive = 'author';
		elseif( is_category() || is_tag() ) {
			$archive = get_queried_object()->taxonomy;
			$archive = str_replace( 'post_', '', $archive );
		} else
			$archive = ''; ?>
		<hgroup id="current-location">
			<!-- <h6 class="prefix-text"><?php _e( 'Currently browsing', 'pinboard' ); ?> <?php echo $archive; ?></h6> -->
			<<?php pinboard_title_tag( 'location' ); ?> class="page-title">
				<?php if( isset( $pinboard_page_template ) ) {
					echo the_title();
				} elseif( is_search() ) {
					__( 'Search results for', 'pinboard' ) . ': &quot;' .  get_search_query() . '&quot;';
				} elseif( is_author() ) {
					$author = get_userdata( get_query_var( 'author' ) );
					echo $author->display_name;
				} elseif ( is_year() ) {
					echo get_query_var( 'year' );
				} elseif ( is_month() ) {
					echo get_the_time( 'F Y' );
				} elseif ( is_day() ) {
					echo get_the_time( 'F j, Y' );
				} else {
					single_term_title( '' );
				}
				if( is_paged() ) {
					global $page, $paged;
					if( ! is_home() )
						echo ', ';
					echo sprintf( __( 'Page %d', 'pinboard' ), get_query_var( 'paged' ) );
				}
				?>
			</<?php pinboard_title_tag( 'location' ); ?>>
			<?php if( is_category() || is_tag() || is_tax() ) : ?>
				<div class="category-description">
					<?php echo term_description(); ?>
				</div>
			<?php endif; ?>
		</hgroup>
		<?php
	}
}

function pinboard_404() { ?>
	<article class="post hentry column onecol" id="post-0">
		<h2 class="entry-title"><?php _e( 'Seite nicht gefunden', 'pinboard' ) ?></h2>
		<div class="entry-content">
			<?php _e( 'Die gewünschte Seite konnte nicht gefunden werden.', 'pinboard' ); ?></p>
			<?php if( is_active_sidebar( 7 ) ) : ?>
				<?php # _e( 'Use the information below or try to seach to find what you\'re looking for:', 'pinboard' ); ?></p>
			<?php endif; ?>
			<?php dynamic_sidebar( 7 ); ?>
		</div><!-- .entry-content -->
	</article><!-- .post -->
	<div class="clear"></div>
<?php
}


function excerpt_read_more_link($output) {
 global $post;
 return $output . '<a href="'. get_permalink($post->ID) . '"> Weiterlesen ...</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');
?>