const requestCreatedTemplate = ({
  userName,
  requestId,
  requestType,
  status,
}) => {

  return `
Hello ${userName},

Your service request has been submitted successfully.

------------------------------------

Request ID      : ${requestId}

Request Type    : ${requestType}

Status          : ${status}

------------------------------------

Thank you for using Investor Service Request Management Portal.

Regards,
KFintech Support Team
`;
};

module.exports = {
  requestCreatedTemplate,
};