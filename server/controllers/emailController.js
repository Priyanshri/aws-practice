const { sendEmail } = require("../services/sesService");

const {
  requestCreatedTemplate,
} = require("../templates/emailTemplates");

const sendRequestCreatedEmail = async (req, res) => {

  try {

    const {
      to,
      userName,
      requestId,
      requestType,
    } = req.body;

    const message = requestCreatedTemplate({
      userName,
      requestId,
      requestType,
      status: "Pending",
    });

    await sendEmail({
      to,
      subject: "Investor Service Request Submitted",
      message,
    });

    res.status(200).json({
      message: "Email sent successfully",
    });

  } catch (error) {

    console.error(error);

    res.status(500).json({
      message: "Failed to send email",
      error: error.message,
    });

  }

};

module.exports = {
  sendRequestCreatedEmail,
};