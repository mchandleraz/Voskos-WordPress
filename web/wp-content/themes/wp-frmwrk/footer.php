	<?php frmwrk_footer_before(); ?>
	<footer id="footer" role="contentinfo">
		<?php frmwrk_footer_before_copyright(); ?>
		<p class="copy"><small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></small></p>
		<?php frmwrk_footer_inside(); ?>
	</footer><!-- /#footer -->
	<?php frmwrk_footer_after(); ?>
</div><!-- /#wrap -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo FRMWRK_ASSETS ?>js/jquery-1.9.1.min.js"><\/script>')</script>

<?php wp_footer(); ?>
<?php frmwrk_footer(); ?>

</body>
</html>