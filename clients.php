<?php
/**
 * Template Name: Clients
 * 
 * @package theme-inpulse
 */

get_header();

// Afficher le contenu WordPress (éditable par les SEO)
// Récupérer le contenu de la page de manière sécurisée
global $post;
if (isset($post) && isset($post->ID) && function_exists('get_post')) {
    $page_post = get_post($post->ID);
    if ($page_post && !empty(trim($page_post->post_content))) {
        $wp_content = $page_post->post_content;
        echo '<section class="wordpress-editable-content" style="padding: 80px 0; background-color: #ffffff;">';
        echo '<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">';
        echo apply_filters('the_content', $wp_content);
        echo '</div>';
        echo '</section>';
    }
}

// --- DONNÉES DE LA PAGE (Modifiable ici) ---

// 1. Tableau des logos partenaires (Hero)
$logos = [
    ["file" => "logo-courbevoie.png", "alt" => "Courbevoie Handball"],
    ["file" => "logo-93handball.png", "alt" => "93 Handball"],
    ["file" => "logo-rosny.png", "alt" => "Rosny Handball"],
    ["file" => "logo-vhb.png", "alt" => "VHB"],
    ["file" => "logo-csd-ffhb.png", "alt" => "Comité Seine Saint Denis"],
    ["file" => "logo-mhb.png", "alt" => "MHB"]
];

// 2. Tableau des cartes projets (Grille)
$projects = [
    [
        "badge" => "Montreuil",
        "img"   => "projet-montreuil.jpg",
        "desc"  => "Gestion complète de l'identité visuelle du club de Montreuil : Visuels, réseaux sociaux, photos et vidéos.",
        "alt"   => "Équipe de Montreuil"
    ],
    [
        "badge" => "Rosny",
        "img"   => "projet-rosny.jpg",
        "desc"  => "Gestion de la production photographique pour le club de Rosny.",
        "alt"   => "Joueurs de Rosny"
    ],
    [
        "badge" => "CDHB93",
        "img"   => "projet-cdhb93.jpg",
        "desc"  => "Production et gestion des contenus visuels du Comité 93 lors des tournois (photos, vidéos, visuels et stories).",
        "alt"   => "Comité 93 Handball"
    ],
    [
        "badge" => "Courbevoie",
        "img"   => "projet-courbevoie.jpg",
        "desc"  => "Création de visuels et production photo pour le club de Courbevoie.",
        "alt"   => "Club de Courbevoie"
    ],
    [
        "badge" => "FC93",
        "img"   => "projet-fc93.jpg",
        "desc"  => "Définition de l'identité visuelle du FC93 et réalisation des visuels de match.",
        "alt"   => "Joueur du FC93"
    ],
    [
        "badge" => "Villemomble",
        "img"   => "projet-villemomble.jpg",
        "desc"  => "Gestion des visuels et des contenus photo du club de Villemomble.",
        "alt"   => "Équipe de Villemomble"
    ]
];
?>

<style>
/* === PAGE CLIENTS CSS === */

/* --- VARIABLES & RESET --- */
:root {
    --blue: #1B3083;
    --green: #11DD9E;
    --text-dark: #1a1a1a;
    --text-light: #ffffff;
    --bg-light: #F5F7FA;
}

/* --- HERO --- */
.hero {
    text-align: center;
    padding: 140px 0 60px;
    background: linear-gradient(180deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1));
    color: #ffffff;
    position: relative;
}

.hero h1 {
    font-size: 3.5rem;
    text-transform: uppercase;
    margin-bottom: 20px;
    letter-spacing: 2px;
    color: #11dd9e;
    font-weight: 900;
}

.hero-text {
    max-width: 700px;
    margin: 0 auto 50px;
    color: #ccc;
    font-size: 1rem;
    opacity: 0.95;
}

/* Bandeau Logos */
.logos-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
    padding: 0 20px;
}

.client-logo {
    height: 55px;
    width: auto;
    filter: brightness(0) invert(1);
    opacity: 0.9;
    transition: opacity 0.3s;
}

.client-logo:hover {
    opacity: 1;
}

