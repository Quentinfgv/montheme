<?php
/**
 * Template Name: Contact
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

// 1. Les Coordonnées
$coordonnees = [
    [
        'titre' => 'ADRESSE',
        'valeur' => 'Gymnase Auguste Delaune<br>2 rue de Nanteuil<br>93100 Montreuil, France',
        'icone' => 'location_on',
        'sens'  => 'normal'
    ],
    [
        'titre' => 'TÉLÉPHONE',
        'valeur' => '<a href="tel:0689611525">06 89 61 15 25</a><br>Benjamin Rousseau',
        'icone' => 'phone',
        'sens'  => 'inverse'
    ],
    [
        'titre' => 'EMAIL',
        'valeur' => '<a href="mailto:Contact@impulse-club.fr">Contact@impulse-club.fr</a>',
        'icone' => 'email',
        'sens'  => 'normal'
    ]
];

// 2. Les Horaires
$horaires = [
    ['jour' => 'Lundi - Vendredi', 'heures' => '9h00 - 18h00'],
    ['jour' => 'Samedi - Dimanche', 'heures' => 'Fermé']
];

// Traitement du formulaire
$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
    $prenom = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $telephone = isset($_POST['telephone']) ? htmlspecialchars(trim($_POST['telephone'])) : '';
    $entreprise = isset($_POST['entreprise']) ? htmlspecialchars(trim($_POST['entreprise'])) : '';
    $service = isset($_POST['service']) ? htmlspecialchars(trim($_POST['service'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Validation
    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($entreprise) || empty($service) || empty($message)) {
        $error_message = 'Veuillez remplir tous les champs obligatoires.';
    } elseif (!$email) {
        $error_message = 'Veuillez entrer une adresse email valide.';
    } else {
        // Envoi de l'email
        $to = 'Contact@impulse-club.fr';
        $subject = 'Nouveau message de contact - ' . $nom . ' ' . $prenom;
        $message_body = "Nouveau message de contact\n\n";
        $message_body .= "Nom: $nom\n";
        $message_body .= "Prénom: $prenom\n";
        $message_body .= "Email: $email\n";
        $message_body .= "Téléphone: $telephone\n";
        $message_body .= "Entreprise/Organisation: $entreprise\n";
        $message_body .= "Service concerné: $service\n\n";
        $message_body .= "Message:\n$message\n";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $message_body, $headers)) {
            $message_sent = true;
        } else {
            $error_message = 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.';
        }
    }
}
?>

<style>
/* === PAGE CONTACT CSS === */

/* --- HERO --- */
.hero {
    text-align: center;
    padding: 100px 0 80px;
    background: linear-gradient(135deg, rgba(1, 13, 59, 1) 0%, rgba(27, 48, 131, 1) 50%, rgba(17, 221, 158, 0.3) 100%);
    color: #ffffff;
    position: relative;
}

.hero h1 {
    font-size: 4rem;
    text-transform: uppercase;
    margin-bottom: 20px;
    letter-spacing: 3px;
    color: #ffffff;
    font-weight: 900;
}

.hero-text {
    max-width: 800px;
    margin: 0 auto;
    color: #ffffff;
    font-size: 1.2rem;
    line-height: 1.8;
}

/* --- SECTION PRINCIPALE (2 COLONNES) --- */
.contact-main-section {
    padding: 80px 0;
    background: #ffffff;
}

.contact-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* --- COLONNE GAUCHE - COORDONNÉES --- */
.contact-info-col {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.coordonnees-title {
    font-size: 2.5rem;
    text-transform: uppercase;
    margin-bottom: 30px;
    color: #160049;
    font-weight: 900;
}

.coordonnees-title span {
    color: #11dd9e;
}

.coordonnee-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 30px;
}

.coordonnee-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.coordonnee-icon .material-symbols-outlined {
    font-size: 2.5rem;
    color: #11dd9e;
}

.coordonnee-text h3 {
    font-size: 1rem;
    font-weight: 700;
    color: #160049;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.coordonnee-text .valeur {
    font-size: 1rem;
    color: #3100a5;
    line-height: 1.6;
}

.coordonnee-text .valeur a {
    color: #3100a5;
    text-decoration: none;
}

.coordonnee-text .valeur a:hover {
    color: #11dd9e;
}

/* Horaires */
.horaires-box {
    background: linear-gradient(135deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1));
    padding: 25px;
    border-radius: 10px;
    border: 2px solid #11dd9e;
    margin-top: 20px;
}

.horaires-box h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #11dd9e;
    margin-bottom: 15px;
    text-transform: uppercase;
}

.horaires-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.horaires-row:last-child {
    border-bottom: none;
}

/* Carte */
.map-container-contact {
    margin-top: 30px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.map-container-contact iframe {
    width: 100%;
    height: 350px;
    border: none;
}

/* --- COLONNE DROITE - FORMULAIRE --- */
.contact-form-col {
    display: flex;
    flex-direction: column;
}

.form-container {
    background: linear-gradient(135deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1));
    padding: 50px 40px;
    border-radius: 20px;
    border: 2px solid #11dd9e;
}

.form-title {
    font-size: 2.5rem;
    color: #ffffff;
    margin-bottom: 30px;
    text-transform: uppercase;
    font-weight: 900;
    line-height: 1.2;
}

