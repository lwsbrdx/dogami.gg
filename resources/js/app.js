import './bootstrap';
import '@splidejs/splide/dist/css/splide.min.css';
import '@splidejs/splide/dist/js/splide';

import.meta.glob([
    '../assets/**',
]);

import Splide from '@splidejs/splide';

const splide = new Splide('.splide.dogamis-compare', {
    autoplay: false,
    arrows: false,
    pagination: true,
    mediaQuery: 'min',
    breakpoints: {
        640: {
            destroy: true
        }
    },
});

splide.mount();
