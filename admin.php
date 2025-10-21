<?php
  include "db.php";
  session_start();

  if (!isset($_SESSION['isLogin'])) {
    header("location: login.php");
    exit;
  }

  if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit;
  }

  $feedback = null;

  if (isset($_POST['delete_produk'], $_POST['produk_id'])) {
    $produkId = (int) $_POST['produk_id'];

    $stmt = $conn->prepare("SELECT gambar FROM produk WHERE id = ?");
    if ($stmt) {
      $stmt->bind_param("i", $produkId);
      if ($stmt->execute()) {
        $stmt->bind_result($gambarPath);
        if ($stmt->fetch()) {
          $stmt->close();

          $deleteStmt = $conn->prepare("DELETE FROM produk WHERE id = ?");
          if ($deleteStmt) {
            $deleteStmt->bind_param("i", $produkId);
            if ($deleteStmt->execute()) {
              if (!empty($gambarPath)) {
                $relativePath = ltrim($gambarPath, '/\\');
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

              $feedback = [
                'type' => 'success',
                'message' => 'Produk berhasil dihapus.'
              ];
            } else {
              $feedback = [
                'type' => 'error',
                'message' => 'Gagal menghapus data produk.'
              ];
            }
            $deleteStmt->close();
          } else {
            $feedback = [
              'type' => 'error',
              'message' => 'Perintah penghapusan tidak valid.'
            ];
          }
        } else {
          $feedback = [
            'type' => 'error',
            'message' => 'Produk tidak ditemukan.'
          ];
          $stmt->close();
        }
      } else {
        $feedback = [
          'type' => 'error',
          'message' => 'Gagal mengambil data produk.'
        ];
        $stmt->close();
      }
    } else {
      $feedback = [
        'type' => 'error',
        'message' => 'Perintah database tidak valid.'
      ];
    }
  }

  $sql = "SELECT * FROM produk ORDER BY created_at DESC";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth antialiased">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin | Anugrah Jatiwangi</title>
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
        <!-- <header
          class="sticky top-0 z-40 border-b border-slate-200 bg-white/70 backdrop-blur"
        >
          <div
            class="flex flex-col gap-4 px-6 py-5 md:flex-row md:items-center md:justify-between"
          >
            <div>
              <p
                class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-500"
              >
                Dashboard Admin
              </p>
              <h1 class="mt-1 text-2xl font-bold text-slate-900">
                Kelola Produk &amp; Katalog
              </h1>
            </div>
          </div>
        </header> -->

        <section id="produk" class="px-6 py-6 pb-12">
          <?php if ($feedback): ?>
            <div class="mx-auto mb-6 max-w-6xl">
              <div class="<?= $feedback['type'] === 'success' ? 'rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700' : 'rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700' ?>">
                <?= htmlspecialchars($feedback['message'], ENT_QUOTES, 'UTF-8') ?>
              </div>
            </div>
          <?php endif; ?>
          <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div
              class="flex flex-col gap-4 border-b border-slate-200 px-6 py-5 lg:flex-row lg:items-center lg:justify-between"
            >
              <div>
                <h2 class="text-xl font-semibold text-slate-900">
                  Daftar Produk &amp; Katalog
                </h2>
                <p class="text-sm text-slate-500">
                  Kelola informasi produk, harga, dan status ketersediaan.
                </p>
              </div>
              <div class="flex flex-wrap items-center gap-3">
                <a
                  href="tambah-data.php"
                  class="inline-flex items-center gap-2 rounded-full bg-primary-500 px-5 py-2 text-sm font-semibold text-white shadow-soft transition hover:bg-primary-400"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M12 5v14" />
                    <path d="M5 12h14" />
                  </svg>
                  Tambah Produk
                </a>
              </div>
            </div>

            <div class="overflow-x-auto">
  <table class="min-w-full divide-y divide-slate-200 text-sm">
    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">
      <tr>
        <th class="px-6 py-3 text-left">Produk</th>
        <th class="px-6 py-3 text-left">Tagline</th>
        <th class="px-6 py-3 text-left">Deskripsi</th>
        <th class="px-6 py-3 text-center">Tanggal Dibuat</th>
        <th class="px-6 py-3 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-200 bg-white">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr class="hover:bg-slate-50">
            <td class="px-6 py-4">
              <div class="flex items-center gap-4">
                <span class="inline-flex h-12 w-12 items-center justify-center overflow-hidden rounded-xl bg-slate-100">
                  <img
                    src="<?= htmlspecialchars($row['gambar'], ENT_QUOTES, 'UTF-8') ?>"
                    alt="<?= htmlspecialchars($row['nama_produk'], ENT_QUOTES, 'UTF-8') ?>"
                    class="h-full w-full object-cover"
                  />
                </span>
                <div>
                  <p class="font-semibold text-slate-900"><?= htmlspecialchars($row['nama_produk'], ENT_QUOTES, 'UTF-8') ?></p>
                  <p class="text-xs text-slate-500">ID: <?= (int) $row['id'] ?></p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 text-slate-600">
              <?= htmlspecialchars($row['tagline'], ENT_QUOTES, 'UTF-8') ?>
            </td>
            <td class="px-6 py-4 text-slate-600">
              <?= htmlspecialchars($row['deskripsi'], ENT_QUOTES, 'UTF-8') ?>
            </td>
            <td class="px-6 py-4 text-center text-slate-600">
              <?= htmlspecialchars(!empty($row['created_at']) ? date("d M Y", strtotime($row['created_at'])) : '-', ENT_QUOTES, 'UTF-8') ?>
            </td>
            <td class="px-6 py-4 text-center">
              <div class="inline-flex items-center gap-2">
                <a
                  href="edit-data.php?id=<?= (int) $row['id'] ?>"
                  class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 transition hover:border-primary-400 hover:text-primary-500"
                >
                  Edit
                </a>
                <form
                  method="POST"
                  class="inline-flex"
                  onsubmit="return confirm('Yakin ingin menghapus produk ini?');"
                >
                  <input type="hidden" name="produk_id" value="<?= (int) $row['id'] ?>" />
                  <button
                    type="submit"
                    name="delete_produk"
                    value="1"
                    class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 transition hover:border-rose-300 hover:text-rose-500"
                  >
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="px-6 py-4 text-center text-slate-500">Belum ada produk</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

          </div>
        </section>
      </main>
    </div>
  </body>
</html>





