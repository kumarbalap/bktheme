<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="bktMain">

		<header id="masthead" class="site-header" role="banner">
				<div class="row">
						<div class="site-branding columns large-8">
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<h2 style="display:none;" class="site-description"><?php bloginfo( 'description' ); ?></h2>
						</div>
						<div class="columns large-4" style="text-align: right;">
								<a href="#" class="bktSocial bktGithub"></a>
								<a href="#" class="bktSocial bktLinkedin"></a>
								<a href="#" class="bktSocial bktFacebook"></a>
						</div>
				</div>
		</header>

		<div id="content" class="site-content">
