<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rejuvenate Tech Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <h1>Client list</h1>
        <div class="input-group mb-3 w-100">
            <input id="searchInput" class="form-control" type="text" placeholder="Search for client...">
            <button id="searchButton" class="btn btn-primary">Search</button>
        </div>
        <div id="countryFilters" class="mb-3">
            <label class="form-label">Filter by Country:</label>
            @foreach($countries as $country)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $country->code }}" id="{{ $country->code }}">
                <label class="form-check-label" for="{{ $country->code }}">{{ $country->name }}</label>
            </div>
            @endforeach
        </div>
        <table class="table table-striped table-bordered client-table">
            <thead>
                <th data-sort="id"># <span class="sort-arrow"></span></th>
                <th data-sort="full-name">Full Name <span class="sort-arrow"></span></th>
                <th data-sort="email">Email <span class="sort-arrow"></span></th>
                <th data-sort="country">Country <span class="sort-arrow"></span></th>
            </thead>
            <tbody>
                @foreach ($clients as $i => $client)
                    <tr data-id="{{ $client->id }}" data-full-name="{{ $client->first_name }} {{ $client->last_name }}" data-email="{{ $client->email }}" data-country="{{ $client->country->code }}">
                        <td>{{ $client->id }}</td>
                        <td>{{ "{$client->first_name} {$client->last_name}" }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->country->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
