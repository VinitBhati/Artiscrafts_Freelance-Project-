<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Data Admin | Artiscrafts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

  <style>
    /* ==== Background ==== */
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: radial-gradient(circle at top left, #003366, #001a33 60%) no-repeat fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      font-family: "Poppins", sans-serif;
      overflow: hidden;
      position: relative;
    }

    /* Optional animated glow circles */
    body::before, body::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(0, 255, 255, 0.25), transparent 60%);
      filter: blur(80px);
      animation: moveGlow 10s infinite alternate ease-in-out;
    }

    body::before {
      top: 10%;
      left: 10%;
    }

    body::after {
      bottom: 10%;
      right: 15%;
      animation-delay: 3s;
    }

    @keyframes moveGlow {
      from {
        transform: translate(0px, 0px);
      }

      to {
        transform: translate(40px, 40px);
      }
    }

    /* ==== Login Card ==== */
    .login-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(18px);
      border-radius: 18px;
      padding: 45px 50px;
      width: 90%;
      max-width: 400px;
      text-align: center;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
      border: 1px solid rgba(255, 255, 255, 0.2);
      position: relative;
      z-index: 2;
    }

    .login-card h1 {
      font-size: 2.4rem;
      font-weight: 700;
      margin-bottom: 25px;
      background: linear-gradient(90deg, #00f0ff, #00aaff, #0066ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 1px;
      text-shadow: 0 0 12px rgba(0, 255, 255, 0.3);
    }

    .login-card input[type="password"] {
      background-color: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
      border: 2px solid #00b7ffb3;
      padding: 12px 18px;
      color: white;
      width: 100%;
      font-size: 1rem;
      outline: none;
      transition: all 0.3s ease;
    }

    .login-card input[type="password"]::placeholder {
      color: rgba(255, 255, 255, 0.8);
    }

    .login-card input[type="password"]:focus {
      border-color: #00f0ff;
      box-shadow: 0 0 12px #00f0ff;
    }

    .login-card button {
      background: linear-gradient(90deg, #007bff, #00c6ff);
      border: none;
      padding: 10px 40px;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      margin-top: 20px;
      transition: 0.3s ease;
      box-shadow: 0 0 10px rgba(0, 198, 255, 0.4);
    }

    .login-card button:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 20px rgba(0, 198, 255, 0.6);
    }

    #alertMessage {
      margin-top: 10px;
      font-weight: 500;
    }

    @media (max-width: 500px) {
      .login-card {
        padding: 30px 25px;
      }

      .login-card h1 {
        font-size: 1.9rem;
      }
    }
  </style>
</head>

<body>

  <div class="login-card">
    <h1>Artiscrafts</h1>

    <!-- ✅ PHP form remains same -->
    <form action="dashboard.php" method="post" id="loginForm">
      <div class="mb-3">
        <input type="password" placeholder="Enter Password*" id="pass" name="pass" autocomplete="off" required>
      </div>

      <button type="submit">Login</button>

      <div id="alertMessage" style="display: none;"></div>
    </form>
  </div>

  <script>
    const DEFAULT_PASSWORD = "3236";

    function getStoredPassword() {
      return localStorage.getItem("fixedPassword") || DEFAULT_PASSWORD;
    }

    let fixedPassword = getStoredPassword();

    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const userPassword = document.getElementById("pass").value;

      if (userPassword === fixedPassword) {
        window.location.href = "dashboard.php";
      } else {
        showAlert("Incorrect password. Please try again.", "error");
      }
    });

    function showAlert(message, type) {
      const alertBox = document.getElementById("alertMessage");
      alertBox.style.display = "block";
      alertBox.style.color = type === "success" ? "#00ffcc" : "#ff4d4d";
      alertBox.textContent = message;

      setTimeout(() => {
        alertBox.style.display = "none";
      }, 2000);
    }
  </script>

</body>

</html>
