# MONGODB ATLAS SETUP & DATABASE CREATION (STEP BY STEP)

REQUIREMENTS

• MongoDB Atlas Account
• MongoDB Compass (Optional)
• VS Code
• Node.js Installed

=====================================================

STEP 1: Create a MongoDB Atlas Account

1. Open your browser.
2. Visit:

https://www.mongodb.com/cloud/atlas

3. Click **Try Free** or **Sign Up**.

4. Create an account using:
   • Google
   • GitHub
   • Email

5. Verify your email and log in.

---

STEP 2: Create an Organization (Optional)

If prompted:

• Enter an organization name.
• Click Continue.

---

STEP 3: Create a New Project

1. Click **New Project**.
2. Enter a project name.

Example:

ConnectionMongoDB

3. Click **Next**.
4. Click **Create Project**.

---

STEP 4: Create a Cluster

1. Click **Build a Database**.

2. Select:

✔ Free Tier (M0)

3. Choose:

• Cloud Provider (AWS)
• Region (Nearest to your location)

4. Give the cluster a name.

Example:

Cluster0

5. Click **Create Deployment**.

Wait a few minutes until the cluster is created.

---

STEP 5: Create a Database User

1. Enter a username.

Example:

Priya

2. Enter a strong password.

Example:

---

3. Select:

Database User

4. Click:

Create User

**Save the username and password.** You'll need them in the connection string.

---

STEP 6: Configure Network Access

1. Click:

Network Access

2. Click:

Add IP Address

3. Choose:

Allow Access from Anywhere

IP Address:

0.0.0.0/0

4. Click:

Confirm

(For development only. In production, allow only trusted IPs.)

---

STEP 7: Get the Connection String

1. Go to:

Database

2. Click:

Connect

3. Select:

Drivers

4. Select:

Node.js

5. Copy the connection string.

Example:

mongodb+srv://<username>:<password>@cluster0.xxxxx.mongodb.net/?retryWrites=true&w=majority

---

STEP 8: Replace Username & Password

Replace:

<username>

with your MongoDB username.

Replace:

<password>

with your MongoDB password.

Example:

mongodb+srv://Priya:MyPassword123@cluster0.xxxxx.mongodb.net/?retryWrites=true&w=majority

---

STEP 9: Specify the Database Name

Append the database name after ".net/".

Example:

mongodb+srv://Priya:MyPassword123@cluster0.xxxxx.mongodb.net/ConnectionMongoDB?retryWrites=true&w=majority

Database Name:

ConnectionMongoDB

**If the database doesn't exist, MongoDB Atlas will automatically create it when you insert the first document.**

---

STEP 10: Create the .env File

Create a file named:

.env

Add:

PORT=5000

MONGODB_URI=mongodb+srv://Priya:YourPassword@cluster0.xxxxx.mongodb.net/ConnectionMongoDB?retryWrites=true&w=majority

Save the file.

---

STEP 11: Connect from Node.js

Run the project:

npm run dev

OR

node index.js

Expected Output:

Server is running
MongoDB Connected

---

STEP 12: Create the Database Automatically

Send your first POST request from Postman.

Example:

POST

http://localhost:5000/api/users/users

Body:

{
"name":"Rahul",
"age":22,
"weight":68
}

Click:

Send

MongoDB Atlas automatically creates:

• Database → ConnectionMongoDB
• Collection → users
• Document → Rahul's data

---

STEP 13: View the Database

1. Open MongoDB Atlas.
2. Click:

Database

3. Click:

Browse Collections

You'll see:

ConnectionMongoDB

Click it.

Inside you'll see:

users

Click the collection.

Your inserted documents will be displayed.

---

STEP 14: Connect Using MongoDB Compass (Optional)

1. Open MongoDB Compass.
2. Click:

New Connection

3. Paste the same MongoDB Atlas connection string.

Example:

mongodb+srv://Priya:YourPassword@cluster0.xxxxx.mongodb.net/

4. Click:

Connect

5. Expand the database list.

You can now view and manage your databases and collections graphically.

---

SUMMARY

✔ Created a MongoDB Atlas account.
✔ Created a project.
✔ Created a free cluster.
✔ Created a database user.
✔ Allowed network access.
✔ Copied the Node.js connection string.
✔ Added the database name to the connection string.
✔ Stored the connection string in the .env file.
✔ Connected the Node.js application to MongoDB Atlas.
✔ Inserted the first document.
✔ Automatically created the database and collection.
✔ Verified the data using MongoDB Atlas and MongoDB Compass.
