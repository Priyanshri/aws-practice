const {
  PutObjectCommand,
  ListObjectsV2Command,
  DeleteObjectCommand,
  GetObjectCommand,
} = require("@aws-sdk/client-s3");

const { getSignedUrl } = require("@aws-sdk/s3-request-presigner");

const s3 = require("../config/s3");

// Upload File
const uploadToS3 = async (params) => {
  return await s3.send(new PutObjectCommand(params));
};

// Get All Files
const getFiles = async () => {
  return await s3.send(
    new ListObjectsV2Command({
      Bucket: process.env.AWS_BUCKET_NAME,
    })
  );
};

// Delete File
const deleteFromS3 = async (fileName) => {
  return await s3.send(
    new DeleteObjectCommand({
      Bucket: process.env.AWS_BUCKET_NAME,
      Key: fileName,
    })
  );
};

// Generate Pre-Signed Download URL
const generateDownloadUrl = async (fileName) => {
  const command = new GetObjectCommand({
    Bucket: process.env.AWS_BUCKET_NAME,
    Key: fileName,
  });

  return await getSignedUrl(s3, command, {
    expiresIn: 300, // 5 minutes
  });
};

module.exports = {
  uploadToS3,
  getFiles,
  deleteFromS3,
  generateDownloadUrl,
};