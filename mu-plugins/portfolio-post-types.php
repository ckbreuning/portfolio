<?php
function portfolio_post_types() {
    register_post_type("project", array(
        "show_in_rest" => true,
        "supports" => array("title", "editor", "excerpt", "thumbnail"),
        "rewrite" => array("slug" => "work"),
        "has_archive" => true,
        "public" => true,
        "menu_icon" => "dashicons-portfolio",
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