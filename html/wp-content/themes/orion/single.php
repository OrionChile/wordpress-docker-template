<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?> <?php bloginfo('description'); ?> </title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() . '/img/favicon.png' ?>" />
    <?php wp_head();?>
</head>
<body>
<?php get_header(); ?>
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php require('parts/the_content.php'); ?>

<?php endwhile; ?>
<?php get_footer(); ?>
<?php wp_footer() ?>
</body>
</html>

