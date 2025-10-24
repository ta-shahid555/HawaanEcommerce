<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php'); ?>


  <style>
    .about-content {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .page-header {
      text-align: center;
      margin-bottom: 60px;
      padding-top: 40px;
    }

    .page-title {
      font-size: 2.8rem;
      color: var(--eerie-black);
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }

    .page-title:after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--salmon-pink);
      border-radius: 2px;
    }

    .page-subtitle {
      font-size: 1.2rem;
      color: var(--sonic-silver);
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .about-hero {
      display: flex;
      flex-direction: column-reverse;
      gap: 40px;
      margin-bottom: 80px;
    }

    @media (min-width: 992px) {
      .about-hero {
        flex-direction: row;
        align-items: center;
      }
    }

    .about-hero-content {
      flex: 1;
    }

    .about-hero-image {
      flex: 1;
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .about-hero-image img {
      width: 100%;
      height: 100%;
      min-height: 350px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .about-hero-image:hover img {
      transform: scale(1.05);
    }

    .about-hero-content h2 {
      font-size: 2.2rem;
      color: var(--eerie-black);
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 15px;
    }

    .about-hero-content h2:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--salmon-pink);
    }

    .about-hero-content p {
      color: var(--sonic-silver);
      line-height: 1.8;
      margin-bottom: 20px;
      font-size: 1.1rem;
    }

    .mission-vision {
      margin-bottom: 80px;
    }

    .mission-vision-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 30px;
      margin-top: 40px;
    }

    @media (min-width: 768px) {
      .mission-vision-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .mission-card,
    .vision-card,
    .values-card {
      background: white;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      text-align: center;
      transition: all 0.3s ease;
      border: 1px solid rgba(0,0,0,0.05);
    }

    .mission-card:hover,
    .vision-card:hover,
    .values-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .card-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--salmon-pink), #ff7a8a);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 25px;
      font-size: 2rem;
      color: white;
      box-shadow: 0 10px 20px rgba(255, 106, 130, 0.3);
    }

    .mission-card h3,
    .vision-card h3,
    .values-card h3 {
      font-size: 1.5rem;
      color: var(--eerie-black);
      margin-bottom: 15px;
    }

    .mission-card p,
    .vision-card p,
    .values-card p {
      color: var(--sonic-silver);
      line-height: 1.8;
      font-size: 1.05rem;
    }

    .team-section {
      margin-bottom: 80px;
    }

    .section-title {
      text-align: center;
      font-size: 2.2rem;
      color: var(--eerie-black);
      margin-bottom: 50px;
      position: relative;
    }

    .section-title:after {
      content: '';
      position: absolute;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--salmon-pink);
      border-radius: 2px;
    }

    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    .team-member {
      background: white;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      text-align: center;
      transition: all 0.3s ease;
      border: 1px solid rgba(0,0,0,0.05);
    }

    .team-member:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .team-member-img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 20px;
      border: 5px solid white;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .team-member h4 {
      font-size: 1.3rem;
      color: var(--eerie-black);
      margin-bottom: 5px;
    }

    .team-member p {
      color: var(--salmon-pink);
      font-weight: 600;
      margin-bottom: 20px;
      font-size: 0.95rem;
    }

    .member-social {
      display: flex;
      justify-content: center;
      gap: 12px;
    }

    .member-social a {
      width: 38px;
      height: 38px;
      background: var(--cultured);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--sonic-silver);
      transition: all 0.3s ease;
    }

    .member-social a:hover {
      background: var(--salmon-pink);
      color: white;
      transform: translateY(-3px);
    }

    .stats-section {
      background: linear-gradient(135deg, #f8f8f8, #f0f0f0);
      padding: 80px 0;
      border-radius: 16px;
      margin-bottom: 80px;
      position: relative;
      overflow: hidden;
    }

    .stats-section:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--salmon-pink), #ff7a8a);
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 40px;
    }

    @media (min-width: 768px) {
      .stats-grid {
        grid-template-columns: repeat(4, 1fr);
      }
    }

    .stat-item {
      text-align: center;
      position: relative;
    }

    .stat-item:not(:last-child):after {
      content: '';
      position: absolute;
      right: -20px;
      top: 50%;
      transform: translateY(-50%);
      width: 1px;
      height: 60px;
      background: rgba(0,0,0,0.1);
    }

    @media (max-width: 767px) {
      .stat-item:nth-child(2n):after {
        display: none;
      }
    }

    .stat-number {
      font-size: 3.5rem;
      font-weight: 800;
      color: var(--salmon-pink);
      margin-bottom: 10px;
      background: linear-gradient(135deg, var(--salmon-pink), #ff7a8a);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .stat-label {
      font-size: 1.1rem;
      color: var(--sonic-silver);
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .why-choose-us {
      margin-bottom: 80px;
    }

    .features-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 25px;
    }

    @media (min-width: 768px) {
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 992px) {
      .features-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .feature-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 20px;
      padding: 40px 30px;
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
      border: 1px solid rgba(0,0,0,0.05);
    }

    .feature-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .feature-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--salmon-pink), #ff7a8a);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      color: white;
      box-shadow: 0 10px 20px rgba(255, 106, 130, 0.3);
    }

    .feature-item h4 {
      font-size: 1.3rem;
      color: var(--eerie-black);
      margin-bottom: 15px;
    }

    .feature-item p {
      color: var(--sonic-silver);
      line-height: 1.8;
      font-size: 1.05rem;
    }

    .cta-section {
      background: linear-gradient(135deg, var(--salmon-pink), #ff7a8a);
      color: white;
      padding: 80px 40px;
      border-radius: 16px;
      text-align: center;
      margin-bottom: 80px;
      position: relative;
      overflow: hidden;
    }

    .cta-section:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('/assets/images/pattern1.jpg') center/cover;
      opacity: 15;
    }

    .cta-about-content {
      position: relative;
      z-index: 1;
      max-width: 700px;
      margin: 0 auto;
    }

    .cta-about-content h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .cta-about-content p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      opacity: 0.9;
      line-height: 1.7;
    }

    .cta-about-content .btn-primary {
      background: white;
      color: var(--salmon-pink);
      font-weight: 600;
      padding: 16px 40px;
      border-radius: 50px;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      border: none;
      cursor: pointer;
      font-size: 1.1rem;
    }

    .cta-about-content .btn-primary:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    /* Animation */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate {
      animation: fadeInUp 0.8s ease forwards;
    }

    .delay-1 {
      animation-delay: 0.2s;
    }

    .delay-2 {
      animation-delay: 0.4s;
    }

    .delay-3 {
      animation-delay: 0.6s;
    }
  </style>

  <!--
    - MAIN
  -->

  <main>
    <div class="page-container">
      <div class="container">
        
        <div class="page-header animate">
          <h1 class="page-title">About HAWAAN</h1>
          <p class="page-subtitle">Discover our story, mission, and commitment to excellence in fashion and lifestyle</p>
        </div>

        <div class="about-content">
          
          <section class="about-hero">
            <div class="about-hero-content animate delay-1">
              <h2>Our Fashion Journey</h2>
              <p>Founded in 2020, HAWAAN began as a vision to revolutionize online fashion shopping by bringing together quality, style, and affordability under one roof. What started as a small team's dream has grown into a trusted destination for millions of fashion-forward customers worldwide.</p>
              <p>Our name "HAWAAN" represents the winds of change in e-commerce - bringing fresh perspectives, innovative designs, and exceptional shopping experiences to the digital marketplace.</p>
              <p>Today, we curate the finest collections from emerging designers and established brands, offering something special for every style and occasion.</p>
            </div>
            <div class="about-hero-image animate delay-2">
              <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Fashion Team Working">
            </div>
          </section>

          <section class="mission-vision">
            <div class="mission-vision-grid">
              <div class="mission-card animate delay-1">
                <div class="card-icon">
                  <ion-icon name="diamond-outline"></ion-icon>
                </div>
                <h3>Our Mission</h3>
                <p>To democratize fashion by making high-quality, trend-forward clothing and accessories accessible to everyone, while maintaining ethical production standards and exceptional customer service.</p>
              </div>
              
              <div class="vision-card animate delay-2">
                <div class="card-icon">
                  <ion-icon name="eye-outline"></ion-icon>
                </div>
                <h3>Our Vision</h3>
                <p>To become the world's most beloved fashion platform, inspiring confidence through style while building sustainable communities and reducing fashion waste.</p>
              </div>
              
              <div class="values-card animate delay-3">
                <div class="card-icon">
                  <ion-icon name="heart-outline"></ion-icon>
                </div>
                <h3>Our Values</h3>
                <p>Authenticity, innovation, customer delight, and sustainability guide everything we do. We believe fashion should make you look good and feel good about your choices.</p>
              </div>
            </div>
          </section>

          <section class="team-section">
            <h2 class="section-title animate">Fashion Architects</h2>
            <div class="team-grid">
              <div class="team-member animate delay-1">
                <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Fashion Director" class="team-member-img">
                <h4>Sarah Johnson</h4>
                <p>Creative Director</p>
                <div class="member-social">
                  <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
                  <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                </div>
              </div>
              
              <div class="team-member animate delay-1">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Head Designer" class="team-member-img">
                <h4>Michael Chen</h4>
                <p>Head Designer</p>
                <div class="member-social">
                  <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
                  <a href="#"><ion-icon name="logo-behance"></ion-icon></a>
                </div>
              </div>
              
              <div class="team-member animate delay-2">
                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=761&q=80" alt="Brand Strategist" class="team-member-img">
                <h4>Emily Rodriguez</h4>
                <p>Brand Strategist</p>
                <div class="member-social">
                  <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
                  <a href="#"><ion-icon name="logo-pinterest"></ion-icon></a>
                </div>
              </div>
              
              <div class="team-member animate delay-3">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80" alt="Sustainability Lead" class="team-member-img">
                <h4>David Kim</h4>
                <p>Sustainability Lead</p>
                <div class="member-social">
                  <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
                  <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
                </div>
              </div>
            </div>
          </section>

          <section class="stats-section">
            <h2 class="section-title animate">By The Numbers</h2>
            <div class="stats-grid">
              <div class="stat-item animate delay-1">
                <div class="stat-number">2M+</div>
                <div class="stat-label">Stylish Customers</div>
              </div>
              <div class="stat-item animate delay-2">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Fashion Items</div>
              </div>
              <div class="stat-item animate delay-1">
                <div class="stat-number">100+</div>
                <div class="stat-label">Countries Served</div>
              </div>
              <div class="stat-item animate delay-2">
                <div class="stat-number">98%</div>
                <div class="stat-label">Happy Customers</div>
              </div>
            </div>
          </section>


          <?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/config.php'); ?>
