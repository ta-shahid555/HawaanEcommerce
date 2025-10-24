<?php $base_path = '/HawaanEcommerce/'; ?>

<?php
include 'config.php';


// Fetch address, email, phone from DB
$statement = $pdo->prepare("SELECT contact_address, contact_email, contact_phone, footer_copyright FROM tbl_footer_settings WHERE id=1");
$statement->execute();
$footer = $statement->fetch(PDO::FETCH_ASSOC);
?>

    <footer>
        <div class="footer-category">
            <div class="container">
                <h2 class="footer-category-title">Product Directory</h2>

                <div class="footer-category-box">
                    <h3 class="category-box-title">Jewellery :</h3>
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/earring.php" class="footer-category-link">Earrings</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/couplerings.php" class="footer-category-link">Couple Rings</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/necklace.php" class="footer-category-link">Necklace</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/bracelet.php" class="footer-category-link">Bracelets</a>
                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">Perfumes :</h3>
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/floral.php" class="footer-category-link">Floral</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/oriental.php" class="footer-category-link">Oriental</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/woody.php" class="footer-category-link">Woody</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/fougere.php" class="footer-category-link">Fougère</a>
                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">Men's Collection :</h3>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/formal.php" class="footer-category-link">Formal</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/casual.php" class="footer-category-link">Casual</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/tshirts.php" class="footer-category-link">T-shirts</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/jackets.php" class="footer-category-link">Jackets</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/shorts.php" class="footer-category-link">Shorts</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/sunglasses.php" class="footer-category-link">Sunglasses</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/watches.htm" class="footer-category-link">Watches</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/wallets.php" class="footer-category-link">Wallets</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/shoes.php" class="footer-category-link">Shoes</a>
                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">Women's Collection :</h3>
                    <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/formal.php" class="footer-category-link">Formal</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/kurtas&suits.php" class="footer-category-link">Kurtas & Suits</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/saree.php" class="footer-category-link">Saree</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/lehenga&cholis.php" class="footer-category-link">Lehenga Cholis</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/dupattas&shawls.php" class="footer-category-link">Dupattas & Shawls</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/lipstick.php" class="footer-category-link">Lipstick</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/eyeliner.php" class="footer-category-link">Eyeliner</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/primer.php" class="footer-category-link">Primer</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/mascara.php" class="footer-category-link">Mascara</a>
                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">Kids Collection :</h3>
                    <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/formal.php" class="footer-category-link">Formal</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/casual.php" class="footer-category-link">Casual</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/shorts.php" class="footer-category-link">Shorts</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/trousers.php" class="footer-category-link">Trousers</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/tshirts.php" class="footer-category-link">T-shirts</a>
                </div>

                <div class="footer-category-box">
                    <h3 class="category-box-title">Electronics :</h3>
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/sw.php" class="footer-category-link">Smart Watch</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/stv.php" class="footer-category-link">Smart TV</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/mouse.php" class="footer-category-link">Mouse</a>
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/microphone.php" class="footer-category-link">Microphone</a>
                </div>
            </div>
        </div>

        <div class="footer-nav">
            <div class="container">
                <ul class="footer-nav-list">
                    <li class="footer-nav-item">
                        <h2 class="nav-title">Main Categories</h2>
                    </li>
                    <li class="footer-nav-item">
                        <a href="index.php" class="footer-nav-link">Home</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/earring.php" class="footer-nav-link">Jewellery</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/floral.php" class="footer-nav-link">Perfumes</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/formal.php" class="footer-nav-link">Men's Collection</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/formal.php" class="footer-nav-link">Women's Collection</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/formal.php" class="footer-nav-link">Kids Collection</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/electronics/sw.php" class="footer-nav-link">Electronics</a>
                    </li>
                </ul>

                <ul class="footer-nav-list">
                    <li class="footer-nav-item">
                        <h2 class="nav-title">Popular Collections</h2>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/earring.php" class="footer-nav-link">Trending Earrings</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/floral.php" class="footer-nav-link">Premium Perfumes</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/formal.php" class="footer-nav-link">Men's Formal Wear</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/saree.php" class="footer-nav-link">Designer Sarees</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Categories/electronics/sw.php" class="footer-nav-link">Smart Watches</a>
                    </li>
                </ul>

                <ul class="footer-nav-list">
                    <li class="footer-nav-item">
                        <h2 class="nav-title">Company Info</h2>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/about.php" class="footer-nav-link">About Us</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/blogs.php" class="footer-nav-link">Blog</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/privacypolicy.php" class="footer-nav-link">Privacy Policy</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/terms&conditions.php" class="footer-nav-link">Terms & Conditions</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Returnpolicy.php" class="footer-nav-link">Return Policy</a>
                    </li>
                </ul>

                <ul class="footer-nav-list">
                    <li class="footer-nav-item">
                        <h2 class="nav-title">Customer Service</h2>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/contact.php" class="footer-nav-link">Contact Us</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/Helpcenter.php" class="footer-nav-link">Help Center</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/ordersupport.php" class="footer-nav-link">Order Support</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/sizeguide.php" class="footer-nav-link">Size Guide</a>
                    </li>
                    <li class="footer-nav-item">
                        <a href="<?php echo $base_path; ?>other pages/faq.php" class="footer-nav-link">FAQ</a>
                    </li>
                </ul>
<!-- CONTACT SECTION -->
<ul class="footer-nav-list">
    <li class="footer-nav-item">
        <h2 class="nav-title">Contact</h2>
    </li>

    <!-- Address -->
    <li class="footer-nav-item flex">
        <div class="icon-box">📍</div>
        <address class="content">
            <?= nl2br(htmlspecialchars($footer['contact_address'] ?? 'Not available')) ?>
        </address>
    </li>

    <!-- Email -->
    <li class="footer-nav-item flex">
        <div class="icon-box">✉️</div>
        <a href="mailto:<?= htmlspecialchars($footer['contact_email']) ?>" class="footer-nav-link">
            <?= htmlspecialchars($footer['contact_email']) ?>
        </a>
    </li>

    <!-- Phone -->
    <li class="footer-nav-item flex">
        <div class="icon-box">📞</div>
        <a href="tel:<?= htmlspecialchars($footer['contact_phone']) ?>" class="footer-nav-link">
            <?= htmlspecialchars($footer['contact_phone']) ?>
        </a>
    </li>
</ul>


                <ul class="footer-nav-list">
                    <li class="footer-nav-item">
                        <h2 class="nav-title">Follow Us</h2>
                    </li>
                    <li>
                        <ul class="social-link">
                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">📘</a>
                            </li>
                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">🐦</a>
                            </li>
                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">💼</a>
                            </li>
                            <li class="footer-nav-item">
                                <a href="#" class="footer-nav-link">📷</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

<div class="footer-bottom">
    <div class="container">
        <img src="<?php echo $base_path; ?>assets/images/payment.png" alt="payment methods" class="payment-img">
        <p class="copyright">
            <?= htmlspecialchars($footer['footer_copyright']) ?>
        </p>
    </div>
</div>

    </footer>

    <!-- <script src="<?php echo $base_path; ?>assets/js/cart.js" ></script> -->
    <script src="<?php echo $base_path; ?>assets/js/main.js" ></script>
    <script src="<?php echo $base_path; ?>assets/js/script.js" ></script>
    <script src="<?php echo $base_path; ?>assets/js/microphone.js" ></script>
    <!-- Ionicons CDN -->

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
