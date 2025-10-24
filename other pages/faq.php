<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php'); ?>

  <!--
    - MAIN
  -->

  <main>

    <div class="page-container">
      <div class="container">
        
        <div class="page-header">
          <h1 class="page-title">Frequently Asked Questions</h1>
          <p class="page-subtitle">Find answers to common questions about shopping with HAWAAN</p>
        </div>

        <div class="faq-content">
          
          <section class="faq-search">
            <div class="search-container">
              <input type="text" id="faqSearch" placeholder="Search for answers..." class="faq-search-input">
              <button class="search-btn">
                <ion-icon name="search-outline"></ion-icon>
              </button>
            </div>
          </section>

          <section class="faq-categories">
            <h2>Browse by Category</h2>
            <div class="faq-category-grid">
              <div class="faq-category-card active" data-category="all">
                <div class="category-icon">
                  <ion-icon name="apps-outline"></ion-icon>
                </div>
                <h3>All Questions</h3>
                <span class="question-count">24 questions</span>
              </div>
              
              <div class="faq-category-card" data-category="orders">
                <div class="category-icon">
                  <ion-icon name="bag-outline"></ion-icon>
                </div>
                <h3>Orders & Shipping</h3>
                <span class="question-count">8 questions</span>
              </div>
              
              <div class="faq-category-card" data-category="returns">
                <div class="category-icon">
                  <ion-icon name="return-up-back-outline"></ion-icon>
                </div>
                <h3>Returns & Exchanges</h3>
                <span class="question-count">6 questions</span>
              </div>
              
              <div class="faq-category-card" data-category="account">
                <div class="category-icon">
                  <ion-icon name="person-outline"></ion-icon>
                </div>
                <h3>Account & Payment</h3>
                <span class="question-count">5 questions</span>
              </div>
              
              <div class="faq-category-card" data-category="products">
                <div class="category-icon">
                  <ion-icon name="shirt-outline"></ion-icon>
                </div>
                <h3>Products & Sizing</h3>
                <span class="question-count">5 questions</span>
              </div>
            </div>
          </section>
<?php
// Fetch all FAQs grouped by category
$faqCategories = [
    'orders' => 'Orders & Shipping',
    'returns' => 'Returns & Exchanges',
    'account' => 'Account & Payment',
    'products' => 'Products & Sizing'
];

$faqs = [];
foreach ($faqCategories as $category => $title) {
    $stmt = $pdo->prepare("SELECT * FROM tbl_faq WHERE category = ? ORDER BY sort_order");
    $stmt->execute([$category]);
    $faqs[$category] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<section class="faq-list">
    <h2>Frequently Asked Questions</h2>
    
    <?php foreach ($faqCategories as $category => $title): ?>
        <div class="faq-category-section" data-category="<?php echo $category; ?>">
            <h3 class="category-title"><?php echo $title; ?></h3>
            
            <?php foreach ($faqs[$category] as $faq): ?>
                <div class="faq-item" data-accordion-btn>
                    <div class="faq-question">
                        <h4><?php echo htmlspecialchars($faq['question']); ?></h4>
                        <ion-icon name="chevron-down-outline" class="faq-icon"></ion-icon>
                    </div>
                    <div class="faq-answer" data-accordion>
                        <p><?php echo nl2br(htmlspecialchars($faq['answer'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
    <?php endforeach; ?>
</section>

<section class="contact-support">
    <div class="support-card">
        <div class="support-icon">
            <ion-icon name="headset-outline"></ion-icon>
        </div>
        <h3>Still need help?</h3>
        <p>Can't find the answer you're looking for? Our customer support team is here to help.</p>
        <div class="support-actions">
            <a href="other pages/contact.html" class="btn-primary">Contact Support</a>
            <a href="mailto:support@hawaan.com" class="btn-secondary">Email Us</a>
        </div>
    </div>
</section>

        </div>

      </div>
    </div>

  </main>

  <!--
    - FOOTER
  -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php'); ?>



  <!--
    - custom js link
  -->
  <script src="assets/js/script.js"></script>
  <script>
    // FAQ functionality
    document.addEventListener('DOMContentLoaded', function() {
      // FAQ accordion functionality
      const faqItems = document.querySelectorAll('.faq-item[data-accordion-btn]');
      
      faqItems.forEach(item => {
        item.addEventListener('click', () => {
          const answer = item.querySelector('[data-accordion]');
          const icon = item.querySelector('.faq-icon');
          const isActive = answer.classList.contains('active');
          
          // Close all other FAQ items
          faqItems.forEach(otherItem => {
            const otherAnswer = otherItem.querySelector('[data-accordion]');
            const otherIcon = otherItem.querySelector('.faq-icon');
            otherAnswer.classList.remove('active');
            otherIcon.style.transform = 'rotate(0deg)';
          });
          
          // Toggle current item
          if (!isActive) {
            answer.classList.add('active');
            icon.style.transform = 'rotate(180deg)';
          }
        });
      });

      // Category filtering
      const categoryCards = document.querySelectorAll('.faq-category-card');
      const categorySections = document.querySelectorAll('.faq-category-section');
      
      categoryCards.forEach(card => {
        card.addEventListener('click', () => {
          const category = card.dataset.category;
          
          // Update active category
          categoryCards.forEach(c => c.classList.remove('active'));
          card.classList.add('active');
          
          // Show/hide sections
          if (category === 'all') {
            categorySections.forEach(section => section.style.display = 'block');
          } else {
            categorySections.forEach(section => {
              section.style.display = section.dataset.category === category ? 'block' : 'none';
            });
          }
        });
      });

      // Search functionality
      const searchInput = document.getElementById('faqSearch');
      
      searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        
        faqItems.forEach(item => {
          const question = item.querySelector('.faq-question h4').textContent.toLowerCase();
          const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
          
          if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
          } else {
            item.style.display = searchTerm === '' ? 'block' : 'none';
          }
        });
      });
    });
  </script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>