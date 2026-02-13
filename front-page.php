<?php
/**
 * Front Page Template
 * @package theme-inpulse
 */

get_header();

// Afficher le contenu WordPress (éditable par les SEO)
// Récupérer le contenu de la page d'accueil de manière sécurisée
$front_page_id = get_option('page_on_front');
if (!$front_page_id) {
    $front_page_id = get_option('page_for_posts');
}
if ($front_page_id && function_exists('get_post')) {
    $front_page = get_post($front_page_id);
    if ($front_page && !empty(trim($front_page->post_content))) {
        $wp_content = $front_page->post_content;
        echo '<section class="wordpress-editable-content" style="padding: 80px 0; background-color: #ffffff;">';
        echo '<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">';
        echo apply_filters('the_content', $wp_content);
        echo '</div>';
        echo '</section>';
    }
}

$services = [
    [
        'titre' => 'Photos et Vidéos.',
        'desc'  => 'Production de contenus photos et vidéos dynamiques pour valoriser l\'univers sportif, les performances et les émotions.',
        'svg'   => '<path d="M20,4H16.83L15,2H9L7.17,4H4A2,2 0 0,0 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6A2,2 0 0,0 20,4M20,18H4V6H8.05L9.88,4H14.12L15.95,6H20V18M12,7A5,5 0 1,0 17,12A5,5 0 0,0 12,7M12,15A3,3 0 1,1 15,12A3,3 0 0,1 12,15Z" />'
    ],
    [
        'titre' => 'Création Graphique.',
        'desc'  => 'Création de visuels percutants et sportifs pour renforcer l\'identité et l\'image de marque.',
        'svg'   => '<path d="M16.21,4.16L12.5,7.87L16.13,11.5L19.84,7.79C20.04,7.59 20.14,7.34 20.14,7.09C20.14,6.83 20.04,6.58 19.84,6.39L17.61,4.16C17.42,3.96 17.17,3.86 16.91,3.86C16.66,3.86 16.41,3.96 16.21,4.16M15.07,12.56L11.44,8.93L4.21,16.16C4.05,16.32 3.93,16.5 3.86,16.71L3,20.13C2.92,20.45 3.03,20.78 3.28,21.03C3.5,21.25 3.81,21.37 4.12,21.37C4.2,21.37 4.28,21.36 4.36,21.34L7.79,20.47C8,20.41 8.18,20.29 8.34,20.13L15.56,12.91C15.58,12.89 15.59,12.88 15.61,12.86C15.39,12.81 15.21,12.71 15.07,12.56Z" />'
    ],
    [
        'titre' => 'Sponsoring et Mécénat.',
        'desc'  => 'Accompagnement dans la mise en place de partenariats sportifs stratégiques et durables.',
        'svg'   => '<path d="M12,6A3,3 0 0,0 9,9A3,3 0 0,0 12,12A3,3 0 0,0 15,9A3,3 0 0,0 12,6M6,8.17A2.5,2.5 0 0,0 3.5,10.67A2.5,2.5 0 0,0 6,13.17C6.88,13.17 7.65,12.71 8.09,12.03C7.42,11.18 7,10.15 7,9C7,8.8 7,8.6 7.04,8.4C6.72,8.25 6.37,8.17 6,8.17M18,8.17C17.63,8.17 17.28,8.25 16.96,8.4C17,8.6 17,8.8 17,9C17,10.15 16.58,11.18 15.91,12.03C16.35,12.71 17.12,13.17 18,13.17A2.5,2.5 0 0,0 20.5,10.67A2.5,2.5 0 0,0 18,8.17M12,14C10,14 6,15 6,17V19H18V17C18,15 14,14 12,14Z" />'
    ],
    [
        'titre' => 'Contenus Digitaux.',
        'desc'  => 'Création et gestion de contenus digitaux engageants pour renforcer votre présence en ligne et votre communication digitale.',
        'svg'   => '<path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" /><path d="M8,12H16V14H8V12M8,15H16V17H8V15M8,18H13V20H8V18Z" />'
    ],
    [
        'titre' => 'Visibilité et Notoriété.',
        'desc'  => 'Développement de votre visibilité et de votre notoriété grâce à des stratégies de communication ciblées et efficaces.',
        'svg'   => '<path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10Z" />'
    ],
    [
        'titre' => 'Stratégie Digitale.',
        'desc'  => 'Élaboration de stratégies digitales sur mesure pour optimiser votre présence en ligne et atteindre vos objectifs business.',
        'svg'   => '<path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,6H13V11H18V13H13V18H11V13H6V11H11V6Z" />'
    ]
];