.form-title span {
    color: #11dd9e;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.form-control,
.form-select {
    width: 100%;
    padding: 15px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    font-family: inherit;
    font-size: 1rem;
    transition: all 0.3s;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    box-sizing: border-box;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.form-select option {
    background: #010d3b;
    color: #ffffff;
}

.form-control:focus,
.form-select:focus {
    outline: none;
    border-color: #11dd9e;
    background: rgba(255, 255, 255, 0.15);
}

.btn-submit {
    background: #11dd9e;
    color: #050a19;
    padding: 18px 40px;
    border: none;
    border-radius: 30px;
    font-weight: 800;
    font-size: 1rem;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-submit:hover {
    background: #ffffff;
    color: #050a19;
    transform: translateY(-2px);
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 10px;
}

.alert-success {
    background: #11dd9e;
    color: #050a19;
}

.alert-error {
    background: #ff4444;
    color: #ffffff;
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
}

.cta-banner p {
    margin-bottom: 30px;
    font-weight: 500;
    font-size: 1.1rem;
}

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
    .contact-wrapper {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .hero h1 {
        font-size: 2.5rem;
    }
    
    .hero-text {
        font-size: 1rem;
        padding: 0 20px;
    }
    
    .contact-main-section {
        padding: 60px 0;
    }
    
    .form-container {
        padding: 30px 20px;
    }
    
    .coordonnees-title {
        font-size: 2rem;
    }
}
</style>

<section class="hero">
    <div class="container">
        <h1>CONTACTEZ-NOUS !</h1>
        <p class="hero-text">Un projet, une idée ou une ambition sportive ? Contactez-nous et donnons ensemble de l'élan à votre communication.</p>
    </div>
</section>

<section class="contact-main-section">
    <div class="contact-wrapper">
        <!-- COLONNE GAUCHE - COORDONNÉES -->
        <div class="contact-info-col">
            <h2 class="coordonnees-title">NOS <span>COORDONNÉES</span></h2>
            
            <?php foreach($coordonnees as $coord): ?>
                <div class="coordonnee-item">
                    <div class="coordonnee-icon">
                        <span class="material-symbols-outlined"><?php echo $coord['icone']; ?></span>
                    </div>
                    <div class="coordonnee-text">
                        <h3><?php echo $coord['titre']; ?></h3>
                        <div class="valeur"><?php echo $coord['valeur']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Horaires -->
            <div class="horaires-box">
                <h4>HORAIRES D'OUVERTURE</h4>
                <?php foreach($horaires as $horaire): ?>
                    <div class="horaires-row">
                        <span><?php echo $horaire['jour']; ?></span>
                        <span><?php echo $horaire['heures']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Carte -->
            <div class="map-container-contact">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2627.4446857742396!2d2.4398871!3d48.8567031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e612c0d7fb9f5f%3A0x6d0c4e9e3f3a8f1d!2s2%20Rue%20de%20Nanteuil%2C%2093100%20Montreuil!5e0!3m2!1sfr!2sfr!4v1700000000000"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        
        <!-- COLONNE DROITE - FORMULAIRE -->
        <div class="contact-form-col">
            <div class="form-container">
                <h2 class="form-title">ENVOYEZ-NOUS<br>UN <span>MESSAGE</span></h2>

                <?php if ($message_sent): ?>
                    <div class="alert alert-success">
                        <p>Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.</p>
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        <p><?php echo esc_html($error_message); ?></p>
                    </div>
                <?php endif; ?>

                <form method="POST" action="#">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nom *</label>
                            <input type="text" name="nom" class="form-control" placeholder="Votre nom" required value="<?php echo isset($_POST['nom']) ? esc_attr($_POST['nom']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prénom *</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required value="<?php echo isset($_POST['prenom']) ? esc_attr($_POST['prenom']) : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" placeholder="votre.email@exemple.fr" required value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Téléphone *</label>
                        <input type="tel" name="telephone" class="form-control" placeholder="+33 1 23 45 67 89" required value="<?php echo isset($_POST['telephone']) ? esc_attr($_POST['telephone']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Entreprise / Organisation *</label>
                        <input type="text" name="entreprise" class="form-control" placeholder="Votre entreprise" required value="<?php echo isset($_POST['entreprise']) ? esc_attr($_POST['entreprise']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Service concerné *</label>
                        <select name="service" class="form-select" required>
                            <option value="" disabled <?php echo !isset($_POST['service']) ? 'selected' : ''; ?>>Sélectionnez un service</option>
                            <option value="strategie" <?php echo (isset($_POST['service']) && $_POST['service'] == 'strategie') ? 'selected' : ''; ?>>Stratégie de marque</option>
                            <option value="digitale" <?php echo (isset($_POST['service']) && $_POST['service'] == 'digitale') ? 'selected' : ''; ?>>Communication digitale</option>
                            <option value="media" <?php echo (isset($_POST['service']) && $_POST['service'] == 'media') ? 'selected' : ''; ?>>Production média</option>
                            <option value="pack" <?php echo (isset($_POST['service']) && $_POST['service'] == 'pack') ? 'selected' : ''; ?>>Pack média</option>
                            <option value="autre" <?php echo (isset($_POST['service']) && $_POST['service'] == 'autre') ? 'selected' : ''; ?>>Autre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message *</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Décrivez-nous votre projet..." required><?php echo isset($_POST['message']) ? esc_html($_POST['message']) : ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-outlined">send</span>
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="cta-banner">
    <div class="container">
        <h2>PRÊT À LANCER VOTRE PROJET ?</h2>
        <p>Rejoignez les marques sportives qui nous font confiance</p>
        <a href="<?php echo function_exists('home_url') ? esc_url(home_url('/services')) : '/services.php'; ?>" class="btn-cta">Découvrir nos services</a>
    </div>
</section>

<?php get_footer(); ?>