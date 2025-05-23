<?php $mh_newsdesk_options = mh_newsdesk_theme_options(); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php if (is_page_template('atos-data-collect-template.php') || is_page_template('atos-vote-template.php') || is_page_template('template-custom-home.php') || is_page_template('template-home-v2.php')) : ?>
	<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<?php endif; ?>

<?php if (is_singular() && pings_open(get_queried_object())) : ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php endif; ?>
<?php wp_head(); ?>
</head>
  <?php if (is_page_template('template-custom-home.php')) : ?>
  <?php $harcode_color="background-color:white"; ?>
  <?php else:?>
  <?php $harcode_color=""; ?>
  <?php endif;?>
  
<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage" style="<?php echo $harcode_color; ?>">
<?php if (has_nav_menu('header_nav') || has_nav_menu('social_nav')) { ?>
	<div class="header-top">
		<div class="wrapper-inner clearfix">
			<?php if (has_nav_menu('header_nav')) { ?>
				<nav class="header-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'header_nav', 'fallback_cb' => '')); ?>
				</nav>
			<?php } ?>
			<?php if (has_nav_menu('social_nav')) { ?>
				<nav class="social-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-mh-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
				</nav>
			<?php } ?>
		</div>
	</div>
<?php } ?>
  
<?php if (is_page_template('template-custom-home.php')) : ?>
<div id="full-wrapper">
<?php $custom_width = "max-w-5xl mx-auto"; ?>
<?php else: ?>
<div id="mh-wrapper">
<?php $custom_width = ""; ?>
<?php endif; ?>
  
<header class="mh-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
  <?php if (is_page_template('template-custom-home.php')) : ?>
  <div class="bg-[#45474b]">
  <?php endif; ?>
  
	<div class="header-menu <?php echo $custom_width; ?> clearfix">
		<nav class="main-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</nav>
		<!--<div class="header-sub clearfix">
			<?php if ($mh_newsdesk_options['show_ticker']) { ?>
				<?php get_template_part('content', 'news-ticker'); ?>
			<?php } ?>
			<aside class="mh-col mh-1-3 header-search">
				<?php //get_search_form(); ?>
			</aside>
		</div> -->
	</div>
  <?php if (is_page_template('template-custom-home.php')) : ?>
  </div>
  <?php endif; ?>
  
	
	<div class="header-wrap custom-head-style <?php echo $custom_width; ?> clearfix">
		<?php //is_active_sidebar('header-ad') ? $logo_class = ' header-logo' : $logo_class = ' header-logo-full'; ?>
		<div class="mh-col">
			<?php mh_newsdesk_logo(); ?>
		</div>
		<?php //dynamic_sidebar('header-ad'); ?>
		<?php //$subtitle = "Union Pour la Réparation des Actionnaires [Atos]"; ?>
		<?php $subtitle = "Union Pour la Réparation des Actionnaires"; ?>
		<div class="mh-col">
        	<p class="sub-title pl-5 md:pl-0"><?php _e($subtitle, 'mh-newsdesk'); ?></p>
		</div>
	</div>
	<?php
		//$disclaimer_message = "Ce blog n&#39;a aucun lien juridique avec la société Atos SE.";
		//if (is_front_page()) {
		//	echo sprintf('<div class="atos-disclaimer"><p>%s</p></div>', $disclaimer_message);
		//}
	?>
</header>