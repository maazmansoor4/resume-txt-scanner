# Resume Txt Scanner

Just a basic CRUD program I made to practice PHP, CSS, HTML and working with a database.

You upload a .txt resume and it tries to pull out the name, email, phone, education and GPA using some regex, then saves it to a MySQL database. You can also edit and delete the entries.

## Setup

I used Laragon (Apache + PHP) with MySQL.

1. Put the folder in your Laragon `www` directory.
2. Make a database called `resume_scanner`.
3. Create an `applicants` table with these columns: id, name, email, phone, education, gpa.
4. Open it in the browser through Laragon.

The database login is set to root with no password in `dbManager.php` (default Laragon setup), change it if yours is different.

## Notes

Uploaded files go into the `uploads/` folder and are not included in the repo.