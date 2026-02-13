<?php
/**
 * Template Name: Services
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

// 1. Les Services
$services = [
    [
        'titre' => 'STRATÉGIE DE MARQUE',
        'intro' => 'Nous créons des identités de marque fortes et différenciantes pour les acteurs du sport.',
        'desc'  => 'De la définition du positionnement à la création de l\'identité visuelle, nous construisons des marques qui résonnent avec leur audience.',
        'liste' => ['Audit de marque', 'Positionnement stratégique', 'Identité visuelle complète', 'Charte graphique', 'Guidelines de marque'],
        'image' => get_template_directory_uri() . '/img/projet-courbevoie.jpg',
        'sens'  => 'normal'
    ],
    [
        'titre' => 'COMMUNICATION DIGITALE',
        'intro' => 'Notre équipe développe et anime votre présence en ligne avec des contenus créatifs et engageants.',
        'desc'  => 'Nous gérons l\'ensemble de votre écosystème digital pour maximiser votre impact.',
        'liste' => ['Gestion des réseaux sociaux', 'Création de contenus', 'Community management', 'Stratégie d\'influence', 'Publicité digitale'],
        'image' => get_template_directory_uri() . '/img/projet-fc93.jpg',
        'sens'  => 'inverse'
    ]
];

// 2. Les Packs
$packs = [
    [
        'nom' => 'IDENTITÉ VISUELLE',
        'duree' => 'Sans engagement',
        'details' => '',
        'inclus' => ['Audit de marque', 'Logo & Déclinaisons', 'Charte Graphique', 'Cartes de visite'],
        'highlight' => false,
        'transparent' => false
    ],
    [
        'nom' => 'MEDIA PRO',
        'duree' => '10 mois de couverture',
        'details' => '(20% de commission)',
        'inclus' => ['Charte Graphique', 'Template Social Media', 'Création d\'identité de marque', '8 matchs avec photographe', '8 affiches de matchs', 'Stories de matchs'],
        'highlight' => true,
        'transparent' => true
    ],
    [
        'nom' => 'MEDIA PREMIUM',
        'duree' => '10 mois de couverture',
        'details' => '(20% de commission)',
        'inclus' => ['Tout le pack PRO', 'Vidéos highlights matchs', 'Interviews joueurs', 'Shooting photo officiel', 'Gestion complète Instagram'],
        'highlight' => false,
        'transparent' => true
    ]
];
?>

<style>
/* === PAGE SERVICES CSS === */

/* Container global pour cohérence */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* --- HERO --- */
.hero {
    text-align: center;
    padding: 140px 0 80px;
    background: linear-gradient(180deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1));
    color: #ffffff;
}

.hero h1 {
    font-size: 3.5rem;
    text-transform: uppercase;
    margin-bottom: 30px;
    letter-spacing: 2px;
    color: #11dd9e;
    font-weight: 900;
    line-height: 1.2;
}

.hero-text {
    max-width: 800px;
    margin: 0 auto;
    color: #ffffff;
    font-size: 1.1rem;
    line-height: 1.8;
}

/* --- SERVICES SECTION --- */
.services-section {
    padding: 80px 0;
    background-color: #ffffff;
}

.service-block {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 60px;
    margin-bottom: 120px;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    padding: 0 20px;
}

.service-block:last-child {
    margin-bottom: 0;
}

.service-block.inverse {
    flex-direction: row-reverse;
}

.service-content {
    flex: 1;
    min-width: 0;
}

.service-content h2 {
    font-size: 2.5rem;
    margin-bottom: 25px;
    text-transform: uppercase;
    border-left: 4px solid #11dd9e;
    padding-left: 20px;
    line-height: 1.2;
    color: #1B3083;
    font-weight: 900;
}

.service-content .intro {
    font-size: 1.15rem;
    margin-bottom: 20px;
    color: #1B3083;
    font-weight: 600;
    line-height: 1.7;
}

.service-content .desc {
    color: #444;
    margin-bottom: 30px;
    font-size: 1.05rem;
    line-height: 1.8;
    font-weight: 400;
}

.service-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.service-list li {
    margin-bottom: 12px;
    padding-left: 30px;
    position: relative;
    font-size: 1.05rem;
    line-height: 1.7;
    color: #2a2a2a;
    font-weight: 500;
}

.service-list li::before {
    content: '•';
    color: #11dd9e;
    position: absolute;
    left: 0;
    font-size: 1.8rem;
    line-height: 1rem;
    font-weight: bold;
}

