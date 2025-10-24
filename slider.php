<?php $base_path = '/HawaanEcommerce/'; ?>

<?php
// Function to fetch active sliders
function getActiveSliders($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM tbl_slider WHERE is_active = 1 ORDER BY display_order ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get sliders from database
$sliders = getActiveSliders($pdo);
?>

<div class="banner">
    <div class="container">
        <div class="slider-container has-scrollbar">
            <?php foreach ($sliders as $slider): ?>
                <div class="slider-item">
                    <img src="<?php echo $base_path; ?><?= htmlspecialchars($slider['image_url']) ?>" 
                         alt="<?= htmlspecialchars($slider['title']) ?>" 
                         class="banner-img">

                    <div class="banner-content">
                        <p class="banner-subtitle"><?= htmlspecialchars($slider['subtitle']) ?></p>
                        <h2 class="banner-title"><?= htmlspecialchars($slider['title']) ?></h2>
                        <p class="banner-text">
                        <?= htmlspecialchars($slider['price_text']) ?>
                        </p>
                        <a href="<?= htmlspecialchars($slider['button_url']) ?>" 
                           class="banner-btn">
                           <?= htmlspecialchars($slider['button_text']) ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>