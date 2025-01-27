# Laravel Blog Starter

## About

This project is a simple blog application built with Laravel. It is designed to help programmers learn how to build a blog using the Laravel framework.

## Features

- User authentication and registration
- Create, read, update, and delete blog posts
- Comment on blog posts
- User profiles
- Responsive design

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/talalalmrka/jawad.git
    ```
2. Navigate to the project directory:
    ```sh
    cd jawad
    ```
3. Install the dependencies:
    ```sh
    composer install
    npm install
    ```
4. Copy the `.env.example` file to `.env`:
    ```sh
    cp .env.example .env
    ```
5. Generate the application key:
    ```sh
    php artisan key:generate
    ```
6. Set up your database configuration in the `.env` file.
7. Run the database migrations:
    ```sh
    php artisan migrate
    ```
8. Seed the database with sample data:
    ```sh
    php artisan db:seed
    ```
9. Start the development server:
    ```sh
    php artisan serve
    npm run dev
    ```

## Usage

- Register a new user or log in with an existing account.
- Create new blog posts, edit or delete existing posts.
- Comment on blog posts.
- View and edit your user profile.

## Contributing

Contributions are welcome! Please read the contribution guidelines before submitting a pull request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).