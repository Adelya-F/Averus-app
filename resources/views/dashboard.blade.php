<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Averus Course</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 m-0 p-0 w-full">

<!-- NAVIGATION -->
<nav class="bg-white shadow-md fixed w-full z-50">
  <div class="w-full px-4 md:px-6 py-4 flex justify-between items-center max-w-7xl mx-auto">
    
    <div class="flex items-center space-x-2 md:space-x-3">
      <img src="{{ asset('image/averus.png') }}" alt="Logo Averus" class="h-8 md:h-10 w-auto">
      <h1 class="text-xs md:text-2xl font-bold flex">
        <span class="text-red-500">A</span><span class="text-yellow-500">v</span><span class="text-green-500">e</span><span class="text-blue-500">r</span><span class="text-purple-500">u</span><span class="text-pink-500">s</span>
        <span class="ml-1 text-violet-900">College</span> 
      </h1>
    </div>

    <div class="flex items-center space-x-2 md:space-x-6">
      <a href="#" class="text-[10px] md:text-base hover:text-yellow-600 transition font-medium">Dashboard</a>
      <a href="#program" class="text-[10px] md:text-base hover:text-yellow-600 transition font-medium">Program</a>
      
      <a href="{{ route('register') }}" class="text-[10px] md:text-base text-blue-600 font-bold hover:underline">Daftar</a>
      
      <a href="{{ route('login') }}" class="bg-blue-600 text-white px-2 py-1 md:px-4 md:py-2 rounded-md md:rounded-lg text-[10px] md:text-base hover:bg-blue-700 transition shadow-sm">
        Login
      </a>
    </div>

  </div>
</nav>

<!-- HERO SECTION -->
<section class="pt-32 pb-20 bg-gradient-to-r from-blue-300 to-indigo-500 text-white w-full">
  <div class="px-6 md:px-12 lg:px-24 grid md:grid-cols-2 gap-10 items-center max-w-7xl mx-auto">
    <div>
      <h2 class="text-4xl md:text-5xl font-bold leading-tight">Tingkatkan Prestasimu Bersama Kami</h2>
      <p class="mt-6 text-lg">Tempat kursus terbaik untuk SD, SMP, dan SMA. Mentor berpengalaman dan metode belajar interaktif.</p>
      <div class="mt-8">
        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Daftar Sekarang</a>
      </div>
    </div>
    <div>
      <img src="https://images.unsplash.com/photo-1584697964358-3e14ca57658b" class="rounded-xl shadow-2xl w-full mt-10 md:mt-0" alt="Kursus">
    </div>
  </div>
</section>

<!-- ABOUT SECTION -->
<section class="py-20 bg-white reveal w-full overflow-hidden">
  <div class="px-6 md:px-12 lg:px-24 max-w-7xl mx-auto text-center">
    <h3 class="text-3xl font-bold mb-6">Kenapa Memilih Kami?</h3>
    <p class="text-gray-600 max-w-3xl mx-auto">Kami berkomitmen membantu siswa memahami pelajaran dengan metode yang menyenangkan dan efektif.</p>

    <div class="relative mt-12 py-8 overflow-visible">
      <button id="scrollLeft" class="absolute -left-4 md:-left-10 top-1/2 -translate-y-1/2 bg-white shadow-xl rounded-full p-3 hover:bg-gray-50 transition z-20 border border-gray-100">←</button>
      
      <button id="scrollRight" class="absolute -right-4 md:-right-10 top-1/2 -translate-y-1/2 bg-white shadow-xl rounded-full p-3 hover:bg-gray-50 transition z-20 border border-gray-100">→</button>

      <div id="cardContainer" class="flex gap-8 overflow-x-auto scroll-smooth py-10 no-scrollbar px-6 md:px-12">
        
        <div class="card min-w-[280px] p-6 bg-white rounded-2xl shadow-md hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent">
          <h4 class="font-semibold text-lg mb-2">Mentor Profesional</h4>
          <p class="text-gray-600 text-sm">Pengajar berpengalaman & tersertifikasi.</p>
        </div>

        <div class="card min-w-[280px] p-6 bg-white rounded-2xl shadow-md hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent">
          <h4 class="font-semibold text-lg mb-2">Kelas Interaktif</h4>
          <p class="text-gray-600 text-sm">Belajar jadi aktif, tidak membosankan, dan pastinya jauh lebih menyenangkan bagi siswa.</p>
        </div>

        <div class="card min-w-[280px] p-6 bg-white rounded-2xl shadow-md hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent">
          <h4 class="font-semibold text-lg mb-2">Belajar Jadi Mudah</h4>
          <p class="text-gray-600 text-sm">Penjelasan materi dibuat sesederhana mungkin agar konsep tersulit pun jadi gampang dimengerti.</p>
        </div>

        <div class="card min-w-[280px] p-6 bg-white rounded-2xl shadow-md hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent">
          <h4 class="font-semibold text-lg mb-2">Kurikulum Update</h4>
          <p class="text-gray-600 text-sm">Materi selalu disesuaikan dengan kurikulum sekolah terbaru (Merdeka).</p>
        </div>

        <div class="card min-w-[280px] p-6 bg-white rounded-2xl shadow-md hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent">
          <h4 class="font-semibold text-lg mb-2">Fasilitas Terpenuhi</h4>
          <p class="text-gray-600 text-sm">Faisilitas alat tulis, Ruangan kelas yang nyaman dan lingkungan belajar yang tenang serta bersih.</p>
        </div>

        <div class="card min-w-[280px] p-6 bg-white rounded-2xl shadow-md hover:-translate-y-2 transition-all duration-300 cursor-pointer border-2 border-transparent">
          <h4 class="font-semibold text-lg mb-2">Jadwal Belajar Fleksibel</h4>
          <p class="text-gray-600 text-sm">Pilihan waktu belajar yang dapat disesuaikan dengan jadwal sekolah agar siswa tidak terlalu lelah.</p>
        </div>
        
        </div>
    </div>
  </div>
