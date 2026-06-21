const {
  SendEmailCommand,
} = require("@aws-sdk/client-ses");

const ses = require("../config/ses");

const sendEmail = async ({ to, subject, message }) => {

  const params = {
    Source: process.env.SES_FROM_EMAIL,

    Destination: {
      ToAddresses: [to],
    },

    Message: {
      Subject: {
        Data: subject,
      },

      Body: {
        Text: {
          Data: message,
        },
      },
    },
  };

  return await ses.send(
    new SendEmailCommand(params)
  );
};

module.exports = {
  sendEmail,
};