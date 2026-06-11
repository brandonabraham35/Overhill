<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/includes/functions.php';

class EmailService {

    public static function sendEmail($to, $subject, $body, $altBody = '') {
        $mail = new PHPMailer(true);
        $status = 'sent';
        $errorMessage = null;

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = SMTP_AUTH;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASS;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port       = SMTP_PORT;

            // Recipients
            $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $altBody ?: strip_tags($body);

            $mail->send();
        } catch (Exception $e) {
            $status = 'failed';
            $errorMessage = $mail->ErrorInfo;
        }

        // Log the email
        self::logEmail($to, $subject, $body, $status, $errorMessage);

        return $status === 'sent';
    }

    private static function logEmail($to, $subject, $body, $status, $errorMessage) {
        try {
            $pdo = db();
            $stmt = $pdo->prepare("INSERT INTO email_logs (recipient, subject, body, status, error_message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$to, $subject, $body, $status, $errorMessage]);
        } catch (Exception $e) {
            // Silently fail logging if database is down, or log to a file
            error_log("Failed to log email: " . $e->getMessage());
        }
    }

    private static function getTemplate($templateName, $data) {
        $templatePath = BASE_PATH . "/includes/email_templates/{$templateName}.html";
        if (!file_exists($templatePath)) {
            return "Template {$templateName} not found.";
        }
        $content = file_get_contents($templatePath);
        foreach ($data as $key => $value) {
            $content = str_replace("{{{$key}}}", $value, $content);
        }
        return $content;
    }

    public static function sendAdmissionConfirmation($parentEmail, $data) {
        $subject = "Admission Application Received - Overhill Junior School";
        $body = self::getTemplate('admission_confirmation', $data);
        return self::sendEmail($parentEmail, $subject, $body);
    }

    public static function sendAdmissionApproved($parentEmail, $data) {
        $subject = "Admission Application Approved - Overhill Junior School";
        $body = self::getTemplate('admission_approved', $data);
        return self::sendEmail($parentEmail, $subject, $body);
    }

    public static function sendAdmissionRejected($parentEmail, $data) {
        $subject = "Update on Admission Application - Overhill Junior School";
        $body = self::getTemplate('admission_rejected', $data);
        return self::sendEmail($parentEmail, $subject, $body);
    }

    public static function sendContactConfirmation($userEmail, $data) {
        $subject = "We received your message - Overhill Junior School";
        $body = self::getTemplate('contact_confirmation', $data);
        return self::sendEmail($userEmail, $subject, $body);
    }

    public static function sendAdminNotification($subject, $data) {
        $body = self::getTemplate('admin_notification', $data);
        return self::sendEmail(ADMIN_EMAIL, $subject, $body);
    }
}
