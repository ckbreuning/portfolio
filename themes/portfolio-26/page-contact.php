<?php get_header(); ?>

<main id="main" class="wrap page-pad contact-page">
    <?php while (have_posts()) {
        the_post(); ?>

        
        <div class="contact-head">
            <p class="tag mono"><b>Contact</b><span>Next challenge</span></p>
            <h1 class="display contact-heading">Let's work together<span class="acc">.</span></h1>
            <p class="lead">Internships, freelance work or a question about a project. Write a message and I'll get back to you.</p>
        </div>

        <div class="split contact-grid">
            <div class="contact-side">
                <div class="contact-card contact-email-card">
                    <p class="contact-label mono">Email</p>

                    <!-- data-email bruges af kopiér-knappen i main.js. Statusbeskeden skrives i .copy-status -->
                    <div class="contact-email-row">
                        <a class="contact-email" href="mailto:ckbreuning@gmail.com">ckbreuning@gmail.com</a>
                        <button class="copy-btn mono" type="button" data-email="ckbreuning@gmail.com">Copy</button>
                    </div>
                    <p class="copy-status mono"></p>
                </div>

                <div class="contact-card contact-links">
                    <a href="https://linkedin.com/in/christian-breuning" target="_blank"><span class="contact-link-name">LinkedIn</span><span class="contact-link-handle">/in/christian-breuning ↗</span></a>
                    <a href="https://github.com/ckbreuning" target="_blank"><span class="contact-link-name">GitHub</span><span class="contact-link-handle">/ckbreuning ↗</span></a>
                    <a href="https://behance.net/zesiDesign" target="_blank"><span class="contact-link-name">Behance</span><span class="contact-link-handle">/zesiDesign ↗</span></a>
                </div>

                <p class="contact-status mono"><span class="contact-dot"></span>Open for internship &amp; freelance - Aalborg, DK</p>
            </div>

            <div class="contact-form" id="contact-form">

                <!-- Formularen er bygget i Contact Form 7 (WP admin), og do_shortcode viser den her -->
                <!-- Contact Form 7 i en PHP-skabelon: https://philowen.co/blog/adding-contact-form-7-form-php-template-wordpress -->
                 <?php echo do_shortcode("[contact-form-7 id='690d498' title='Contact']"); ?>
            </div>
        </div>
    <?php } ?>
</main>

<?php get_footer(); ?>