<?php
/**
 * Template Name: Contact
 * 
 * @package theme-inpulse
 */

get_header();

// Afficher le contenu WordPress (éditable par les SEO)
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

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* === PAGE CONTACT CSS === */

/* Variables */
:root {
    --emerald: #11dd9e;
    --dark-blue: #0a1a2b;
    --blue: #1B3083;
}

/* Hero Section */
#hero {
    text-align: center;
    padding: 100px 0 80px;
    background: linear-gradient(135deg, rgba(1, 13, 59, 1) 0%, rgba(27, 48, 131, 1) 50%, rgba(17, 221, 158, 0.3) 100%);
    color: #ffffff;
}

#hero h1 {
    font-size: 4rem;
    text-transform: uppercase;
    margin-bottom: 20px;
    letter-spacing: 3px;
    font-weight: 900;
}

#hero p {
    max-width: 800px;
    margin: 0 auto;
    color: #ffffff;
    font-size: 1.2rem;
    line-height: 1.8;
}

/* Logos Row */
.logos-row {
    overflow-x: auto;
    white-space: nowrap;
    padding: 20px 0;
    display: flex;
    flex-wrap: nowrap;
    gap: 30px;
    justify-content: center;
    margin-top: 40px;
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

/* Contact Section */
.contact-section {
    padding: 80px 0;
    background: #ffffff;
}

/* Icon Box */
.icon-box {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.icon-box .material-symbols-outlined {
    font-size: 2.5rem;
    color: var(--emerald);
}

/* Text Emerald */
.text-emerald {
    color: var(--emerald) !important;
}

/* Opening Hours Box */
.opening-hours {
    background: linear-gradient(135deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1));
    border: 2px solid var(--emerald);
}

.opening-hours h5 {
    color: var(--emerald);
    text-transform: uppercase;
}

/* Map Container */
.map-container {
    margin-top: 30px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.img-map {
    width: 100%;
    height: 350px;
    object-fit: cover;
}

/* Form Container */
.form-container {
    background: linear-gradient(135deg, rgba(1, 13, 59, 1), rgba(27, 48, 131, 1));
    border: 2px solid var(--emerald);
}

.form-container h2 {
    color: #ffffff;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 1.2;
}

.form-container .form-label {
    color: #ffffff;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.form-container .form-control,
.form-container .form-select {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    color: #ffffff;
    padding: 15px;
    transition: all 0.3s;
}

.form-container .form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.form-container .form-control:focus,
.form-container .form-select:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: var(--emerald);
    color: #ffffff;
    outline: none;
    box-shadow: none;
}

.form-container .form-select option {
    background: #010d3b;
    color: #ffffff;
}

/* Button Emerald */
.btn-emerald {
    background-color: var(--emerald);
    color: var(--dark-blue);
    font-weight: 800;
    text-transform: uppercase;
    border: none;
    transition: all 0.3s;
}

.btn-emerald:hover {
    background-color: #ffffff;
    color: var(--dark-blue);
    transform: translateY(-2px);
}

/* Alerts */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 10px;
}

.alert-success {
    background: var(--emerald);
    color: var(--dark-blue);
    border: none;
}

.alert-error {
    background: #ff4444;
    color: #ffffff;
    border: none;
}

/* CTA Banner */
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
    color: #fff;
}

/* Responsive */
@media (max-width: 768px) {
    #hero h1 {
        font-size: 2.5rem;
    }
    
    #hero p {
        font-size: 1rem;
        padding: 0 20px;
    }
    
    .contact-section {
        padding: 60px 0;
    }
    
    .form-container {
        padding: 30px 20px !important;
    }
}
</style>

<section id="hero">
    <div class="container hero-content">
        <h1 style="color: #11dd9e;">CONTACTEZ-NOUS</h1>
        <p>Un projet, une idée ou une ambition sportive ? Contactez-nous et donnons ensemble de l'élan à votre communication.</p>
    </div>
</section>

