# 1. Introduction

## What is AWS?

Amazon Web Services (AWS) is a cloud computing platform provided by Amazon. Instead of storing files on our own computer or sending emails using our own mail server, AWS provides managed cloud services that are reliable, scalable, secure, and widely used in the industry.

## Why are we using AWS in this project?

The portal digitizes investor service requests (e.g., Bank, Address, or KYC updates). Because supporting documents contain confidential data and local server storage is volatile, the system uses Amazon S3 for secure file storage and Amazon SES for transactional notifications.


# 2. AWS services used 

📦 Amazon S3
Role: Private cloud vault for investor docs.

Features: Public access blocked by default; temporary 5-minute pre-signed links for admin reviews; files prefixed with UUIDs to prevent data overwrites.

✉️ Amazon SES
Role: Automated email notification engine.

Features: Injects live variables into bank-styled HTML templates; enforces strict sandbox safety rules during testing.

🔐 AWS IAM
Role: Identity gatekeeper for backend access permissions.

Features: Grants least-privilege security keys to the Node.js app; isolates developer access without exposing the main root account.

💻 AWS CLI
Role: Terminal-based local management tool.

Features: Connects local codebases via the aws configure wizard; enables quick asset auditing (like aws s3 ls) without a browser.

# 3. Complete AWS Workflow

When an investor uploads documents, the complete flow is:

Investor → Select Documents → React Frontend → Express API → Multer Middleware → Validation → Amazon S3 → Store URL in MongoDB

Admin → Approve Request → Express Backend → Amazon SES → Investor receives Email

# 4. AWS Account Creation

1. Visit **https://aws.amazon.com**
2. Click **Create AWS Account**.
3. Register with your email and verify it.
4. Add billing details.
5. Select the **Free Tier** plan.
6. Sign in to the **AWS Management Console**.

# 5. IAM User Setup

> **Note:** Avoid using the Root Account for development.

1. Open **AWS Console** → **IAM** → **Users**.
2. Click **Create User**.
3. Enter a username (e.g., `aws-practice-user`).
4. Assign the **AdministratorAccess** permission.
5. Generate the **Access Key** and **Secret Access Key**.
6. Store both credentials securely for use in your Node.js application

# 6. Project Setup

```bash
git clone https://github.com/Priyanshri/aws-practice.git

cd AWS-Practice/server

npm install express multer dotenv uuid @aws-sdk/client-s3 @aws-sdk/client-ses @aws-sdk/s3-request-presigner cors

node app.js 
```
Expected Output:  Server running on port 5000

Sensitive information such as AWS credentials are stored inside a `.env` file.

Open Postman and use the following base URL:
http://localhost:5000/api

Verify AWS Services:
Check the Amazon S3 bucket for uploaded files.
Check the verified email inbox for Amazon SES notifications.

# 7. Amazon S3

Amazon S3 (Simple Storage Service) is AWS's cloud object storage service used to securely store and manage files.

## Bucket Creation

1. Open **AWS Console**.
2. Search for **S3**.
3. Click **Create Bucket**.
4. Enter a **globally unique** bucket name.
5. Select the **ap-south-1 (Mumbai)** region.
6. Keep **Block Public Access** enabled.
7. Leave **Versioning** disabled.
8. Select **SSE-S3** as the default encryption.
9. Click **Create Bucket**.

## Project Implementation

In this project, Amazon S3 stores all investor KYC documents (PAN Card, Aadhaar Card, Address Proof, Cancelled Cheque) uploaded through the application.

The backend uses **AWS SDK v3** to:

* Upload files to S3
* Generate unique filenames using UUID
* Store S3 file URLs in MongoDB
* Generate secure pre-signed download URLs
* Delete files when required

## Upload Flow

Investor → Select Documents → React Frontend → Express API → Multer → Validation → Amazon S3 → Store URL in MongoDB

## APIs Used

