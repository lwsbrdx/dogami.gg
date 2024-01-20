import './bootstrap';
import "/node_modules/select2/dist/css/select2.css";
import '@splidejs/splide/dist/css/splide.min.css';
import '@splidejs/splide/dist/js/splide';

import.meta.glob([
    '../assets/**',
]);

import './dogamis-selector/main';

import Splide from '@splidejs/splide';

const splides = [];
const splidesToLoad = [
    '.splide.dogamis-compare',
    '.splide.trainings-results',
]

document.addEventListener("DOMContentLoaded", (_) => {
    for (let splideToLoad of splidesToLoad) {
        if (document.querySelector(splideToLoad)) {
            splides.push(
                new Splide(splideToLoad, {
                    autoplay: false,
                    arrows: false,
                    pagination: true,
                    mediaQuery: 'min',
                    breakpoints: {
                        640: {
                            destroy: true
                        }
                    },
                })
            );
        }
    }

    splides.forEach(splide => splide.mount());
});
