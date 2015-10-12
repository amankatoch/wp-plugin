<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width"/>
	<title>
		<?php wp_title( ' | ', true, 'right' ); ?>
	</title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="displet-mobile-header" class="<?php displetretsidx_the_default_mobile_styles_class(); ?>">
	<?php if ( displetretsidx_has_mobile_title() ) : ?>
		<div class="displet-title">
			<?php displetretsidx_the_mobile_title(); ?>
		</div>
	<?php endif; ?>
	<?php if ( displetretsidx_has_mobile_header() ) : ?>
		<div class="displet-text">
			<?php displetretsidx_the_mobile_header(); ?>
		</div>
	<?php endif; ?>
	<?php if ( displetretsidx_has_phone() ) : ?>
		<div class="displet-phone">
			<a href="<?php displetretsidx_the_phone_url(); ?>">
				<?php displetretsidx_the_phone(); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="displet-menu displet-group">
		<a href="<?php displetretsidx_the_mobile_home_url(); ?>">
			Home
		</a>
		<a class="<?php displetretsidx_the_mobile_favorites_class(); ?>" href="<?php displetretsidx_the_mobile_favorites_url(); ?>">
			Favorites
		</a>
		<a href="<?php displetretsidx_the_mobile_search_url(); ?>">
			Search
		</a>
		<a href="<?php displetretsidx_the_mobile_contact_url(); ?>">
			Contact
		</a>
	</div>
</div>