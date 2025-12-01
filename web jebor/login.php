<?php
  include "db.php";
  session_start();

  if(isset($_SESSION['isLogin'])) {
    header("location: admin.php");
  }

  if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
       $data = $result->fetch_assoc();
       $_SESSION["username"] = $data["username"];
       $_SESSION["isLogin"] = True;
       header("location: admin.php");
    } else {
      echo "Akun tidak ada";
    }
  }
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth antialiased">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Mitra | Anugrah Jatiwangi</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: "#b45309",
              50: "#fef6ec",
              100: "#fde7d0",
              200: "#f9cda3",
              300: "#f4a76d",
              400: "#e87e30",
              500: "#d5661b",
              600: "#b45309",
              700: "#8a3f09",
              800: "#5e2906",
              900: "#3d1a04"
            },
            accent: "#0f172a"
          },
          fontFamily: {
            sans: ["Montserrat", "ui-sans-serif", "system-ui", "sans-serif"]
          },
          boxShadow: {
            soft: "0 25px 50px -20px rgb(15 23 42 / 0.25)"
          }
        }
      }
    };
  </script>
</head>
<body class="bg-slate-950 font-sans text-base text-slate-100">
  <div class="flex min-h-screen flex-col">
    <header class="border-b border-slate-800 bg-slate-950/80">
      <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8">
        <a href="index.html" class="flex items-center gap-3">
          <img src="gambar/logo.jpg" alt="Logo Pabrik Genteng" class="h-12 w-12 rounded-full object-cover ring-4 ring-primary-400/40" />
          <div class="leading-tight">
            <span class="block text-[11px] font-semibold uppercase tracking-[0.3em] text-primary-400">Anugrah</span>
            <span class="text-lg font-bold text-white">Jatiwangi</span>
          </div>
        </a>
        <a
          href="https://wa.me/6281234567890"
          target="_blank"
          rel="noopener"
          class="inline-flex items-center gap-2 rounded-full border border-primary-400/40 px-5 py-2.5 text-sm font-semibold text-primary-200 transition hover:border-primary-300 hover:text-primary-100"
        >
          Butuh Bantuan?
        </a>
      </div>
    </header>

    <main class="flex-1">
      <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900"></div>
        <div class="mx-auto flex max-w-6xl flex-col gap-12 px-4 py-16 sm:px-6 lg:flex-row lg:items-center lg:gap-16 lg:px-8 lg:py-24">
          <div class="max-w-xl space-y-6">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-primary-200">
              Dashboard Mitra
            </span>
            <h1 class="text-3xl font-bold text-white sm:text-4xl">Masuk untuk Memantau Produksi & Pengiriman</h1>
            <p class="text-base text-slate-300">
              Akses data produksi harian, status pengiriman, dan histori tagihan secara realtime. Nikmati layanan prioritas dengan akun mitra Anugrah Jatiwangi.
            </p>
            <ul class="space-y-4 text-sm text-slate-300">
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary-500/10 text-primary-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m4 12 4 4 12-12" />
                  </svg>
                </span>
                Dashboard stok dan progres produksi terintegrasi dengan pabrik.
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary-500/10 text-primary-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m4 12 4 4 12-12" />
                  </svg>
                </span>
                Tracking pengiriman lengkap dengan bukti serah terima digital.
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary-500/10 text-primary-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m4 12 4 4 12-12" />
                  </svg>
                </span>
                Riwayat transaksi dan invoice dapat diunduh kapan saja.
              </li>
            </ul>
          </div>
          <form method="POST" action="login.php" class="w-full max-w-md rounded-3xl border border-white/10 bg-white/5 p-8 shadow-soft backdrop-blur">
            <h2 class="text-xl font-semibold text-white">Login Mitra</h2>
            <p class="mt-2 text-sm text-slate-300">Gunakan email dan kata sandi yang terdaftar untuk masuk ke dashboard.</p>
            <div class="mt-6 space-y-5">
              <div>
                <label for="login-email" class="text-sm font-medium text-slate-200">Email</label>
                <input
                  type="text"
                  name="username"
                  placeholder="Masukkan Username"
                  required
                  class="mt-2 w-full rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm text-white placeholder-white/50 transition focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-primary-400/40"
                />
              </div>
              <div>
                <div class="flex items-center justify-between">
                  <label for="login-password" class="text-sm font-medium text-slate-200">Kata Sandi</label>
                  <a href="#" class="text-xs font-semibold text-primary-200 transition hover:text-primary-100">Lupa password?</a>
                </div>
                <input
                  type="password"
                  name="password"
                  placeholder="Masukkan kata sandi"
                  required
                  class="mt-2 w-full rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-sm text-white placeholder-white/50 transition focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-primary-400/40"
                />
              </div>
            </div>
            <button
              type="submit"
              name="login"
              class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-full bg-primary-500 px-6 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-primary-400"
            >
              Masuk
            </button>
            <p class="mt-4 text-xs text-slate-400">
              Belum punya akun? <a href="index.html#kontak" class="font-semibold text-primary-200 transition hover:text-primary-100">Hubungi kami</a> untuk registrasi mitra.
            </p>
          </form>
        </div>
      </div>
    </main>

    <footer class="border-t border-slate-800 bg-slate-950/80">
      <p class="mx-auto max-w-6xl px-4 py-6 text-center text-xs uppercase tracking-[0.3em] text-slate-500 sm:px-6 lg:px-8">
        &copy; <span id="year"></span> Pabrik Genteng Anugrah Jatiwangi. All Rights Reserved.
      </p>
    </footer>
  </div>

  <script>
    const yearEl = document.getElementById("year");
    if (yearEl) {
      yearEl.textContent = new Date().getFullYear();
    }
  </script>
</body>
</html>
