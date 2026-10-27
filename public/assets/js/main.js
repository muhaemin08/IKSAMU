/**
 * Main Application Script for Pondok Pesantren Miftahul Ulum Gunung Bubut
 */

document.addEventListener('DOMContentLoaded', () => {
  initNavbar();
  initBackToTop();
  initModals();
  initPSBForm();
  initContactForm();
  highlightActiveNav();
});

// Navbar logic & Mobile menu toggle
function initNavbar() {
  const mobileToggle = document.getElementById('mobileMenuToggle');
  const bottomTrigger = document.getElementById('mobileBottomMenuTrigger');
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileMenuClose = document.getElementById('mobileMenuClose');
  const header = document.getElementById('siteHeader');

  const openDrawer = () => {
    if (!mobileMenu) return;
    mobileMenu.classList.remove('hidden');
    setTimeout(() => {
      mobileMenu.querySelector('.drawer-content')?.classList.remove('-translate-x-full');
    }, 10);
  };

  if (mobileToggle) {
    mobileToggle.addEventListener('click', openDrawer);
  }

  if (bottomTrigger) {
    bottomTrigger.addEventListener('click', openDrawer);
  }

  if (mobileMenu) {
    const closeMenu = () => {
      const drawer = mobileMenu.querySelector('.drawer-content');
      if (drawer) drawer.classList.add('-translate-x-full');
      setTimeout(() => {
        mobileMenu.classList.add('hidden');
      }, 250);
    };

    if (mobileMenuClose) {
      mobileMenuClose.addEventListener('click', closeMenu);
    }

    mobileMenu.addEventListener('click', (e) => {
      if (e.target === mobileMenu) closeMenu();
    });
  }

  // Scroll effect on header
  window.addEventListener('scroll', () => {
    if (header) {
      if (window.scrollY > 40) {
        header.classList.add('shadow-md', 'bg-white/95');
        header.classList.remove('bg-white');
      } else {
        header.classList.remove('shadow-md');
        header.classList.add('bg-white');
      }
    }
  });

  // Mobile submenu accordions
  document.querySelectorAll('.mobile-dropdown-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const content = btn.nextElementSibling;
      const icon = btn.querySelector('.mobile-dropdown-icon');
      if (content) {
        content.classList.toggle('hidden');
        if (icon) icon.classList.toggle('rotate-180');
      }
    });
  });
}

// Active Nav Link Highlight
function highlightActiveNav() {
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';
  const navLinks = document.querySelectorAll('header nav a, #mobileMenu a');
  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href && (href === currentPath || (currentPath === '' && href === 'index.html'))) {
      link.classList.add('text-emerald-700', 'font-bold');
      if (link.classList.contains('desktop-nav-link')) {
        link.classList.add('border-b-2', 'border-amber-500');
      }
    }
  });
}

// Back to Top button
function initBackToTop() {
  const btn = document.getElementById('backToTop');
  if (!btn) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      btn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
      btn.classList.add('opacity-100', 'translate-y-0');
    } else {
      btn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
      btn.classList.remove('opacity-100', 'translate-y-0');
    }
  });

  btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// Global Modal for Publication (Artikel, Even, Kegiatan)
function initModals() {
  const modal = document.getElementById('detailModal');
  if (!modal) return;

  const closeBtns = modal.querySelectorAll('.close-modal-trigger');
  closeBtns.forEach(btn => {
    btn.addEventListener('click', () => closeModal());
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });
}

function openDetailModal(item) {
  const modal = document.getElementById('detailModal');
  if (!modal) return;

  document.getElementById('modalImage').src = item.gambar || 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=800&q=80';
  document.getElementById('modalCategory').textContent = item.kategori;
  document.getElementById('modalDate').textContent = item.tanggal;
  document.getElementById('modalAuthor').textContent = item.penulis;
  document.getElementById('modalTitle').textContent = item.judul;
  document.getElementById('modalContent').innerHTML = `
    <p class="text-base leading-relaxed text-slate-700 mb-4">${item.ringkasan}</p>
    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 text-slate-800 text-base leading-relaxed mb-4">
      ${item.isi}
    </div>
    <div class="flex items-center gap-2 mt-4 text-xs font-semibold text-emerald-800">
      <span class="px-3 py-1 bg-emerald-100 rounded-full">#${item.tag || 'MiftahulUlum'}</span>
      <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full">#GunungBubut</span>
    </div>
  `;

  modal.classList.remove('hidden');
  document.body.classList.add('overflow-hidden');
}

function closeModal() {
  const modal = document.getElementById('detailModal');
  if (!modal) return;
  modal.classList.add('hidden');
  document.body.classList.remove('overflow-hidden');
}

// PSB Online Registration Form
function initPSBForm() {
  // Biarkan form dikirim secara normal ke backend database via Laravel POST
  const form = document.getElementById('formPSB');
  if (!form) return;
}

// Contact Form
function initContactForm() {
  const form = document.getElementById('formKontak');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const nama = form.querySelector('[name="nama"]')?.value;
    const pesan = form.querySelector('[name="pesan"]')?.value;
    
    showToast(`Terima kasih Bapak/Ibu ${nama}, pesan Anda telah terkirim kepada Sekretariat Pesantren Miftahul Ulum.`, 'success');
    form.reset();
  });
}

// Simple Toast Notification
function showToast(message, type = 'info') {
  let toastContainer = document.getElementById('toastContainer');
  if (!toastContainer) {
    toastContainer = document.createElement('div');
    toastContainer.id = 'toastContainer';
    toastContainer.className = 'fixed bottom-20 right-6 z-50 flex flex-col gap-2 max-w-sm w-full';
    document.body.appendChild(toastContainer);
  }

  const toast = document.createElement('div');
  const bgClass = type === 'success' ? 'bg-emerald-800 text-white border-emerald-600' : 'bg-slate-900 text-white border-slate-700';
  toast.className = `flex items-center gap-3 p-4 rounded-xl shadow-2xl border ${bgClass} transition-all duration-300 transform translate-y-4 opacity-0`;
  toast.innerHTML = `
    <div class="text-amber-400 text-xl font-bold"><i class="fa-solid fa-circle-check"></i></div>
    <div class="flex-1 text-sm font-medium">${message}</div>
    <button class="text-white/70 hover:text-white" onclick="this.parentElement.remove()">&times;</button>
  `;

  toastContainer.appendChild(toast);

  setTimeout(() => {
    toast.classList.remove('translate-y-4', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');
  }, 10);

  setTimeout(() => {
    toast.classList.add('opacity-0', 'translate-y-4');
    setTimeout(() => toast.remove(), 300);
  }, 4500);
}
