<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    :root {
      --primary: #3a6ea5;
      --accent: #5b8dbb;
      --bg-dark: #0f172a;
      --text: #1e293b;
      --muted: #94a3b8;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(135deg, #C4D7E0, #3a6ea5);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .bg-bubble {
      position: absolute;
      width: 200px;
      height: 200px;
      background: var(--accent);
      opacity: 0.15;
      border-radius: 50%;
      filter: blur(50px);
      animation: float 8s ease-in-out infinite;
    }
    .bg-bubble:nth-child(1) { top: 10%; left: 15%; animation-delay: 0s; }
    .bg-bubble:nth-child(2) { bottom: 15%; right: 10%; animation-delay: 2s; }
    .bg-bubble:nth-child(3) { top: 40%; right: 40%; animation-delay: 4s; }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(25px); }
    }

    .login-card {
      position: relative;
      background: white;
      width: 380px;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      padding: 40px 35px;
      text-align: center;
      z-index: 2;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-card h2 {
      color: var(--text);
      font-weight: 600;
      margin-bottom: 8px;
    }

    .login-card p {
      color: var(--muted);
      font-size: 0.95rem;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 18px;
      text-align: left;
    }

    label {
      display: block;
      color: var(--text);
      font-size: 0.9rem;
      margin-bottom: 6px;
    }

    input {
      width: 100%;
      padding: 10px 12px;
      border-radius: 10px;
      border: 1px solid #d1d5db;
      background: #f9fafb;
      font-size: 0.95rem;
      transition: 0.3s;
    }

    input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(73, 39, 208, 0.2);
      background: #fff;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background: var(--primary);
      color: #fff;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background: #051a48;
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(6, 3, 57, 0.3);
    }

    .alert {
      background: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fecaca;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 15px;
      font-size: 0.9rem;
      animation: fadeIn 0.3s ease;
    }

    .footer {
      margin-top: 20px;
      font-size: 0.85rem;
      color: var(--muted);
    }
  </style>
</head>
<body>
  <div class="bg-bubble"></div>
  <div class="bg-bubble"></div>
  <div class="bg-bubble"></div>

  <div class="login-card">
    <h2>Selamat Datang!!</h2>

    @if($errors->any())
      <div class="alert">
        @foreach($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <div class="form-group">
        <label for="username">Nama Pengguna</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required placeholder="Masukkan username">
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input id="password" type="password" name="password" required placeholder="Masukkan password">
      </div>

      <button type="submit" class="btn">Masuk</button>
    </form>

    <div class="footer">
      @ Sistem Kependudukan Desa Andromeda
    </div>
  </div>
</body>
</html>
    