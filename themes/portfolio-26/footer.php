<footer class="wrap site-footer">
    <p class="display footer-slogan">Built different.<br><span class="acc">Delivered right.</span></p>

    <div class="footer-bottom mono">
        <?php // date("Y") giver altid det aktuelle år ?>
        <span>&copy; <?php echo date("Y"); ?> Christian Breuning</span>
        <span>Designed and built by Christian Breuning</span>
        <a class="footer-link" href="#">Back to the top <i class="fa-solid fa-arrow-up-long"></i></a>
    </div>
</footer>

<?php get_template_part("template-parts/crosshair"); ?>

<?php // wp_footer indsætter main.js her i bunden, så al HTML er indlæst, før scriptet kører ?>
<?php wp_footer(); ?>
</body>
</html>