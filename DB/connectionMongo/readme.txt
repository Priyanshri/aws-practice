Use MongoDB Atlas in browser or mongodb compass on your laptop. And Postman should be installed. (I'm using mongodb version 1.49.9)

-------------------------------
STEP 1: Start the Server
-------------------------------
Open the project in VS Code and run:    npm run dev

Expected Output:
Server is running
MongoDB Connected

--------------------------------
STEP 2: Open Postman
--------------------------------
Tap on + icon and select http. Then select POST(to insert new data) / GET(to get or view the inserted data) / PUT(update the data) / DELETE(delete data).

-------------------------------------------------
STEP 3: Add Data
-------------------------------------------------
Create a POST request.
URL:    http://localhost:5000/api/users/users

Go to:
Body
→ raw
→ JSON

Paste:
{
    "name": "Rahul",
    "age": 22,
    "weight": 68
}

Click SEND.
A new document will be inserted into MongoDB.

-------------------------------------------------
STEP 4: View All Data
-------------------------------------------------

Send a GET request.
URL:    http://localhost:5000/api/users/users

Example Response:
[
  {
    "id": .....
    "name": "Rahul",
    "age": 22,
    "weight": 68
  }
]

-------------------------------------------------
STEP 5: UPDATE A USER
-------------------------------------------------

PUT Request
http://localhost:5000/api/users/users/<user-id>
Replace <user-id> with the MongoDB document _id.

Body:

{
    "name": "Rahul",
    "age": 22,
    "weight": 68
  }

-------------------------------------------------
STEP 6: DELETE A USER
-------------------------------------------------

DELETE Request
http://localhost:5000/api/users/users/<user-id>
Replace <user-id> with the MongoDB document _id.



CRUD SUMMARY
===========================

POST    → Create a new user
GET     → Read all users
PUT     → Update an existing user
DELETE  → Delete a user



---------------------------------------------------------------------------------------------------------
WHAT I HAVE DONE IN THIS FOLDER (STEP BY STEP WITH COMMANDS):
==========================================================================================================
---------------------------------
STEP 1: Create the Project Folder
--------------------------------
Command:

mkdir ConnectionMongoDB
cd ConnectionMongoDB

------------------------------------
STEP 2: Initialize Node.js Project
------------------------------------
Command:

npm init -y

Result:
• package.json file is created.

-------------------------------------
STEP 3: Install Required Packages
------------------------------------
Commands:

npm install express mongoose dotenv nodemon

---------------------------------------------
STEP 4: Create Project Structure
---------------------------------------------
Create the following files and folders:

ConnectionMongoDB/
│
├── models/
│   └── userModel.js
│
├── routes/
│   └── users.js
│
├── .env
├── db.js
├── index.js
├── package.json

-------------------------------------------
STEP 5: Configure Environment Variables
---------------------------------------------
Create .env and keep the sesitive info in it.

Add:

PORT=5000
MONGODB_URI=your_mongodb_atlas_connection_string

----------------------------------------------
STEP 6: Create Database Connection
----------------------------------------------
File:

db.js

Work Done:
• Imported mongoose.
• Imported dotenv.
• Loaded environment variables.
• Connected MongoDB Atlas using mongoose.connect().

------------------------------------------------
STEP 7: Create Express Server
------------------------------------------------
File:

index.js

Work Done:
• Imported Express.
• Created Express app.
• Added express.json() middleware.
• Connected MongoDB.
• Registered routes.
• Started server using app.listen().

-------------------------------------------------
STEP 8: Create User Model
------------------------------------------------
File:

models/userModel.js

Work Done:
• Created User Schema.
• Added fields:
- name
- age
- weight
• Exported the User model.

-------------------------------------------------
STEP 9: Create CRUD Routes
-------------------------------------------------
File:

routes/users.js

Created APIs:

POST    /api/users/users
GET     /api/users/users
PUT     /api/users/users/:id
DELETE  /api/users/users/:id

--------------------------------------------------
STEP 10: Start the Server
--------------------------------------------------
Command:    npm run dev

Expected Output:

Server is running
MongoDB Connected

-------------------------------------------------
STEP 11: Test POST API
-------------------------------------------------
Method:

POST

URL:

http://localhost:5000/api/users/users

Body:

{
"name":"Rahul",
"age":22,
"weight":68
}

Result:

• New document inserted into MongoDB.

---------------------------------------------------------
STEP 12: Test GET API
---------------------------------------------------------
Method:

GET

URL:

http://localhost:5000/api/users/users

Result:

• Displays all users stored in MongoDB.

--------------------------------------------------------
STEP 13: Test UPDATE API
--------------------------------------------------------
Method:

PUT

URL:

http://localhost:5000/api/users/users/<user-id>

Replace <user-id> with the MongoDB document _id.

Body:

{
"name":"Rahul Sharma",
"age":23,
"weight":70
}

Result:

• User information updated successfully.

--------------------------------------------------------
STEP 14: Test DELETE API
---------------------------------------------------------
Method:

DELETE

URL:

http://localhost:5000/api/users/users/<user-id>

Replace <user-id> with the MongoDB document _id.

Result:

• Selected user deleted successfully.

---------------------------------------------------------
STEP 15: Verify Data in MongoDB Atlas
---------------------------------------------------------
Steps:

1. Open MongoDB Atlas.
2. Open your Cluster.
3. Click Browse Collections.
4. Open your database.
5. Open the users collection.
6. Verify inserted, updated, or deleted documents.

---

TECHNOLOGIES USED

• Node.js
• Express.js
• MongoDB Atlas
• Mongoose
• dotenv
• Postman
• Nodemon

---

COMMANDS USED:

mkdir ConnectionMongoDB
cd ConnectionMongoDB
npm init -y
npm install express mongoose nodemon dotenv
npm run dev