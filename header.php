<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme-inpulse
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <style>
        /* === HEADER CSS === */
        
        /* Variables CSS */
        :root {
            --dark-blue: #050A19;
            --mint-green: #11DD9E;
            --white: #ffffff;
        }
        
        /* Header principal - Background adaptatif selon la page */
        header,
        #masthead,
        .site-header {
            <?php
            // Détecter la page et adapter le background selon la première section
            $header_bg = 'linear-gradient(135deg, #010D3B 0%, #1B3083 100%)'; // Par défaut
            
            if (is_front_page() || is_home()) {
                // Page d'accueil : header transparent pour intégration dans la section hero
                $header_bg = 'transparent';
            } elseif (is_page_template('services.php') || (function_exists('is_page') && is_page('services'))) {
                // Page Services : même dégradé que la section hero
                $header_bg = 'linear-gradient(180deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1))';
            } elseif (is_page_template('clients.php') || (function_exists('is_page') && is_page('clients'))) {
                // Page Clients : même dégradé que la section hero
                $header_bg = 'linear-gradient(180deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1))';
            } elseif (is_page_template('contact.php') || (function_exists('is_page') && is_page('contact'))) {
                // Page Contact : même dégradé que la section hero
                $header_bg = 'linear-gradient(135deg, rgba(1, 13, 59, 1) 0%, rgba(27, 48, 131, 1) 50%, rgba(17, 221, 158, 0.3) 100%)';
            }
            ?>
            background: <?php echo $header_bg; ?> !important;
            padding: <?php echo (is_front_page() || is_home()) ? '30px 0' : '25px 0'; ?> !important;
            position: <?php echo (is_front_page() || is_home()) ? 'absolute' : 'sticky'; ?> !important;
            top: <?php echo (is_front_page() || is_home()) ? '20px' : '0'; ?> !important;
            left: 0;
            right: 0;
            z-index: <?php echo (is_front_page() || is_home()) ? '10000' : '9999'; ?> !important;
            margin-top: 0 !important;
            width: 100% !important;
            margin: 0 !important;
            display: block !important;
            box-shadow: <?php echo (is_front_page() || is_home()) ? 'none' : '0 2px 10px rgba(0, 0, 0, 0.1)'; ?> !important;
        }
        
        /* Header transparent sur la page d'accueil - intégration dans l'image */
        <?php if (is_front_page() || is_home()): ?>
        /* Logo avec effet de fusion */
        header .site-branding .logo,
        #masthead .site-branding .logo,
        .site-header .site-branding .logo {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
            opacity: 0.95;
        }
        
        /* Navigation avec effet de fusion */
        header .main-navigation ul li a,
        #masthead .main-navigation ul li a,
        .site-header .main-navigation ul li a {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6), 0 1px 2px rgba(0, 0, 0, 0.4);
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 5px;
        }
        
        header .main-navigation ul li a:hover,
        header .main-navigation ul li a:focus,
        #masthead .main-navigation ul li a:hover,
        #masthead .main-navigation ul li a:focus,
        .site-header .main-navigation ul li a:hover,
        .site-header .main-navigation ul li a:focus {
            background: var(--mint-green) !important;
            color: var(--dark-blue) !important;
            text-shadow: none !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(17, 221, 158, 0.4);
            font-weight: 700;
            outline: none;
        }
        
        header .main-navigation ul li a.active,
        #masthead .main-navigation ul li a.active,
        .site-header .main-navigation ul li a.active,
        header .main-navigation .current-menu-item > a,
        #masthead .main-navigation .current-menu-item > a,
        .site-header .main-navigation .current-menu-item > a {
            background: var(--mint-green) !important;
            color: var(--dark-blue) !important;
            text-shadow: none !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(17, 221, 158, 0.3);
        }
        
        /* Bouton actif avec effet de fusion */
        header .main-navigation ul li a.btn-nav,
        #masthead .main-navigation ul li a.btn-nav,
        .site-header .main-navigation ul li a.btn-nav {
            background: rgba(17, 221, 158, 0.2) !important;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(17, 221, 158, 0.4);
        }
        
        header .main-navigation ul li a.btn-nav:hover,
        #masthead .main-navigation ul li a.btn-nav:hover,
        .site-header .main-navigation ul li a.btn-nav:hover {
            background: rgba(17, 221, 158, 0.3) !important;
            border-color: rgba(17, 221, 158, 0.6);
        }
        
        /* Légère transparence du header pour fusionner avec l'image */
        header::before,
        #masthead::before,
        .site-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, transparent 100%);
            pointer-events: none;
            z-index: -1;
        }
        <?php endif; ?>
        
        /* Skip link pour accessibilité */
        .skip-link {
            position: absolute;
            left: -9999px;
            z-index: 999999;
        }
        
        .skip-link:focus {
            left: 6px;
            top: 7px;
            background: var(--mint-green);
            color: var(--dark-blue);
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
        }
        
        /* Container du header */
        header .container,
        #masthead .container,
        .site-header .container {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            flex-wrap: nowrap !important;
            max-width: 1200px !important;
            margin: 0 auto !important;
            padding: 0 20px !important;
        }
        
        /* Site branding (Logo) */
        .site-branding {
            display: flex;
            align-items: center;
        }
        
        .site-branding .logo {
            height: 35px;
            width: auto;
            max-height: 35px;
            display: block;
            transition: opacity 0.3s;
        }
        
        .site-branding .logo:hover {
            opacity: 0.8;
        }
        
        .site-branding a {
            display: inline-block;
            text-decoration: none;
        }
        
        /* Navigation principale */
        .main-navigation,
        #site-navigation {
            display: flex;
            align-items: center;
        }
        
        /* Menu toggle (Hamburger) */
        .menu-toggle {
            display: none;
            background: transparent;
            border: 2px solid var(--white);
            color: var(--white);
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s;
            font-family: 'Montserrat', sans-serif;
        }
        
        .menu-toggle:hover,
        .menu-toggle:focus {
            background: var(--mint-green);
            border-color: var(--mint-green);
            color: var(--dark-blue);
            outline: none;
        }
        
        .menu-toggle[aria-expanded="true"] {
            background: var(--mint-green);
            border-color: var(--mint-green);
            color: var(--dark-blue);
        }
        
        /* Menu principal */
        #primary-menu,
        .main-navigation ul,
        .main-navigation .menu {
            display: flex !important;
            list-style: none !important;
            gap: 30px;
            margin: 0 !important;
            padding: 0 !important;
            flex-wrap: wrap;
            align-items: center;
        }
        
        #primary-menu li,
        .main-navigation ul li,
        .main-navigation .menu li {
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
            display: list-item !important;
        }
        
        #primary-menu a,
        .main-navigation a,
        .main-navigation .menu a {
            color: var(--white) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 5px;
            transition: all 0.3s;
            text-decoration: none !important;
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
        }
        
        #primary-menu a:hover,
        #primary-menu a:focus,
        .main-navigation a:hover,
        .main-navigation a:focus,
        .main-navigation .menu a:hover {
            background: var(--mint-green) !important;
            color: var(--dark-blue) !important;
            outline: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(17, 221, 158, 0.4);
            font-weight: 700;
        }
        
        #primary-menu a.active,
        .main-navigation a.active,
        .main-navigation .menu a.active {
            background: var(--mint-green) !important;
            color: var(--dark-blue) !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(17, 221, 158, 0.3);
        }
        
        #primary-menu .current-menu-item > a,
        #primary-menu .current_page_item > a,
        .main-navigation .current-menu-item > a,
        .main-navigation .current_page_item > a {
            background: var(--mint-green) !important;
            color: var(--dark-blue) !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(17, 221, 158, 0.3);
        }
        
        /* Responsive - Menu mobile */
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            #primary-menu,
            .main-navigation ul,
            .main-navigation .menu {
                display: none !important;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #010D3B 0%, #1B3083 100%);
                flex-direction: column;
                padding: 20px;
                gap: 0;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                border-top: 2px solid var(--mint-green);
            }
            
            .menu-toggle[aria-expanded="true"] + #primary-menu,
            .menu-toggle[aria-expanded="true"] ~ #primary-menu,
            .main-navigation.toggled #primary-menu,
            .main-navigation.toggled ul,
            .main-navigation.toggled .menu {
                display: flex !important;
            }
            
            #primary-menu li,
            .main-navigation ul li,
            .main-navigation .menu li {
                width: 100%;
                text-align: center;
            }
            
            #primary-menu a,
            .main-navigation a,
            .main-navigation .menu a {
                display: block;
                padding: 15px;
                width: 100%;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            #primary-menu a:last-child,
            .main-navigation a:last-child,
            .main-navigation .menu a:last-child {
                border-bottom: none;
            }
        }
        
        /* === FOOTER CSS === */
        
        /* Footer principal */
        footer,
        #colophon,
        .site-footer {
            background: linear-gradient(135deg, #010D3B 0%, #1B3083 100%) !important;
            color: var(--white) !important;
            padding: 60px 20px 20px !important;
            border-top: 3px solid var(--mint-green) !important;
            width: 100% !important;
            margin: 0 !important;
        }
        
        /* Grille du footer */
        .footer-grid {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 40px !important;
            margin-bottom: 40px !important;
            max-width: 1200px !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
        
        /* Colonnes du footer */
        .footer-col {
            display: flex;
            flex-direction: column;
        }
        
        .footer-col .logo {
            height: auto;
            max-height: 35px;
            width: auto;
            display: block;
            margin-bottom: 20px;
        }
        
        .footer-col h4 {
            color: var(--mint-green) !important;
            margin-bottom: 20px !important;
            font-size: 1.2rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            font-family: 'Montserrat', sans-serif !important;
        }
        
        /* Menus du footer */
        .footer-col ul {
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .footer-col ul li {
            margin-bottom: 10px !important;
            padding: 0 !important;
        }
        
        .footer-col ul li a {
            color: var(--white) !important;
            text-decoration: none !important;
            transition: color 0.3s !important;
            font-size: 0.95rem !important;
            display: inline-block !important;
        }
        
        .footer-col ul li a:hover {
            color: var(--mint-green) !important;
        }
        
        /* Copyright */
        .copyright {
            text-align: center !important;
            padding-top: 30px !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            opacity: 0.7 !important;
            font-size: 0.9rem !important;
            color: var(--white) !important;
            max-width: 1200px !important;
            margin: 0 auto !important;
        }
        
        /* Responsive Footer */
        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 30px !important;
            }
        }
        
        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr !important;
                gap: 30px !important;
                text-align: center !important;
            }
            
            .footer-col {
                align-items: center !important;
            }
            
            .footer-col h4 {
                text-align: center !important;
            }
            
            .footer-col ul {
                text-align: center !important;
            }
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php 
if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php 
        if (function_exists('esc_html_e')) {
            esc_html_e('Skip to content', 'theme-inpulse');
        } else {
            echo 'Skip to content';
        }
    ?></a>
    
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-impulse.png" alt="Impulse Logo" class="logo">
                </a>
            </div>
            
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    Menu
                </button>
                
                <?php
                // Afficher le menu WordPress si configuré, sinon utiliser le menu de fallback
                $menu_displayed = false;
                if (function_exists('wp_nav_menu') && function_exists('has_nav_menu')) {
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'container'      => false,
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            )
                        );
                        $menu_displayed = true;
                    }
                }
                
                // Si aucun menu WordPress n'a été affiché, utiliser le menu de fallback
                if (!$menu_displayed) {
                    // Déterminer la page actuelle
                    $current_page = '';
                    if (isset($_SERVER['REQUEST_URI'])) {
                        $uri = $_SERVER['REQUEST_URI'];
                        if (strpos($uri, '/clients') !== false || strpos($uri, 'clients.php') !== false) {
                            $current_page = 'clients';
                        } elseif (strpos($uri, '/services') !== false || strpos($uri, 'services.php') !== false) {
                            $current_page = 'services';
                        } elseif (strpos($uri, '/contact') !== false || strpos($uri, 'contact.php') !== false) {
                            $current_page = 'contact';
                        } else {
                            $current_page = 'home';
                        }
                    }
                    
                    // Générer les URLs avec fallback
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
                    <ul id="primary-menu" class="menu">
                        <li><a href="<?php echo $home_link; ?>" <?php echo ($current_page === 'home') ? 'class="active" aria-current="page"' : ''; ?>>Accueil</a></li>
                        <li><a href="<?php echo $clients_link; ?>" <?php echo ($current_page === 'clients') ? 'class="active" aria-current="page"' : ''; ?>>Nos clients</a></li>
                        <li><a href="<?php echo $services_link; ?>" <?php echo ($current_page === 'services') ? 'class="active" aria-current="page"' : ''; ?>>Nos services</a></li>
                        <li><a href="<?php echo $contact_link; ?>" <?php echo ($current_page === 'contact') ? 'class="active" aria-current="page"' : ''; ?>>Contact</a></li>
                    </ul>
                    <?php
                }
                ?>
            </nav>
        </div>
    </header>
    
    <div id="content" class="site-content">