| Method | Endpoint                  | Purpose                        |
| ------ | ------------------------- | ------------------------------ |
| POST   | `/api/upload`             | Upload a single file           |
| POST   | `/api/upload-documents`   | Upload multiple documents      |
| GET    | `/api/files`              | List uploaded files            |
| GET    | `/api/download/:filename` | Generate a secure download URL |
| DELETE | `/api/file/:filename`     | Delete a file                  |

## Key Features
* Upload single and multiple KYC documents
* Private S3 bucket with Block Public Access
* File Type & Size Validation
* Pre-signed Download URLs
* Modular S3 Service Architecture


# 8. Amazon SES

Amazon SES (Simple Email Service) is AWS's cloud email service used to send transactional and notification emails.

## Email Identity Verification

Before sending emails, verify the sender email address.

1. Open **AWS Console**.
2. Search for **Amazon SES**.
3. Go to **Identities** → **Create Identity**.
4. Select **Email Address**.
5. Enter the sender email.
6. Verify the email using the link received in the inbox.

**Note:** New AWS accounts operate in **Sandbox Mode**, so both sender and receiver email addresses must be verified.

## Project Implementation

In this project, Amazon SES is used to send automated email notifications to investors when:

* A service request is created
* A request is approved
* A request is rejected

The backend uses **AWS SDK v3** to:

* Configure the SES client
* Generate dynamic HTML email templates
* Send emails to investors
* Handle email delivery errors

## Email Sending Flow

Investor → Raise Request → Express Backend → Email Template → Amazon SES → Investor Email Inbox

## API Used

| Method | Endpoint                     | Purpose                         |
| ------ | ---------------------------- | ------------------------------- |
| POST   | `/api/request-created-email` | Send request confirmation email |

## Key Features

* Automated email notifications
* Dynamic HTML email templates
* Sender email verification
* Sandbox mode support for testing

# 9. Project Folder Structure

```text
AWS-Practice
│
├── README.md
│
├── server
│   ├── app.js
│   ├── .env
│   ├── config
│   │   ├── s3.js
│   │   └── ses.js
│   ├── controllers
│   │   ├── uploadController.js
│   │   └── emailController.js
│   ├── routes
│   │   ├── uploadRoutes.js
│   │   └── emailRoutes.js
│   ├── services
│   │   ├── s3Service.js
│   │   └── sesService.js
│   ├── templates
│   │   └── emailTemplates.js
│   └── utils
│       └── formatFile.js
```

## Folder Responsibilities

| Folder/File    | Purpose                                                        |
| -------------- | -------------------------------------------------------------- |
| `app.js`       | Entry point of the application and Express server setup        |
| `config/`      | AWS S3 and SES client configuration                            |
| `controllers/` | Handles request processing and business logic                  |
| `routes/`      | Defines API endpoints                                          |
| `services/`    | Contains AWS S3 and SES operations                             |
| `templates/`   | Reusable HTML email templates                                  |
| `utils/`       | Helper and formatting functions                                |
| `.env`         | Stores environment variables and AWS credentials               |
| `.gitignore`   |Excludes sensitive files like .env and node_modules from GitHub.|

## Request Flow

Client → Route → Controller → Service → AWS SDK → AWS Service (S3/SES)


# 10. API Documentation

This section describes all APIs implemented in the project.

## Base URL
```text
http://localhost:5000
```

## API Summary

| Method | Endpoint                     | Purpose                                    |
| ------ | ---------------------------- | ------------------------------------------ |
| POST   | `/api/upload`                | Upload a single file to Amazon S3          |
| POST   | `/api/upload-documents`      | Upload multiple KYC documents              |
| GET    | `/api/files`                 | Retrieve all uploaded files                |
| GET    | `/api/download/:filename`    | Generate a secure pre-signed download URL  |
| DELETE | `/api/file/:filename`        | Delete a file from Amazon S3               |
| POST   | `/api/request-created-email` | Send a confirmation email using Amazon SES |

