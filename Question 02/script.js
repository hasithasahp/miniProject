$(document).ready(function() {
    // Populate country dropdown
    $.ajax({
        url: 'fetch_countries.php',
        success: function(data) {
            $('#countrySelect').append(data);
        }
    });

    // Handle country selection
    $('#countrySelect').on('change', function() {
        const selectedCountry = $(this).val();
        if (selectedCountry) {
            $.ajax({
                url: `https://restcountries.com/v3.1/name/${selectedCountry}?fullText=true`,
                method: 'GET',
                success: function(data) {
                    displayCountryInfo(data[0]);
                },
                error: function() {
                    alert('Failed to retrieve data');
                }
            });
        } else {
            $('#countryInfo').hide();
        }
    });

    // Function to display country info
    function displayCountryInfo(country) {
        $('#flag').attr('src', country.flags.png);
        $('#name').text(country.name.official);
        $('#capital').text(country.capital ? country.capital[0] : 'N/A');
        $('#region').text(country.region);
        $('#subregion').text(country.subregion || 'N/A');
        
        // Formatting Currencies
        const currencies = country.currencies ? 
            Object.values(country.currencies).map(cur => `${cur.name} (${cur.symbol})`).join(', ') 
            : 'N/A';
        $('#currencies').text(currencies);

        $('#code').text(country.cca2);
        $('#population').text(country.population.toLocaleString());
        $('#area').text(country.area.toLocaleString());
        
        // Formatting Borders
        const borders = country.borders ? country.borders.join(', ') : 'None';
        $('#borders').text(borders);
        $('#googleMap').attr('href', `https://www.google.com/maps/search/?api=1&query=${country.latlng[0]},${country.latlng[1]}`);
        $('#countryInfo').show();
    }
})