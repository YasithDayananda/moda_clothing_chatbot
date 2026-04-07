function scrollLeft() {
    const container = document.querySelector('.horizontal-images');
    container.scrollBy({ left: -300, behavior: 'smooth' });
}

function scrollRight() {
    const container = document.querySelector('.horizontal-images');
    container.scrollBy({ left: 300, behavior: 'smooth' });
}
