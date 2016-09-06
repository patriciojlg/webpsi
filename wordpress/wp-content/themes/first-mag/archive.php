<?php get_header(); ?>

<?php get_template_part( 'template-part', 'head' ); ?>

<?php get_template_part( 'template-part', 'topnav' ); ?>

<!-- start content container -->
<div class="row rsrc-content">

	<?php //left sidebar ?>
	<?php get_sidebar( 'left' ); ?>

    <div class="col-md-<?php first_mag_main_content_width(); ?> rsrc-main">
		<?php if ( have_posts() ) : ?>
			<?php if ( function_exists( 'first_mag_breadcrumb' ) && get_theme_mod( 'breadcrumbs-check', 1 ) != 0 ) {
				first_mag_breadcrumb();
			} ?>
			<div class="archive-content">
				<h1 class="page-title text-center">
					<?php
					if ( is_category() ) :
						single_cat_title();
					elseif ( is_tag() ) :
						single_tag_title();
					elseif ( is_author() ) :
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 */
						the_post();
						printf( __( 'Author: %s', 'first-mag' ), '<span class="vcard">' . get_the_author() . '</span>' );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'first-mag' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'first-mag' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'first-mag' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
						_e( 'Asides', 'first-mag' );

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						_e( 'Images', 'first-mag' );

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						_e( 'Videos', 'first-mag' );

					elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
						_e( 'Quotes', 'first-mag' );

					elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
						_e( 'Links', 'first-mag' );

					else :
						_e( 'Archives', 'first-mag' );

					endif;
					?>
				</h1>

				<?php while ( have_posts() ) : the_post(); ?>


					<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
				<div class="footer-pagination"><?php first_mag_pagination(); ?></div>
			<?php else: ?>

				<?php get_404_template(); ?>

			<?php endif; ?>

		</div>
	</div>
<?php //get the right sidebar  ?>
<?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->


<?php get_footer(); ?>

