<?php 
function portfolio_files() {
    wp_enqueue_style("portfolio-google-fonts", "https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Tektur:wght@400..900&display=swap");
    wp_enqueue_style("font-awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css");

    wp_enqueue_style("portfolio-main-styles", get_theme_file_uri("/css/main.css"), NULL, microtime());
    wp_enqueue_script("portfolio-main-js", get_theme_file_uri("/js/main.js"), NULL, microtime(), true);
}
add_action("wp_enqueue_scripts", "portfolio_files");

function portfolio_features() {
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
}
add_action("after_setup_theme", "portfolio_features");

function portfolio_adjust_queries($query) {
    if (!is_admin() and is_post_type_archive("project") and $query->is_main_query()) {
        $query->set("meta_key", "project_number");
        $query->set("orderby", "meta_value");
        $query->set("order", "DESC");
    } 
}
add_action("pre_get_posts", "portfolio_adjust_queries");

// https://www.digitizer.studio/wpcf7-autop/#elementor-toc__heading-anchor-2
add_filter("wpcf7_autop_or_not", "__return_false");