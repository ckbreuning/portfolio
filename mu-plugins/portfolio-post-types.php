<?php

// Opretter post typen "project" til mine cases.
// Ligger i mu-plugins i stedet for temaet, så cases ikke forsvinder, hvis temaet skiftes
function portfolio_post_types() {
    register_post_type("project", array(

        // false = cases bruger den klassiske editor, fordi indholdet ligger i ACF-felter
        "show_in_rest" => false,

        // Ingen "editor", fordi casens tekst ligger i ACF-felter
        "supports" => array("title", "excerpt", "thumbnail"),

        // Adresserne bliver /work/case-navn i stedet for /project/case-navn
        "rewrite" => array("slug" => "work"),

        // Giver en archive side på /work, som bruger archive-project.php
        "has_archive" => true,
        "public" => true,
        "menu_icon" => "dashicons-portfolio",

        // Teksterne i admin-menuen
        "labels" => array(
            "name" => "Projects",
            "add_new_item" => "Add New Project",
            "edit_item" => "Edit Project",
            "all_items" => "All Projects",
            "singular_name" => "Project"
        )
    ));
}
add_action("init", "portfolio_post_types");