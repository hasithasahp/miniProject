const statsContainer = document.getElementById("provinces");

const apiHost = "covid-19-statistics.p.rapidapi.com";
const apiKey = "fff3b7ba29msh26ec1452c3fe5c0p114e96jsn5e8277a7df64";

async function fetchChinaProvinces() {
    const url = 'https://covid-19-statistics.p.rapidapi.com/provinces?iso=CHN';
    const options = {
        method: 'GET',
        headers: {
            'x-rapidapi-key': apiKey,
            'x-rapidapi-host': apiHost
        }
    };

    try {
        const response = await fetch(url, options);
        const data = await response.json();
        displayChinaProvinces(data.data);
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

// Display Provinces
function displayChinaProvinces(stats) {
    statsContainer.innerHTML = ""; // Clear previous content
    console.log(stats);
    
    stats.forEach(province => {
        const provinceElement = document.createElement("div");
        provinceElement.classList.add("div", "col-lg-4", 'col-md-6');

        provinceElement.innerHTML = `
            <div class="card p-2 m-1">
                <h6 class="card-title">${province.province}</h6>
                <div class="cart-text">Latitude: ${province.lat || 'N/A'}</div>
                <div class="cart-text">Longitude: ${province.long || 'N/A'}</div>
            </div>
        `;

        statsContainer.appendChild(provinceElement);
    });
}

// Call the function to fetch and display stats
fetchChinaProvinces();
