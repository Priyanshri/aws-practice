const express = require("express");
const cors = require("cors");
require("dotenv").config();

const app = express();

const uploadRoutes = require("./routes/uploadRoutes");

app.use(cors());
app.use(express.json());

app.use("/api", uploadRoutes);

app.get("/", (req, res) => {
  res.send("AWS Practice Server Running 🚀");
});

const PORT = process.env.PORT || 5000;

app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});