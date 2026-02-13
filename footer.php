<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme-inpulse
 */
?>

    </div><!-- #content -->

    <?php wp_footer(); ?>
    
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-impulse.png" alt="Impulse Logo" class="logo" style="margin-bottom: 25px;">
                </div>

                <div class="footer-col">
                    <h4>Rubriques</h4>
                    <?php
                    // Menu Rubriques avec fallback
                    if (function_exists('wp_nav_menu') && function_exists('has_nav_menu') && has_nav_menu('menu-footer-1')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-footer-1',
                                'menu_id'        => 'menu-footer-1',
                                'container'      => false,
                                'items_wrap'     => '<ul id="%1$s">%3$s</ul>',
                            )
                        );
                    } else {
                        // Fallback menu
                        if (function_exists('home_url')) {
                            $home_link = esc_url(home_url('/'));
                            $clients_link = esc_url(home_url('/clients'));
                            $services_link = esc_url(home_url('/services'));
                            $contact_link = esc_url(home_url('/contact'));
                        } else {
                            $base = 'http://' . $_SERVER['HTTP_HOST'];
                            $home_link = htmlspecialchars($base . '/index.php', ENT_QUOTES, 'UTF-8');
                            $clients_link = htmlspecialchars($base . '/clients.php', ENT_QUOTES, 'UTF-8');
                            $services_link = htmlspecialchars($base . '/services.php', ENT_QUOTES, 'UTF-8');
                            $contact_link = htmlspecialchars($base . '/contact.php', ENT_QUOTES, 'UTF-8');
                        }
                        ?>
                        <ul id="menu-footer-1">
                            <li><a href="<?php echo $home_link; ?>">Accueil</a></li>
                            <li><a href="<?php echo $clients_link; ?>">Nos clients</a></li>
                            <li><a href="<?php echo $services_link; ?>">Nos services</a></li>
                            <li><a href="<?php echo $contact_link; ?>">Contact</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <div class="footer-col">
                    <h4>Services</h4>
                    <?php
                    // Menu Services avec fallback
                    if (function_exists('wp_nav_menu') && function_exists('has_nav_menu') && has_nav_menu('menu-footer-2')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-footer-2',
                                'menu_id'        => 'menu-footer-2',
                                'container'      => false,
                                'items_wrap'     => '<ul id="%1$s">%3$s</ul>',
                            )
                        );
                    } else {
                        // Fallback menu Services
                        ?>
                        <ul id="menu-footer-2">
                            <li><a href="<?php echo function_exists('home_url') ? esc_url(home_url('/services')) : '/services.php'; ?>">Photo et vidéos</a></li>
                            <li><a href="<?php echo function_exists('home_url') ? esc_url(home_url('/services')) : '/services.php'; ?>">Créations graphique</a></li>
                            <li><a href="<?php echo function_exists('home_url') ? esc_url(home_url('/services')) : '/services.php'; ?>">Sponsoring et mécénat</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
                
                <div class="footer-col">
                    <h4>Contact</h4>
                    <?php
                    // Menu Contact avec fallback
                    if (function_exists('wp_nav_menu') && function_exists('has_nav_menu') && has_nav_menu('menu-footer-3')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'menu-footer-3',
                                'menu_id'        => 'menu-footer-3',
                                'container'      => false,
                                'items_wrap'     => '<ul id="%1$s">%3$s</ul>',
                            )
                        );
                    } else {
                        // Fallback menu Contact
                        $email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'Contact@impulse-club.fr';
                        $phone = defined('CONTACT_PHONE') ? CONTACT_PHONE : '06 89 61 15 25';
                        ?>
                        <ul id="menu-footer-3">
                            <li><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                            <li><a href="tel:<?php echo str_replace(' ', '', $phone); ?>"><?php echo $phone; ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <div class="copyright">
                <?php echo date('Y'); ?> - Impulse club - Tout droit réservé
            </div>
        </div>
    </footer>

</div><!-- #page -->

</body>
</html>