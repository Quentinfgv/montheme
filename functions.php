<?php

/**
 * Impulse V2 - Functions
 * Configuration du thème WordPress
 */


// === SHORTCODES POUR L'ÉDITION DE CONTENU ===

// Shortcode pour insérer du contenu personnalisé dans la page d'accueil
function impulse_custom_content_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'class' => '',
        'style' => ''
    ), $atts);
    
    $output = '<div class="custom-content ' . esc_attr($atts['class']) . '"';
    if (!empty($atts['style'])) {
        $output .= ' style="' . esc_attr($atts['style']) . '"';
    }
    $output .= '>';
    $output .= do_shortcode($content);
    $output .= '</div>';
    
    return $output;
}
add_shortcode('impulse_content', 'impulse_custom_content_shortcode');

// Shortcode pour insérer une section personnalisée
function impulse_section_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'background' => '#ffffff',
        'padding' => '80px 0',
        'class' => ''
    ), $atts);
    
    $style = 'background-color: ' . esc_attr($atts['background']) . '; padding: ' . esc_attr($atts['padding']) . ';';
    
    $output = '<section class="impulse-custom-section ' . esc_attr($atts['class']) . '" style="' . $style . '">';
    $output .= '<div class="container">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    $output .= '</section>';
    
    return $output;
}
add_shortcode('impulse_section', 'impulse_section_shortcode');

// Shortcode pour insérer du HTML personnalisé (permet l'ajout de code)
function impulse_html_shortcode($atts, $content = null) {
    // Permet l'exécution de HTML brut
    return do_shortcode($content);
}
add_shortcode('impulse_html', 'impulse_html_shortcode');

// Permettre l'exécution de shortcodes dans les widgets
add_filter('widget_text', 'do_shortcode');

// Permettre l'exécution de shortcodes dans les extraits
add_filter('the_excerpt', 'do_shortcode');

// Permettre l'ajout de code personnalisé dans l'éditeur (pour Yoast SEO et autres)
// Cette fonction permet d'exécuter du code PHP via un shortcode sécurisé
function impulse_exec_code_shortcode($atts, $content = null) {
    // ATTENTION: Cette fonction permet l'exécution de code PHP
    // À utiliser uniquement par des administrateurs de confiance
    if (!current_user_can('manage_options')) {
        return '<!-- Accès refusé -->';
    }
    
    // Nettoyer le contenu
    $content = trim($content);
    
    // Si le contenu commence par <?php, l'exécuter
    if (strpos($content, '<?php') === 0) {
        ob_start();
        eval('?>' . $content);
        return ob_get_clean();
    }
    
    // Sinon, retourner le contenu tel quel
    return do_shortcode($content);
}
// DÉCOMMENTEZ LA LIGNE SUIVANTE UNIQUEMENT SI VOUS VOULEZ PERMETTRE L'EXÉCUTION DE CODE PHP
// add_shortcode('impulse_exec', 'impulse_exec_code_shortcode');

// Fonction pour afficher le contenu de la page d'accueil dans front-page.php
function impulse_display_homepage_content() {
    if (is_front_page() && have_posts()) {
        while (have_posts()) {
            the_post();
            $content = get_the_content();
            if (!empty($content)) {
                echo '<div class="homepage-editable-content">';
                echo apply_filters('the_content', $content);
                echo '</div>';
            }
        }
    }
}

// Permettre l'exécution de HTML/JavaScript dans l'éditeur WordPress pour toutes les pages
// Cette fonction permet d'ajouter du code personnalisé via l'éditeur de code de Yoast SEO
function impulse_allow_html_in_content($content) {
    // Permettre l'exécution de HTML brut sur toutes les pages avec template personnalisé
    if (is_front_page() ||
        is_page_template('front-page.php') || 
        is_page_template('index.php') ||
        is_page_template('clients.php') || 
        is_page_template('contact.php') ||
        is_page_template('services.php') ||
        is_page_template('template-clients.php') ||
        is_page_template('template-services.php') ||
        is_page_template('template-contact.php')) {
        // Ne pas filtrer le HTML pour permettre l'ajout de code personnalisé
        // Le contenu sera affiché tel quel avec apply_filters('the_content')
        return $content;
    }
    return $content;
}
add_filter('the_content', 'impulse_allow_html_in_content', 1);

// Désactiver le filtrage HTML pour les administrateurs sur les pages avec template personnalisé
function impulse_disable_kses_for_custom_pages($content) {
    if (current_user_can('manage_options') && 
        (is_front_page() ||
         is_page_template('front-page.php') || 
         is_page_template('index.php') ||
         is_page_template('clients.php') || 
         is_page_template('contact.php') ||
         is_page_template('services.php') ||
         is_page_template('template-clients.php') ||
         is_page_template('template-services.php') ||
         is_page_template('template-contact.php'))) {
        // Permettre tous les tags HTML pour les administrateurs
        remove_filter('the_content', 'wp_kses_post');
    }
    return $content;
}
add_filter('the_content', 'impulse_disable_kses_for_custom_pages', 0);

// === SYSTÈME DE SYNCHRONISATION DU CONTENU PHP VERS WORDPRESS ===

