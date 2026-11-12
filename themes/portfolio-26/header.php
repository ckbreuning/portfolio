<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (is_singular("project") && has_excerpt()) { ?>
       <meta name="description" content="<?php echo esc_attr(get_the_excerpt()); ?>">
    <?php } else { ?>
       <meta name="description" content="Christian Breuning, multimedia designer in Aalborg. Frontend development, UX/UI and graphic design.">
    <?php } ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a href="#main" class="skip-link">Skip to content</a>

<header class="top">
    <div class="wrap top-row">
        <a href="<?php echo site_url("/"); ?>" class="logo">
            <span class="visually-hidden">Christian Breuning, home</span>
            <?php get_template_part("template-parts/logo"); ?>
        </a>

        <nav class="nav">
            <a href="<?php echo get_post_type_archive_link('project'); ?>" <?php if (is_post_type_archive('project') or is_singular('project')) echo "class='current-menu-item'"; ?>>Work</a>
            <a href="<?php echo site_url('/about'); ?>" <?php if (is_page("about")) echo "class='current-menu-item'"; ?>>About</a>
            <a href="<?php echo site_url('/contact'); ?>" <?php if (is_page("contact")) echo "class='current-menu-item'"; ?>>Contact</a>
        </nav>
    </div>
</header>