<?php $mh_newsdesk_options = mh_newsdesk_theme_options(); ?>
</div>
<footer class="mh-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php dynamic_sidebar('footer-ad'); ?>
	<div class="wrapper-inner clearfix">
		<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) { ?>
			<div class="mh-section mh-group footer-widgets">
				<?php if (is_active_sidebar('footer-1')) { ?>
					<div class="mh-col mh-1-3 footer-1">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('footer-2')) { ?>
					<div class="mh-col mh-1-3 footer-2">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('footer-3')) { ?>
					<div class="mh-col mh-1-3 footer-3">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="footer-bottom py-4 bg-[#327A7A]">
		<div class="wrapper-inner text-base clearfix max-w-5xl">
			<?php if (has_nav_menu('footer_nav')) { ?>
				<nav class="footer-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'footer_nav', 'fallback_cb' => '')); ?>
				</nav>
			<?php } ?>
			<div class="copyright-wrap">
				<p class="copyright">
                    <?php mh_newsdesk_copyright_notice(); ?>
				</p>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>