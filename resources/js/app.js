import './bootstrap';
import './home-editor';


document.addEventListener('DOMContentLoaded', () => {
  const btn  = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');

  if (!btn || !menu) return;

  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
});
