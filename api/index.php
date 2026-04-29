<?php
/**
 * Index.php - Point d'entrée principal
 * Gère le routage des pages si WordPress n'est pas configuré
 */

// Vérifier si WordPress est chargé
if (!function_exists('get_header')) {
    // WordPress n'est pas chargé, gérer le routage manuellement
    $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $request_uri = trim(parse_url($request_uri, PHP_URL_PATH), '/');
    
    // Routes disponibles
    $routes = array(
        'clients' => 'clients.php',
        'services' => 'services.php',
        'contact' => 'contact.php'
    );
    
    // Vérifier si on demande une route spécifique
    foreach ($routes as $route => $template) {
        if ($request_uri === $route || $request_uri === $route . '/') {
            $template_path = __DIR__ . '/' . $template;
            if (file_exists($template_path)) {
                // Simuler un environnement WordPress minimal
                if (!defined('ABSPATH')) {
                    define('ABSPATH', __DIR__ . '/');
                }
                include($template_path);
                exit;
            }
        }
    }
    
    // Si aucune route ne correspond, charger la page d'accueil
    if (file_exists(__DIR__ . '/front-page.php')) {
        include(__DIR__ . '/front-page.php');
        exit;
    }
}

// WordPress est chargé, utiliser le système WordPress normal
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        // Your loop code
    endwhile;
else :
    echo 'toto';
endif;

get_footer();
?>