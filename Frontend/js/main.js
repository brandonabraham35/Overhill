// Overhill Junior School - frontend interactions (vanilla JS)
document.addEventListener('DOMContentLoaded', function () {
  // Current year in footer
  var y = document.getElementById('year');
  if (y) y.textContent = new Date().getFullYear();

  // Sticky header behaviour for transparent (home) header
  var header = document.getElementById('siteHeader');
  if (header && header.classList.contains('transparent')) {
    var onScroll = function () {
      if (window.scrollY > 80) header.classList.add('scrolled');
      else header.classList.remove('scrolled');
    };
    window.addEventListener('scroll', onScroll);
    onScroll();
  }

  // Mobile nav toggle
  var toggle = document.getElementById('navToggle');
  var nav = document.getElementById('mainNav');
  if (toggle && nav) {
    var backdrop = document.createElement('div');
    backdrop.className = 'nav-backdrop';
    document.body.appendChild(backdrop);
    var close = function () { nav.classList.remove('open'); backdrop.classList.remove('show'); };
    toggle.addEventListener('click', function () {
      nav.classList.toggle('open');
      backdrop.classList.toggle('show');
    });
    backdrop.addEventListener('click', close);

    // Mobile dropdown accordions
    nav.querySelectorAll('.has-dropdown > a').forEach(function (a) {
      a.addEventListener('click', function (e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          a.parentElement.classList.toggle('open');
        }
      });
    });
  }

  // Hero slider
  var slider = document.getElementById('heroSlider');
  if (slider) {
    var slides = slider.querySelectorAll('.slide');
    var dots = slider.querySelectorAll('.dot');
    var idx = 0, timer;
    var go = function (n) {
      slides[idx].classList.remove('active');
      if (dots[idx]) dots[idx].classList.remove('active');
      idx = (n + slides.length) % slides.length;
      slides[idx].classList.add('active');
      if (dots[idx]) dots[idx].classList.add('active');
    };
    var next = function () { go(idx + 1); };
    var prev = function () { go(idx - 1); };
    var start = function () { timer = setInterval(next, 6000); };
    var reset = function () { clearInterval(timer); start(); };

    var nb = document.getElementById('nextSlide');
    var pb = document.getElementById('prevSlide');
    if (nb) nb.addEventListener('click', function () { next(); reset(); });
    if (pb) pb.addEventListener('click', function () { prev(); reset(); });
    dots.forEach(function (d) {
      d.addEventListener('click', function () { go(parseInt(d.dataset.slide, 10)); reset(); });
    });
    start();
  }
});
