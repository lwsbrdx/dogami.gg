import $ from 'jquery';
import select2 from 'select2';

select2(window, $);
const selector_class = '.dogamis-selector';

function formatState(dogami) {
    if (!dogami.id) {
        return dogami.text;
    }

    let state = $(`
        <span style="display: flex; align-items: center; column-gap: 10%;">
            <img src="${dogami.image}" style="height: 50px;" />
            ${dogami.text}
        </span>`
    );

    return state;
};

document.addEventListener("DOMContentLoaded", (_) => {
    const select_element = document.querySelector(selector_class);
    if (select_element === null) {
        return;
    }

    $(selector_class).select2({
        minimumInputLength: 1,
        templateResult: formatState,
        ajax: {
            url: '/api/search',
            dataType: 'json',
            data: (term, page) => {
                return {
                    needle: term.term,
                    comparator: true,
                };
            },
            processResults: (data) => {
                return {
                    results: data.data.map((dogami) => {
                        console.log(dogami.image);
                        let ipfsId = dogami.image.split("ipfs://")[1];

                        return {
                            id: dogami.nftId,
                            text: dogami.name,
                            image: `https://ipfs.io/ipfs/${ipfsId}`,
                        };
                    }),
                };
            }
        }
    });
});
