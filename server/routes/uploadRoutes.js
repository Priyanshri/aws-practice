const express = require("express");
const multer = require("multer");

const {
  uploadFile,
  uploadMultipleDocuments,
  listFiles,
  deleteFile,
  downloadFile,
} = require("../controllers/uploadController");

const router = express.Router();

const storage = multer.memoryStorage();

// Allowed file types
const allowedTypes = [
    "application/pdf",
    "image/jpeg",
    "image/jpg",
    "image/png",
];

// Multer configuration
const upload = multer({
    storage,

    limits: {
        fileSize: 5 * 1024 * 1024, // 5 MB
    },

    fileFilter: (req, file, cb) => {

        console.log("Original Name:", file.originalname);
        console.log("MIME Type:", file.mimetype);

        if (!allowedTypes.includes(file.mimetype)) {
            return cb(
                new Error("Only PDF, JPG, JPEG and PNG files are allowed.")
            );
        }

        cb(null, true);

    },

});

// Upload
router.post(
    "/upload",
    upload.single("file"),
    uploadFile
);
router.post(
  "/upload-documents",
  upload.fields([
    { name: "panCard", maxCount: 1 },
    { name: "aadhaarCard", maxCount: 1 },
    { name: "cancelledCheque", maxCount: 1 },
    { name: "addressProof", maxCount: 1 },
  ]),
  uploadMultipleDocuments
);

// List
router.get("/files", listFiles);

// Delete
router.delete("/file/:filename", deleteFile);

// Download
router.get("/download/:filename", downloadFile);

module.exports = router;