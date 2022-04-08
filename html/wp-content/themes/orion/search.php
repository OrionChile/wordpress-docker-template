<!DOCTYPE html>
<html lang="<?php language_attributes();?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>">
    <title><?php echo get_bloginfo( 'name' ); ?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/img/favicon.png' ?>" />
    <?php wp_head();?>
</head>
<body>
<?php get_header(); ?>


<section id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->

                <?php shape_content_nav( 'nav-above' ); ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'search' ); ?>

                <?php endwhile; ?>

                <?php shape_content_nav( 'nav-below' ); ?>

            <?php else : ?>

                <?php get_template_part( 'no-results', 'search' ); ?>

            <?php endif; ?>

            </div><!-- #content .site-content -->
        </section><!-- #primary .content-area -->

<?php get_footer(); ?>
<?php wp_footer() ?>
</body>
</html>