<section class="contact-section py-5 bg-white">
    <div class="container py-lg-5">
        <div class="row">
            
            <!-- COLONNE GAUCHE - COORDONNÉES -->
            <div class="col-lg-5 pe-lg-5">
                <h1 class="fw-bold mb-5" style="color: #0a1a2b;">NOS <span class="text-emerald fw-bold mb-5">COORDONNÉES</span></h1>

                <div class="d-flex align-items-start mb-4">
                    <div class="icon-box me-3">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: #0a1a2b;">ADRESSE</h6>
                        <p class="text-muted">Gymnase Auguste Delaune<br>2 rue de Nanteuil, 93100 Montreuil, France</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="icon-box me-3">
                        <span class="material-symbols-outlined">phone_enabled</span>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-uppercase" style="color: #0a1a2b;">Téléphone</h6>
                        <p class="text-muted">06 89 61 15 25<br>Benjamin Rousseau</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-5">
                    <div class="icon-box me-3">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: #0a1a2b;">EMAIL</h6>
                        <p class="text-muted">
                            <a href="mailto:Contact@impulse-club.fr" style="color: #6c757d; text-decoration: none;">Contact@impulse-club.fr</a>
                        </p>
                    </div>
                </div>

                <div class="opening-hours p-4 text-white rounded-4 mb-4">
                    <h5 class="fw-bold mb-3">HORAIRES D'OUVERTURE</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Lundi - Vendredi</span>
                        <span>9h00 - 18h00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Samedi - Dimanche</span>
                        <span>Fermé</span>
                    </div>
                </div>

                <div class="map-container rounded-4 overflow-hidden">
                    <?php 
                    $map_image = get_template_directory_uri() . '/img/localisation.jpeg';
                    $map_image_fallback = get_template_directory_uri() . '/img/localisation.jpg';
                    // Si aucune image n'existe, utiliser une iframe Google Maps en fallback
                    ?>
                    <?php if (file_exists(get_template_directory() . '/img/localisation.jpeg') || file_exists(get_template_directory() . '/img/localisation.jpg')): ?>
                        <img src="<?php echo file_exists(get_template_directory() . '/img/localisation.jpeg') ? $map_image : $map_image_fallback; ?>" alt="Localisation - 2 Rue de Nanteuil, 93100 Montreuil" class="w-100 img-map">
                    <?php else: ?>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2627.4446857742396!2d2.4398871!3d48.8567031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e612c0d7fb9f5f%3A0x6d0c4e9e3f3a8f1d!2s2%20Rue%20de%20Nanteuil%2C%2093100%20Montreuil!5e0!3m2!1sfr!2sfr!4v1700000000000"
                            width="100%" 
                            height="350" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Carte Google Maps - 2 Rue de Nanteuil, 93100 Montreuil">
                        </iframe>
                    <?php endif; ?>
                </div>
            </div>

            <!-- COLONNE DROITE - FORMULAIRE -->
            <div class="col-lg-7 mt-5 mt-lg-0">
                <div class="form-container p-4 p-lg-5 rounded-5 text-white">
                    <h2 class="fw-bold mb-4">ENVOYEZ-NOUS <br> UN <span class="text-emerald">MESSAGE</span></h2>
                    
                    <?php if ($message_sent): ?>
                        <div class="alert alert-success">
                            <p class="mb-0">Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.</p>
                        </div>
                    <?php endif; ?>

                    <?php if ($error_message): ?>
                        <div class="alert alert-error">
                            <p class="mb-0"><?php echo esc_html($error_message); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom *</label>
                                <input type="text" name="nom" class="form-control" placeholder="Votre nom" required value="<?php echo isset($_POST['nom']) ? esc_attr($_POST['nom']) : ''; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom *</label>
                                <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required value="<?php echo isset($_POST['prenom']) ? esc_attr($_POST['prenom']) : ''; ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" placeholder="votre.email@exemple.fr" required value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Téléphone *</label>
                            <input type="tel" name="telephone" class="form-control" placeholder="+33 1 23 45 67 89" required value="<?php echo isset($_POST['telephone']) ? esc_attr($_POST['telephone']) : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Entreprise / Organisation *</label>
                            <input type="text" name="entreprise" class="form-control" placeholder="Votre entreprise" required value="<?php echo isset($_POST['entreprise']) ? esc_attr($_POST['entreprise']) : ''; ?>">
                        </div>

                        <div class="mb-3">
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

                        <div class="mb-4">
                            <label class="form-label">Message *</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Décrivez-nous votre projet..." required><?php echo isset($_POST['message']) ? esc_html($_POST['message']) : ''; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-emerald w-100 py-3 fw-bold rounded-pill">
                            <span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 8px;">send</span>
                            Envoyer le message
                        </button>
                    </form>
                </div>
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
