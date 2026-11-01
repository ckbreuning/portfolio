<?php get_header(); ?>

<main id="main">
  <?php while (have_posts()) {
    the_post(); ?>

<!-- HERO -->
  <section class="poster" aria-label="Introduction">
    <span class="plus plus-1" data-depth="-1.2" aria-hidden="true"></span>
    <span class="plus plus-2" data-depth="1.6" aria-hidden="true"></span>

    <div class="wrap poster-grid">
      <div class="poster-top">
        <div class="poster-brand mono">
          <?php get_template_part("template-parts/logo"); ?>
          <span>Portfolio - Aalborg, Denmark</span>
        </div>
        <a href="https://github.com/ckbreuning" class="qr-link" aria-label="My GitHub profile" target="_blank">
          <?php get_template_part("template-parts/qr-github"); ?>
        </a>
      </div>
      <h1 class="display poster-title">
       <span>Christian</span>
       <span>Breuning</span>
      </h1>
      <p class="note note-1" data-depth="-0.6"><span class="note-label mono">Role 01:</span><b>Frontend development</b></p>
      <p class="note note-2" data-depth="-0.9"><span class="note-label mono">Role 02:</span><b>UX/UI design</b></p>
      <p class="note note-3" data-depth="0.6"><span class="note-label mono">Role 03:</span><b>Visual design</b></p>
      <p class="note note-4" data-depth="0.9"><span class="note-label mono">Based in:</span><b>Aalborg, Denmark</b></p>

      <div class="poster-photo" data-depth="0.35">
        <?php the_post_thumbnail('large'); ?>
      </div>

      <div class="poster-radar">
        <svg class="radar" viewBox="0 0 200 200" role="group" aria-label="Shortcuts">
          <circle class="ring" cx="100" cy="100" r="92"/>
          <circle class="ring" cx="100" cy="100" r="62"/>
          <circle class="ring" cx="100" cy="100" r="32"/>
          <path class="ring ring-dashed" d="M8 100h184M100 8v184M35 35l130 130M165 35L35 165"/>

          <g class="sweep">
            <path class="sweep-fill" d="M100 100L100 8A92 92 0 0 1 165 35z"/>
            <path class="sweep-line" d="M100 100L100 8"/>
          </g>

          <a class="blip" href="<?php echo get_post_type_archive_link('project'); ?>"><circle cx="146" cy="58" r="5"/><text x="146" y="48" text-anchor="middle">WORK</text></a>
          <a class="blip" href="<?php echo site_url('/about'); ?>"><circle cx="52" cy="70" r="5"/><text x="52" y="60" text-anchor="middle">ABOUT</text></a>
          <a class="blip" href="#process"><circle cx="50" cy="150" r="5"/><text x="50" y="140" text-anchor="middle">PROCESS</text></a>
          <a class="blip" href="<?php echo site_url('/contact'); ?>"><circle cx="150" cy="150" r="5"/><text x="150" y="140" text-anchor="middle">CONTACT</text></a>
        </svg>
      </div>

      <div class="poster-meta">
        <span class="status mono"><span class="status-dot"></span>Open for internship &amp; freelance</span>
        <a href="<?php echo get_post_type_archive_link('project'); ?>" class="btn btn-ink">See my projects <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
      </div>
    </div>
  </section>
<!-- INTRO -->
  <section class="intro" aria-labelledby="intro-heading">
    <ul class="feed">
      <li class="feed-row"><span class="feed-who" aria-hidden="true">CKB</span><i class="fa-solid fa-code" aria-hidden="true"></i><span>Frontend Development</span></li>
      <li class="feed-row"><span class="feed-who" aria-hidden="true">CKB</span><i class="fa-solid fa-layer-group" aria-hidden="true"></i><span>UX/UI Design</span></li>
      <li class="feed-row"><span class="feed-who" aria-hidden="true">CKB</span><i class="fa-solid fa-swatchbook" aria-hidden="true"></i><span>Visual Design</span></li>
    </ul>

    <div class="wrap intro-content">
      <div class="split">
        <div>
          <p class="tag mono"><b>01</b><span>About me</span></p>
          <h2 class="display header-large intro-heading" id="intro-heading">I design and build<br><span class="acc">digital solutions.</span></h2>
        </div>
        <div class="intro-text">
          <p class="lead">I'm a multimedia designer who builds things that work both technically and visually. I'm analytical and structured, but I never forget that it has to feel right for the person using it.</p>
          <p class="lead">I study multimedia design at UCN in Aalborg and work across frontend development, UX/UI and visual design.</p>
          <p class="lead">Curious? <a class="text-link" href="<?php echo get_post_type_archive_link('project'); ?>">See my projects</a> or <a class="text-link" href="<?php echo site_url('/contact'); ?>">get in touch</a>.</p>
        </div>
      </div>
    </div>
  </section>

<!-- SELECTED WORK -->
<section class="wrap work" aria-labelledby="work-heading">
  <div class="work-head">
    <div>
      <p class="tag mono"><b>02</b><span>Case studies</span></p>
      <h2 class="display header-xl work-heading" id="work-heading">Selected work</h2>
    </div>
    <p class="work-intro">Three projects, from research and design to the finished build.</p>
  </div>

  <div class="pool">
    <?php 
    $homepageProjects = new WP_Query(array(
      "posts_per_page" => 3,
      "post_type" => "project",
      "meta_key" => "project_number",
      "orderby" => "meta_value",
      "order" => "ASC"
    ));

    while ($homepageProjects->have_posts()) {
      $homepageProjects->the_post();
      get_template_part("template-parts/project-card");
    }
    wp_reset_postdata();
    ?>
  </div>
</section>
<?php } ?>
</main>

<?php get_footer(); ?>