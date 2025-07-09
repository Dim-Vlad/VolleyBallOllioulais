document.getElementById('season-select').addEventListener('change', function () {
    const season = this.value;
    const gallery = document.getElementById('archive-gallery');
    gallery.innerHTML = '';

    // Exemple d’images par saison
    const archives = {
        '2024': [
            'photos/saison-24-25/20241218_175606.jpg',
            'photos/saison-24-25/20241218_181119.jpg'
        ],
        '2023': [
            '/photos/saison-23-24/thumb1.jpg',
            '/photos/saison-23-24/thumb2.jpg'
        ],
        'events': [
            '/photos/evenements/thumb1.jpg',
            '/photos/evenements/thumb2.jpg'
        ]
    };

    if (archives[season]) {
        archives[season].forEach(imgSrc => {
            const link = document.createElement('a');
            link.setAttribute('href', imgSrc); // Tu peux remplacer par lightbox ou lien vers une page
            link.setAttribute('data-lightbox', 'archive');
            link.innerHTML = `<img src="${imgSrc}" alt="Photo archive">`;
            gallery.appendChild(link);
        });
    }
});

const swiper = new Swiper('.swiper-container', {
    loop: true,
    pagination: { el: '.swiper-pagination' },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
});