<?php
  include "db.php";
  session_start();

  if (!isset($_SESSION['isLogin'])) {
    header("location: login.php");
    exit;
  }

  $feedback = null;
  $produk = null;

  $produkId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
  if ($produkId <= 0) {
    header("location: admin.php");
    exit;
  }

  $stmt = $conn->prepare("SELECT id, nama_produk, deskripsi, tagline, gambar FROM produk WHERE id = ?");
  if ($stmt) {
    $stmt->bind_param("i", $produkId);
    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $produk = $result->fetch_assoc();
      $stmt->close();

      if (!$produk) {
        header("location: admin.php");
        exit;
      }
    } else {
      $stmt->close();
      $feedback = [
        'type' => 'error',
        'message' => 'Gagal mengambil data produk.'
      ];
    }
  } else {
    $feedback = [
      'type' => 'error',
      'message' => 'Perintah database tidak valid.'
    ];
  }

  $nama_produk = $produk['nama_produk'] ?? '';
  $deskripsi = $produk['deskripsi'] ?? '';
  $tagline = $produk['tagline'] ?? '';
  $gambar_lama = $produk['gambar'] ?? '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = trim($_POST['nama_produk'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $tagline = trim($_POST['tagline'] ?? '');
    $gambar_path = $gambar_lama;
    $errors = [];

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

            if (!empty($gambar_lama)) {
              $relativePath = ltrim($gambar_lama, '/\\');
              $normalizedPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath);
              $fullPath = __DIR__ . DIRECTORY_SEPARATOR . $normalizedPath;

              if (is_file($fullPath)) {
                $rootPath = realpath(__DIR__);
                $filePath = realpath($fullPath);

                if ($filePath !== false && $rootPath !== false && strpos($filePath, $rootPath) === 0) {
                  unlink($fullPath);
                }
              }
            }
          }
        }
      } else {
        $errors[] = 'Terjadi kesalahan saat mengunggah gambar.';
      }
    }

    if (empty($errors)) {
      $updateStmt = $conn->prepare('UPDATE produk SET nama_produk = ?, deskripsi = ?, tagline = ?, gambar = ? WHERE id = ?');
      if ($updateStmt) {
        $updateStmt->bind_param('ssssi', $nama_produk, $deskripsi, $tagline, $gambar_path, $produkId);

        if ($updateStmt->execute()) {
          $feedback = [
            'type' => 'success',
            'message' => 'Produk berhasil diperbarui.'
          ];
          $gambar_lama = $gambar_path;
          header("location: admin.php");
        } else {
          $errors[] = 'Gagal memperbarui data produk.';
        }
        $updateStmt->close();
      } else {
        $errors[] = 'Perintah pembaruan tidak valid.';
      }
    }

    if (!empty($errors)) {
      $feedback = [
        'type' => 'error',
        'message' => implode(' ', $errors)
      ];
    }
  }
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth antialiased">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin | Edit Produk</title>
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
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-500">Update</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Edit Produk &amp; Katalog</h1>
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
          <?php if ($feedback): ?>
            <div class="<?= $feedback['type'] === 'success' ? 'mb-6 rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700' : 'mb-6 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700' ?>">
              <?= htmlspecialchars($feedback['message'], ENT_QUOTES, 'UTF-8') ?>
            </div>
          <?php endif; ?>

          <form method="POST" enctype="multipart/form-data" class="space-y-6 rounded-3xl border border-slate-200 bg-white p-8 shadow-soft">
            <div>
              <label for="nama_produk" class="text-sm font-semibold text-slate-600">Nama Produk</label>
              <input
                type="text"
                id="nama_produk"
                name="nama_produk"
                value="<?= htmlspecialchars($nama_produk, ENT_QUOTES, 'UTF-8') ?>"
                required
                class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
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
              ><?= htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <div>
              <label for="tagline" class="text-sm font-semibold text-slate-600">Tagline / Highlight</label>
              <input
                type="text"
                id="tagline"
                name="tagline"
                value="<?= htmlspecialchars($tagline, ENT_QUOTES, 'UTF-8') ?>"
                required
                class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
              />
              <p class="mt-2 text-xs text-slate-500">Pisahkan beberapa highlight dengan koma.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-[1fr_auto] md:items-start">
              <div>
                <label for="gambar" class="text-sm font-semibold text-slate-600">Gambar Produk (Opsional)</label>
                <input
                  type="file"
                  id="gambar"
                  name="gambar"
                  accept=".jpg,.jpeg,.png,.webp"
                  class="mt-2 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-primary-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-primary-400"
                />
                <p class="mt-2 text-xs text-slate-500">Jika tidak memilih file, gambar lama akan tetap digunakan.</p>
              </div>
              <div class="flex flex-col items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <span class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Gambar Saat Ini</span>
                <div class="h-24 w-24 overflow-hidden rounded-xl bg-white">
                  <?php if (!empty($gambar_lama)): ?>
                    <img
                      src="<?= htmlspecialchars($gambar_lama, ENT_QUOTES, 'UTF-8') ?>"
                      alt="<?= htmlspecialchars($nama_produk, ENT_QUOTES, 'UTF-8') ?>"
                      class="h-full w-full object-cover"
                    />
                  <?php else: ?>
                    <div class="flex h-full w-full items-center justify-center text-xs text-slate-400">Tidak ada gambar</div>
                  <?php endif; ?>
                </div>
              </div>
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
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
