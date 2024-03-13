document.addEventListener('DOMContentLoaded', function () {
    const laundryAppointmentsTable = document.querySelector('.laundry-appointments tbody');

    fetch('submit_appointment')
        .then(response => response.json())
        .then(data => {
            // Clear existing table rows

            laundryAppointmentsTable.innerHTML = '';

            // Populate the table with fetched data
            data.forEach(appointment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${appointment[0]}</td>
                    <td>${appointment[1]}</td>
                    <td>${appointment[2]}</td>
                    <td>${appointment[3]}</td>
                `;
                laundryAppointmentsTable.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});