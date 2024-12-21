This project is primarily built using native PHP. To check the website, you need to create a database with the same table names and populate it using the app's forms.

### MAIN PAGES:
1. **Courses Page**: The main page displays all courses, allowing users to view and comment on them. Admin login is available via the sidebar.
2. **Admin Page**: The admin dashboard is fully functional, with access to the database via phpMyAdmin.
3. **Registration Form**: The registration form works, and password reset emails are sent using PHP Mailer.
4. **Login Page**: Users can log in and reset their passwords if needed.

### DASHBOARD FEATURES:
1. **Courses Management**: View all posts on the courses page, add, edit, delete, or mark posts as drafts so they are hidden from the courses page.
2. **Categories Page**: View all categories, and add, edit, or delete categories as needed.
3. **Comments Page**: Approve or disapprove comments and view their details from the database.
4. **Profile Page**: View and edit admin profile information.
5. **Users Page**: View all user details, and add, edit, delete, or change roles by clicking on the role name.
6. **Online Users**: The number of active online users is displayed in the header bar.

### COURSES PAGE FEATURES:
1. View all available courses.
2. Add comments on specific courses after clicking on a post to visit its page.
3. View courses grouped by the author's name by clicking on their name.
4. View courses grouped by category by clicking on the category name.
5. Search for courses by post tag using the sidebar.

Each feature has its own PHP page. The PHP pages for the courses are located in the main CMS folder, with approximately four PHP pages. Additional PHP pages can be found in the **admin/demo** folder, with include folders for the courses in the CMS main folder and the admin pages in the admin folder.
