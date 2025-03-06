<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Math_Note
 */

?>
		</div><!-- #content -->
	</div>
	<footer id="colophon" class="footer navbar-default">
	  <div class="container">
	    <ul class="nav navbar-nav navbar-left">		
			<li>
				<!--copyright-->
				<a href="<?php echo esc_url(home_url( '/' )); ?>">
					<?php
					printf(
						esc_html__( '© %1$s %2$s', 'math-note' ),
						date( 'Y' ),
						get_bloginfo( 'name' )
					);
					?>
				</a>
			</li>
			<li class="hidden">
				<a href="#">
					<?php
					$math_note_description = get_bloginfo( 'description', 'display' );
					if ( $math_note_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $math_note_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</a>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="<?php echo esc_url( __( 'https://functor.network', 'math-note' ) ); ?>">
					<?php
					printf( esc_html__( 'Theme designed by %s', 'math-note' ), 'Functor Network' );
					?>
				</a>
			</li>
		</ul>
	  </div>		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
