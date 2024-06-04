document.addEventListener('DOMContentLoaded', function () {
    fetch('https://countriesnow.space/api/v0.1/countries')
        .then(response => response.json())
        .then(data => {
            const countrySelect = document.getElementById('country');
            data.data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.country;
                option.textContent = country.country;
                countrySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching countries:', error));
});
