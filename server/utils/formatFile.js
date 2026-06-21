const formatFile = (file) => {

  const originalName = file.Key.substring(37);

  return {
    key: file.Key,
    originalName,
    size: `${(file.Size / 1024).toFixed(2)} KB`,
    uploadedOn: new Date(file.LastModified).toLocaleString(),

    fileUrl: `https://${process.env.AWS_BUCKET_NAME}.s3.${process.env.AWS_REGION}.amazonaws.com/${encodeURIComponent(file.Key)}`
  };
};

module.exports = formatFile;