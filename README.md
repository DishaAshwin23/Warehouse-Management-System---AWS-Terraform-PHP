# Warehouse-Management-System---AWS-Terraform-PHP
Overview
This Warehouse Management System (WMS) is designed to automate inventory management processes within a warehouse. It leverages AWS services for hosting and Terraform for infrastructure provisioning. The backend utilizes RDSQL for database management, while the frontend is developed using PHP.

Features
- Automated inventory tracking: Automatically update and track inventory levels in real-time.
- User authentication: Secure login system for authorized access to the system.
- Product management: Add, update, and delete products from the inventory.
- Order management: Manage orders including creation, fulfillment, and tracking.
- Reporting: Generate reports on inventory levels, sales, and orders.

Technologies Used
- AWS (Amazon Web Services): Cloud platform for hosting the application.
- Terraform: Infrastructure as code tool for provisioning AWS resources.
- RDSQL (Relational Database Service): Managed database service for storing inventory data.
- PHP: Backend scripting language for server-side logic.
- HTML/CSS: Frontend markup and styling.
- JavaScript: Client-side scripting for interactive features.

Architecture
The system is deployed on AWS with the following architecture:
- EC2 Instance: Hosts the PHP frontend application.
- RDS Instance: Provides the database backend powered by RDSQL.
- S3 Bucket: Stores static assets such as images, CSS, and JavaScript files.
- AWS Lambda: Utilized for serverless functions for specific tasks like generating reports.
- API Gateway: Manages API endpoints for communication between frontend and backend.

Deployment
The deployment process is automated using Terraform:
1. Define infrastructure components in Terraform configuration files.
2. Run `terraform init` to initialize the project.
3. Run `terraform plan` to preview the changes.
4. Run `terraform apply` to provision the infrastructure on AWS.
5. Update configuration files with AWS resource details in the PHP frontend.
