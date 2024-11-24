# Rejuvenate Tech Test
The purpose of this test is to see how you think and gauge your experience level with Laravel. There is no right or wrong, as long as the code meets the objectives.

## Objective
We need a simple search page for our client list, it should show active clients and be filterable by country. The country table already exists and is populated, but we need a new client table and model building.

Use the json file found in `storage/app/private/clients.json` to populate a new database table relating the client to the country based on the `country` field. 

Output the active list of clients on the home page with the option to filter by country.

Please don’t forget, your code should be production ready, clean and readable!

## Nice to have
- Demonstrate understanding of OOP
- Styled HTML output (Boostrap is included)
- Use as many of the framework's features as possible
- Unit Tests

---

# Setup instructions

## Requirements
- PHP 8.2+
- Composer

## Install
1. Install dependencies `composer install`
2. Migrate database tables `php artisan migrate` (select yes to create a local sqlite database)
3. Seed database tables `php artisan db:seed`
4. Run the site `php artisan serve`

## Testing
Run `php artisan test`