/* --- GRILLE PROJETS --- */
.projects-section {
    padding: 80px 0;
    background-color: #fff;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.project-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
    height: 100%;
}

.project-card:hover {
    transform: translateY(-5px);
}

.card-img-wrapper {
    position: relative;
    height: 240px;
    width: 100%;
}

.card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: #11dd9e;
    color: #1a1a1a;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    font-family: 'Montserrat', sans-serif;
}

.card-content {
    padding: 25px;
    flex-grow: 1;
}

.card-content p {
    font-size: 0.95rem;
    color: #333;
    line-height: 1.6;
    font-weight: 500;
}

/* --- CTA BANNER --- */
.cta-banner {
    background: linear-gradient(135deg, #A8EED8 0%, #8AE6C7 100%);
    color: #1B3083;
    text-align: center;
    padding: 80px 20px;
}

.cta-banner h2 {
    font-size: 2.2rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 900;
    line-height: 1.2;
    color: #1B3083;
}

.cta-banner p {
    margin-bottom: 30px;
    font-weight: 600;
    font-size: 1.05rem;
    color: #1B3083;
}

.btn-cta {
    display: inline-block;
    padding: 15px 40px;
    border-radius: 50px;
    font-weight: 800;
    text-transform: uppercase;
    font-size: 0.9rem;
    background-color: #1B3083;
    color: #fff;
    text-decoration: none;
    transition: 0.3s;
    border: none;
    cursor: pointer;
}

.btn-cta:hover {
    transform: scale(1.05);
}

/* Zone de contenu éditable depuis l'éditeur WordPress */
.editable-content-zone {
    padding: 80px 0;
    background-color: #ffffff;
}
.editable-content-zone .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.editable-content-zone h1,
.editable-content-zone h2,
.editable-content-zone h3,
.editable-content-zone h4 {
    color: #1B3083;
    margin-bottom: 20px;
}
.editable-content-zone p {
    line-height: 1.8;
    margin-bottom: 15px;
    color: #333;
}
.editable-content-zone code {
    background: #f5f5f5;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: monospace;
}
.editable-content-zone pre {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    overflow-x: auto;
    margin-bottom: 20px;
}
.editable-content-zone pre code {
    background: none;
    padding: 0;
}

/* --- RESPONSIVE --- */
@media (max-width: 1024px) {
    .projects-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .hero h1 {
        font-size: 2.8rem;
    }

    .logos-row {
        gap: 25px;
    }
}

@media (max-width: 768px) {
    .projects-grid {
        grid-template-columns: 1fr;
    }

    .hero h1 {
        font-size: 2.2rem;
    }

    .hero-text {
        font-size: 0.9rem;
        padding: 0 10px;
    }

    .logos-row {
        gap: 20px;
    }

    .client-logo {
        height: 45px;
    }
}
</style>

<section class="hero">
    <div class="container">
        <h1>NOS CLIENTS</h1>
        <p class="hero-text">Clubs, marques, athlètes ou Institutions : ils nous font confiance. Découvrez les clients qui partagent notre vision du sport et de la performance.</p>

        <div class="logos-row">
            <?php foreach($logos as $logo): ?>
                <img src="<?php echo get_template_directory_uri() . '/img/' . $logo['file']; ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="client-logo">
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="projects-section">
    <div class="container">
        <div class="projects-grid">
            <?php foreach($projects as $project): ?>
                <article class="project-card">
                    <div class="card-img-wrapper">
                        <img src="<?php echo get_template_directory_uri() . '/img/' . $project['img']; ?>" alt="<?php echo esc_attr($project['alt']); ?>">
                        <span class="badge"><?php echo esc_html($project['badge']); ?></span>
                    </div>
                    <div class="card-content">
                        <p><?php echo esc_html($project['desc']); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="cta-banner">
    <div class="container">
        <h2>PRÊT À LANCER VOTRE<br>PROJET ?</h2>
        <p>Rejoignez les marques sportives qui nous font confiance</p>
        <a href="<?php echo function_exists('home_url') ? esc_url(home_url('/contact')) : '/contact.php'; ?>" class="btn-cta">Contactez-nous</a>
    </div>
</section>

<?php get_footer(); ?>