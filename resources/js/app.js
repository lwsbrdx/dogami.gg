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
const splidesToLoad = {
    '.splide.dogamis-compare': { inside: false },
    '.splide.trainings-results': { inside: false },
    '.splide.trainings-results-all': { inside: false, contains: true },
    '.splide.trainings-results-no_treats': { inside: true },
    '.splide.trainings-results-small_treats': { inside: true },
    '.splide.trainings-results-medium_treats': { inside: true },
    '.splide.trainings-results-large_treats': { inside: true },
}

document.addEventListener("DOMContentLoaded", (_) => {
    for (let splideToLoadClass in splidesToLoad) {
        let splideToLoad = splidesToLoad[splideToLoadClass];

        if (document.querySelector(splideToLoadClass)) {
            splides.push(
                new Splide(splideToLoadClass, {
                    autoplay: false,
                    arrows: splideToLoad.inside ? true : false,
                    drag: splideToLoad.inside ? false : true,
                    pagination: true,
                    mediaQuery: 'min',
                    breakpoints: {
                        640: {
                            destroy: splideToLoad.contains ? false : true
                        }
                    },
                    perPage: 1,
                })
            );
        }
    }

    splides.forEach(splide => splide.mount());
});
