// Image Slider Logic
document.querySelectorAll('.post-image-slider').forEach(slider => {
  const images = slider.querySelectorAll('.slide-img');
  let current = 0;

  // Set the first image as active initially to avoid a blank start
  if (images.length > 0) {
    images[0].classList.add('active');
  }

  setInterval(() => {
    images[current].classList.remove('active');
    current = (current + 1) % images.length;
    images[current].classList.add('active');
  }, 1500); // Change image every 2 seconds
});