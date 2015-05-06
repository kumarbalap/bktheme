<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

		?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="bktMain">

		<header id="masthead" class="site-header" role="banner">
				<div class="row">
						<div class="site-branding columns large-8 medium-8 small-5">
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-wb.png" /></a></h1>
								<h2 style="display:none;" class="site-description"><?php bloginfo( 'description' ); ?></h2>
						</div>
						<div class="columns large-4 medium-4 small-7">
								<div class="socialCont">
										<a href="#" class="bktSocial bktGithub"></a>
										<a href="#" class="bktSocial bktLinkedin"></a>
										<a href="#" class="bktSocial bktFacebook"></a>
								</div>
						</div>
				</div>
		</header>

		<div id="content" class="site-content">
