<?php
  include "db.php";

  $produk_items = [];

  if (isset($conn) && $conn instanceof mysqli) {
    $produk_result = $conn->query("SELECT nama_produk, deskripsi, tagline, gambar FROM produk ORDER BY id DESC");

    if ($produk_result) {
      while ($row = $produk_result->fetch_assoc()) {
        $produk_items[] = $row;
      }
      $produk_result->free();
    }
  }
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth antialiased">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pabrik Genteng Anugrah Jatiwangi</title>
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
  <body class="bg-slate-50 font-sans text-base text-slate-700">
    <header
      class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur"
    >
      <div
        class="relative mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8"
      >
        <a href="#beranda" class="flex items-center gap-3">
          <img
            src="gambar/logo.jpg"
            alt="Logo Pabrik Genteng"
            class="h-12 w-12 rounded-full object-cover ring-4 ring-primary-100"
          />
          <div class="leading-tight">
            <span
              class="block text-[11px] font-semibold uppercase tracking-[0.3em] text-primary-500"
              >Anugrah</span
            >
            <span class="text-lg font-bold text-slate-900">Jatiwangi</span>
          </div>
        </a>
        <nav
          data-nav-menu
          class="absolute left-4 right-4 top-full z-40 hidden flex-col gap-2 rounded-2xl border border-slate-200 bg-white px-4 pb-6 pt-2 text-sm font-semibold text-slate-700 shadow-soft lg:static lg:flex lg:flex-1 lg:flex-row lg:items-center lg:justify-center lg:gap-8 lg:border-0 lg:bg-transparent lg:p-0 lg:text-slate-600 lg:shadow-none"
        >
          <a href="#beranda" class="rounded-full px-4 py-2 transition hover:bg-primary-50 hover:text-primary-600 lg:rounded-none lg:px-0 lg:py-0">Beranda</a>
          <a href="#tentang" class="rounded-full px-4 py-2 transition hover:bg-primary-50 hover:text-primary-600 lg:rounded-none lg:px-0 lg:py-0">Tentang Kami</a>
          <a href="#produk" class="rounded-full px-4 py-2 transition hover:bg-primary-50 hover:text-primary-600 lg:rounded-none lg:px-0 lg:py-0">Produk</a>
          <a href="#testimoni" class="rounded-full px-4 py-2 transition hover:bg-primary-50 hover:text-primary-600 lg:rounded-none lg:px-0 lg:py-0">Testimoni</a>
          <a href="#kontak" class="rounded-full px-4 py-2 transition hover:bg-primary-50 hover:text-primary-600 lg:rounded-none lg:px-0 lg:py-0">Kontak</a>
          <a href="login.php" class="rounded-full px-4 py-2 transition hover:bg-primary-50 hover:text-primary-600 lg:rounded-none lg:px-0 lg:py-0">Masuk</a>
          <div class="lg:hidden">
            <a
              href="https://wa.me/6281234567890"
              target="_blank"
              rel="noopener"
              class="mt-4 inline-flex w-full items-center justify-center rounded-full bg-primary-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-primary-500"
            >
              Hubungi via WhatsApp
            </a>
          </div>
        </nav>
        <div class="flex items-center gap-3">
          <a
            href="https://wa.me/6281234567890"
            target="_blank"
            rel="noopener"
            class="hidden rounded-full bg-primary-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 lg:inline-flex"
          >
            Hubungi via WhatsApp
          </a>
          <button
            type="button"
            data-nav-toggle
            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-700 transition hover:border-primary-500 hover:text-primary-600 lg:hidden"
            aria-expanded="false"
            aria-label="Buka menu navigasi"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              stroke="currentColor"
              stroke-width="1.8"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M4 7h16M4 12h16M4 17h16" />
            </svg>
          </button>
        </div>
      </div>
    </header>
    <main>
      <section
        id="beranda"
        class="relative isolate overflow-hidden bg-slate-900 text-white"
      >
        <img
          src="gambar/jebor1.jpg"
          alt="Produksi genteng Anugrah Jatiwangi"
          class="absolute inset-0 -z-20 h-full w-full object-cover"
        />
        <div class="absolute inset-0 -z-10 bg-slate-950/70"></div>
        <div
          class="mx-auto flex max-w-6xl flex-col gap-12 px-4 py-24 sm:px-6 lg:flex-row lg:items-center lg:gap-16 lg:px-8"
        >
          <div class="max-w-2xl">
            <span
              class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-primary-100 ring-1 ring-white/20 backdrop-blur"
            >
              Sejak 1998
            </span>
            <h1
              class="mt-6 text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl"
            >
              Pabrik Genteng Anugrah Jatiwangi
            </h1>
            <p class="mt-6 text-lg text-slate-100 sm:text-xl">
              Produksi ribuan genteng beton, keramik, dan metal setiap hari
              dengan kontrol kualitas ketat untuk proyek perumahan dan komersial
              di seluruh Indonesia.
            </p>
            <div class="mt-10 flex flex-wrap items-center gap-4">
              <a
                href="#produk"
                class="inline-flex items-center gap-2 rounded-full bg-primary-500 px-6 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
              >
                Lihat Produk
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
              </a>
              <a
                href="https://wa.me/6281234567890"
                target="_blank"
                rel="noopener"
                class="inline-flex items-center gap-2 rounded-full border border-white/40 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
              >
                Pesan Sekarang
              </a>
            </div>
          </div>
          <div
            class="grid w-full max-w-md gap-6 rounded-3xl bg-white/10 p-6 backdrop-blur lg:max-w-sm"
          >
            <div
              class="flex items-center justify-between border-b border-white/20 pb-4"
            >
              <div>
                <p class="text-sm text-slate-200">Produksi Harian</p>
                <p class="text-3xl font-semibold text-white">10.000+</p>
              </div>
              <span
                class="rounded-full bg-primary-500/80 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-white"
              >
                Genteng
              </span>
            </div>
            <div>
              <p class="text-sm text-slate-200">Area Layanan</p>
              <p class="mt-1 text-base font-semibold text-white">
                Pengiriman nasional melalui armada, gudang transit, dan mitra
                logistik tepercaya.
              </p>
            </div>
            <div class="rounded-2xl bg-white/10 p-4">
              <p class="text-sm font-semibold text-white">Garansi Kualitas</p>
              <p class="mt-2 text-sm text-slate-100">
                Setiap batch dilengkapi sertifikat uji kerapatan, kekuatan
                tekan, dan daya serap air.
              </p>
            </div>
          </div>
        </div>
      </section>
      <section class="border-y border-slate-200 bg-white">
        <div
          class="mx-auto grid max-w-6xl gap-6 px-4 py-14 sm:px-6 md:grid-cols-3 lg:px-8"
        >
          <div
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm"
          >
            <p class="text-4xl font-bold text-primary-600">120+</p>
            <p class="mt-3 text-sm text-slate-600">
              Distributor aktif di Jawa, Sumatra, Kalimantan, dan Bali.
            </p>
          </div>
          <div
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm"
          >
            <p class="text-4xl font-bold text-primary-600">35</p>
            <p class="mt-3 text-sm text-slate-600">
              Tim teknisi yang mensupervisi produksi dan pengiriman tepat waktu.
            </p>
          </div>
          <div
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm"
          >
            <p class="text-4xl font-bold text-primary-600">25 th</p>
            <p class="mt-3 text-sm text-slate-600">
              Pengalaman memproduksi genteng standar SNI untuk proyek skala
              nasional.
            </p>
          </div>
        </div>
      </section>

      <section id="tentang" class="bg-white py-20">
        <div
          class="mx-auto grid max-w-6xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8"
        >
          <div class="space-y-6">
            <span
              class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-500"
              >Tentang Kami</span
            >
            <h2 class="text-3xl font-bold text-slate-900 sm:text-4xl">
              Kenapa Memilih Anugrah Jatiwangi?
            </h2>
            <p class="text-lg text-slate-600">
              Kami memadukan pengalaman puluhan tahun dengan teknologi kiln
              modern sehingga setiap genteng menjaga presisi, daya tahan, dan
              estetika atap Anda.
            </p>
            <ul class="space-y-4 text-sm font-medium text-slate-600">
              <li class="flex items-start gap-3">
                <span
                  class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 text-primary-600"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-3.5 w-3.5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="m4 12 4 4 12-12" />
                  </svg>
                </span>
                Produksi &gt;10.000 genteng per hari dengan QC berlapis.
              </li>
              <li class="flex items-start gap-3">
                <span
                  class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 text-primary-600"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-3.5 w-3.5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="m4 12 4 4 12-12" />
                  </svg>
                </span>
                Distribusi ke seluruh Indonesia dengan tracking dan laporan
                realtime.
              </li>
              <li class="flex items-start gap-3">
                <span
                  class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 text-primary-600"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-3.5 w-3.5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="m4 12 4 4 12-12" />
                  </svg>
                </span>
                Garansi kualitas &amp; layanan purna jual lengkap dengan stok
                suku cadang.
              </li>
            </ul>
            <div class="pt-2">
              <div class="grid gap-4 sm:grid-cols-2">
                <a
                  href="https://wa.me/6281234567890"
                  target="_blank"
                  rel="noopener"
                  class="inline-flex items-center justify-center gap-2 rounded-2xl border border-primary-200 bg-primary-50 px-5 py-3 text-sm font-semibold text-primary-600 transition hover:border-primary-400 hover:text-primary-700"
                >
                  Jadwalkan Kunjungan
                </a>
                <a
                  href="#produk"
                  class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600"
                >
                  Lihat Sertifikasi
                </a>
              </div>
            </div>
          </div>
          <div class="relative">
            <div
              class="absolute -inset-6 -z-10 rounded-3xl bg-gradient-to-br from-primary-100 via-white to-slate-100"
            ></div>
            <img
              src="gambar/fotorama.jpg"
              alt="Proses produksi genteng"
              class="w-full rounded-3xl object-cover shadow-soft"
            />
            <div
              class="absolute -bottom-10 right-6 hidden max-w-xs rounded-2xl bg-white p-5 shadow-soft lg:block"
            >
              <p class="text-sm font-semibold text-slate-900">
                Tim Quality Control
              </p>
              <p class="mt-2 text-xs text-slate-500">
                Monitoring kelembaban, suhu kiln, dan ketebalan genteng setiap 2
                jam.
              </p>
            </div>
          </div>
        </div>
      </section>
      <section id="produk" class="bg-slate-100 py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
          <div class="mx-auto max-w-3xl text-center">
            <span
              class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-500"
              >Produk Unggulan</span
            >
            <h2 class="mt-4 text-3xl font-bold text-slate-900 sm:text-4xl">
              Produk &amp; Katalog
            </h2>
            <p class="mt-4 text-base text-slate-600">
              Pilih varian genteng terbaik sesuai kebutuhan proyek Anda. Kami
              siap bantu kalkulasi kebutuhan dan pengiriman.
            </p>
          </div>
          <div class="mt-12 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
            <?php if (!empty($produk_items)) : ?>
              <?php foreach ($produk_items as $produk) : ?>
                <?php
                  $taglineParts = array_filter(array_map('trim', explode(',', $produk['tagline'] ?? '')));
                  $imageSource = !empty($produk['gambar']) ? $produk['gambar'] : 'produk/placeholder.jpg';
                ?>
                <article
                  class="group relative flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-soft"
                >
                  <div class="aspect-[4/3] bg-slate-200">
                    <img
                      src="<?php echo htmlspecialchars($imageSource, ENT_QUOTES, 'UTF-8'); ?>"
                      alt="<?php echo htmlspecialchars($produk['nama_produk'], ENT_QUOTES, 'UTF-8'); ?>"
                      class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    />
                  </div>
                  <div class="flex flex-1 flex-col p-6">
                    <h3 class="text-xl font-semibold text-slate-900">
                      <?php echo htmlspecialchars($produk['nama_produk'], ENT_QUOTES, 'UTF-8'); ?>
                    </h3>
                    <p class="mt-3 text-sm text-slate-600">
                      <?php echo htmlspecialchars($produk['deskripsi'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <?php if (!empty($taglineParts)) : ?>
                      <div class="mt-6 flex flex-wrap items-center gap-3 text-xs font-semibold text-primary-600">
                        <?php foreach ($taglineParts as $tag) : ?>
                          <span class="rounded-full bg-primary-50 px-3 py-1">
                            <?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?>
                          </span>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                    <a
                      href="#"
                      class="mt-8 inline-flex items-center gap-2 self-start rounded-full bg-primary-500 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
                    >
                      Beli Sekarang
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14M13 6l6 6-6 6" />
                      </svg>
                    </a>
                  </div>
                </article>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm">
                <h3 class="text-xl font-semibold text-slate-900">Produk belum tersedia</h3>
                <p class="mt-3 text-sm text-slate-600">Tim kami sedang memperbarui katalog. Silakan kembali lagi atau hubungi kami untuk info stok.</p>
                <a
                  href="login.php"
                  class="mt-6 inline-flex items-center gap-2 rounded-full bg-primary-500 px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
                >
                  Login Admin
                </a>
              </div>
            <?php endif; ?>
          </div>
          <div
            class="mt-12 flex flex-wrap items-center justify-between gap-4 rounded-3xl border border-primary-200 bg-primary-50 px-6 py-6 text-sm font-medium text-primary-700 sm:flex-nowrap"
          >
            <span
              >Butuh harga grosir atau sampel fisik? Kami siap kirim dalam 24
              jam.</span
            >
            <a
              href="https://wa.me/6281234567890"
              target="_blank"
              rel="noopener"
              class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-primary-500"
            >
              Konsultasi Gratis
            </a>
          </div>
        </div>
      </section>
      <section id="testimoni" class="bg-white py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
          <div class="mx-auto max-w-2xl text-center">
            <span
              class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-500"
              >Testimoni</span
            >
            <h2 class="mt-4 text-3xl font-bold text-slate-900 sm:text-4xl">
              Apa Kata Mitra Kami
            </h2>
            <p class="mt-4 text-base text-slate-600">
              Suara pelanggan mengenai kualitas produk dan layanan kami.
            </p>
          </div>
          <div data-slider class="relative mt-12 overflow-hidden">
            <div
              class="flex gap-6 transition-transform duration-500 ease-out will-change-transform"
              data-slider-track
              style="transform: translateX(0%)"
            >
              <article
                class="min-w-full rounded-3xl bg-slate-100 p-8 text-left sm:p-10"
              >
                <div class="flex items-center gap-4">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-500/10 text-lg font-semibold text-primary-600"
                  >
                    BS
                  </div>
                  <div>
                    <p class="text-base font-semibold text-slate-900">
                      Budi Santoso
                    </p>
                    <p class="text-xs text-slate-500">
                      Kontraktor Perumahan, Bandung
                    </p>
                  </div>
                </div>
                <p class="mt-6 text-lg text-slate-600">
                  "Gentengnya kuat dan presisi. Pengiriman cepat meski pesannya
                  banyak, jadi jadwal proyek tetap on track."
                </p>
              </article>
              <article
                class="min-w-full rounded-3xl bg-slate-100 p-8 text-left sm:p-10"
              >
                <div class="flex items-center gap-4">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-500/10 text-lg font-semibold text-primary-600"
                  >
                    SA
                  </div>
                  <div>
                    <p class="text-base font-semibold text-slate-900">
                      Sari Aulia
                    </p>
                    <p class="text-xs text-slate-500">
                      Developer Hunian, Bekasi
                    </p>
                  </div>
                </div>
                <p class="mt-6 text-lg text-slate-600">
                  "Tim sales responsif dan bantu pilih jenis genteng yang cocok
                  untuk tiap cluster. Garansinya jelas, pelanggan puas."
                </p>
              </article>
              <article
                class="min-w-full rounded-3xl bg-slate-100 p-8 text-left sm:p-10"
              >
                <div class="flex items-center gap-4">
                  <div
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-500/10 text-lg font-semibold text-primary-600"
                  >
                    HT
                  </div>
                  <div>
                    <p class="text-base font-semibold text-slate-900">
                      Hartono
                    </p>
                    <p class="text-xs text-slate-500">Toko Bangunan, Cirebon</p>
                  </div>
                </div>
                <p class="mt-6 text-lg text-slate-600">
                  "Stok selalu tersedia dan proses retur mudah. Tim gudang ramah
                  dan bantu muatan sampai selesai."
                </p>
              </article>
            </div>
            <div
              class="pointer-events-none absolute inset-y-0 flex w-full items-center justify-between px-3"
            >
              <button
                type="button"
                data-slider-prev
                aria-label="Testimoni sebelumnya"
                class="pointer-events-auto inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white/80 text-slate-600 shadow-sm transition hover:bg-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
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
                  <path d="m15 18-6-6 6-6" />
                </svg>
              </button>
              <button
                type="button"
                data-slider-next
                aria-label="Testimoni berikutnya"
                class="pointer-events-auto inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white/80 text-slate-600 shadow-sm transition hover:bg-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
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
                  <path d="m9 6 6 6-6 6" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </section>
    <section id="kontak" class="bg-slate-900 py-20 text-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
          <div class="grid gap-12 lg:grid-cols-[1.1fr,0.9fr]">
            <div class="space-y-8">
              <span
                class="text-xs font-semibold uppercase tracking-[0.35em] text-primary-300"
                >Kontak &amp; Lokasi</span
              >
              <h2 class="text-3xl font-bold text-white sm:text-4xl">
                Diskusikan Kebutuhan Genteng Anda
              </h2>
              <p class="text-slate-200">
                Hubungi kami untuk konsultasi kebutuhan proyek, perhitungan
                volume genteng, atau jadwal kunjungan ke pabrik.
              </p>
              <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                  <p class="text-xs uppercase tracking-[0.3em] text-slate-300">
                    Telepon
                  </p>
                  <a
                    href="tel:+62234567890"
                    class="mt-2 block text-lg font-semibold text-white transition hover:text-primary-200"
                    >(0231) 456-7890</a
                  >
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                  <p class="text-xs uppercase tracking-[0.3em] text-slate-300">
                    WhatsApp
                  </p>
                  <a
                    href="https://wa.me/6281234567890"
                    target="_blank"
                    rel="noopener"
                    class="mt-2 inline-flex items-center gap-2 text-lg font-semibold text-primary-200 transition hover:text-primary-100"
                  >
                    +62 831-8725-8044
                  </a>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                  <p class="text-xs uppercase tracking-[0.3em] text-slate-300">
                    Email
                  </p>
                  <a
                    href="mailto:marketing@anugrahgenteng.com"
                    class="mt-2 block text-lg font-semibold text-white transition hover:text-primary-200"
                  >
                    marketing@gmail.com
                  </a>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                  <p class="text-xs uppercase tracking-[0.3em] text-slate-300">
                    Jam Operasional
                  </p>
                  <p class="mt-2 text-lg font-semibold text-white">
                    Senin - Sabtu, 08.00 - 17.00 WIB
                  </p>
                </div>
              </div>
              <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                <p class="text-xs uppercase tracking-[0.3em] text-slate-300">
                  Alamat Pabrik
                </p>
                <p class="mt-2 text-lg font-semibold text-white">
                  Leuweunggede, Jatiwangi, Majalengka Regency, West Java 45454
                </p>
              </div>
              <div class="flex flex-wrap gap-4">
                <a
                  href="https://wa.me/6281234567890"
                  target="_blank"
                  rel="noopener"
                  class="inline-flex items-center gap-2 rounded-full bg-primary-500 px-6 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-primary-400"
                >
                  Konsultasi Sekarang
                </a>
                <a
                  href="tel:+62234567890"
                  class="inline-flex items-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-white/10"
                >
                  Call Center
                </a>
              </div>
            </div>
            <form class="rounded-3xl bg-white p-8 shadow-soft">
              <h3 class="text-xl font-semibold text-slate-900">Kirim Pesan</h3>
              <p class="mt-2 text-sm text-slate-500">
                Tim kami akan merespons dalam waktu kurang dari 1x24 jam.
              </p>
              <div class="mt-6 space-y-5">
                <div>
                  <label for="name" class="text-sm font-medium text-slate-600"
                    >Nama</label
                  >
                  <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Nama lengkap"
                    required
                    class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
                  />
                </div>
                <div>
                  <label for="phone" class="text-sm font-medium text-slate-600"
                    >Nomor HP</label
                  >
                  <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="08xxxxxxxxxx"
                    required
                    class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
                  />
                </div>
                <div>
                  <label
                    for="message"
                    class="text-sm font-medium text-slate-600"
                    >Pesan</label
                  >
                  <textarea
                    id="message"
                    name="message"
                    rows="4"
                    placeholder="Tuliskan kebutuhan Anda"
                    required
                    class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200"
                  ></textarea>
                </div>
              </div>
              <button
                type="submit"
                class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-full bg-primary-500 px-6 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-primary-400"
              >
                Kirim Pesan
              </button>
              <p class="mt-4 text-xs text-slate-500">
                Dengan mengirim pesan, Anda menyetujui dihubungi melalui telepon
                atau WhatsApp.
              </p>
            </form>
          </div>
          <div
            class="mt-12 overflow-hidden rounded-3xl border border-white/10 bg-white/5 p-1"
          >
            <div class="aspect-video w-full overflow-hidden rounded-[26px]">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1632.849475761832!2d108.27093244351482!3d-6.748496025955763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f278fda3aaf2d%3A0x7bdf08107698a965!2sPabrik%20Genteng%20ANUGRAH!5e1!3m2!1sen!2sid!4v1758515743715!5m2!1sen!2sid"
                width="100%"
                height="100%"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="border-t border-slate-200 bg-white">
      <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-3">
          <div class="space-y-4">
            <div class="flex items-center gap-3">
              <img
                src="gambar/logo.jpg"
                alt="Logo Pabrik Genteng"
                class="h-10 w-10 rounded-full object-cover ring-4 ring-primary-100"
              />
              <div class="leading-tight">
                <span
                  class="block text-xs font-semibold uppercase tracking-[0.3em] text-primary-500"
                  >Anugrah</span
                >
                <span class="text-base font-bold text-slate-900"
                  >Jatiwangi</span
                >
              </div>
            </div>
            <p class="text-sm text-slate-600">
              Leuweunggede, Jatiwangi, Majalengka Regency, West Java 45454
            </p>
            <p class="text-sm text-slate-600">
              Senin - Sabtu, 08.00 - 17.00 WIB
            </p>
          </div>
          <div>
            <h4
              class="text-sm font-semibold uppercase tracking-[0.35em] text-primary-500"
            >
              Link Cepat
            </h4>
            <ul class="mt-4 space-y-3 text-sm text-slate-600">
              <li>
                <a class="transition hover:text-primary-600" href="#produk"
                  >Produk</a
                >
              </li>
              <li>
                <a class="transition hover:text-primary-600" href="#kontak"
                  >Kontak</a
                >
              </li>
              <li>
                <a class="transition hover:text-primary-600" href="#tentang"
                  >Tentang Kami</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h4
              class="text-sm font-semibold uppercase tracking-[0.35em] text-primary-500"
            >
              Ikuti Kami
            </h4>
            <ul class="mt-4 space-y-3 text-sm text-slate-600">
              <li>
                <a
                  href="https://wa.me/6281234567890"
                  target="_blank"
                  rel="noopener"
                  class="inline-flex items-center gap-2 transition hover:text-primary-600"
                >
                  WhatsApp
                </a>
              </li>
              <li>
                <a
                  href="https://www.instagram.com"
                  target="_blank"
                  rel="noopener"
                  class="inline-flex items-center gap-2 transition hover:text-primary-600"
                >
                  Instagram
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="border-t border-slate-200">
        <p
          class="mx-auto max-w-6xl px-4 py-6 text-center text-xs uppercase tracking-[0.35em] text-slate-500 sm:px-6 lg:px-8"
        >
          &copy; <span id="year"></span> Pabrik Genteng Anugrah Jatiwangi. All
          Rights Reserved.
        </p>
      </div>
    </footer>
    <script>
      const sliderInstances = document.querySelectorAll("[data-slider]");
      sliderInstances.forEach((slider) => {
        const track = slider.querySelector("[data-slider-track]");
        const items = track ? Array.from(track.children) : [];
        let current = 0;

        const prevButton = slider.querySelector("[data-slider-prev]");
        const nextButton = slider.querySelector("[data-slider-next]");

        function update() {
          if (!track) return;
          const offset = -current * 100;
          track.style.transform = `translateX(${offset}%)`;
        }

        if (prevButton && nextButton && items.length > 1) {
          prevButton.addEventListener("click", () => {
            current = (current - 1 + items.length) % items.length;
            update();
          });

          nextButton.addEventListener("click", () => {
            current = (current + 1) % items.length;
            update();
          });
        }
      });

      const navToggle = document.querySelector("[data-nav-toggle]");
      const navMenu = document.querySelector("[data-nav-menu]");

      if (navToggle && navMenu) {
        navToggle.addEventListener("click", () => {
          const isHidden = navMenu.classList.toggle("hidden");
          navToggle.setAttribute("aria-expanded", (!isHidden).toString());
        });

        navMenu.querySelectorAll("a").forEach((link) => {
          link.addEventListener("click", () => {
            if (
              window.innerWidth < 1024 &&
              !navMenu.classList.contains("hidden")
            ) {
              navMenu.classList.add("hidden");
              navToggle.setAttribute("aria-expanded", "false");
            }
          });
        });
      }

      const yearEl = document.getElementById("year");
      if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
      }
    </script>
  </body>
</html>













