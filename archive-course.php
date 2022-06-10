<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="mx-auto container py-12">
		
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="text-center font-bold text-3xl">All Courses</h1>
			</header><!-- .page-header -->
			<div class="archive-wrap">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</div>
</div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
