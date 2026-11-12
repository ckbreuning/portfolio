<?php 

// Indlæser CSS, JavaScript og skrifttyper på alle sider
function portfolio_files() {

    // Kun de vægte, siden bruger. Tektur er en variabel font, så 400..900 er én fil
    wp_enqueue_style("portfolio-google-fonts", "https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600;700&family=Tektur:wght@400..900&display=swap");
    
    // Font Awesome via cdnjs
    wp_enqueue_style("font-awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css");
    
    // Versionsnummeret er filens ændringstidspunkt.
    // Det skifter kun, når filen ændres, så browseren cacher CSS og JS, men henter den nye version efter en ændring.
    // true = main.js indlæses i bunden af siden, efter HTML'en.
    // filemtime: https://www.php.net/manual/en/function.filemtime.php
    // get_theme_file_path: https://developer.wordpress.org/reference/functions/get_theme_file_path/
    wp_enqueue_style("portfolio-main-styles", get_theme_file_uri("/css/main.css"), NULL, filemtime(get_theme_file_path("/css/main.css")));
    wp_enqueue_script("portfolio-main-js", get_theme_file_uri("/js/main.js"), NULL, filemtime(get_theme_file_path("/js/main.js")), true);
}
add_action("wp_enqueue_scripts", "portfolio_files");

// Slår titler og featured images til.
function portfolio_features() {
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
}
add_action("after_setup_theme", "portfolio_features");

// Sorterer Work-siden efter ACF-feltet project_number, højeste værdi først.
// Kun på forsiden af sitet (ikke i admin) og kun for main query på projekt-arkivet
function portfolio_adjust_queries($query) {
    if (!is_admin() and is_post_type_archive("project") and $query->is_main_query()) {
        $query->set("meta_key", "project_number");
        $query->set("orderby", "meta_value");
        $query->set("order", "DESC");
    } 
}
add_action("pre_get_posts", "portfolio_adjust_queries");

// Stopper Contact Form 7 i at sætte ekstra <p>- og <br>-tags ind i formularen, så den kan styles med egen CSS
// Contact Form 7 uden autop: https://www.digitizer.studio/wpcf7-autop/#elementor-toc__heading-anchor-2
add_filter("wpcf7_autop_or_not", "__return_false");