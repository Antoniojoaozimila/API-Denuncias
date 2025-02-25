document.addEventListener('DOMContentLoaded', function() {
    const gallery = document.querySelector('.gallery');
    const images = document.querySelectorAll('.gallery img');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let currentIndex = 0;

    prevBtn.addEventListener('click', () => {
      slide(-1);
    });

    nextBtn.addEventListener('click', () => {
      slide(1);
    });

    function slide(direction) {
      currentIndex = (currentIndex + direction + images.length) % images.length;
      const offset = -currentIndex * images[0].clientWidth;
      gallery.style.transform = `translateX(${offset}px)`;
    }
  });