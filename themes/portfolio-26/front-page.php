<?php get_header(); ?>

<main id="main">
  <?php while (have_posts()) {
    the_post(); ?>

<!-- HERO -->
  <section class="poster">
    <span class="plus plus-1" data-depth="-1.2"></span>
    <span class="plus plus-2" data-depth="1.6"></span>

    <div class="wrap poster-grid">
      <div class="poster-top">
        <div class="poster-brand mono">
          <?php get_template_part("template-parts/logo"); ?>
          <span>Portfolio - Aalborg, Denmark</span>
        </div>
        <a href="https://github.com/ckbreuning" class="qr-link" target="_blank">
          <?php get_template_part("template-parts/qr-github"); ?>
        </a>
      </div>
      <h1 class="display poster-title">
        <span>Christian</span>
        <span>Breuning</span>
        <span class="poster-role mono">Multimedia designer</span>
      </h1>
      <p class="note note-1" data-depth="-0.6"><span class="note-label mono">Role 01:</span><b>Frontend development</b></p>
      <p class="note note-2" data-depth="-0.9"><span class="note-label mono">Role 02:</span><b>UX/UI design</b></p>
      <p class="note note-3" data-depth="0.6"><span class="note-label mono">Role 03:</span><b>Visual design</b></p>
      <p class="note note-4" data-depth="0.9"><span class="note-label mono">Based in:</span><b>Aalborg, Denmark</b></p>

      <div class="poster-photo" data-depth="0.35">
        <?php the_post_thumbnail('large'); ?>
      </div>

      <div class="poster-radar">
        <svg class="radar" viewBox="0 0 200 200" role="group">
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
        <a href="<?php echo get_post_type_archive_link('project'); ?>" class="btn btn-ink">See my projects <i class="fa-solid fa-arrow-right-long"></i></a>
      </div>
    </div>

    <a class="scroll-hint" href="#intro">
      <i class="fa-solid fa-chevron-down"></i>
      <i class="fa-solid fa-chevron-down"></i>
      <i class="fa-solid fa-chevron-down"></i>
    </a>
  </section>

<!-- INTRO -->
  <section class="intro" id="intro">
    <ul class="feed">
      <li class="feed-row"><span class="feed-who">CKB</span><i class="fa-solid fa-code"></i><span>Frontend Development</span></li>
      <li class="feed-row"><span class="feed-who">CKB</span><i class="fa-solid fa-layer-group"></i><span>UX/UI Design</span></li>
      <li class="feed-row"><span class="feed-who">CKB</span><i class="fa-solid fa-swatchbook"></i><span>Visual Design</span></li>
    </ul>

    <div class="wrap intro-content">
      <div class="split">
        <div>
          <p class="tag mono"><b>01</b><span>About me</span></p>
          <h2 class="display header-large intro-heading" id="intro-heading">I design and build<br><span class="acc">digital solutions.</span></h2>
        </div>
        <div class="intro-text">
          <p class="lead">I'm a multimedia designer who builds things that work <strong>both technically and visually</strong>. I'm analytical and structured, but I never forget that it has to <strong>feel right for the person using it</strong>.</p>
          <p class="lead">I study multimedia design at UCN in Aalborg and work across <strong>frontend development, UX/UI and visual design</strong>.</p>
          <p class="lead">Curious? <a class="text-link" href="<?php echo get_post_type_archive_link('project'); ?>">See my projects</a> or <a class="text-link" href="<?php echo site_url('/contact'); ?>">get in touch</a>.</p>
        </div>
      </div>
    </div>
  </section>

<!-- SELECTED WORK -->
<section class="wrap work">
  <div class="work-head">
    <div>
      <p class="tag mono"><b>02</b><span>Case studies</span></p>
      <h2 class="display header-xl work-heading" id="work-heading">Selected work</h2>
    </div>
  </div>

  <div class="project-grid">
    <?php 
    $homepageProjects = new WP_Query(array(
      "posts_per_page" => 3,
      "post_type" => "project",
      "meta_key" => "project_number",
      "orderby" => "meta_value",
      "order" => "DESC"
    ));

    while ($homepageProjects->have_posts()) {
      $homepageProjects->the_post();
      get_template_part("template-parts/project-card");
    }
    wp_reset_postdata();
    ?>
  </div>
</section>

<!-- HOW I WORK -->
<section class="wrap process" id="process">

  <div class="process-head">
    <div>
      <p class="tag mono"><b>03</b><span>My process</span></p>
      <h2 class="display header-xl process-heading" id="process-heading">How I work</h2>
    </div>
    <p class="lead">I work through five steps on every project, but not in a straight line. What I learn from testing usually sends me back to improve the design.</p>
  </div>

  <div class="timeline">

    <svg class="timeline-loop" viewBox="0 0 1000 100" preserveAspectRatio="none">
      <path d="M808 100 C 720 0, 500 0, 408 100"/>
    </svg>
    <span class="timeline-loop-label mono">Back to design</span>

    <ol class="timeline-steps">
      <li class="timeline-step">
        <span class="timeline-node"></span>
        <p class="timeline-number mono">01</p>
        <h3 class="display timeline-name">Research</h3>
        <p class="timeline-text">Interviews, client meetings and affinity diagrams. Nothing gets designed before I know what people actually need.</p>
      </li>
      <li class="timeline-step">
        <span class="timeline-node"></span>
        <p class="timeline-number mono">02</p>
        <h3 class="display timeline-name">Define</h3>
        <p class="timeline-text">One clear goal, a content sitemap and priorities, so the time goes to the things that matter most.</p>
      </li>
      <li class="timeline-step">
        <span class="timeline-node"></span>
        <p class="timeline-number mono">03</p>
        <h3 class="display timeline-name">Design</h3>
        <p class="timeline-text">Sketches, then wireframes in Figma, then a visual system with colours checked for contrast.</p>
      </li>
      <li class="timeline-step">
        <span class="timeline-node"></span>
        <p class="timeline-number mono">04</p>
        <h3 class="display timeline-name">Build</h3>
        <p class="timeline-text">Semantic HTML, CSS and my own JavaScript, versioned in Git and measured in Lighthouse.</p>
      </li>
      <li class="timeline-step">
        <span class="timeline-node"></span>
        <p class="timeline-number mono">05</p>
        <h3 class="display timeline-name">Test &amp; iterate</h3>
        <p class="timeline-text">Tests with real users, then back to the design with what they showed me.</p>
      </li>
    </ol>
  </div>
</section>

<!-- SKILLS -->
<section class="wrap skills" id="skills">
  <p class="tag mono"><b>04</b><span>Skills</span></p>
  <h2 class="display header-xl skills-heading" id="skills-heading">What I work with</h2>

  <div class="skill">
    <div class="skill-tabs">
      <button type="button" class="skill-tab is-active"><span class="skill-key mono">1</span>Code</button>
      <button type="button" class="skill-tab"><span class="skill-key mono">2</span>UX &amp; research</button>
      <button type="button" class="skill-tab"><span class="skill-key mono">3</span>UI &amp; visual</button>
      <button type="button" class="skill-tab"><span class="skill-key mono">4</span>Tools &amp; process</button>
    </div>

    <div class="skill-panels">

      <!-- 1. FRONTEND -->
      <div class="skill-panel">
        <ul class="slots">
          <li class="slot"><span class="slot-name">HTML &amp; CSS</span><p class="slot-text">Semantic, accessible markup and responsive layouts.</p></li>
          <li class="slot"><span class="slot-name">JavaScript</span><p class="slot-text">Interactions I write and understand myself.</p></li>
          <li class="slot"><span class="slot-name">PHP &amp; WordPress</span><p class="slot-text">Custom themes and post types, no page builders.</p></li>
        </ul>
        <div class="also">
          <p class="also-label mono">Also</p>
          <ul class="also-list">
            <li>Responsive design</li>
            <li>Vue</li>
            <li>WordPress REST API</li>
            <li>Headless CMS</li>
            <li>SQL databases</li>
            <li>SEO</li>
            <li>Deployment</li>
          </ul>
        </div>
      </div>

      <!-- 2. UX & RESEARCH -->
      <div class="skill-panel" hidden>
        <ul class="slots">
          <li class="slot"><span class="slot-name">User research</span><p class="slot-text">Finding out what people need before anything is designed.</p></li>
          <li class="slot"><span class="slot-name">Think-aloud tests</span><p class="slot-text">Watching real users, then fixing what they struggle with.</p></li>
          <li class="slot"><span class="slot-name">Information architecture</span><p class="slot-text">Structure and navigation that help people find things.</p></li>
        </ul>
        <div class="also">
          <p class="also-label mono">Also</p>
          <ul class="also-list">
            <li>Interviews</li>
            <li>Personas</li>
            <li>Affinity diagrams</li>
            <li>Card sorting</li>
            <li>Usability tests (tree, 5-second)</li>
            <li>Content sitemaps</li>
            <li>Metadata</li>
            <li>UX writing</li>
          </ul>
        </div>
      </div>

      <!-- 3. UI & VISUAL -->
      <div class="skill-panel" hidden>
        <ul class="slots">
          <li class="slot"><span class="slot-name">Interface design</span><p class="slot-text">Clear layouts built on hierarchy and contrast.</p></li>
          <li class="slot"><span class="slot-name">Prototyping</span><p class="slot-text">Clickable flows in Figma, to test ideas early.</p></li>
          <li class="slot"><span class="slot-name">Typography</span><p class="slot-text">Type that does the work before decoration does.</p></li>
        </ul>
        <div class="also">
          <p class="also-label mono">Also</p>
          <ul class="also-list">
            <li>Wireframes</li>
            <li>Atomic Design</li>
            <li>Visual hierarchy</li>
            <li>Colours &amp; contrast</li>
            <li>Branding &amp; visual identity</li>
            <li>Data visualisation</li>
          </ul>
        </div>
      </div>

      <!-- 4. TOOLS & PROCESS -->
      <div class="skill-panel" hidden>
        <ul class="slots">
          <li class="slot"><span class="slot-name">Figma</span><p class="slot-text">Wireframes, prototypes and design systems.</p></li>
          <li class="slot"><span class="slot-name">Git &amp; GitHub</span><p class="slot-text">Branches, merges and conflicts, in teams and solo.</p></li>
          <li class="slot"><span class="slot-name">Project leading</span><p class="slot-text">Planning the work and keeping a team on track.</p></li>
        </ul>
        <div class="also">
          <p class="also-label mono">Also</p>
          <ul class="also-list">
            <li>Affinity</li>
            <li>Photoshop</li>
            <li>VS Code</li>
            <li>Design sprints</li>
            <li>Requirement specifications</li>
            <li>Digital Services Act (DSA)</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT TEASER -->
<section class="wrap about-teaser">
  <div class="split">

    <div class="about-teaser-milestones">
      <p class="milestones-label mono">Milestones</p>
      <ol class="milestones">
        <li><span class="milestone-year mono">2023</span><span>Founded Supernova Gaming League, a tournament organiser whose players went on to teams like fnatic and MOUZ NXT</span></li>
        <li><span class="milestone-year mono">2023</span><span>Started designing graphics for esports projects</span></li>
        <li><span class="milestone-year mono">2024</span><span>Roster announcement and banners for SemperFI, a professional Australian team</span></li>
        <li class="is-current"><span class="milestone-year mono">2025</span><span>Studying multimedia design at UCN, Aalborg <b class="milestone-now mono">Now</b></span></li>
        <li class="is-upcoming"><span class="milestone-year mono">Next</span><span>A frontend or UX/UI internship</span></li>
        <li class="is-upcoming"><span class="milestone-year mono">2027</span><span>Graduate as a multimedia designer</span></li>
        <li class="is-goal"><span class="milestone-year mono">Beyond</span><span>Design and build for esports organisations <i class="fa-solid fa-flag-checkered"></i></span></li>
      </ol>
      <?php /* CV: <a class="btn btn-outline milestones-cv" href="YOUR-CV-LINK.pdf" download>Download full CV</a> */ ?>
    </div>

    <div class="about-teaser-text">
      <p class="tag mono"><b>05</b><span>Personal</span></p>
      <h2 class="display header-large" id="about-teaser-heading">Calm under pressure.<br><span class="acc">Sharp on details.</span></h2>
      <p class="lead">When I ask people around me to describe me, the same words keep coming back: <strong>analytical, loyal, empathetic and dedicated</strong>. My About page covers the rest: my background, what drives me and where I'm heading.</p>

      <div class="about-teaser-buttons">
        <a class="btn btn-solid" href="<?php echo site_url("/contact"); ?>">Get in touch <i class="fa-solid fa-arrow-right-long"></i></a>
        <a class="btn btn-outline" href="<?php echo site_url("/about"); ?>">More about me</a>
      </div>
    </div>

  </div>
</section>

<!-- CONTACT -->
<section class="wrap contact" id="contact">
  <div class="accept">
    <p class="mono accept-label">Next challenge</p>
    <h2 class="display accept-heading" id="contact-heading">Let's work together</h2>
    <p class="accept-text">Internship, freelance or a question about a project. Send me a message, and I'll get back to you.</p>

    <div class="accept-bar"><span></span></div>

    <a class="btn accept-btn" href="<?php echo site_url("/contact"); ?>">Get in touch <i class="fa-solid fa-arrow-right-long"></i></a>
    <a class="accept-email mono" href="mailto:ckbreuning@gmail.com">ckbreuning@gmail.com</a>

    <div class="accept-links">
      <a class="btn btn-outline" href="https://linkedin.com/in/christian-breuning" target="_blank"><i class="fa-brands fa-linkedin"></i>LinkedIn</a>
      <a class="btn btn-outline" href="https://github.com/ckbreuning" target="_blank"><i class="fa-brands fa-github"></i>GitHub</a>
    </div>
  </div>
</section>
<?php } ?>
</main>

<?php get_footer(); ?>