</section>

<!-- PROGRAM SECTION -->
<section id="program" class="py-20 bg-gradient-to-r from-yellow-300 to-amber-100 reveal w-full">
  <div class="px-6 md:px-12 lg:px-24 max-w-5xl mx-auto text-center">
    <h3 class="text-3xl font-bold mb-4">Program Kelas</h3>
    <p class="text-gray-600 mb-10">Pilih jenjang pendidikan untuk melihat detail program kami.</p>

    <div class="flex flex-wrap justify-center gap-4 mb-12">
      <button onclick="changeProgram('sd')" id="btn-sd" class="prog-btn px-8 py-3 rounded-full border-2 border-blue-600 font-bold transition-all duration-300 bg-blue-600 text-white shadow-lg active:scale-95">Kelas SD</button>
      <button onclick="changeProgram('smp')" id="btn-smp" class="prog-btn px-8 py-3 rounded-full border-2 border-blue-600 font-bold transition-all duration-300 bg-white text-blue-600 hover:bg-blue-50 active:scale-95">Kelas SMP</button>
      <button onclick="changeProgram('sma')" id="btn-sma" class="prog-btn px-8 py-3 rounded-full border-2 border-blue-600 font-bold transition-all duration-300 bg-white text-blue-600 hover:bg-blue-50 active:scale-95">Kelas SMA</button>
    </div>

    <div id="programDisplay" class="bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-gray-100 transition-all duration-500 transform opacity-100 translate-y-0">
      <div class="grid md:grid-cols-2 gap-10 items-center text-left">
        <div>
          <span id="progBadge" class="bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wider">Level Dasar</span>
          <h4 id="progTitle" class="text-3xl font-bold mt-4 mb-4 text-gray-800">Kelas SD (Sekolah Dasar)</h4>
          <p id="progDesc" class="text-gray-600 leading-relaxed mb-6">
            Fokus utama kami adalah membangun fondasi logika matematika yang kuat dan kemampuan literasi Bahasa Indonesia yang baik agar siswa siap menghadapi jenjang berikutnya.
          </p>
          <ul id="progFeatures" class="space-y-3 mb-8">
            <li class="flex items-center text-gray-700"><span class="mr-2 text-green-500">✔</span> Matematika Menyenangkan</li>
            <li class="flex items-center text-gray-700"><span class="mr-2 text-green-500">✔</span> Bimbingan PR Harian</li>
            <li class="flex items-center text-gray-700"><span class="mr-2 text-green-500">✔</span> Persiapan Ujian Sekolah</li>
          </ul>
          <div class="flex items-center justify-between border-t pt-6">
            <span id="progPrice" class="text-2xl font-bold text-blue-600">Rp 350.000 <span class="text-sm text-gray-400 font-normal">/ bulan</span></span>
            <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Daftar Sekarang</a>
          </div>
        </div>
        <div class="hidden md:block">
           <img id="progImg" src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=500" class="rounded-2xl shadow-lg w-full h-64 object-cover" alt="Program">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONI SECTION -->
