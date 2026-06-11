<?php
/**
 * Shared helper functions: security, sanitization, uploads, responses.
 */
require_once dirname(__DIR__) . '/config/database.php';

/* ---------------- Session bootstrap ---------------- */
function start_secure_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) return;
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'secure'   => $secure,
        'samesite' => 'Lax',
    ]);
    session_start();
}

/* ---------------- CSRF protection ---------------- */
function csrf_token(): string
{
    start_secure_session();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

function verify_csrf(?string $token): bool
{
    start_secure_session();
    return !empty($token) && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function require_csrf(): void
{
    $token = $_POST['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    if (!verify_csrf($token)) {
        json_response(['ok' => false, 'error' => 'Invalid CSRF token.'], 419);
    }
}

/* ---------------- Sanitization / escaping ---------------- */
function e(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function clean(?string $value): string
{
    return trim((string)$value);
}

/* ---------------- JSON helpers ---------------- */
function json_response($data, int $code = 200): void
{
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}

function read_json_body(): array
{
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

/* ---------------- Validation ---------------- */
function valid_email(string $email): bool
{
    return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
}

/* ---------------- Pagination helper ---------------- */
function paginate(int $total, int $page, int $perPage): array
{
    $pages = max(1, (int)ceil($total / $perPage));
    $page  = max(1, min($page, $pages));
    return ['page' => $page, 'pages' => $pages, 'total' => $total,
            'offset' => ($page - 1) * $perPage, 'perPage' => $perPage];
}

/* ---------------- File uploads ---------------- */
function handle_upload(array $file, string $type = 'image'): array
{
    if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['ok' => false, 'error' => 'No file uploaded.'];
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'error' => 'Upload failed (code ' . $file['error'] . ').'];
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($type === 'image') {
        $allowed = $GLOBALS['ALLOWED_IMAGE_EXT'];
        $maxSize = MAX_IMAGE_SIZE;
        $dir     = UPLOAD_PATH . '/images';
        $urlBase = UPLOAD_URL . '/images';
    } else {
        $allowed = $GLOBALS['ALLOWED_DOC_EXT'];
        $maxSize = MAX_DOC_SIZE;
        $dir     = UPLOAD_PATH . '/documents';
        $urlBase = UPLOAD_URL . '/documents';
    }

    if (!in_array($ext, $allowed, true)) {
        return ['ok' => false, 'error' => 'Invalid file type. Allowed: ' . implode(', ', $allowed)];
    }
    if ($file['size'] > $maxSize) {
        return ['ok' => false, 'error' => 'File too large. Max ' . round($maxSize / 1048576) . 'MB.'];
    }

    // Verify real MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    $okMimes = [
        'jpg' => ['image/jpeg'], 'jpeg' => ['image/jpeg'], 'png' => ['image/png'],
        'webp' => ['image/webp'], 'pdf' => ['application/pdf'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'],
    ];
    if (isset($okMimes[$ext]) && !in_array($mime, $okMimes[$ext], true)) {
        return ['ok' => false, 'error' => 'File content does not match its extension.'];
    }

    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $name = bin2hex(random_bytes(8)) . '_' . time() . '.' . $ext;
    $dest = $dir . '/' . $name;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        return ['ok' => false, 'error' => 'Could not save uploaded file.'];
    }
    return ['ok' => true, 'path' => $urlBase . '/' . $name, 'file' => $name];
}

function delete_upload(?string $url): void
{
    if (!$url) return;
    $pathPart = parse_url($url, PHP_URL_PATH) ?: $url;
    $pathPart = ltrim($pathPart, '/');
    $path = BASE_PATH . '/' . $pathPart;
    if (is_file($path) && strpos(realpath($path), realpath(UPLOAD_PATH)) === 0) {
        @unlink($path);
    }
}

function count_rows(string $table): int
{
    return (int) db()->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
}
