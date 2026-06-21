const express = require("express");

const {
  sendRequestCreatedEmail,
} = require("../controllers/emailController");

const router = express.Router();

router.post(
  "/request-created-email",
  sendRequestCreatedEmail
);

module.exports = router;