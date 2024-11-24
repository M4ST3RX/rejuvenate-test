import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

// Search using ajax request
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#searchButton').on('click', function () {
        let searchTerm = $('#searchInput').val().toLowerCase();
        let selectedCountries = $('#countryFilters input:checked').map(function () {
            return $(this).val();
        }).get();

         $.ajax({
            method: "POST",
            url: "/search",
            data: {
                search: searchTerm,
                countries: selectedCountries
            },
            success: function(response) {
                let tbody = $('.client-table tbody');
                tbody.empty();

                if (response.data.length > 0) {
                    response.data.forEach(client => {
                        let row = `
                            <tr>
                                <td>${client.id}</td>
                                <td>${client.full_name}</td>
                                <td>${client.email}</td>
                                <td>${client.country}</td>
                            </tr>`;
                        tbody.append(row); // Append new row
                    });
                } else {
                    let emptyRow = `
                        <tr>
                            <td colspan="4" class="text-center">No clients found.</td>
                        </tr>`;
                    tbody.append(emptyRow);
                }
            }
         });
    });
});
