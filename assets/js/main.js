$(document).ready(function() {
    // Function to fetch and populate admin data
    function populateAdminTable() {
        $.getJSON('../backend/fetch_admin_data.php', function(data) {
            var adminTable = $('#admin-table');
            if ($.fn.DataTable.isDataTable(adminTable)) {
                adminTable.DataTable().destroy(); // Destroy existing DataTable instance
            }
            adminTable.DataTable({
                "data": data,
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "email" },
                    
                    { "defaultContent": "<button class='delete-btn'>Delete</button>" }
                ]
            });
        });
    }

    // Call the function to populate admin table when the document is ready
    populateAdminTable();

    // Initialize DataTables for other tables
    $('#product-table').DataTable();
    $('#messages-table').DataTable();
    $('#sales-table').DataTable();
    $('#customers-table').DataTable();

    // Other event handlers and functions can go here...
});


