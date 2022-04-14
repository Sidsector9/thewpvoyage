<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Propellers
 */

get_header();

$per_page = 100;
$page     = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$query_args = array(
	'post_type'      => 'post',
	'posts_per_page' => $per_page,
);

$list_transient = get_transient( 'thewpvoyage_list_items' );

if ( false === $list_transient ) {
	$query = new \WP_Query( $query_args );
	set_transient( 'thewpvoyage_list_items', $query );
} else {
	$query = $list_transient;
}

$total = wp_count_posts()->publish;

$counter = $total - ( $per_page * ( $page - 1 ) );
?>

	<main id="primary" class="site-main">

		<?php

		if ( $query->have_posts() ) :

			/* Start the Loop */
			while ( $query->have_posts() ) :
				$query->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'list', array( 'counter' => $counter ) );

				$counter--;

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
