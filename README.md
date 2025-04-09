# Latihan-BNSP: Pendaftaran Murid Baru Online

**Latihan-BNSP** is an online registration system designed for the enrollment of new students (murid baru) using PHP and Bootstrap. This system enables students to register for their courses or institutions online easily, and allows administrators to manage student applications in an efficient manner.

## Features

- **Student Registration**: Students can register online by filling out a simple registration form.
- **Document Upload**: Option for students to upload necessary documents such as identity cards, proof of previous education, etc.
- **Admin Panel**: Admin users can view and manage student registrations, review submissions, and approve or reject them.
- **Email Notification**: Automated email notifications are sent to students after completing registration.
- **Simple and Responsive Design**: Built with Bootstrap to ensure the system works well on both mobile and desktop devices.

## Technologies Used

- **Backend**: PHP (native)
- **Frontend**: HTML, CSS, and Bootstrap for responsive UI.
- **Database**: MySQL (or any other relational database).

## Installation

To get started with **Latihan-BNSP**, follow these installation steps:

### Prerequisites

- PHP (v7.x or higher)
- MySQL Database
- A local server environment like XAMPP, WAMP, or LAMP
- Git (optional, for cloning the repo)

### Steps

1. **Clone or Download the Repository**
   ```bash
   git clone https://github.com/LorentzaZweena/latihan-bnsp.git
   cd latihan-bnsp
   ```

2. **Set up the Database**
   - Create a new database in MySQL, for example, `latihan_bns`.
   - Import the database schema (e.g., `database.sql`) into the new database.

3. **Configure Database Connection**
   - Open `config.php` and update the database connection details (`DB_SERVER`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE`).

4. **Run the Application**
   - Place the files in the **htdocs** (or equivalent) directory if using XAMPP/WAMP.
   - Open `index.php` in a web browser (e.g., `http://localhost/latihan-bnsp`).
   
5. **Email Configuration**
   - If you want to send email notifications, configure the mail settings in `mailer.php` with your email server details (e.g., SMTP).

## Usage

### For Students:

1. Go to the online registration page.
2. Fill out the registration form with required details (name, address, previous school details, etc.).
3. Upload any necessary documents (ID card, proof of education, etc.).
4. Submit the form and receive a confirmation email after successful registration.

### For Admin:

1. Log in to the admin panel using your credentials.
2. View the list of student registrations.
3. Approve or reject student applications.
4. Manage data and track the status of the registrations.

## Example of Database Schema (MySQL)

Here is a sample table for storing student registration data:

```sql
CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  address TEXT,
  school VARCHAR(255),
  email VARCHAR(255) NOT NULL,
  documents TEXT,
  status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Contributing

We welcome contributions to improve this project! To contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Commit your changes and push them to your fork.
4. Open a pull request for review.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Contact

For any questions or suggestions, please contact [ariva02zweena@gmail.com](mailto:ariva02zweena@gmail.com).
