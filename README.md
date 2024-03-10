# Barta

## Project Objective
Barta is a website where different individuals and organizations can share various types of content.

### Features
- A user can express any important text, thoughts by writing.
- A user can post any image, any image with text, etc.
- A user can give like if any other person or organization likes the post.
- An authentic user can comment good or bad on someone else's post.
- A user can access someone's account and see all posts.
- A user can find any user's account, post by searching.

## Project Description
Barta is a social content sharing website. Users can register and create an account to share text, images, or a combination of both. After logging in, users can edit their profiles, including uploading a profile image. Users can create posts, like posts made by others, and comment on them. They can also view posts made by other users and visit their profiles. The search functionality allows users to find specific users or posts based on keywords.

### Tools & Languages Used
#### Tools
- Visual Studio Code: Code editor.
- Web browser (Google Chrome).
- XAMPP: Apache and MySQL servers.
- Operating System: Windows.

#### Languages
- HTML (Hyper Text Markup Language): Web page design.
- Tailwind CSS: Responsive website design.
- MySQL: Database storage.
- PHP (Hypertext Preprocessor): Server-side scripting.
- Laravel: PHP framework.

## Installation and Setup
1. Clone the repository: `git clone https://github.com/your-username/barta.git`
2. Navigate to the project directory: `cd barta`
3. Install dependencies: `composer install`
4. Configure environment variables by copying `.env.example` to `.env` and configuring it with your database credentials and other settings.
5. Generate an application key: `php artisan key:generate`
6. Run migrations to create the necessary database tables: `php artisan migrate`
7. Serve the application: `php artisan serve`
8. Access the application in your web browser at `http://localhost:8000`

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request.

## License
This project is licensed under the [MIT License](LICENSE).
