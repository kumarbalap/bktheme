<?php
/**
 * @package bktheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="row">
				<div class="columns large-12 small-12 medium-12">
						<header class="entry-header">
								<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
								<?php if ( 'post' == get_post_type() ) : ?>
								<div class="postMetaInfo">
											<div class="entry-meta">
													<time class="entry-time updated" itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('M'); ?> <strong><?php the_time('d'); ?></strong></time>
													<span class="commentsCount comments-link">
															<?php comments_popup_link( __( '0', 'bktheme' ), __( '1', 'bktheme' ), __( '%', 'bktheme' ) ); ?>
													</span>
											</div><!-- .entry-meta -->
								</div>
								<?php endif; ?>
						</header><!-- .entry-header -->

						<div class="entry-content clearfix">
								<?php
									/* translators: %s: Name of current post */
									the_content( sprintf(
										__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bktheme' ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									) );
								?>

								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'bktheme' ),
										'after'  => '</div>',
									) );
								?>
						</div><!-- .entry-content -->

						<footer class="entry-footer">
								<?php bktheme_entry_footer(); ?>
						</footer>
				</div>
		</div>
</article><!-- #post-## -->