<?php

$statement = $pdo->prepare("SELECT * FROM tbl_service ORDER BY id ASC");
$statement->execute();
$services = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="why-choose-us">
  <h2 class="section-title animate">The HAWAAN Difference</h2>
  <div class="features-grid">
    <?php
    $delay_classes = ['delay-1', 'delay-2', 'delay-3'];
    $i = 0;
    foreach ($services as $service):
      $delay = $delay_classes[$i % count($delay_classes)];
      $i++;
    ?>
    <div class="feature-item animate <?php echo $delay; ?>">
<div class="feature-icon">
  <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>
</div>

      <h4><?php echo htmlspecialchars($service['title']); ?></h4>
      <p><?php echo htmlspecialchars($service['content']); ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</section>

          <section class="cta-section">
            <div class="cta-about-content animate">
              <h2>Ready to Elevate Your Style?</h2>
              <p>Join millions of fashion-forward customers and discover your perfect look with HAWAAN's curated collections.</p>
              <a href="/HawaanEcommerce/index.html" class="btn-primary">Start Shopping</a>
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
    // Simple animation trigger
    document.addEventListener('DOMContentLoaded', function() {
      const animateElements = document.querySelectorAll('.animate');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
          }
        });
      }, { threshold: 0.1 });

      animateElements.forEach(element => {
        element.style.opacity = 0;
        observer.observe(element);
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