.service-image {
    flex: 1;
    min-width: 0;
    display: flex;
    align-items: flex-start;
}

.service-image img {
    width: 100%;
    height: auto;
    min-height: 400px;
    max-height: 500px;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    object-fit: cover;
    display: block;
}

/* --- PACKS SECTION --- */
.packs-section {
    padding: 80px 0;
    background: linear-gradient(135deg, rgba(1, 13, 59, 1) 0%, rgba(27, 48, 131, 1) 50%, rgba(27, 48, 131, 0.95) 75%, rgba(15, 35, 100, 0.9) 100%);
    color: #ffffff;
}

.packs-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.packs-section h1 {
    color: #11dd9e;
    text-align: center;
    font-size: 3rem;
    text-transform: uppercase;
    margin-bottom: 20px;
    letter-spacing: 2px;
    font-weight: 900;
    line-height: 1.2;
}

.section-subtitle {
    text-align: center;
    color: #ffffff;
    margin-bottom: 60px;
    font-size: 1.1rem;
    opacity: 0.9;
}

.packs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    align-items: stretch;
}

.pack-card {
    background: #fff;
    color: #050A19;
    padding: 30px 25px;
    border-radius: 15px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.pack-card.transparent {
    background: transparent;
    border: 3px solid #11dd9e;
    color: #ffffff;
    box-shadow: 0 10px 30px rgba(17, 221, 158, 0.2);
}

.pack-card.transparent .pack-head h3 span,
.pack-card.transparent .pack-head h3 {
    color: #ffffff;
}

.pack-card.transparent .pack-head small {
    color: rgba(255, 255, 255, 0.8);
}

.pack-card.transparent .engagement-badge {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.pack-card.transparent .pack-body {
    border-top: 1px solid rgba(255, 255, 255, 0.3);
}

.pack-card.transparent .label-inclus {
    color: rgba(255, 255, 255, 0.7);
}

.pack-card.transparent .pack-body ul li {
    color: #ffffff;
}

.pack-card.transparent .btn-pack {
    border-color: #11dd9e;
    color: #11dd9e;
}

.pack-card.transparent:hover .btn-pack {
    background: #11dd9e;
    color: #ffffff;
}

.pack-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.pack-card.highlighted {
    border: 3px solid #11dd9e;
    box-shadow: 0 15px 35px rgba(17, 221, 158, 0.3);
}

.pack-card.transparent.highlighted {
    box-shadow: 0 15px 35px rgba(17, 221, 158, 0.4);
}

.pack-head {
    margin-bottom: 15px;
}

.pack-head h3 {
    font-size: 0.85rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
    font-weight: 600;
}

.pack-head h3 span {
    display: block;
    font-size: 1.5rem;
    font-weight: 900;
    color: #1B3083;
    margin: 12px 0;
    line-height: 1.2;
}

.pack-head small {
    color: #666;
    font-size: 0.8rem;
    display: block;
    margin-top: 4px;
}

.engagement-badge {
    background: #f0f0f0;
    padding: 6px 15px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.8rem;
    display: inline-block;
    margin-bottom: 6px;
    color: #1B3083;
}

.pack-body {
    margin: 25px 0;
    text-align: left;
    border-top: 1px solid #eee;
    padding-top: 20px;
    flex-grow: 1;
}

.label-inclus {
    font-size: 0.7rem;
    font-weight: 700;
    color: #888;
    margin-bottom: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.pack-body ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pack-body ul li {
    font-size: 0.9rem;
    margin-bottom: 10px;
    color: #333;
    line-height: 1.5;
    padding-left: 5px;
    font-weight: 400;
}

.btn-pack {
    display: block;
    padding: 12px 20px;
    border: 2px solid #1B3083;
    border-radius: 30px;
    font-weight: 800;
    text-decoration: none;
    color: #1B3083;
    transition: 0.3s;
    text-transform: uppercase;
    font-size: 0.85rem;
    margin-top: auto;
}

.pack-card:hover .btn-pack {
    background: #1B3083;
    color: #fff;
    transform: scale(1.02);
}

/* --- CTA BANNER --- */
.cta-banner {
    background: #11dd9e;
    color: #050A19;
    text-align: center;
    padding: 80px 20px;
}

.cta-banner h2 {
    font-size: 2.2rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 900;
    line-height: 1.2;
}

.cta-banner p {
    margin-bottom: 30px;
    font-weight: 600;
    font-size: 1.05rem;
}

.btn-cta {
    background: #050A19;
    color: #fff;
    padding: 15px 40px;
    border-radius: 30px;
    font-weight: 800;
    text-decoration: none;
    display: inline-block;
    transition: 0.3s;
    text-transform: uppercase;
    font-size: 0.9rem;
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
    .service-block {
        gap: 40px;
        margin-bottom: 80px;
    }
    
    .service-content h2 {
        font-size: 2.2rem;
    }
    
    .packs-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
    
    .packs-section h1 {
        font-size: 3rem;
    }
}

@media (max-width: 900px) {
    .hero {
        padding: 100px 0 60px;
    }
    
    .hero h1 {
        font-size: 2.8rem;
    }
    
    .service-block,
    .service-block.inverse {
        flex-direction: column;
        text-align: center;
        gap: 40px;
        margin-bottom: 80px;
    }

    .service-content {
        text-align: center;
    }

    .service-content h2 {
        border-left: none;
        border-bottom: 4px solid #11dd9e;
        padding-bottom: 15px;
        display: inline-block;
        padding-left: 0;
        margin-bottom: 20px;
    }
    
    .service-content .intro,
    .service-content .desc {
        text-align: left;
    }
    
    .service-list {
        text-align: left;
        display: inline-block;
    }

    .packs-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .pack-card.highlighted {
        transform: none;
    }
    
    .packs-section h1 {
        font-size: 2.2rem;
    }
}

@media (max-width: 768px) {
    .hero {
        padding: 80px 0 50px;
    }
    
    .hero h1 {
        font-size: 2.2rem;
    }
    
    .hero-text {
        font-size: 1rem;
        padding: 0 20px;
    }
    
    .services-section {
        padding: 60px 0;
    }
    
    .service-block {
        margin-bottom: 60px;
        padding: 0 15px;
    }
    
    .service-content h2 {
        font-size: 1.8rem;
    }
    
    .packs-section {
        padding: 60px 0;
    }
    
    .packs-section h1 {
        font-size: 2rem;
    }
    
    .cta-banner {
        padding: 60px 20px;
    }
    
    .cta-banner h2 {
        font-size: 1.8rem;
    }
}
</style>

<section class="hero">
    <div class="container">
        <h1>NOS SERVICES</h1>
        <p class="hero-text">Stratégie, création et activation : découvrez l'ensemble de nos services pensés pour faire rayonner les acteurs du sport.</p>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <?php foreach($services as $service): ?>
            <div class="service-block <?php echo ($service['sens'] === 'inverse') ? 'inverse' : ''; ?>">
                <div class="service-content">
                    <h2><?php echo esc_html($service['titre']); ?></h2>
                    <p class="intro"><?php echo esc_html($service['intro']); ?></p>
                    <p class="desc"><?php echo esc_html($service['desc']); ?></p>
                    
                    <ul class="service-list">
                        <?php foreach($service['liste'] as $item): ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="service-image">
                    <img src="<?php echo esc_url($service['image']); ?>" alt="<?php echo esc_attr($service['titre']); ?>">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="packs-section">
    <div class="container">
        <h1>NOS PACKS</h1>
        <p class="section-subtitle">Estimez le budget de votre projet en quelques clics</p>

        <div class="packs-grid">
            <?php foreach($packs as $pack): ?>
                <div class="pack-card <?php echo $pack['highlight'] ? 'highlighted' : ''; ?> <?php echo isset($pack['transparent']) && $pack['transparent'] ? 'transparent' : ''; ?>">
                    <div class="pack-head">
                        <h3>Le Pack<br><span><?php echo esc_html($pack['nom']); ?></span></h3>
                        <div class="engagement-badge">
                            <?php echo esc_html($pack['duree']); ?>
                        </div>
                        <?php if(!empty($pack['details'])): ?>
                            <small><?php echo esc_html($pack['details']); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="pack-body">
                        <p class="label-inclus">INCLUS DANS LE PACK</p>
                        <ul>
                            <?php foreach($pack['inclus'] as $feature): ?>
                                <li>→ <?php echo esc_html($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="pack-footer">
                        <a href="<?php echo function_exists('home_url') ? esc_url(home_url('/contact')) : '/contact.php'; ?>" class="btn-pack">En savoir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="cta-banner">
    <div class="container">
        <h2>PRÊT À LANCER VOTRE PROJET ?</h2>
        <p>Rejoignez les marques sportives qui nous font confiance</p>
        <a href="<?php echo function_exists('home_url') ? esc_url(home_url('/contact')) : '/contact.php'; ?>" class="btn-cta">Contactez-nous</a>
    </div>
</section>

<?php get_footer(); ?>