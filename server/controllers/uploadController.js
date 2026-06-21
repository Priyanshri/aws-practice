const { v4: uuidv4 } = require("uuid");

const {
  uploadToS3,
  getFiles,
  deleteFromS3,
  generateDownloadUrl,
} = require("../services/s3Service");

const formatFile = require("../utils/formatFile");

// Upload File
const uploadFile = async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({
        message: "No file uploaded",
      });
    }

    const fileName = `${uuidv4()}-${req.file.originalname}`;

    const params = {
      Bucket: process.env.AWS_BUCKET_NAME,
      Key: fileName,
      Body: req.file.buffer,
      ContentType: req.file.mimetype,
    };

    await uploadToS3(params);

    res.status(200).json({
      message: "File uploaded successfully",
      fileUrl: `https://${process.env.AWS_BUCKET_NAME}.s3.${process.env.AWS_REGION}.amazonaws.com/${encodeURIComponent(fileName)}`,
    });

  } catch (error) {

    console.error(error);

    res.status(500).json({
      message: "Upload failed",
      error: error.message,
    });

  }
};

// List Files
const listFiles = async (req, res) => {
  try {

    const data = await getFiles();

    const files = data.Contents
      ? data.Contents.map(formatFile)
      : [];

    res.status(200).json(files);

  } catch (error) {

    console.error(error);

    res.status(500).json({
      message: "Failed to fetch files",
      error: error.message,
    });

  }
};

// Delete File
const deleteFile = async (req, res) => {
  try {

    const fileName = req.params.filename;

    await deleteFromS3(fileName);

    res.status(200).json({
      message: "File deleted successfully",
    });

  } catch (error) {

    console.error(error);

    res.status(500).json({
      message: "Delete failed",
      error: error.message,
    });

  }
};

// Download File (Generate Pre-Signed URL)
const downloadFile = async (req, res) => {
  try {

    const fileName = req.params.filename;

    const downloadUrl = await generateDownloadUrl(fileName);

    res.status(200).json({
      message: "Download URL generated successfully",
      downloadUrl,
      expiresIn: "5 minutes",
    });

  } catch (error) {

    console.error(error);

    res.status(500).json({
      message: "Failed to generate download URL",
      error: error.message,
    });

  }
};

module.exports = {
  uploadFile,
  listFiles,
  deleteFile,
  downloadFile,
};