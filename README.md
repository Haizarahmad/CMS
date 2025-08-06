## ✨ Classrom Management System (CMS)

Features:

Superadmin
- View Dashboard
- Manage Classrooms (Manage classroom details, Assign classroom hometeacher and notify through email)
- Manage Subjects (Manage Subjects)

Teacher
- View Dashboard
- Manage Student (Manage Student details, Attach student picture, Assign subjects)
- Add student using OCR (Optical Character Recognition)

![alt text](https://github.com/Haizarahmad/CMS/blob/new/dashboard.png?raw=true "Dashboard Page")

## Entity Relationship Diagram (ERD)
![alt text](https://github.com/Haizarahmad/CMS/blob/new/ERD-2.png?raw=true "ERD Diagram")

## System Setup
Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/Haizarahmad/CMS.git
   ```
   
2. Navigate to the project folder:
   ```bash
   cd CMS
   ```
   
3. Install PHP dependencies:
   ```bash
   composer install
   ```

4. Copy .env configuration:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Configure the database in the .env file with your local credentials.

7. Run database migrations and seed sample data:
   ```bash
   php artisan migrate:fresh
   ```

8. Link storage for media files:
   ```bash
   php artisan storage:link
   ```

9. Install JavaScript and CSS dependencies:
   ```bash
   npm install && npm run dev
   ```

10. Start the Laravel development server:
    ```bash
    php artisan serve
    ```

11. Login using the default admin credentials:

## Login Credentials

1. Admin
   Email: superadmin@gmail.com
   Password: password123

2. Teacher
   Email: teacher03@gmail.com
   Password: password123



