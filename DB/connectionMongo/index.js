const express = require("express");
const app = express();

//body parser middleware
app.use(express.json());

// connect to database
const connectDB = require("./db");
connectDB();

const users = require("./routes/users");
app.use("/api/users", users);

const dotenv = require("dotenv");
//load env configuration
dotenv.config();

const PORT = process.env.PORT;

app.get('/', (req, res) => {
    console.log("I am inside home page route handler");
    res.send("Hello I'm Pri");
});

app.listen(PORT, () => {
    console.log(`Server is running `);
});