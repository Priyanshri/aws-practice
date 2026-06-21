const requestCreatedTemplate = ({
  userName,
  requestId,
  requestType,
  status,
}) => {

return `
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body style="margin:0;padding:30px;background:#f4f6f9;font-family:Arial,sans-serif;">

<table align="center" width="650" cellpadding="0" cellspacing="0"
style="background:white;border-radius:10px;overflow:hidden;border:1px solid #ddd;">

<tr>
<td style="background:#0d6efd;color:white;padding:20px;text-align:center;font-size:26px;font-weight:bold;">
Investor Service Request Management Portal
</td>
</tr>

<tr>
<td style="padding:35px;">

<h2 style="color:#0d6efd;">
Request Submitted Successfully
</h2>

<p>Hello <strong>${userName}</strong>,</p>

<p>
Your service request has been submitted successfully.
Our team will review it shortly.
</p>

<table width="100%" cellpadding="10"
style="border-collapse:collapse;margin-top:20px;">

<tr style="background:#f7f7f7;">
<td><strong>Request ID</strong></td>
<td>${requestId}</td>
</tr>

<tr>
<td><strong>Request Type</strong></td>
<td>${requestType}</td>
</tr>

<tr style="background:#f7f7f7;">
<td><strong>Status</strong></td>

<td>

<span style="
background:#ffc107;
padding:6px 12px;
border-radius:20px;
font-weight:bold;
">
${status}
</span>

</td>

</tr>

</table>

<p style="margin-top:35px;">
Thank you for using
<b>Investor Service Request Management Portal.</b>
</p>

<p>
Regards,<br>
<b>KFintech Support Team</b>
</p>

</td>
</tr>

<tr>

<td
style="
background:#0d6efd;
color:white;
text-align:center;
padding:15px;
font-size:14px;
">

© 2026 Investor Service Request Management Portal

</td>

</tr>

</table>

</body>
</html>

`;

};

module.exports = {
requestCreatedTemplate,
};