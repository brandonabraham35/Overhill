<?php
/**
 * Authentication & session management for the admin area.
 */
require_once __DIR__ . '/functions.php';

function current_admin(): ?array
{
    start_secure_session();
    return $_SESSION['admin'] ?? null;
}

function is_logged_in(): bool
{
    start_secure_session();
    if (empty($_SESSION['admin'])) return false;

    // Idle timeout
    $last = $_SESSION['last_activity'] ?? 0;
    if (time() - $last > SESSION_TIMEOUT) {
        logout_admin();
        return false;
    }
    $_SESSION['last_activity'] = time();
    return true;
}

function login_admin(string $username, string $password): bool
{
    start_secure_session();
    $stmt = db()->prepare('SELECT * FROM admins WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin'] = [
            'id'       => (int)$admin['id'],
            'username' => $admin['username'],
            'name'     => $admin['full_name'],
        ];
        $_SESSION['last_activity'] = time();
        db()->prepare('UPDATE admins SET last_login = NOW() WHERE id = ?')->execute([$admin['id']]);
        return true;
    }
    return false;
}

function logout_admin(): void
{
    start_secure_session();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function admin_exists(): bool
{
    return count_rows('admins') > 0;
}
