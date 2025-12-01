<aside
        class="flex w-full flex-col border-b border-slate-200 bg-white/90 px-6 py-6 shadow-sm backdrop-blur lg:w-72 lg:border-b-0 lg:border-r"
      >
        <a href="index.php" class="flex items-center gap-3">
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
        <p
          class="mt-6 text-xs font-semibold uppercase tracking-[0.35em] text-slate-400"
        >
          Panel Admin
        </p>
        <nav class="mt-4 space-y-2 text-sm font-semibold text-slate-500">
          <a
            href="admin.php"
            class="flex items-center gap-3 rounded-2xl bg-primary-500/10 px-4 py-3 text-primary-600 shadow-inner shadow-primary-500/10"
          >
            <span
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-500/20 text-primary-600"
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
                <path d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </span>
            Produk & Katalog
          </a>
        </nav>
        <div class="mt-auto space-y-4 pt-10">
         <form action="admin.php" method="post">
           <button
            type="submit"
            name="logout"
            class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-500 transition hover:border-primary-400 hover:text-primary-500"
            >
            Keluar Panel
          </button>
         </form>
        </div>
      </aside>