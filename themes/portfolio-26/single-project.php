<?php get_header(); ?>

<main id="main">
<?php while (have_posts()) {
    the_post();

    $sections = array(
        "problem" => "The problem",
        "research" => "Research",
        "structure" => "Content &amp; structure",
        "wireframes" => "Sketches &amp; wireframes",
        "ui" => "UI design",
        "frontend" => "Frontend",
        "testing" => "Test &amp; iteration",
        "before_after" => "Before / after",
        "reflection" => "Reflection"
    );
    ?>
    <nav class="chapters">
        <div class="wrap">
            <ol class="chapter-list">
                <li><a href="#intro"><span class="chapter-number">00</span><span class="chapter-name"><?php the_title(); ?></span></a></li>
                <li><a href="#overview"><span class="chapter-number">01</span><span class="chapter-name">Overview</span></a></li>
                <?php 
                $chapterNumber = 2;
                foreach ($sections as $name => $title) {
                    $data = get_field($name);
                    if ($data and $data["text"]) { ?>
                    <!-- https://stackoverflow.com/questions/5659042/php-prepend-leading-zero-before-single-digit-number-on-the-fly -->
                    <li><a href="#<?php echo $name; ?>"><span class="chapter-number"><?php echo str_pad($chapterNumber, 2, "0", STR_PAD_LEFT); ?></span><span class="chapter-name"><?php echo $title; ?></span></a></li>
                    <?php $chapterNumber++;
                    } 
                } ?>
            </ol>
        </div>
    </nav>

    <div class="wrap">
        <section class="case-head case-section" id="intro">
            <a href="<?php echo get_post_type_archive_link("project"); ?>" class="back-link mono"><i class="fa-solid fa-arrow-left-long"></i>All work</a>

            <div class="split case-intro">
                <div>
                    <p class="tag mono"><b>Case <?php the_field("project_number"); ?></b><span><?php the_field("project_year"); ?></span></p>
                    <h1 class="display case-title"><?php the_title(); ?><span class="acc">.</span></h1>
                </div>
                <p class="lead"><?php echo get_the_excerpt(); ?></p>
            </div>

            <div class="case-hero"><?php the_post_thumbnail("full"); ?></div>
        </section>

        <article class="case">
            <section class="case-section" id="overview">
                <p class="tag mono"><b>01</b><span>Overview</span></p>
                <dl class="facts">
                    <div>
                        <dt class="mono">My role</dt>
                        <dd><?php the_field("project_role"); ?></dd>
                    </div>
                    <div>
                        <dt class="mono">Team</dt>
                        <dd><?php the_field("project_team"); ?></dd>
                    </div>
                    <div>
                        <dt class="mono">Year</dt>
                        <dd><?php the_field("project_year"); ?></dd>
                    </div>
                    <div>
                        <dt class="mono">Tools</dt>
                        <dd><?php the_field("project_tools"); ?></dd>
                    </div>
                </dl>
                <?php if (get_field("project_live_url")) { ?>
                    <a class="btn btn-solid case-live" href="<?php the_field("project_live_url"); ?>" target="_blank">Visit the live site <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                <?php } ?>
            </section>

            <?php 
            $number = 2;
            foreach ($sections as $name => $title) {
                $data = get_field($name);

                if ($data and $data["text"]) { ?>
                    <section class="case-section <?php if (!$data["image"]) { echo "case-section-text"; } ?>" id="<?php echo $name; ?>">
                        <p class="tag mono"><b><?php echo str_pad($number, 2, "0", STR_PAD_LEFT); ?></b><span><?php echo $title; ?></span></p>
                        <h2 class="display header-large case-heading"><?php echo $data["heading"] ? $data["heading"] : $title; ?></h2>

                        <div class="case-text"><?php echo $data["text"]; ?></div>

                        <?php if ($data["image"]) {
                            $imageId = is_array($data["image"]) ? $data["image"]["ID"] : $data["image"];

                            $imageSize = wp_get_attachment_image_src($imageId, "full");
                            $isWide = $imageSize[1] > $imageSize[2]; ?>
                            <figure class="case-figure <?php if ($isWide) { echo "is-wide"; } ?>">
                                <button class="zoom" type="button" data-full="<?php echo esc_url($imageSize[0]); ?>">
                                    <?php echo wp_get_attachment_image($imageId, "large"); ?>
                                    <span class="zoom-icon"><i class="fa-solid fa-expand"></i></span>
                                </button>
                                <?php if ($data["image_caption"]) { ?>
                                    <figcaption class="mono"><?php echo esc_html($data["image_caption"]); ?></figcaption>
                                <?php } ?>
                            </figure>
                        <?php } ?>

                        <?php if ($data["code"]) { ?>
                            <figure class="case-code">
                                <figcaption class="mono"><?php echo esc_html($data["code_file"]); ?></figcaption>
                                <pre><code><?php echo esc_html($data["code"]); ?></code></pre>
                            </figure>
                        <?php } ?>
                    </section>
                    <?php $number++;
                }
            } ?>

            <div class="case-end">
                <a class="btn btn-outline" href="<?php echo get_post_type_archive_link("project"); ?>"><i class="fa-solid fa-arrow-left-long"></i>All work</a>
                <a class="btn btn-solid" href="<?php echo site_url("/contact"); ?>">Talk about this project <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
        </article>
    </div>
<?php } ?>

    <dialog class="lightbox">
        <button class="lightbox-close" type="button"><i class="fa-solid fa-xmark"></i></button>
        <img class="lightbox-image" alt="">
    </dialog>
</main>

<?php get_footer(); ?>