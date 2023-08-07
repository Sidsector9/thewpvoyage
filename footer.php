<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Propellers
 */

?>
	<div class="buntywp">
		<div class="buntywp__wrapper">
			<?php
				printf(
					__( "Hey visitors! If you're a beginner in WordPress and WP-CLI development, then you should check out my dear friend Bhargav's Youtube channel! <a href='%s'>@BuntyWP</a>" ),
					esc_url( 'https://www.youtube.com/@BuntyWP/videos' )
				);
			?>
		</div>
	</div>
	<footer id="colophon" class="site-footer">
		<?php printf( __( 'Powered by <a href="https://wordpress.org/">%s</a>' ), 'WordPress' ); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SWLBFQ9VCC"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-SWLBFQ9VCC');
</script>

</body>
</html>
