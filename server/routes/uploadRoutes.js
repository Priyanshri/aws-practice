const express = require("express");
const multer = require("multer");

const {
  uploadFile,
  listFiles,
  deleteFile,
  downloadFile,
} = require("../controllers/uploadController");

const router = express.Router();

const storage = multer.memoryStorage();

const upload = multer({
  storage,
});

// Upload File
router.post(
  "/upload",
  upload.single("file"),
  uploadFile
);

// List Files
router.get("/files", listFiles);

// Delete File
router.delete("/file/:filename", deleteFile);

// Download File (Pre-Signed URL)
router.get("/download/:filename", downloadFile);

module.exports = router;