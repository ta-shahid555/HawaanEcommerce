<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php'); ?>


  <!--
    - MAIN
  -->

  <main>

    <div class="page-container">
      <div class="container">
        
        <div class="page-header">
          <h1 class="page-title">Contact Us</h1>
          <p class="page-subtitle">We'd love to hear from you. Get in touch with us!</p>
        </div>

        <div class="contact-content">
          
          <section class="contact-info">
            <div class="contact-info-grid">
              <div class="contact-card">
                <div class="contact-icon">
                  <ion-icon name="location-outline"></ion-icon>
                </div>
                <h3>Visit Us</h3>
                <p>419 State 414 Rte<br>Beaver Dams, New York(NY)<br>14812, USA</p>
              </div>
              
              <div class="contact-card">
                <div class="contact-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
                <h3>Call Us</h3>
                <p>Phone: <a href="tel:+607936-8058">(607) 936-8058</a><br>
                   Toll Free: <a href="tel:+1800123456">1-800-123-456</a></p>
              </div>
              
              <div class="contact-card">
                <div class="contact-icon">
                  <ion-icon name="mail-outline"></ion-icon>
                </div>
                <h3>Email Us</h3>
                <p>General: <a href="mailto:info@hawaan.com">info@hawaan.com</a><br>
                   Support: <a href="mailto:support@hawaan.com">support@hawaan.com</a></p>
              </div>
              
              <div class="contact-card">
                <div class="contact-icon">
                  <ion-icon name="time-outline"></ion-icon>
                </div>
                <h3>Business Hours</h3>
                <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                   Saturday: 10:00 AM - 4:00 PM<br>
                   Sunday: Closed</p>
              </div>
            </div>
          </section>

          <section class="contact-form-section">
            <div class="contact-form-container">
              <div class="form-header">
                <h2>Send us a Message</h2>
                <p>Fill out the form below and we'll get back to you as soon as possible.</p>
              </div>
              
              <form class="contact-form" id="contactForm">
                <div class="form-row">
                  <div class="form-group">
                    <label for="firstName">First Name *</label>
                    <input type="text" id="firstName" name="firstName" required>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last Name *</label>
                    <input type="text" id="lastName" name="lastName" required>
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="subject">Subject *</label>
                  <select id="subject" name="subject" required>
                    <option value="">Select a subject</option>
                    <option value="general">General Inquiry</option>
                    <option value="support">Customer Support</option>
                    <option value="order">Order Issue</option>
                    <option value="return">Return/Exchange</option>
                    <option value="partnership">Partnership</option>
                    <option value="feedback">Feedback</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="message">Message *</label>
                  <textarea id="message" name="message" rows="6" required placeholder="Please describe your inquiry in detail..."></textarea>
                </div>
                
                <div class="form-group checkbox-group">
                  <label class="checkbox-label">
                    <input type="checkbox" id="newsletter" name="newsletter">
                    <span class="checkmark"></span>
                    Subscribe to our newsletter for updates and special offers
                  </label>
                </div>
                
                <button type="submit" class="btn-primary submit-btn">
                  <ion-icon name="send-outline"></ion-icon>
                  Send Message
                </button>
              </form>
            </div>
          </section>

          <section class="map-section">
            <h2>Find Us on Map</h2>
            <div class="map-container">
              <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.123456789!2d-74.0059413!3d40.7127753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQyJzQ2LjAiTiA3NMKwMDAnMjEuNCJX!5e0!3m2!1sen!2sus!4v1234567890123"
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </section>

          <section class="faq-preview">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-grid">
              <div class="faq-item">
                <h4>How can I track my order?</h4>
                <p>You can track your order using the tracking number sent to your email after purchase.</p>
              </div>
              <div class="faq-item">
                <h4>What is your return policy?</h4>
                <p>We offer a 30-day return policy for all unused items in original packaging.</p>
              </div>
              <div class="faq-item">
                <h4>Do you offer international shipping?</h4>
                <p>Yes, we ship to over 100 countries worldwide with various shipping options.</p>
              </div>
              <div class="faq-item">
                <h4>How can I change my order?</h4>
                <p>Contact us within 24 hours of placing your order to make changes.</p>
              </div>
            </div>
            <div class="faq-cta">
              <a href="other pages/faq.html" class="btn-secondary">View All FAQs</a>
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
document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('contact-handler.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === 'success') {
      alert("Message sent successfully!");
      document.getElementById('contactForm').reset();
    } else {
      alert("Failed to send message: " + data);
    }
  })
  .catch(error => {
    alert("Error: " + error);
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