<?php
/**
 * Admissions Form Processor
 * Handles form submissions, validation, database storage, and email notifications
 */

header('Content-Type: application/json');

// Prevent direct access, only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Include database configuration
    require_once __DIR__ . '/admin/config.php';
    require_once __DIR__ . '/brand.php';
    
    // Validate all required fields
    $required_fields = ['child_name', 'child_gender', 'parent_name', 'parent_nin',
                       'relationship', 'parent_phone', 'parent_email', 'address', 'privacy_consent'];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Missing required field: " . ucfirst(str_replace('_', ' ', $field)));
        }
    }
    
    // Validate email format
    if (!filter_var($_POST['parent_email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email address");
    }
    
    // Validate phone format (basic)
    if (!preg_match('/^[\d\+\-\s\(\)]{7,20}$/', $_POST['parent_phone'])) {
        throw new Exception("Invalid phone number format");
    }
    
    // Validate privacy consent checkbox
    if ($_POST['privacy_consent'] !== 'on' && $_POST['privacy_consent'] !== '1') {
        throw new Exception("You must agree to the privacy policy");
    }
    
    // Handle file upload (birth certificate)
    $birth_certificate_file = null;
    if (!empty($_FILES['birth_certificate']['name'])) {
        $upload_dir = __DIR__ . '/uploads/admissions/';
        
        // Create directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file = $_FILES['birth_certificate'];
        $allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        // Validate file
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload error: " . $file['error']);
        }
        
        if ($file['size'] > $max_size) {
            throw new Exception("File size exceeds 5MB limit");
        }
        
        if (!in_array($file['type'], $allowed_types)) {
            throw new Exception("File type not allowed. Use PDF, JPG, or PNG");
        }
        
        // Generate unique filename
        $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_name = 'admission_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $file_ext;
        $file_path = $upload_dir . $file_name;
        
        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            throw new Exception("Failed to upload file");
        }
        
        $birth_certificate_file = 'uploads/admissions/' . $file_name;
    }
    
    // Sanitize inputs
    $child_name = $conn->real_escape_string(trim($_POST['child_name']));
    $child_gender = $conn->real_escape_string(trim($_POST['child_gender']));
    $parent_name = $conn->real_escape_string(trim($_POST['parent_name']));
    $parent_nin = $conn->real_escape_string(trim($_POST['parent_nin']));
    $relationship = $conn->real_escape_string(trim($_POST['relationship']));
    $parent_phone = $conn->real_escape_string(trim($_POST['parent_phone']));
    $parent_email = $conn->real_escape_string(trim($_POST['parent_email']));
    $address = $conn->real_escape_string(trim($_POST['address']));
    $special_needs = !empty($_POST['special_needs']) ? $conn->real_escape_string(trim($_POST['special_needs'])) : null;
    
    // Prepare SQL insert statement
    $sql = "INSERT INTO admissions_submissions 
            (child_name, child_gender, birth_certificate_file, parent_name, parent_nin, relationship, 
             parent_phone, parent_email, residential_address, special_needs, privacy_consent) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Database prepare error: " . $conn->error);
    }
    
    $stmt->bind_param(
        "ssssssssss",
        $child_name,
        $child_gender,
        $birth_certificate_file,
        $parent_name,
        $parent_nin,
        $relationship,
        $parent_phone,
        $parent_email,
        $address,
        $special_needs
    );
    
    if (!$stmt->execute()) {
        throw new Exception("Database error: " . $stmt->error);
    }
    
    $submission_id = $stmt->insert_id;
    $stmt->close();
    
    // Send confirmation email to parent
    $subject = SCHOOL_NAME . " - Admission Application Received";
    $message = "
    <html>
    <body style='font-family: Arial, sans-serif; color: #333;'>
        <div style='max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;'>
            <div style='background: linear-gradient(135deg, #1e3a8a, #2563eb); color: white; padding: 30px; text-align: center;'>
                <h1 style='margin: 0;'>" . SCHOOL_NAME . "</h1>
                <p style='margin: 10px 0 0 0;'>" . SCHOOL_MOTTO . "</p>
            </div>
            
            <div style='padding: 30px;'>
                <h2>Admission Application Received</h2>
                <p>Dear " . htmlspecialchars($parent_name) . ",</p>
                
                <p>Thank you for submitting the admission application for <strong>" . htmlspecialchars($child_name) . "</strong>. We have received your submission and will review it carefully.</p>
                
                <div style='background-color: #f0f9ff; padding: 15px; border-left: 4px solid #2563eb; margin: 20px 0;'>
                    <p style='margin: 0;'><strong>Application Reference:</strong> #" . str_pad($submission_id, 6, '0', STR_PAD_LEFT) . "</p>
                    <p style='margin: 5px 0 0 0;'><strong>Submitted on:</strong> " . date('F j, Y \a\t g:i A') . "</p>
                </div>
                
                <h3>Application Details:</h3>
                <ul>
                    <li><strong>Child's Name:</strong> " . htmlspecialchars($child_name) . "</li>
                    <li><strong>Gender:</strong> " . ucfirst($child_gender) . "</li>
                    <li><strong>Parent/Guardian:</strong> " . htmlspecialchars($parent_name) . "</li>
                    <li><strong>Contact:</strong> " . htmlspecialchars($parent_phone) . " | " . htmlspecialchars($parent_email) . "</li>
                </ul>
                
                <p>Our admissions team will review your application and contact you shortly with updates. If you have any questions, please don't hesitate to reach out.</p>
                
                <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666;'>
                    <p style='margin: 0;'><strong>" . SCHOOL_NAME . "</strong></p>
                    <p style='margin: 5px 0;'>P.O. BOX 124666, Kampala, Uganda</p>
                    <p style='margin: 5px 0;'>Phone: +256 774-744-394 | +256 752-482-066</p>
                    <p style='margin: 5px 0;'>Email: mugalureagan18@gmail.com</p>
                </div>
            </div>
        </div>
    </body>
    </html>";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: " . SCHOOL_NAME . " <admissions@calystchristianschool.com>" . "\r\n";

    // Helper: send email via PHPMailer SMTP if available, otherwise fallback to mail()
    function send_email(string $to, string $subject, string $htmlBody, string $altBody = ''): bool {
        // Try to use PHPMailer when installed via Composer
        $autoload = __DIR__ . '/vendor/autoload.php';
        if (file_exists($autoload)) {
            require_once $autoload;
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASS;
                if (!empty(SMTP_SECURE)) {
                    $mail->SMTPSecure = SMTP_SECURE;
                }
                $mail->Port = SMTP_PORT;
                $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
                $mail->addAddress($to);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $htmlBody;
                if ($altBody !== '') {
                    $mail->AltBody = $altBody;
                }
                $mail->send();
                return true;
            } catch (Exception $e) {
                error_log('PHPMailer error: ' . $mail->ErrorInfo);
                // fall through to native mail()
            }
        }

        // Native mail fallback (suppress warnings to prevent output before JSON)
        $fallbackHeaders = "MIME-Version: 1.0" . "\r\n";
        $fallbackHeaders .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $fallbackHeaders .= "From: " . SMTP_FROM_NAME . " <" . SMTP_FROM_EMAIL . ">" . "\r\n";
        return (bool) @mail($to, $subject, $htmlBody, $fallbackHeaders);
    }

    // Send email to parent
    send_email($parent_email, $subject, $message);

    // Send notification email to school
    $school_email = $school['email'] ?? "mugalureagan18@gmail.com";
    $admin_subject = "New Admission Application - " . htmlspecialchars($child_name);
    $admin_message = "
    <html>
    <body style='font-family: Arial, sans-serif;'>
        <h2>New Admission Application</h2>
        <p><strong>Application Reference:</strong> #" . str_pad($submission_id, 6, '0', STR_PAD_LEFT) . "</p>
        <h3>Child Information:</h3>
        <ul>
            <li><strong>Name:</strong> " . htmlspecialchars($child_name) . "</li>
            <li><strong>Gender:</strong> " . ucfirst($child_gender) . "</li>
        </ul>
        <h3>Parent/Guardian Information:</h3>
        <ul>
            <li><strong>Name:</strong> " . htmlspecialchars($parent_name) . "</li>
            <li><strong>Relationship:</strong> " . ucfirst($relationship) . "</li>
            <li><strong>NIN:</strong> " . htmlspecialchars($parent_nin) . "</li>
            <li><strong>Phone:</strong> " . htmlspecialchars($parent_phone) . "</li>
            <li><strong>Email:</strong> " . htmlspecialchars($parent_email) . "</li>
            <li><strong>Address:</strong> " . htmlspecialchars($address) . "</li>
        </ul>
        " . (!empty($special_needs) ? "<h3>Special Needs:</h3><p>" . nl2br(htmlspecialchars($special_needs)) . "</p>" : "") . "
        <p><a href='./admin/contact-submissions.php'>View in admin panel</a></p>
    </body>
    </html>";
    
    send_email($school_email, $admin_subject, $admin_message);
    
    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Your application has been submitted successfully!',
        'reference' => str_pad($submission_id, 6, '0', STR_PAD_LEFT)
    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
