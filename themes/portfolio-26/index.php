<?php
get_header(); ?>

<main id="main" class="wrap page-pad">
  <?php while (have_posts()) {
    the_post(); ?>
    <h1 class="display header-large"><?php the_title(); ?></h1>
    <div class="lead page-content"><?php the_content(); ?></div>
  <?php } ?>
</main>

<?php get_footer(); ?>