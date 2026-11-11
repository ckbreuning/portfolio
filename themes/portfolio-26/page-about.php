<?php get_header(); ?>
 
<main id="main" class="wrap page-pad about-page">
    <?php while (have_posts()) {
        the_post(); ?>
 
        <div class="split about-head">
            <div>
                <p class="tag mono"><b>About</b><span>Aalborg, Denmark</span></p>
                <h1 class="display about-heading">I'm Christian Breuning<span class="acc">.</span></h1>
                <p class="lead">I'm a multimedia designer focused on frontend, UI design and graphic design. I work in a structured way, think analytically, and always put the user first.</p>
                <ul class="about-roles">
                    <li class="mono">Frontend developer</li>
                    <li class="mono">UX/UI designer</li>
                    <li class="mono">Graphic designer</li>
                </ul>
            </div>

            <?php if (has_post_thumbnail()) { ?>
                <div class="about-hero-photo"><?php the_post_thumbnail("large"); ?></div>
            <?php } ?>
        </div>
 
        <section class="about-section split">
            <div>
                <p class="tag mono"><b>01</b><span>Background</span></p>
                <h2 class="display header-large about-section-heading">Where I come from<span class="acc">.</span></h2>
 
                <div class="about-text">
                    <p>My background is broader than most designers'. I've been the in-game leader of Counter-Strike teams for six years, worked in a nursery, and done freelance graphic design on the side. That mix of leadership, empathy and taking responsibility on my own isn't typical for a designer, but it's exactly what shapes how I work.</p>
                    <p>I finished HTX at Frederikssund Gymnasium in 2023 and took two years off before university. I spent them as a childcare assistant in a nursery and, in my spare time, running Supernova Gaming League, an esports tournament organiser I founded with a group of others.</p>
                    <p>SGL grew bigger than any of us expected. Our tournaments drew players like a former Major finalist, and others have since gone on to teams like fnatic and MOUZ NXT. Around the same time, I started designing graphics for esports projects, and in 2024 I made the roster announcement and profile banners for SemperFi, a professional Australian team.</p>
                    <p>In 2025, I started studying multimedia design at UCN.</p>
                </div>
            </div>
 
            <div>
                <p class="milestones-label mono">Timeline</p>
                <ol class="milestones" data-src="<?php echo get_theme_file_uri("data/milestones.json"); ?>"></ol>
            </div>
        </section>

        <section class="about-section">
            <p class="tag mono"><b>02</b><span>Experience</span></p>
            <h2 class="display header-large about-section-heading">What I bring<span class="acc">.</span></h2>
 
            <div class="about-slots">
                <div class="slots">
                    <div class="slot">
                        <p class="slot-name">In-game leader</p>
                        <p class="slot-text">Leadership and strategy under pressure. Six years of making fast decisions and explaining them clearly while the round is still going.</p>
                    </div>
                    <div class="slot">
                        <p class="slot-name">Freelance design</p>
                        <p class="slot-text">Responsibility from brief to delivery. Managing my own projects and setting realistic expectations.</p>
                    </div>
                    <div class="slot">
                        <p class="slot-name">Childcare</p>
                        <p class="slot-text">Empathy and patience in practice. Meeting people where they are. That goes for users too.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <p class="tag mono"><b>03</b><span>Personality</span></p>
            <h2 class="display header-large about-section-heading">How I work<span class="acc">.</span></h2>
 
            <div class="about-slots">
                <div class="slots">
                    <div class="slot">
                        <p class="slot-name">Analytical</p>
                        <p class="slot-text">I get to the bottom of a problem before I start solving it. Structure comes before looks.</p>
                    </div>
                    <div class="slot">
                        <p class="slot-name">Empathetic</p>
                        <p class="slot-text">Working with children taught me to meet people where they are. I bring that into every design.</p>
                    </div>
                    <div class="slot">
                        <p class="slot-name">Detail-oriented</p>
                        <p class="slot-text">Spacing, contrast, semantics. Nothing is random. The craft is in the details.</p>
                    </div>
                </div>
            </div>
 
            <p class="about-note">
                <span class="mono">Working on</span>
                I can get lost in the details and lose track of time, because I'm rarely satisfied with "good enough". I'm working on knowing when to move on.
            </p>
        </section>

        <section class="about-section">
            <p class="tag mono"><b>04</b><span>Outside view</span></p>
            <h2 class="display header-large about-section-heading">What others say<span class="acc">.</span></h2>

            <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/blockquote -->
            <div class="about-quotes">
                <figure class="about-quote">
                    <blockquote>"Not satisfied with a 'meh' result."</blockquote>
                    <figcaption class="mono">A friend</figcaption>
                </figure>
                <figure class="about-quote">
                    <blockquote>"He doesn't need to fill the room, but when he speaks, it makes sense."</blockquote>
                    <figcaption class="mono">My sister</figcaption>
                </figure>
            </div>
        </section>

        <section class="about-section">
            <p class="tag mono"><b>05</b><span>Next</span></p>
            <h2 class="display header-large about-section-heading">Where I'm heading<span class="acc">.</span></h2>
            <div class="about-text">
                <p>I want to work in a team where I can bring structure, creativity and technical understanding, and get better with every project.</p>
                <p>Next is an internship in frontend or UX/UI. I graduate in 2027, and the long-term goal is to design and build for esports organisations.</p>
            </div>
        </section>

        <section class="about-section">
            <p class="tag mono"><b>06</b><span>Outside design</span></p>
            <h2 class="display header-large about-section-heading">Off the clock<span class="acc">.</span></h2>
            <div class="about-text">
                <p>Counter-Strike is still a big part of my life. In May 2026, I played my first LAN, Parken Challenger Championship in Copenhagen. We didn't win a match, but it was by far the best CS experience I've ever had.</p>
            </div>

            <div class="about-gallery">
                <figure class="about-photo about-photo-large">
                    <img src="<?php echo get_theme_file_uri("images/about/pcc-lan.webp"); ?>" alt="A row of players in headsets at their computers during the LAN in Parken, with the event’s sponsor wall behind them." loading="lazy">
                    <figcaption class="mono">First LAN, Copenhagen 2026</figcaption>
                </figure>
                <figure class="about-photo">
                    <img src="<?php echo get_theme_file_uri("images/about/inferno-online.webp"); ?>" alt="Seen from above and behind: me at a desk, looking at a Counter-Strike match lobby on the screen." loading="lazy">
                    <figcaption class="mono">Waiting for the next match</figcaption>
                </figure>
                <figure class="about-photo about-photo-fit">
                    <img src="<?php echo get_theme_file_uri("images/about/semperfi-graphic.webp"); ?>" alt="A green player announcement graphic I designed for the team SemperFi, with a photo of the player and the word “Welcome!”." loading="lazy">
                    <figcaption class="mono">Player announcement for SemperFi</figcaption>
                </figure>
                <figure class="about-photo">
                    <img src="<?php echo get_theme_file_uri("images/about/gokart.webp"); ?>" alt="The view from the driver’s seat of a red go-kart, waiting behind kart number 19 in an indoor karting hall." loading="lazy">
                    <figcaption class="mono">On the grid</figcaption>
                </figure>
                <figure class="about-photo">
                    <img src="<?php echo get_theme_file_uri("images/about/bowling.webp"); ?>" alt="Friends laughing together at a bowling alley, with bowling balls in the background." loading="lazy">
                    <figcaption class="mono">Bowling with friends</figcaption>
                </figure>
            </div>
        </section>

        <div class="about-buttons">
            <a class="btn btn-solid" href="<?php echo site_url("/contact"); ?>">Get in touch <i class="fa-solid fa-arrow-right-long"></i></a>
            <a class="btn btn-outline" href="<?php echo get_post_type_archive_link("project"); ?>">See my work</a>
        </div>
    <?php } ?>
</main>
 
<?php get_footer(); ?>