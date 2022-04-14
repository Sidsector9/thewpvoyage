<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Propellers
 */

?>

<div class="list-item">
	<div class="list-item-count"><?php printf( "%03d\n", $args['counter'] ); ?></div>
	<div class="list-item-right-wrapper">
		<?php the_title( '<h2 class="list-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<span class="list-item-post-date"><?php echo get_the_date( 'd.M.y' ); ?>
	</div>
</div>




