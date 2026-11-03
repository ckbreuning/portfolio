<?php get_header(); ?>

<main id="main" class="wrap work-page">
    <div class="work-head">
        <div>
            <p class="tag mono" aria-live="polite"><b class="project-count"><?php echo $wp_query->found_posts; ?></b><span>Case studies</span></p>
            <h1 class="display header-xl work-heading">Work</h1>
        </div>
        <p class="work-intro">Every project, from research and design to the finished build.</p>
    </div>

    <div class="filters">
        <button type="button" class="filter is-active" aria-pressed="true" data-filter="all">All</button>
        <button type="button" class="filter" aria-pressed="false" data-filter="frontend">Frontend</button>
        <button type="button" class="filter" aria-pressed="false" data-filter="ux/ui">UX/UI</button>
        <button type="button" class="filter" aria-pressed="false" data-filter="visual">Visual design</button>
    </div>

    <div class="project-grid">
        <?php while (have_posts()) {
          the_post();
          get_template_part("template-parts/project-card");
        } ?>
    </div>

    <p class="filter-empty" hidden>No projects in this category yet.</p>
</main>

<?php get_footer(); ?>