import sys
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

def send_email(sender_email, receiver_email, subject, message, smtp_server, smtp_port, smtp_username, smtp_password):
    # Create a multipart message
    msg = MIMEMultipart()
    msg["From"] = sender_email
    msg["To"] = receiver_email
    msg["Subject"] = subject

    # Add body to the email
    msg.attach(MIMEText(message, "plain"))

    try:
        # Create a secure SSL/TLS connection to the SMTP server
        with smtplib.SMTP(smtp_server, smtp_port) as server:
            server.starttls()
            server.login(smtp_username, smtp_password)
            server.sendmail(sender_email, receiver_email, msg.as_string())
        return True
    except Exception as e:
        print("Error sending email:", str(e))
        return False

# Get the recipients as a command-line argument
recipients = sys.argv[1].split(',')

# Example usage
sender_email = "your_email@gmail.com"
subject = "Book Renewal Reminder - Vel Tech Multi Tech Dr.Rangarajan Dr.Sakunthala Engineering College"
message = '''Dear Patrons,\n
We hope this email finds you well. This is a friendly reminder that the due date for your borrowed book from Vel Tech Multi Tech Dr.Rangarajan Dr.Sakunthala Engineering College's library is approaching. If you wish to extend the borrowing period, we kindly ask you to renew the book as soon as possible.\n
To renew the book, please visit our library's website or contact the library staff directly. Renewing the book will allow you to continue enjoying it without any late fees or penalties.\n

Should you have any questions or need further assistance, please don't hesitate to reach out to us. Thank you for your cooperation.\n

Best regards,\n
Vel Tech Multi Tech Dr.Rangarajan Dr.Sakunthala Engineering College Library
'''
smtp_server = "smtp.gmail.com"
smtp_port = 587
smtp_username = "carstrongr04@gmail.com"
smtp_password = "lvrsepfdqamtswiq"



# Send email to each recipient individually
for recipient_email in recipients:
    # Send email
    if send_email(sender_email, recipient_email, subject, message, smtp_server, smtp_port, smtp_username, smtp_password):
        print("Email sent successfully to:", recipient_email)
    else:
        print("Failed to send email to:", recipient_email)
