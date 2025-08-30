# Car Dealership Admin System - Database Design

## System Overview

This database design supports a comprehensive car dealership admin system with role-based access control, complete vehicle lifecycle management, customer relationship management, financial processing, and content management.

## Database Flow

### 1. **User Authentication & Authorization Flow**
- Users register/login → `users` table
- Roles assigned via `role_id` → `roles` table
- Permissions checked via `role_permissions` junction table
- Activity logged in `activity_logs` table

### 2. **Vehicle Management Flow**
- Admin creates vehicle categories → `vehicle_categories` table
- Admin adds vehicle brands → `vehicle_brands` table
- Inventory manager adds vehicles → `vehicles` table
- Vehicle images uploaded → `vehicle_images` table
- Maintenance records tracked → `vehicle_maintenance` table

### 3. **Sales Process Flow**
- Customer inquiry → `sales_leads` table
- Customer registration → `customers` table
- Vehicle selection → `vehicles` table
- Financing application → `financing_applications` table
- Sale completion → `sales` table
- Payment tracking → `payments` table

### 4. **Content Management Flow**
- Marketing manager creates blog posts → `blog_posts` table
- Customer testimonials → `testimonials` table
- Support tickets → `support_tickets` table

## Database Tables

### 1. **USERS** (Core Authentication)
```sql
users
├── id (PK, BIGINT, AUTO_INCREMENT)
├── name (VARCHAR(255), NOT NULL)
├── email (VARCHAR(255), UNIQUE, NOT NULL)
├── password (VARCHAR(255), NOT NULL)
├── role_id (FK → roles.id, NOT NULL)
├── phone (VARCHAR(20), NULLABLE)
├── address (TEXT, NULLABLE)
├── profile_image (VARCHAR(255), NULLABLE)
├── is_active (BOOLEAN, DEFAULT TRUE)
├── email_verified_at (TIMESTAMP, NULLABLE)
├── last_login_at (TIMESTAMP, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `role_id` → `roles.id` (Many-to-One)
- Referenced by: `vehicles.created_by`, `sales_leads.assigned_to`, `sales.salesperson_id`, `financing_applications.approved_by`, `blog_posts.author_id`, `support_tickets.assigned_to`, `ticket_responses.user_id`, `activity_logs.user_id`

### 2. **ROLES** (Role Management)
```sql
roles
├── id (PK, BIGINT, AUTO_INCREMENT)
├── name (VARCHAR(100), UNIQUE, NOT NULL)
├── description (TEXT, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Sample Data:**
- super_admin
- sales_manager
- inventory_manager
- finance_manager
- customer_service_manager
- marketing_manager

### 3. **PERMISSIONS** (Permission System)
```sql
permissions
├── id (PK, BIGINT, AUTO_INCREMENT)
├── name (VARCHAR(255), NOT NULL)
├── slug (VARCHAR(255), UNIQUE, NOT NULL)
├── description (TEXT, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Sample Permissions:**
- manage_users, manage_vehicles, manage_sales, manage_finance, manage_content, view_reports

### 4. **ROLE_PERMISSIONS** (Junction Table)
```sql
role_permissions
├── id (PK, BIGINT, AUTO_INCREMENT)
├── role_id (FK → roles.id, NOT NULL)
├── permission_id (FK → permissions.id, NOT NULL)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── UNIQUE KEY (role_id, permission_id)
```

### 5. **VEHICLE_CATEGORIES** (Vehicle Classification)
```sql
vehicle_categories
├── id (PK, BIGINT, AUTO_INCREMENT)
├── name (VARCHAR(100), UNIQUE, NOT NULL)
├── description (TEXT, NULLABLE)
├── image (VARCHAR(255), NULLABLE)
├── is_active (BOOLEAN, DEFAULT TRUE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Sample Data:** Sedan, SUV, Truck, Hatchback, Convertible, Van

### 6. **VEHICLE_BRANDS** (Manufacturer Management)
```sql
vehicle_brands
├── id (PK, BIGINT, AUTO_INCREMENT)
├── name (VARCHAR(100), UNIQUE, NOT NULL)
├── logo (VARCHAR(255), NULLABLE)
├── description (TEXT, NULLABLE)
├── is_active (BOOLEAN, DEFAULT TRUE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Sample Data:** Toyota, Honda, Ford, Chevrolet, BMW, Mercedes-Benz

### 7. **VEHICLES** (Core Vehicle Data)
```sql
vehicles
├── id (PK, BIGINT, AUTO_INCREMENT)
├── category_id (FK → vehicle_categories.id, NOT NULL)
├── brand_id (FK → vehicle_brands.id, NOT NULL)
├── model (VARCHAR(100), NOT NULL)
├── year (INT, NOT NULL)
├── mileage (INT, NOT NULL)
├── price (DECIMAL(10,2), NOT NULL)
├── sale_price (DECIMAL(10,2), NULLABLE)
├── vin_number (VARCHAR(17), UNIQUE, NOT NULL)
├── engine_size (VARCHAR(50), NULLABLE)
├── fuel_type (ENUM('gasoline', 'diesel', 'electric', 'hybrid'), NOT NULL)
├── transmission (ENUM('automatic', 'manual', 'cvt'), NOT NULL)
├── color (VARCHAR(50), NOT NULL)
├── interior_color (VARCHAR(50), NULLABLE)
├── features (JSON, NULLABLE)
├── description (TEXT, NULLABLE)
├── status (ENUM('available', 'sold', 'reserved', 'maintenance'), DEFAULT 'available')
├── is_featured (BOOLEAN, DEFAULT FALSE)
├── created_by (FK → users.id, NOT NULL)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `category_id` → `vehicle_categories.id` (Many-to-One)
- `brand_id` → `vehicle_brands.id` (Many-to-One)
- `created_by` → `users.id` (Many-to-One)
- Referenced by: `vehicle_images.vehicle_id`, `vehicle_maintenance.vehicle_id`, `sales_leads.vehicle_id`, `sales.vehicle_id`, `financing_applications.vehicle_id`, `vehicle_views.vehicle_id`

### 8. **VEHICLE_IMAGES** (Vehicle Media)
```sql
vehicle_images
├── id (PK, BIGINT, AUTO_INCREMENT)
├── vehicle_id (FK → vehicles.id, NOT NULL)
├── image_path (VARCHAR(255), NOT NULL)
├── is_primary (BOOLEAN, DEFAULT FALSE)
├── alt_text (VARCHAR(255), NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `vehicle_id` → `vehicles.id` (Many-to-One)

### 9. **VEHICLE_MAINTENANCE** (Service History)
```sql
vehicle_maintenance
├── id (PK, BIGINT, AUTO_INCREMENT)
├── vehicle_id (FK → vehicles.id, NOT NULL)
├── service_type (VARCHAR(100), NOT NULL)
├── description (TEXT, NOT NULL)
├── cost (DECIMAL(10,2), NOT NULL)
├── service_date (DATE, NOT NULL)
├── next_service_date (DATE, NULLABLE)
├── performed_by (FK → users.id, NOT NULL)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `vehicle_id` → `vehicles.id` (Many-to-One)
- `performed_by` → `users.id` (Many-to-One)

### 10. **CUSTOMERS** (Customer Management)
```sql
customers
├── id (PK, BIGINT, AUTO_INCREMENT)
├── user_id (FK → users.id, NULLABLE)
├── first_name (VARCHAR(100), NOT NULL)
├── last_name (VARCHAR(100), NOT NULL)
├── email (VARCHAR(255), UNIQUE, NOT NULL)
├── phone (VARCHAR(20), NOT NULL)
├── address (TEXT, NOT NULL)
├── city (VARCHAR(100), NOT NULL)
├── state (VARCHAR(50), NOT NULL)
├── zip_code (VARCHAR(10), NOT NULL)
├── date_of_birth (DATE, NULLABLE)
├── driver_license (VARCHAR(50), NULLABLE)
├── credit_score (INT, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `user_id` → `users.id` (One-to-One, optional)
- Referenced by: `sales_leads.customer_id`, `sales.customer_id`, `financing_applications.customer_id`, `support_tickets.customer_id`

### 11. **SALES_LEADS** (Lead Management)
```sql
sales_leads
├── id (PK, BIGINT, AUTO_INCREMENT)
├── customer_id (FK → customers.id, NOT NULL)
├── vehicle_id (FK → vehicles.id, NULLABLE)
├── source (ENUM('website', 'phone', 'walk_in', 'referral'), NOT NULL)
├── status (ENUM('new', 'contacted', 'qualified', 'closed', 'lost'), DEFAULT 'new')
├── notes (TEXT, NULLABLE)
├── assigned_to (FK → users.id, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `customer_id` → `customers.id` (Many-to-One)
- `vehicle_id` → `vehicles.id` (Many-to-One, optional)
- `assigned_to` → `users.id` (Many-to-One, optional)

### 12. **SALES** (Sales Transactions)
```sql
sales
├── id (PK, BIGINT, AUTO_INCREMENT)
├── customer_id (FK → customers.id, NOT NULL)
├── vehicle_id (FK → vehicles.id, NOT NULL)
├── salesperson_id (FK → users.id, NOT NULL)
├── sale_price (DECIMAL(10,2), NOT NULL)
├── down_payment (DECIMAL(10,2), NOT NULL)
├── financing_amount (DECIMAL(10,2), NOT NULL)
├── sale_date (DATE, NOT NULL)
├── status (ENUM('pending', 'completed', 'cancelled'), DEFAULT 'pending')
├── notes (TEXT, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `customer_id` → `customers.id` (Many-to-One)
- `vehicle_id` → `vehicles.id` (Many-to-One)
- `salesperson_id` → `users.id` (Many-to-One)

### 13. **FINANCING_APPLICATIONS** (Loan Applications)
```sql
financing_applications
├── id (PK, BIGINT, AUTO_INCREMENT)
├── customer_id (FK → customers.id, NOT NULL)
├── vehicle_id (FK → vehicles.id, NOT NULL)
├── requested_amount (DECIMAL(10,2), NOT NULL)
├── monthly_income (DECIMAL(10,2), NOT NULL)
├── employment_status (ENUM('employed', 'self_employed', 'unemployed'), NOT NULL)
├── employer_name (VARCHAR(255), NULLABLE)
├── employment_duration (INT, NULLABLE) -- months
├── credit_score (INT, NOT NULL)
├── status (ENUM('pending', 'approved', 'rejected'), DEFAULT 'pending')
├── approved_by (FK → users.id, NULLABLE)
├── approved_at (TIMESTAMP, NULLABLE)
├── interest_rate (DECIMAL(5,2), NULLABLE)
├── loan_term (INT, NULLABLE) -- months
├── monthly_payment (DECIMAL(10,2), NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `customer_id` → `customers.id` (Many-to-One)
- `vehicle_id` → `vehicles.id` (Many-to-One)
- `approved_by` → `users.id` (Many-to-One, optional)
- Referenced by: `payments.financing_application_id`

### 14. **PAYMENTS** (Payment Tracking)
```sql
payments
├── id (PK, BIGINT, AUTO_INCREMENT)
├── financing_application_id (FK → financing_applications.id, NOT NULL)
├── amount (DECIMAL(10,2), NOT NULL)
├── payment_date (DATE, NOT NULL)
├── payment_method (ENUM('credit_card', 'bank_transfer', 'cash', 'check'), NOT NULL)
├── status (ENUM('pending', 'completed', 'failed'), DEFAULT 'pending')
├── transaction_id (VARCHAR(255), NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `financing_application_id` → `financing_applications.id` (Many-to-One)

### 15. **BLOG_POSTS** (Content Management)
```sql
blog_posts
├── id (PK, BIGINT, AUTO_INCREMENT)
├── title (VARCHAR(255), NOT NULL)
├── slug (VARCHAR(255), UNIQUE, NOT NULL)
├── content (LONGTEXT, NOT NULL)
├── excerpt (TEXT, NULLABLE)
├── featured_image (VARCHAR(255), NULLABLE)
├── author_id (FK → users.id, NOT NULL)
├── status (ENUM('draft', 'published', 'archived'), DEFAULT 'draft')
├── published_at (TIMESTAMP, NULLABLE)
├── meta_title (VARCHAR(255), NULLABLE)
├── meta_description (TEXT, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `author_id` → `users.id` (Many-to-One)

### 16. **TESTIMONIALS** (Customer Reviews)
```sql
testimonials
├── id (PK, BIGINT, AUTO_INCREMENT)
├── customer_name (VARCHAR(255), NOT NULL)
├── customer_email (VARCHAR(255), NOT NULL)
├── rating (INT, NOT NULL) -- 1-5 stars
├── content (TEXT, NOT NULL)
├── is_approved (BOOLEAN, DEFAULT FALSE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

### 17. **SUPPORT_TICKETS** (Customer Support)
```sql
support_tickets
├── id (PK, BIGINT, AUTO_INCREMENT)
├── customer_id (FK → customers.id, NOT NULL)
├── subject (VARCHAR(255), NOT NULL)
├── description (TEXT, NOT NULL)
├── priority (ENUM('low', 'medium', 'high', 'urgent'), DEFAULT 'medium')
├── status (ENUM('open', 'in_progress', 'resolved', 'closed'), DEFAULT 'open')
├── assigned_to (FK → users.id, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `customer_id` → `customers.id` (Many-to-One)
- `assigned_to` → `users.id` (Many-to-One, optional)
- Referenced by: `ticket_responses.ticket_id`

### 18. **TICKET_RESPONSES** (Support Conversations)
```sql
ticket_responses
├── id (PK, BIGINT, AUTO_INCREMENT)
├── ticket_id (FK → support_tickets.id, NOT NULL)
├── user_id (FK → users.id, NOT NULL)
├── message (TEXT, NOT NULL)
├── is_internal (BOOLEAN, DEFAULT FALSE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Relationships:**
- `ticket_id` → `support_tickets.id` (Many-to-One)
- `user_id` → `users.id` (Many-to-One)

### 19. **PAGE_VIEWS** (Website Analytics)
```sql
page_views
├── id (PK, BIGINT, AUTO_INCREMENT)
├── page_url (VARCHAR(500), NOT NULL)
├── user_agent (TEXT, NULLABLE)
├── ip_address (VARCHAR(45), NULLABLE)
├── user_id (FK → users.id, NULLABLE)
├── session_id (VARCHAR(255), NULLABLE)
└── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
```

**Relationships:**
- `user_id` → `users.id` (Many-to-One, optional)

### 20. **VEHICLE_VIEWS** (Vehicle Analytics)
```sql
vehicle_views
├── id (PK, BIGINT, AUTO_INCREMENT)
├── vehicle_id (FK → vehicles.id, NOT NULL)
├── user_id (FK → users.id, NULLABLE)
├── ip_address (VARCHAR(45), NULLABLE)
└── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
```

**Relationships:**
- `vehicle_id` → `vehicles.id` (Many-to-One)
- `user_id` → `users.id` (Many-to-One, optional)

### 21. **SETTINGS** (System Configuration)
```sql
settings
├── id (PK, BIGINT, AUTO_INCREMENT)
├── key (VARCHAR(255), UNIQUE, NOT NULL)
├── value (TEXT, NOT NULL)
├── description (TEXT, NULLABLE)
├── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
└── updated_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)
```

**Sample Settings:**
- site_name, contact_email, business_hours, tax_rate, default_interest_rate

### 22. **ACTIVITY_LOGS** (Audit Trail)
```sql
activity_logs
├── id (PK, BIGINT, AUTO_INCREMENT)
├── user_id (FK → users.id, NULLABLE)
├── action (VARCHAR(255), NOT NULL)
├── model_type (VARCHAR(255), NULLABLE)
├── model_id (BIGINT, NULLABLE)
├── description (TEXT, NULLABLE)
├── ip_address (VARCHAR(45), NULLABLE)
├── user_agent (TEXT, NULLABLE)
└── created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
```

**Relationships:**
- `user_id` → `users.id` (Many-to-One, optional)

## Indexes for Performance

### Primary Indexes (Auto-created)
- All `id` columns are primary keys

### Foreign Key Indexes (Auto-created)
- All foreign key columns are automatically indexed

### Additional Recommended Indexes
```sql
-- Users table
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role_id ON users(role_id);
CREATE INDEX idx_users_is_active ON users(is_active);

-- Vehicles table
CREATE INDEX idx_vehicles_status ON vehicles(status);
CREATE INDEX idx_vehicles_brand_id ON vehicles(brand_id);
CREATE INDEX idx_vehicles_category_id ON vehicles(category_id);
CREATE INDEX idx_vehicles_price ON vehicles(price);
CREATE INDEX idx_vehicles_year ON vehicles(year);
CREATE INDEX idx_vehicles_vin ON vehicles(vin_number);

-- Sales table
CREATE INDEX idx_sales_date ON sales(sale_date);
CREATE INDEX idx_sales_status ON sales(status);
CREATE INDEX idx_sales_customer_id ON sales(customer_id);

-- Financing applications
CREATE INDEX idx_financing_status ON financing_applications(status);
CREATE INDEX idx_financing_customer_id ON financing_applications(customer_id);

-- Support tickets
CREATE INDEX idx_tickets_status ON support_tickets(status);
CREATE INDEX idx_tickets_priority ON support_tickets(priority);
CREATE INDEX idx_tickets_assigned_to ON support_tickets(assigned_to);

-- Activity logs
CREATE INDEX idx_activity_user_id ON activity_logs(user_id);
CREATE INDEX idx_activity_created_at ON activity_logs(created_at);
```

## Data Integrity Constraints

### Check Constraints
```sql
-- Vehicle year must be reasonable
ALTER TABLE vehicles ADD CONSTRAINT chk_vehicle_year CHECK (year >= 1900 AND year <= YEAR(CURRENT_DATE) + 1);

-- Vehicle price must be positive
ALTER TABLE vehicles ADD CONSTRAINT chk_vehicle_price CHECK (price > 0);

-- Credit score must be between 300-850
ALTER TABLE financing_applications ADD CONSTRAINT chk_credit_score CHECK (credit_score >= 300 AND credit_score <= 850);

-- Rating must be between 1-5
ALTER TABLE testimonials ADD CONSTRAINT chk_rating CHECK (rating >= 1 AND rating <= 5);
```

### Unique Constraints
- `users.email` - Email must be unique
- `vehicles.vin_number` - VIN must be unique
- `vehicle_categories.name` - Category name must be unique
- `vehicle_brands.name` - Brand name must be unique
- `blog_posts.slug` - Blog slug must be unique
- `settings.key` - Setting key must be unique

## Security Considerations

1. **Password Hashing**: All passwords stored using Laravel's bcrypt hashing
2. **SQL Injection Prevention**: Use Laravel's Eloquent ORM with parameterized queries
3. **XSS Prevention**: All user input sanitized and validated
4. **CSRF Protection**: Laravel's built-in CSRF protection enabled
5. **Rate Limiting**: Implement rate limiting on authentication endpoints
6. **Audit Logging**: All admin actions logged in `activity_logs` table

## Backup Strategy

1. **Daily Backups**: Full database backup every 24 hours
2. **Transaction Logs**: Keep transaction logs for point-in-time recovery
3. **Offsite Storage**: Store backups in secure offsite location
4. **Testing**: Regular backup restoration testing

This database design provides a solid foundation for a comprehensive car dealership admin system with proper relationships, constraints, and performance optimization.
