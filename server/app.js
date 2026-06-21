const express = require("express");
const cors = require("cors");
require("dotenv").config();

const app = express();

const uploadRoutes = require("./routes/uploadRoutes");
const emailRoutes = require("./routes/emailRoutes");

app.use(cors());
app.use(express.json());

app.use("/api", uploadRoutes);
app.use("/api", emailRoutes);

app.get("/", (req, res) => {
  res.send("AWS Practice Server Running 🚀");
});

const PORT = process.env.PORT || 5000;

// Multer Error Handler
app.use((err, req, res, next) => {

  if (err instanceof Error) {

    return res.status(400).json({
      success: false,
      message: err.message,
    });

  }

  next();

});

app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});