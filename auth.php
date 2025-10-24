<!-- ...HEAD part same rakhna... -->
<body>
  <div class="container">
    <div class="logo">
      <h1>HAWAAN</h1>
      <p>Premium E-commerce</p>
    </div>
    <?php
// Include configuration file
require_once 'config.php';
// Display message if exists
if(isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    echo "<script>alert('$msg')</script>";
    unset($_SESSION['message']);
}

?>
    <!-- Login Form -->
    <div class="form-panel active" id="loginPanel">
      <h2 style="margin-bottom: 20px; color: #333;">Login</h2>
      <form method="POST" action="login.php">
        <div class="form-group">
          <label>Email:</label>
          <input type="email" name="email" id="loginEmail" required />
          <div class="error" id="loginEmailError"></div>
        </div>
        <div class="form-group">
          <label>Password:</label>
          <input type="password" name="password" id="loginPassword" required />
          <div class="error" id="loginPasswordError"></div>
        </div>
        <button type="submit" class="btn">Login</button>
      </form>

      <button class="switch-btn" onclick="showSignup()">Don't have an account? Sign Up</button>
    </div>

    <!-- Signup Form -->
    <div class="form-panel" id="signupPanel">
      <h2 style="margin-bottom: 20px; color: #333;">Sign Up</h2>
      <form method="POST" action="signup.php">
        <div class="form-group">
          <label>Full Name:</label>
          <input type="text" name="name" id="signupName" required />
          <div class="error" id="signupNameError"></div>
        </div>
        <div class="form-group">
          <label>Email:</label>
          <input type="email" name="email" id="signupEmail" required />
          <div class="error" id="signupEmailError"></div>
        </div>
        <div class="form-group">
          <label>Password:</label>
          <input type="password" name="password" id="signupPassword" required />
          <div class="error" id="signupPasswordError"></div>
        </div>
        <div class="form-group">
          <label>Confirm Password:</label>
          <input type="password" name="confirm_password" id="confirmPassword" required />
          <div class="error" id="confirmPasswordError"></div>
        </div>
        <button type="submit" class="btn">Create Account</button>
      </form>

      <button class="switch-btn" onclick="showLogin()">Already have an account? Login</button>
    </div>
  </div>

  <script>
    // Switch between login and signup
    function showLogin() {
      document.getElementById("loginPanel").classList.add("active");
      document.getElementById("signupPanel").classList.remove("active");
    }

    function showSignup() {
      document.getElementById("signupPanel").classList.add("active");
      document.getElementById("loginPanel").classList.remove("active");
    }

    function showError(id, message) {
      const error = document.getElementById(id);
      error.textContent = message;
      error.style.display = "block";
    }

    function hideError(id) {
      document.getElementById(id).style.display = "none";
    }

    function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    }

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Fallback notification function
    function showNotification(message, type = "info") {
        alert(`[${type.toUpperCase()}] ${message}`);
    }
        // Simple form validation
        function validateLogin() {
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        
        if (!email || !password) {
            alert('Please fill all fields');
            return false;
        }
        return true;
        }
         // Enhanced signup validation
    function validateSignup(event) {
        event.preventDefault();
        
        const name = document.getElementById('signupName').value;
        const email = document.getElementById('signupEmail').value;
        const password = document.getElementById('signupPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        let isValid = true;
        
        // Reset errors
        hideError('signupNameError');
        hideError('signupEmailError');
        hideError('signupPasswordError');
        hideError('confirmPasswordError');
        
        // Name validation
        if (!name) {
            showError('signupNameError', 'Name is required');
            isValid = false;
        }
        
        // Email validation
        if (!email) {
            showError('signupEmailError', 'Email is required');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError('signupEmailError', 'Invalid email format');
            isValid = false;
        }
        
        // Password validation
        if (!password) {
            showError('signupPasswordError', 'Password is required');
            isValid = false;
        } else if (password.length < 6) {
            showError('signupPasswordError', 'Password must be at least 6 characters');
            isValid = false;
        }
        
        // Confirm password validation
        if (!confirmPassword) {
            showError('confirmPasswordError', 'Please confirm your password');
            isValid = false;
        } else if (password !== confirmPassword) {
            showError('confirmPasswordError', 'Passwords do not match');
            isValid = false;
        }
        
        // Submit form if valid
        if (isValid) {
            document.getElementById('signupForm').submit();
        }
    }
    
    // Attach validation to form
    document.getElementById('signupForm').addEventListener('submit', validateSignup);
    
    // Attach validation to login form
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        
        let isValid = true;
        
        // Reset errors
        hideError('loginEmailError');
        hideError('loginPasswordError');
        
        // Email validation
        if (!email) {
            showError('loginEmailError', 'Email is required');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError('loginEmailError', 'Invalid email format');
            isValid = false;
        }
        
        // Password validation
        if (!password) {
            showError('loginPasswordError', 'Password is required');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
</script>

  </script>
</body>



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #8B5CF6, #A855F7);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #8B5CF6;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .logo p {
            color: #666;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #8B5CF6;
        }

        .btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #8B5CF6, #A855F7);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .switch-btn {
            background: none;
            border: none;
            color: #8B5CF6;
            cursor: pointer;
            font-size: 14px;
            margin-top: 20px;
            text-decoration: underline;
        }

        .form-panel {
            display: none;
        }

        .form-panel.active {
            display: block;
        }

        .social-login {
            margin: 20px 0;
        }

        .social-btn {
            width: 48%;
            padding: 12px;
            margin: 0 1%;
            border: 2px solid #ddd;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .social-btn:hover {
            border-color: #8B5CF6;
        }

        .divider {
            margin: 20px 0;
            position: relative;
            text-align: center;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #ddd;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #666;
            font-size: 14px;
        }

        .error {
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
    </style>