$chiffres = [
    ['valeur' => '6',    'label' => 'Clients accompagnés'],
    ['valeur' => '1 an', 'label' => 'D\'expérience'],
    ['valeur' => '10+',  'label' => 'Projets réalisés'],
    ['valeur' => '95%',  'label' => 'Clients satisfaits']
];

$objectifs = [
    [
        'titre' => 'Comprendre.',
        'desc'  => 'Comprendre vos besoins suite à un état des lieux et une analyse de vos objectifs.',
        'svg'   => '<path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A1,1 0 0,0 11,7A1,1 0 0,0 12,8A1,1 0 0,0 13,7A1,1 0 0,0 12,6M11,10V16H13V10H11Z" />'
    ],
    [
        'titre' => 'Améliorer.',
        'desc'  => 'Améliorer votre visibilité et votre impact grâce à des stratégies personnalisées et innovantes.',
        'svg'   => '<path d="M12,2L13.09,8.26L22,9L13.09,9.74L12,16L10.91,9.74L2,9L10.91,8.26L12,2Z" />'
    ],
    [
        'titre' => 'Maximiser.',
        'desc'  => 'Maximiser vos résultats et votre performance avec un accompagnement sur mesure et des solutions adaptées.',
        'svg'   => '<path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,6H13V11H18V13H13V18H11V13H6V11H11V6Z" />'
    ],
    [
        'titre' => 'Stabiliser.',
        'desc'  => 'Stabiliser votre croissance et pérenniser votre développement avec un suivi continu et des ajustements stratégiques.',
        'svg'   => '<path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z" />'
    ]
];
?>