## API 1 – Upload Single File

**Method:** `POST`
**Endpoint:** `/api/upload`
**Content Type:** `multipart/form-data`

| Parameter | Type |
| --------- | ---- |
| file      | File |

**Response**

```json
{
  "message": "File uploaded successfully",
  "fileUrl": "https://..."
}
```

## API 2 – Upload Multiple Documents

**Method:** `POST`
**Endpoint:** `/api/upload-documents`
**Content Type:** `multipart/form-data`

| Parameter       | Type |
| --------------- | ---- |
| requestId       | Text |
| panCard         | File |
| aadhaarCard     | File |
| cancelledCheque | File |
| addressProof    | File |

**Response**

```json
{
  "message": "Documents uploaded successfully",
  "requestId": "REQ-1001"
}
```

## API 3 – List Uploaded Files

**Method:** `GET`
**Endpoint:** `/api/files`

**Response**

```json
[
  {
    "key": "...",
    "downloadUrl": "https://..."
  }
]
```

## API 4 – Download File

**Method:** `GET`
**Endpoint:** `/api/download/:filename`

**Response**

```json
{
  "downloadUrl": "https://signed-url"
}
```

## API 5 – Delete File

**Method:** `DELETE`
**Endpoint:** `/api/file/:filename`

**Response**

```json
{
  "message": "File deleted successfully"
}
```

## API 6 – Send Email

**Method:** `POST`
**Endpoint:** `/api/request-created-email`
**Content Type:** `application/json`

**Request Body**

```json
{
  "to": "investor@gmail.com",
  "userName": "John Doe",
  "requestId": "REQ-1001",
  "requestType": "Bank Details Update"
}
```

**Response**

```json
{
  "message": "Email sent successfully"
}
```

## Common HTTP Status Codes

| Code | Description                    |
| ---- | ------------------------------ |
| 200  | Request Successful             |
| 400  | Bad Request / Validation Error |
| 404  | Resource Not Found             |
| 500  | Internal Server Error          |

## API Testing

The APIs can be tested using:
* Postman
* Thunder Client (VS Code)
* Insomnia

## API Flow

```text
Client → Route → Controller → Service → AWS SDK → Amazon S3 / Amazon SES → Response
```

# 11. Postman Testing Guide

Use **Postman** to verify all backend APIs before integrating them with the frontend.

## Base URL

```text
http://localhost:5000/api
```

## API Test Cases

| Test                      | Method | Endpoint                 | Expected Result                   |
| ------------------------- | ------ | ------------------------ | --------------------------------- |
| Upload Single File        | POST   | `/upload`                | File uploaded successfully        |
| Upload Multiple Documents | POST   | `/upload-documents`      | Documents uploaded successfully   |
| List Uploaded Files       | GET    | `/files`                 | Returns all uploaded files        |
| Download File             | GET    | `/download/:filename`    | Returns a pre-signed download URL |
| Delete File               | DELETE | `/file/:filename`        | File deleted successfully         |
| Send Email                | POST   | `/request-created-email` | HTML email sent successfully      |

## Request Details

### Upload Single File

* **Method:** `POST`
* **Endpoint:** `/upload`
* **Body Type:** `form-data`

| Key  | Type |
| ---- | ---- |
| file | File |

### Upload Multiple Documents

* **Method:** `POST`
* **Endpoint:** `/upload-documents`
* **Body Type:** `form-data`

| Key             | Type |
| --------------- | ---- |
| requestId       | Text |
| panCard         | File |
| aadhaarCard     | File |
| cancelledCheque | File |
| addressProof    | File |

### Send Email

* **Method:** `POST`
* **Endpoint:** `/request-created-email`
* **Body Type:** `raw (JSON)`

```json
{
  "to": "investor@gmail.com",
  "userName": "John Doe",
  "requestId": "REQ-1001",
  "requestType": "Bank Details Update"
}
```
