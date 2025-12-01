<?php
  include "db.php";
  session_start();

  if (!isset($_SESSION['isLogin'])) {
    header("location: login.php");
    exit;
  }

  $nama_produk = '';
  $deskripsi = '';
  $tagline = '';
  $success_message = '';
  $errors = [];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = trim($_POST['nama_produk'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $tagline = trim($_POST['tagline'] ?? '');
    $gambar_path = '';

    if ($nama_produk === '') {
      $errors[] = 'Nama produk wajib diisi.';
    }

    if ($deskripsi === '') {
      $errors[] = 'Deskripsi produk wajib diisi.';
    }

    if ($tagline === '') {
      $errors[] = 'Tagline produk wajib diisi.';
    }

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
      if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $extension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowed_extensions, true)) {
          $errors[] = 'Format gambar tidak didukung. Gunakan JPG, JPEG, PNG, atau WEBP.';
        } else {
          $new_filename = 'produk_' . uniqid('', true) . '.' . $extension;
          $destination = __DIR__ . '/produk/' . $new_filename;

          if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $destination)) {
            $errors[] = 'Gagal menyimpan gambar ke server.';
          } else {
            $gambar_path = 'produk/' . $new_filename;
          }
        }
      } else {
        $errors[] = 'Terjadi kesalahan saat mengunggah gambar.';
      }
    } else {
      $errors[] = 'Gambar produk wajib diunggah.';
    }

    if (empty($errors) && $gambar_path !== '') {
      $stmt = $conn->prepare('INSERT INTO produk (nama_produk, deskripsi, tagline, gambar) VALUES (?, ?, ?, ?)');

      if ($stmt) {
        $stmt->bind_param('ssss', $nama_produk, $deskripsi, $tagline, $gambar_path);

        if ($stmt->execute()) {
          $success_message = 'Produk berhasil ditambahkan.';
          $nama_produk = '';
          $deskripsi = '';
          $tagline = '';
          header("location: admin.php");
        } else {
          $errors[] = 'Gagal menyimpan data produk ke database.';
        }

        $stmt->close();
      } else {
        $errors[] = 'Perintah database tidak valid.';
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth antialiased">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin | Tambah Produk</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
  />
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
              900: "#3d1a04",
            },
            accent: "#0f172a",
          },
          fontFamily: {
            sans: ["Montserrat", "ui-sans-serif", "system-ui", "sans-serif"],
          },
          boxShadow: {
            soft: "0 25px 50px -20px rgb(15 23 42 / 0.25)",
          },
        },
      },
    };
  </script>
</head>
<body class="bg-slate-100 font-sans text-slate-700">
  <div class="min-h-screen lg:flex">
    <?php include 'navside.php'; ?>
    <main class="flex-1">
      <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/70 backdrop-blur">
        <div class="flex flex-col gap-4 px-6 py-5 md:flex-row md:items-center md:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-500">Create</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Tambah Produk &amp; Katalog</h1>
          </div>
          <a
            href="admin.php"
            class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 transition hover:border-primary-400 hover:text-primary-500"
          >
            Kembali ke Dashboard
          </a>
        </div>
      </header>

      <section class="px-6 py-10">
        <div class="mx-auto max-w-3xl">
          <?php if (!empty($success_message)) : ?>
            <div class="mb-6 rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700">
              <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($errors)) : ?>
            <div class="mb-6 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
              <ul class="list-disc space-y-1 pl-5">
                <?php foreach ($errors as $error) : ?>
                  <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="POST" enctype="multipart/form-data" class="space-y-6 rounded-3xl border border-slate-200 bg-white p-8 shadow-soft">
            <div>
              <label for="nama_produk" class="text-sm font-semibold text-slate-600">Nama Produk</label>
              <input
                type="text"
                id="nama_produk"
                name="nama_produk"
                value="<?php echo htmlspecialchars($nama_produk, ENT_QUOTES, 'UTF-8'); ?>"
                required
                class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
                placeholder="Contoh: Genteng Beton Super"
              />
            </div>

            <div>
              <label for="deskripsi" class="text-sm font-semibold text-slate-600">Deskripsi Produk</label>
              <textarea
                id="deskripsi"
                name="deskripsi"
                rows="4"
                required
                class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
                placeholder="Tulis spesifikasi singkat, ukuran, dan keunggulan utama."
              ><?php echo htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div>
              <label for="tagline" class="text-sm font-semibold text-slate-600">Tagline / Highlight</label>
              <input
                type="text"
                id="tagline"
                name="tagline"
                value="<?php echo htmlspecialchars($tagline, ENT_QUOTES, 'UTF-8'); ?>"
                required
                class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
                placeholder="Contoh: Batch Ready, Best Seller"
              />
              <p class="mt-2 text-xs text-slate-500">Pisahkan beberapa highlight dengan koma.</p>
            </div>

            <div>
              <label for="gambar" class="text-sm font-semibold text-slate-600">Gambar Produk</label>
              <input
                type="file"
                id="gambar"
                name="gambar"
                accept=".jpg,.jpeg,.png,.webp"
                required
                class="mt-2 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-primary-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-primary-400"
              />
              <p class="mt-2 text-xs text-slate-500">Format yang didukung: JPG, JPEG, PNG, WEBP. File akan disimpan di folder produk.</p>
            </div>

            <div class="flex items-center justify-end gap-3">
              <a
                href="admin.php"
                class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 transition hover:border-primary-400 hover:text-primary-500"
              >
                Batal
              </a>
              <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-full bg-primary-500 px-6 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
              >
                Simpan Produk
              </button>
            </div>
          </form>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
