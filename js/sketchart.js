document.addEventListener('DOMContentLoaded', function() {
    // Removed all lightbox-related selectors and functions
    const sketchGrid = document.querySelector('.sketch-grid');

    // Subtle animation for sketch items on load
    if (sketchGrid) {
        const sketches = sketchGrid.querySelectorAll('.sketch-item');
        sketches.forEach((sketch, index) => {
            // Set initial state (already set in CSS, but reinforcing for clarity)
            sketch.style.opacity = 0;
            sketch.style.transform = 'translateY(40px) rotateZ(5deg)'; // Matches CSS initial state
            // Apply animation after a slight delay for staggered effect
            setTimeout(() => {
                sketch.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                sketch.style.opacity = 1;
                sketch.style.transform = 'translateY(0) rotateZ(0deg)'; // Animate to final state
            }, 100 + (index * 80)); // Staggered delay for each item
        });
    }
});