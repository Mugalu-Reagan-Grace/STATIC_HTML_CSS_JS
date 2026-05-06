<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - <?= SCHOOL_NAME_UPPER ?></title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      .login-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 100%;
        padding: 40px;
      }

      .logo-section {
        text-align: center;
        margin-bottom: 30px;
      }

      .logo-section h1 {
        color: #1e3a8a;
        font-size: 24px;
        margin-bottom: 10px;
      }

      .logo-section p {
        color: #666;
        font-size: 14px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: 14px;
      }

      input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
      }

      input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
      }

      .login-btn {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition:
          transform 0.2s,
          box-shadow 0.2s;
        margin-top: 10px;
      }

      .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(30, 58, 138, 0.3);
      }

      .login-btn:active {
        transform: translateY(0);
      }

      .error-message {
        background: #fee;
        color: #c33;
        padding: 12px;
        border-radius: 6px;
        margin-bottom: 20px;
        display: none;
        font-size: 14px;
      }

      .loading {
        display: none;
        text-align: center;
        color: #666;
        font-size: 14px;
        margin-top: 10px;
      }

      .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3b82f6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 8px;
      }

      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }

      .back-link {
        text-align: center;
        margin-top: 20px;
      }

      .back-link a {
        color: #3b82f6;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
      }

      .back-link a:hover {
        color: #1e3a8a;
      }

      @media (max-width: 480px) {
        .login-container {
          padding: 30px 20px;
        }

        .logo-section h1 {
          font-size: 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="logo-section">
        <h1>🔐 Admin Portal</h1>
        <p><?= SCHOOL_NAME_UPPER ?></p>
      </div>

      <div id="errorMessage" class="error-message"></div>

      <form id="loginForm" action="./admin/login.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            required
            autocomplete="username"
            placeholder="Enter your username"
          />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            required
            autocomplete="current-password"
            placeholder="Enter your password"
          />
        </div>

        <button type="submit" class="login-btn">Sign In</button>

        <div class="loading">
          <span class="spinner"></span>
          <span>Authenticating...</span>
        </div>
      </form>

      <div class="back-link">
        <a href="./home.php">← Back to Website</a>
      </div>
    </div>

    <script>
      const form = document.getElementById("loginForm");
      const errorMsg = document.getElementById("errorMessage");
      const loading = document.querySelector(".loading");
      const loginBtn = form.querySelector("button[type='submit']");

      form.addEventListener("submit", () => {
        errorMsg.style.display = "none";
        loading.style.display = "block";
        loginBtn.disabled = true;
      });
    </script>
  </body>
</html>




