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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo FRMWRK_ASSETS ?>js/jquery-1.9.1.min.js"><\/script>')</script>

	<!-- jQuery ScrollTo Plugin -->
	<script src="//balupton.github.io/jquery-scrollto/lib/jquery-scrollto.js"></script>

	<!-- History.js -->
	<script src="//browserstate.github.io/history.js/scripts/bundled/html4+html5/jquery.history.js"></script>

	<!-- Ajaxify -->
	<script src="//rawgithub.com/browserstate/ajaxify/master/ajaxify-html5.js"></script>

<?php wp_footer(); ?>
<?php frmwrk_footer(); ?>

</body>
</html>