<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Propellers
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			?>

			<div class="end-of-article">
				<?php echo get_icon_svg( 'vintage-separator' ); ?>
			</div>

			<div class="subscription-form">
				<div class="subscription-form__left">
					<div class="subs-title"><?php esc_html_e( 'Subscribe to the Newsletter' ); ?></div>
					<div class="subs-sub-title"><?php esc_html_e( 'Subscribe to get my latest content by email.' ); ?></div>
					<?php echo get_icon_svg( 'envelope' ); ?>
				</div>
				<div class="subscription-form__right">
					<div class="subscription-form-wrapper">
						<form id="subscription-form-el" method="POST">
							<input required type="text" name="fname" placeholder="<?php esc_html_e( 'Your first name' ); ?>" />
							<input required type="email" name="email" placeholder="<?php esc_html_e( 'Your email address' ); ?>" />
							<button id="subcribe-button" type="submit"><?php esc_html_e( 'Subscribe!' ); ?></button>
						</form>
					</div>
					<div class="checker-tick">
						<?php echo get_icon_svg( 'checker-tick' ); ?>
						<div class="checker-tick--response-message"></div>
					</div>
				</div>
			</div>

			<?php

			the_post_navigation(
				array(
					'prev_text' => '<div class="nav-control nav-prev-text"><span class="nav-type">' . esc_html__( 'Previous', 'thewpvoyage' ) . '</span><span class="nav-title">%title</span></div>',
					'next_text' => '<div class="nav-control nav-next-text"><span class="nav-type">' . esc_html__( 'Next', 'thewpvoyage' ) . '</span><span class="nav-title">%title</span></div>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				// comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<script>
		const ajaxUrl = '<?php echo admin_url( 'admin-ajax' ); ?>';
		const formWrapper = document.querySelector( '.subscription-form-wrapper' );
		const checkerTick = document.querySelector( '.checker-tick' );
		const checkerTickSvg = document.querySelector( '.checker-tick svg' );
		const subscriptionFormEl = document.getElementById( 'subscription-form-el' );
		const responseTextEl = document.querySelector( '.checker-tick--response-message' );

		subscriptionFormEl.addEventListener( 'submit', function( e ) {
			e.preventDefault();

			formWrapper.classList.toggle( 'subscription-form-wrapper--hide' );
			checkerTick.querySelector( '#check' ).classList.add( 'progress' );

			async function submitForm() {
				const formData = new FormData();
				const firstName = subscriptionFormEl.querySelector( 'input[name="fname"]' ).value;
				const email = subscriptionFormEl.querySelector( 'input[name="email"]' ).value;
				formData.append( 'name', firstName );
				formData.append( 'email', email );
				formData.append( 'action', 'twv_register_new_subscriber' );
				// checkerTick.querySelector( '#check' ).classList.toggle( 'progress' );

				const response = await fetch( ajaxUrl, {
					method: 'POST',
					body: formData,
				} );

				return response.json();
			}

			checkerTick.classList.toggle( 'checker-tick--show' );

			setTimeout( async function() {
				const response = await submitForm();
	
				if ( response.success ) {
					checkerTick.querySelector( '#check' ).classList.toggle( 'progress' );
					checkerTick.querySelector( '#check' ).classList.toggle( 'ready' );
				} else {
					checkerTick.classList.toggle( 'checker-tick--show' );
					responseTextEl.classList.toggle( 'checker-tick--response-message--move' );
				}
				
				responseTextEl.classList.toggle( 'checker-tick--response-message--show' );
				responseTextEl.textContent = response.data.message;
			}, 200 );
		} );
	</script>

<?php
get_sidebar();
get_footer();