<style>
.hero {
    text-align: center;
    padding: 140px 0 80px;
    background: linear-gradient(rgba(27, 48, 131, 0.75), rgba(27, 48, 131, 0.5)), url('<?php echo get_template_directory_uri(); ?>/img/hero-bg.jpg');
    background-size: cover;
    background-position: center;
    color: #ffffff;
    position: relative;
}
.hero h1 {
    font-size: 3.5rem;
    text-transform: uppercase;
    margin-bottom: 30px;
    letter-spacing: 2px;
    font-weight: 900;
    line-height: 1.2;
}
.text-green { color: #11dd9e; }
.text-blue  { color: #1B3083; }
.text-white { color: #ffffff; }
.hero-text {
    max-width: 800px;
    margin: 0 auto 40px;
    color: #ffffff;
    font-size: 1.1rem;
    line-height: 1.8;
}
.btn {
    display: inline-block;
    padding: 15px 40px;
    border-radius: 50px;
    font-weight: 800;
    text-transform: uppercase;
    font-size: 0.9rem;
    text-decoration: none;
    transition: 0.3s;
}
.btn-green { background-color: #11dd9e; color: #1a1a1a; }
.btn-green:hover { background-color: #ffffff; transform: scale(1.05); }

.services-section { padding: 80px 0; background-color: #ffffff; }
.section-title {
    font-size: 2.5rem;
    text-transform: uppercase;
    margin-bottom: 60px;
    text-align: center;
    font-weight: 900;
}
.services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}
.service-item {
    text-align: center;
    padding: 40px 30px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: transform 0.3s;
}
.service-item:hover { transform: translateY(-5px); }
.service-icon-svg { width: 60px; height: 60px; margin-bottom: 20px; fill: #11dd9e; }
.service-item h3 { font-size: 1.3rem; margin-bottom: 15px; color: #1B3083; font-weight: 700; }
.service-item p { color: #333; line-height: 1.6; font-size: 0.95rem; }

.histoire-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #010D3B 0%, #1B3083 100%);
}
.histoire-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.histoire-img-col img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}
.histoire-text-col h2 {
    font-size: 2.5rem;
    text-transform: uppercase;
    margin-bottom: 30px;
    color: #ffffff;
    font-weight: 900;
}
.histoire-text-col p { color: #ffffff; font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px; }

.chiffres-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #010D3B 0%, #1B3083 100%);
}
.chiffres-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.chiffre-item {
    text-align: center;
    padding: 40px 20px;
    background: rgba(255,255,255,0.1);
    border-radius: 15px;
    border: 2px solid #11dd9e;
}
.chiffre-item h3 { font-size: 3rem; font-weight: 900; color: #11dd9e; margin-bottom: 10px; }
.chiffre-item p { color: #ffffff; font-size: 1.1rem; }

.objectifs-section { padding: 80px 0; background-color: #ffffff; }
.objectifs-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.objectifs-content {
    text-align: left;
}
.objectifs-content .section-title {
    margin-bottom: 40px;
    margin-left: 0;
    text-align: left;
}
.objectifs-content > p {
    margin-left: 0;
    margin: 0 auto 40px;
}
.objectif-item { 
    display: flex; 
    align-items: flex-start; 
    gap: 20px; 
    margin-bottom: 30px; 
    text-align: left;
    width: 100%;
}
.objectif-icon-svg { width: 50px; height: 50px; fill: #11dd9e; flex-shrink: 0; }
.objectif-text h3 { font-size: 1.5rem; margin-bottom: 10px; color: #1B3083; font-weight: 700; }
.objectif-text p { color: #333; line-height: 1.6; }
.objectifs-image {
    display: flex;
    align-items: flex-end;
    padding-top: 80px;
}
.objectifs-image img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.cta-banner { background: #11dd9e; color: #050A19; text-align: center; padding: 80px 20px; }
.cta-banner h2 { font-size: 2.2rem; margin-bottom: 10px; text-transform: uppercase; font-weight: 900; line-height: 1.2; }
.cta-banner p { margin-bottom: 30px; font-weight: 600; font-size: 1.05rem; }
.btn-cta {
    background: #050A19;
    color: #fff;
    padding: 15px 40px;
    border-radius: 30px;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    transition: 0.3s;
}
.btn-cta:hover { transform: scale(1.05); }

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

@media (max-width: 1024px) {
    .services-grid { grid-template-columns: repeat(2, 1fr); }
    .chiffres-grid { grid-template-columns: repeat(2, 1fr); }
    .hero h1 { font-size: 2.8rem; }
}
@media (max-width: 768px) {
    .services-grid { grid-template-columns: 1fr; }
    .chiffres-grid { grid-template-columns: 1fr; }
    .histoire-wrapper, .objectifs-wrapper { grid-template-columns: 1fr; }
    .hero h1 { font-size: 2.2rem; }
    .hero-text { font-size: 1rem; padding: 0 20px; }
}
</style>

<section class="hero">
    <div class="container">
        <h1>ENSEMBLE VERS<br>VOTRE <span class="text-green">RÉUSSITE !</span></h1>
        <p class="hero-text">
            Dans un monde en constante évolution, les préoccupations sportives et économiques prennent de l'ampleur. Tout comme les nouvelles attentes des entreprises et des athlètes. Pour s'adapter à ces changements, les diversités actuelles exigent de réinventer les professions. C'est pourquoi nous, chez Impulse, souhaitons jouer un rôle majeur dans la transformation et l'aboutissement de ces acteurs à la réussite.
        </p>
        <a href="<?php echo function_exists('home_url') ? esc_url(home_url('/contact')) : '/contact.php'; ?>" class="btn btn-green">Nous contacter</a>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <h2 class="section-title text-blue">NOS <span class="text-green">SERVICES</span></h2>
        <div class="services-grid">
            <?php foreach($services as $service): ?>
                <div class="service-item">
                    <svg class="service-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <?php echo $service['svg']; ?>
                    </svg>
                    <h3><?php echo esc_html($service['titre']); ?></h3>
                    <p><?php echo esc_html($service['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="histoire-section">
    <div class="histoire-wrapper">
        <div class="histoire-img-col">
            <img src="<?php echo get_template_directory_uri(); ?>/img/histoire.jpg" alt="Notre Histoire">
        </div>
        <div class="histoire-text-col">
            <h2>NOTRE <span class="text-green">HISTOIRE</span></h2>
            <p>Impulse est spécialisée dans la communication digitale et le développement commercial, offrant des solutions sur mesure pour répondre aux besoins variés de nos clients.</p>
            <p>Nos compétences sont multiples. A travers une approche innovante qui combine analyse de marché, création de contenu pertinent et stratégies de partenariats efficaces.</p>
        </div>
    </div>
</section>

<section class="chiffres-section">
    <div class="container">
        <h2 class="section-title text-white">NOS <span class="text-green">CHIFFRES</span></h2>
        <div class="chiffres-grid">
            <?php foreach($chiffres as $chiffre): ?>
                <div class="chiffre-item">
                    <h3><?php echo esc_html($chiffre['valeur']); ?></h3>
                    <p><?php echo esc_html($chiffre['label']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="objectifs-section">
    <div class="container">
        <div class="objectifs-wrapper">
            <div class="objectifs-content">
                <h2 class="section-title text-blue">NOS <span class="text-green">OBJECTIFS</span></h2>
                <?php foreach($objectifs as $objectif): ?>
                    <div class="objectif-item">
                        <svg class="objectif-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <?php echo $objectif['svg']; ?>
                        </svg>
                        <div class="objectif-text">
                            <h3><?php echo esc_html($objectif['titre']); ?></h3>
                            <p><?php echo esc_html($objectif['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="objectifs-image">
                <img src="<?php echo get_template_directory_uri(); ?>/img/objectifs.jpg" alt="Sportif">
            </div>
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