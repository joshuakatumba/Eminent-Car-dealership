# Admin Panel Access

## How to Access the Admin Panel

The admin panel is accessible on port 8001. Here's how to set it up and access it:

### 1. Start the Admin Server

```bash
php artisan serve --port=8001
```

### 2. Access the Admin Panel

Open your browser and navigate to:
```
http://localhost:8001
```

This will automatically redirect you to the admin login page.

### 3. Login Credentials

Use these demo credentials to log in:

- **Email:** `admin@cardealership.com`
- **Password:** `password`

### 4. Admin Panel Features

Once logged in, you'll have access to:

- **Dashboard** - Overview of sales, vehicles, customers, and other metrics
- **Vehicles** - Manage vehicle inventory (create, edit, delete, view)
- **Customers** - Manage customer information
- **Sales** - Record and manage sales transactions
- **Finance** - Handle financing applications
- **Content** - Manage blog posts and content
- **Support** - Handle customer support tickets
- **Reports** - View various business reports
- **Settings** - Configure system settings
- **System Info** - View system information
- **Activity Log** - Monitor user activities

### 5. Navigation

- Use the sidebar navigation to access different sections
- The dashboard provides quick access to common actions
- Each section has full CRUD (Create, Read, Update, Delete) functionality

### 6. Security

- The admin panel is protected by authentication middleware
- Only users with admin roles can access the panel
- Session-based authentication is used
- Logout functionality is available in the user dropdown

### 7. Troubleshooting

If you encounter issues:

1. Make sure the database is migrated and seeded:
   ```bash
   php artisan migrate:fresh --seed
   ```

2. Check that the server is running on port 8001:
   ```bash
   php artisan serve --port=8001
   ```

3. Verify the admin user exists in the database

4. Check the browser console for any JavaScript errors

### 8. Development

- The admin panel uses Bootstrap 5 for styling
- Font Awesome icons are used throughout
- Chart.js is used for dashboard charts
- All forms include validation and error handling