<section class="py-24 bg-[#F8FAFC] reveal w-full overflow-hidden">
  <div class="px-6 md:px-12 lg:px-24 max-w-7xl mx-auto text-center">
    <h3 class="text-3xl font-bold mb-4">Apa Kata Mereka?</h3>
    <p class="text-gray-600 mb-16 max-w-2xl mx-auto">Bergabunglah dengan siswa lainnya yang telah meningkatkan prestasi akademiknya bersama Averus College.</p>
    
    <div class="grid md:grid-cols-3 gap-10 mt-10">
      
      <div class="relative bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border border-blue-50/50">
        <div class="absolute -top-4 left-8 bg-[#1e3a8a] text-white w-8 h-8 rounded-lg flex items-center justify-center text-xl font-serif">“</div>
        <p class="text-gray-700 italic text-left mb-8 leading-relaxed">
          "Nilai matematika saya naik drastis! Dulu benci banget sama angka, sekarang malah jadi pelajaran favorit karena cara ngajarnya asik."
        </p>
        <div class="flex items-center gap-4 border-t pt-6">
          <div class="w-11 h-11 bg-blue-100 text-[#1e3a8a] rounded-full flex items-center justify-center font-bold">A</div>
          <div class="text-left">
            <h5 class="font-bold text-gray-900">Andi Saputra</h5>
            <p class="text-xs text-blue-600 font-medium">Siswa SMP - Kelas 8</p>
          </div>
        </div>
      </div>

      <div class="relative md:-translate-y-8 bg-white p-8 rounded-[2rem] shadow-md hover:shadow-xl transition-all duration-300 border border-blue-100/50 z-10">
        <div class="absolute -top-4 left-8 bg-[#1e3a8a] text-white w-8 h-8 rounded-lg flex items-center justify-center text-xl font-serif">“</div>
        <p class="text-gray-700 italic text-left mb-8 leading-relaxed">
          "Pengajarnya sabar banget dan mudah dipahami. Materi yang di sekolah kelihatan susah, di sini jadi gampang dimengerti."
        </p>
        <div class="flex items-center gap-4 border-t pt-6">
          <div class="w-11 h-11 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center font-bold">S</div>
          <div class="text-left">
            <h5 class="font-bold text-gray-900">Siti Aminah</h5>
            <p class="text-xs text-blue-600 font-medium">Siswa SMA - Kelas 12</p>
          </div>
        </div>
      </div>

      <div class="relative bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border border-blue-50/50">
        <div class="absolute -top-4 left-8 bg-[#1e3a8a] text-white w-8 h-8 rounded-lg flex items-center justify-center text-xl font-serif">“</div>
        <p class="text-gray-700 italic text-left mb-8 leading-relaxed">
          "Sebagai orang tua, saya sangat puas dengan laporan perkembangan berkala. Tempat kursus paling komunikatif dan transparan."
        </p>
        <div class="flex items-center gap-4 border-t pt-6">
          <div class="w-11 h-11 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center font-bold">O</div>
          <div class="text-left">
            <h5 class="font-bold text-gray-900">Bunda Rara</h5>
            <p class="text-xs text-blue-600 font-medium">Orang Tua Murid</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FOOTER FULL WIDTH -->
<footer class="bg-[#0f172a] text-white pt-20 pb-10 w-full">
  <div class="px-6 md:px-12 lg:px-24 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 text-left">
      
      <div class="col-span-1 md:col-span-1">
        <div class="flex items-center space-x-3 mb-6">
          <img src="{{ asset('image/averus.png') }}" alt="Logo Averus" class="h-10 w-auto">
          <h4 class="text-xl font-bold"> <span class="text-red-500">A</span>
      <span class="text-yellow-500">v</span>
      <span class="text-green-500">e</span>
      <span class="text-blue-500">r</span>
      <span class="text-purple-500">u</span>
      <span class="text-pink-500">s</span>
      <span class="ml-2 text-violet-900">College</span> </h4>
        </div>
        <p class="text-gray-400 text-sm leading-relaxed">
          Membangun generasi cerdas dengan metode belajar yang personal, interaktif, dan menyenangkan sejak 2026.
        </p>
      </div>

      <div>
        <h5 class="font-bold mb-6 text-lg">Program</h5>
        <ul class="space-y-4 text-gray-400 text-sm">
         <li>
          <a href="#program" onclick="changeProgram('sd')" class="hover:text-blue-400 transition">Kelas SD</a>
        </li>
        <li>
          <a href="#program" onclick="changeProgram('smp')" class="hover:text-blue-400 transition">Kelas SMP</a>
        </li>
        <li>
          <a href="#program" onclick="changeProgram('sma')" class="hover:text-blue-400 transition">Kelas SMA</a>
        </li>
        </ul>
      </div>

    <div>
  <h5 class="font-bold mb-6 text-lg">Hubungi Kami</h5>
  <ul class="space-y-4 text-gray-400 text-sm">
    <li class="flex items-start gap-3">
      <span>📍</span>
      <span>Jl. Margaluyu No.53</span>
    </li>
    <li class="flex flex-col gap-y-3">
      <div class="flex items-center gap-3">
        <span class="text-green-500">📞</span>
        <span class="text-gray-300">+62 815 7311 0402</span>
        <span class="text-xs text-gray-500">(Ibu Yuli)</span>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-green-500">📞</span>
        <span class="text-gray-300">+62 896 1916 6886</span>
        <span class="text-xs text-gray-500">(Bapak Eko)</span>
      </div>
    </li>
  </ul>
