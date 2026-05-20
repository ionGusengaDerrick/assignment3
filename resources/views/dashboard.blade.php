<!DOCTYPE html>
<html>
<head>
    <title>Registry Dashboard</title>

    <style>

        body{
            font-family: Arial;
            padding:20px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        th, td{
            border:1px solid #ccc;
            padding:10px;
        }

        .online{
            color:green;
            font-weight:bold;
        }

        .offline{
            color:red;
            font-weight:bold;
        }

    </style>
</head>
<body>

<h1>Live Service Discovery Dashboard</h1>

<table>

    <thead>
        <tr>
            <th>Project</th>
            <th>Status</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody id="tableBody"></tbody>

</table>

<script>

async function loadServices() {

    const response = await fetch('/services');

    const services = await response.json();

    let rows = '';

    for (const key in services) {

        const service = services[key];

        rows += `
            <tr>

                <td>${service.project}</td>

                <td class="${
                    service.status === 'Online'
                    ? 'online'
                    : 'offline'
                }">
                    ${service.status}
                </td>

                <td>
                    <a href="${service.url}" target="_blank">
                        ${service.name}
                    </a>
                </td>

            </tr>
        `;
    }

    document.getElementById('tableBody').innerHTML = rows;
}

loadServices();

setInterval(loadServices, 3000);

</script>

</body>
</html>
