	<?php frmwrk_footer_before(); ?>
	<footer id="footer" role="contentinfo">

		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'container' => '', 'theme_location' => 'footer', 'menu_class' => 'menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php frmwrk_footer_before_copyright(); ?>
		<p class="copy"><small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></small></p>
		<?php frmwrk_footer_inside(); ?>
	</footer><!-- /#footer -->
	<?php frmwrk_footer_after(); ?>
</div><!-- /#wrap -->

<?php wp_footer(); ?>
<?php frmwrk_footer(); ?>

</body>
</html>