</div>

    <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-gray-500 text-xs">
      <p>© 2026 Averus College Nusantara. All Rights Reserved.</p>
    </div>
  </div>
</footer>

<script>
  const container = document.getElementById('cardContainer');
  const leftBtn = document.getElementById('scrollLeft');
  const rightBtn = document.getElementById('scrollRight');
  const cards = document.querySelectorAll('.card');

  rightBtn.addEventListener('click', () => container.scrollBy({ left: 320, behavior: 'smooth' }));
  leftBtn.addEventListener('click', () => container.scrollBy({ left: -320, behavior: 'smooth' }));

  cards.forEach(card => {
    card.addEventListener('click', () => {
      cards.forEach(c => {
        c.classList.remove('scale-105', 'shadow-2xl', 'border-blue-500', 'z-30');
        c.classList.add('border-transparent');
      });
      card.classList.remove('border-transparent');
      card.classList.add('scale-105', 'shadow-2xl', 'border-blue-500', 'z-30');
    });
  });

  const sections = document.querySelectorAll('.reveal');
  const observerOptions = {
    threshold: 0.15
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
      }
    });
  }, observerOptions);

  sections.forEach(section => {
    observer.observe(section);
  });

  const programData = {
  sd: {
    badge: "Level Dasar",
    title: "Kelas SD (Sekolah Dasar)",
    desc: "Fokus utama kami adalah membangun fondasi logika matematika yang kuat dan kemampuan literasi Bahasa Indonesia agar siswa percaya diri di sekolah.",
    features: ["Matematika Menyenangkan", "Bimbingan PR Harian", "Persiapan Ujian Sekolah"],
    price: "Rp 350.000",
    img: "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=500"
  },
  smp: {
    badge: "Level Menengah",
    title: "Kelas SMP (Sekolah Menengah Pertama)",
    desc: "Memasuki fase remaja, kami membantu siswa menguasai konsep abstrak di Matematika, IPA, dan kemampuan analisis di Bahasa Inggris.",
    features: ["Matematika & IPA Terpadu", "English Conversation Dasar", "Teknik Menghafal Cepat"],
    price: "Rp 450.000",
    img: "https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=500"
  },
  sma: {
    badge: "Level Lanjut",
    title: "Kelas SMA (Sekolah Menengah Atas)",
    desc: "Program intensif yang dirancang khusus untuk penguasaan materi kompleks serta persiapan matang menghadapi UTBK dan seleksi masuk PTN.",
    features: ["Persiapan UTBK & Mandiri", "Bedah Soal Olimpiade", "Konsultasi Jurusan Kuliah"],
    price: "Rp 600.000",
    img: "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=500"
  }
};

function changeProgram(key) {
  const display = document.getElementById('programDisplay');
  const btns = document.querySelectorAll('.prog-btn');
  
  // 1. Animasi keluar
  display.classList.remove('opacity-100', 'translate-y-0');
  display.classList.add('opacity-0', 'translate-y-4');

  setTimeout(() => {
    const data = programData[key];
    
    // 2. Update konten teks
    document.getElementById('progBadge').innerText = data.badge;
    document.getElementById('progTitle').innerText = data.title;
    document.getElementById('progDesc').innerText = data.desc;
    document.getElementById('progPrice').innerHTML = `${data.price} <span class="text-sm text-gray-400 font-normal">/ bulan</span>`;
    document.getElementById('progImg').src = data.img;

    // 3. Update list fitur
    const list = document.getElementById('progFeatures');
    list.innerHTML = data.features.map(f => `<li class="flex items-center text-gray-700"><span class="mr-2 text-green-500">✔</span> ${f}</li>`).join('');

    // 4. Update style tombol
    btns.forEach(btn => {
      btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
      btn.classList.add('bg-white', 'text-blue-600');
    });
    const activeBtn = document.getElementById(`btn-${key}`);
    activeBtn.classList.remove('bg-white', 'text-blue-600');
    activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-lg');

    // 5. Animasi masuk
    display.classList.remove('opacity-0', 'translate-y-4');
    display.classList.add('opacity-100', 'translate-y-0');
  }, 300);
}
</script>

<style>
  html, body { margin:0; padding:0; width:100%; }
</style>

</body>
</html>