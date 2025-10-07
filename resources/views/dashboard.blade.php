<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <style>
    :root {
      --primary: #C4D7E0;
      --secondary: #3a6ea5;
      --text-dark: #1e293b;
      --text-muted: #64748b;
      --white: #ffffff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .dashboard-card {
      background: var(--white);
      padding: 50px 70px;
      border-radius: 20px;
      box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 400px;
      animation: fadeIn 0.8s ease;
    }

    h1 {
      color: var(--text-dark);
      font-size: 1.5rem;
      margin-bottom: 10px;
      letter-spacing: 0.5px;
    }

    p {
      color: var(--text-muted);
      font-size: 1rem;
      margin-bottom: 30px;
    }

    .success {
      background-color: #DDF3F5;
      color: #0c4a6e;
      padding: 10px 15px;
      border-radius: 10px;
      font-size: 0.9rem;
      margin-bottom: 20px;
      display: inline-block;
    }

    .btn {
      display: inline-block;
      background-color: var(--primary);
      color: var(--white);
      padding: 10px 25px;
      border-radius: 10px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #A8C7D5;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(25px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="dashboard-card">
    @if($message)
      <div class="success">{{ $message }}</div>
    @endif

    <h1>Selamat Datang, {{ $username }}</h1>

  </div>
</body>
</html>
