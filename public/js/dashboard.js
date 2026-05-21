async function loadServices() {

    try {

        const response = await fetch('/services');
        const data = await response.json();
        
        const services = data.services || [];
        
        // stats
        document.getElementById('statTotal').textContent = services.length;

        const online = services.filter(s => s.status === 'online').length;
        const offline = services.length - online;

        

        document.getElementById('statOnline').textContent = online;
        document.getElementById('statOffline').textContent = offline;

        const percent = services.length
            ? Math.round((online / services.length) * 100)
            : 0;

        document.getElementById('healthPercent').textContent =
            percent + '% online';

        document.getElementById('healthFill').style.width =
            percent + '%';

        document.getElementById('serviceCount').textContent =
            services.length + ' services';

        // table
        const tableBody = document.getElementById('tableBody');

        tableBody.innerHTML = '';

        services.forEach(service => {

            tableBody.innerHTML += `
                <tr>
                    <td>${service.project_name}</td>

                    <td>
                        <span class="badge ${service.status}">
                            ${service.status}
                        </span>
                    </td>

                    <td>
                        <a href="${service.url}" target="_blank">
                            ${service.name}
                        </a>
                    </td>

                    <td>
                        <a href="${service.url}" target="_blank">
                            ${service.url}
                        </a>
                    </td>
                </tr>
            `;
        });

        // empty state
        document.getElementById('emptyState').style.display =
            services.length ? 'none' : 'block';

        document.querySelector('.table-wrap').style.display =
            services.length ? 'block' : 'none';

        // last updated
        document.getElementById('lastUpdated').textContent =
            'Updated ' + new Date().toLocaleTimeString();

    } catch (error) {

        console.error(error);

        document.getElementById('liveStatus').textContent =
            'Connection error';
    }
}

// load immediately
loadServices();

// refresh every 2 seconds
setInterval(loadServices, 2000);