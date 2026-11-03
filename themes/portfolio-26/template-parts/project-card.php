<a class="project-card" href="<?php the_permalink(); ?>" data-disciplines="<?php echo esc_attr(get_field('project_disciplines')); ?>">
    <div class="project-image">
        <?php the_post_thumbnail("large"); ?>
        <span class="project-code" aria-hidden="true"><?php the_field("project_code"); ?></span>
        <span class="project-stamp" aria-hidden="true">Pick</span>
    </div>

    <div class="project-body">
        <p class="project-meta mono">
            Case <?php the_field("project_number"); ?> - <?php the_field("project_year"); ?> - <span class="<?php if (get_field('project_shipped')) echo 'is-shipped'; ?>"><?php echo get_field('project_shipped') ? 'Shipped' : 'In progress'; ?></span>
        </p>
        <h3 class="display project-title"><?php the_title(); ?></h3>
        <p class="project-desc"><?php echo get_the_excerpt(); ?></p>
        <p class="project-tags mono"><?php the_field("project_disciplines"); ?> - <?php the_field("project_team"); ?></p>

        <span class="btn btn-solid" aria-hidden="true">Read the case<i class="fa-solid fa-arrow-right-long"></i></span>
    </div>
</a>