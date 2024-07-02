
document.addEventListener('DOMContentLoaded', function() {
    const startCitySearch = document.getElementById('startCitySearch');


    startCitySearch.addEventListener('input', function() {
        fetchCities(this.value, 'startCityList');
    });

    arrivalCitySearch.addEventListener('input', function() {
        fetchCities(this.value, 'arrivalCityList');
    });
});

function fetchCities(query, listId) {
    if (query.length < 2) return; // Ne commencez la recherche qu'après avoir saisi au moins 2 caractères

    fetch(`https://drivetogether.ewenlm.com/cities/find?search=${encodeURIComponent(query)}`)
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text); });
            }
            return response.json();
        })
        .then(data => {
            const datalist = document.getElementById(listId);
            datalist.innerHTML = '';
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name;
                datalist.appendChild(option);
            });
        })
        .catch(error => console.error('Error finding cities:', error));
}