// Fonction pour initialiser le contenu WordPress avec les valeurs par défaut des templates PHP
function impulse_init_page_content($post_id = null) {
    // Vérifier que nous sommes dans un contexte WordPress valide
    if (!function_exists('get_post_meta') || !function_exists('get_page_template_slug')) {
        return;
    }
    
    // Si aucun ID n'est fourni, essayer de le récupérer depuis la requête actuelle
    if ($post_id === null) {
        global $post;
        if (isset($post) && isset($post->ID)) {
            $post_id = $post->ID;
        } else {
            return;
        }
    }
    
    // Vérifier que l'ID est valide
    if (empty($post_id) || !is_numeric($post_id)) {
        return;
    }
    
    // Ne s'exécute que lors de la première création de la page
    if (get_post_meta($post_id, '_impulse_content_initialized', true)) {
        return;
    }
    
    $template = get_page_template_slug($post_id);
    $content = '';
    
    // Contenu par défaut selon le template
    if ($template === 'front-page.php' || is_front_page()) {
        $content = '<h1>Mon titre personnalisé</h1>
<p>Mon contenu personnalisé</p>

[impulse_section background="#ffffff" padding="60px 0"]
Votre contenu personnalisé ici
[/impulse_section]';
    } elseif ($template === 'services.php') {
        $content = '<h1>NOS SERVICES</h1>
<p>Stratégie, création et activation : découvrez l\'ensemble de nos services pensés pour faire rayonner les acteurs du sport.</p>

[impulse_section background="#ffffff" padding="60px 0"]
Votre contenu personnalisé ici
[/impulse_section]';
    } elseif ($template === 'clients.php') {
        $content = '<h1>NOS CLIENTS</h1>
<p>Clubs, marques, athlètes ou Institutions : ils nous font confiance. Découvrez les clients qui partagent notre vision du sport et de la performance.</p>

[impulse_section background="#ffffff" padding="60px 0"]
Votre contenu personnalisé ici
[/impulse_section]';
    } elseif ($template === 'contact.php') {
        $content = '<h1>CONTACTEZ-NOUS !</h1>
<p>Un projet, une idée ou une ambition sportive ? Contactez-nous et donnons ensemble de l\'élan à votre communication.</p>

[impulse_section background="#ffffff" padding="60px 0"]
Votre contenu personnalisé ici
[/impulse_section]';
    }
    
    // Si le contenu de la page est vide, initialiser avec le contenu par défaut
    $current_content = get_post_field('post_content', $post_id);
    if (empty(trim($current_content)) && !empty($content)) {
        // Utiliser wp_update_post de manière sécurisée
        $update_data = array(
            'ID' => $post_id,
            'post_content' => $content
        );
        // Éviter les boucles infinies en désactivant temporairement le hook
        remove_action('save_post', 'impulse_init_page_content');
        wp_update_post($update_data);
        add_action('save_post', 'impulse_init_page_content');
        update_post_meta($post_id, '_impulse_content_initialized', true);
    }
}
add_action('save_post', 'impulse_init_page_content');

// Fonction pour afficher le contenu WordPress dans les templates
function impulse_display_wordpress_content() {
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $content = get_the_content();
            if (!empty($content)) {
                echo '<section class="wordpress-editable-content">';
                echo '<div class="container">';
                echo apply_filters('the_content', $content);
                echo '</div>';
                echo '</section>';
            }
        }
        wp_reset_postdata();
    }
}

// Fonction pour récupérer le titre de la page depuis WordPress
function impulse_get_page_title() {
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $title = get_the_title();
            wp_reset_postdata();
            return $title;
        }
    }
    return '';
}

// Fonction pour récupérer le contenu de la page depuis WordPress
function impulse_get_page_content() {
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $content = get_the_content();
            wp_reset_postdata();
            return $content;
        }
    }
    return '';
}

// Ajouter des styles CSS pour le contenu éditable WordPress
function impulse_add_editable_content_styles() {
    ?>
    <style>
    .wordpress-editable-content {
        padding: 80px 0;
        background-color: #ffffff;
    }
    .wordpress-editable-content .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .wordpress-editable-content h1,
    .wordpress-editable-content h2,
    .wordpress-editable-content h3,
    .wordpress-editable-content h4 {
        color: #1B3083;
        margin-bottom: 20px;
        font-weight: 900;
    }
    .wordpress-editable-content h1 {
        font-size: 3.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .wordpress-editable-content h2 {
        font-size: 2.5rem;
        text-transform: uppercase;
    }
    .wordpress-editable-content p {
        line-height: 1.8;
        margin-bottom: 15px;
        color: #333;
        font-size: 1.1rem;
    }
    .wordpress-editable-content code {
        background: #f5f5f5;
        padding: 2px 6px;
        border-radius: 3px;
        font-family: monospace;
    }
    .wordpress-editable-content pre {
        background: #f5f5f5;
        padding: 20px;
        border-radius: 10px;
        overflow-x: auto;
        margin-bottom: 20px;
    }
    .wordpress-editable-content pre code {
        background: none;
        padding: 0;
    }
    </style>
    <?php
}
add_action('wp_head', 'impulse_add_editable_content_styles');


