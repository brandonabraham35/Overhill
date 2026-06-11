<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_login();
$pdo = db();

$sections = [
    'general' => [
        'title' => 'General Information',
        'keys' => [
            'school_name' => 'School Name',
            'motto' => 'School Motto',
            'office_hours' => 'Office Hours',
            'address' => 'Physical Address'
        ]
    ],
    'contact' => [
        'title' => 'Contact & Social',
        'keys' => [
            'phone' => 'Phone Number',
            'email' => 'Email Address',
            'facebook_url' => 'Facebook URL',
            'twitter_url' => 'Twitter URL',
            'instagram_url' => 'Instagram URL',
            'youtube_url' => 'YouTube URL'
        ]
    ],
    'stats' => [
        'title' => 'School Statistics',
        'keys' => [
            'years_count' => 'Years of Excellence',
            'pupils_count' => 'Pupils Count',
            'teachers_count' => 'Teachers Count',
            'clubs_count' => 'Clubs Count'
        ]
    ],
    'homepage' => [
        'title' => 'Homepage Content',
        'keys' => [
            'welcome_message' => 'Welcome Message',
            'why_overhill_intro' => 'Why Overhill Intro',
            'news_events_intro' => 'News & Events Intro',
            'programmes_intro' => 'Special Programmes Intro'
        ]
    ],
    'about' => [
        'title' => 'About Us & Messages',
        'keys' => [
            'history' => 'School History',
            'vision' => 'Vision',
            'mission' => 'Mission',
            'core_values' => 'Core Values',
            'proprietor_name' => 'Proprietor Name',
            'proprietor_message' => 'Proprietor Message',
            'chairman_name' => 'Chairman Name',
            'chairman_message' => 'Chairman Message',
            'headteacher_name' => 'Headteacher Name',
            'headteacher_message' => 'Headteacher Message'
        ]
    ],
    'facilities' => [
        'title' => 'Facilities Intro',
        'keys' => [
            'facilities_intro' => 'Facilities General Intro',
            'facility_nursery_content' => 'Nursery Details',
            'facility_primary_content' => 'Primary Details',
            'facility_library_content' => 'Library Details',
            'facility_computer_lab_content' => 'Computer Lab Details',
            'facility_science_lab_content' => 'Science Lab Details',
            'facility_hall_content' => 'Hall Details',
            'facility_sick_bay_content' => 'Sick Bay Details',
            'facility_kitchen_content' => 'Kitchen Details',
            'facility_transport_content' => 'Transport Details',
            'facility_sports_content' => 'Sports Details',
            'facility_washrooms_content' => 'Washrooms Details'
        ]
    ],
    'programmes' => [
        'title' => 'Programmes Details',
        'keys' => [
            'programme_computer_content' => 'Computer Lessons',
            'programme_reading_content' => 'Reading Programme',
            'programme_handwriting_content' => 'Handwriting',
            'programme_games_content' => 'Games & Sports',
            'programme_vocational_content' => 'Vocational Skills',
            'programme_daycare_content' => 'Day Care',
            'programme_cocurricular_content' => 'Co-Curricular'
        ]
    ],
    'anthem_prayer' => [
        'title' => 'Anthem & Prayer',
        'keys' => [
            'school_anthem' => 'School Anthem (Full)',
            'anthem_verse_1' => 'Anthem Verse 1',
            'anthem_verse_2' => 'Anthem Verse 2',
            'anthem_chorus' => 'Anthem Chorus',
            'school_prayer' => 'School Prayer (Full)',
            'prayer_text' => 'Prayer Content'
        ]
    ],
    'policies' => [
        'title' => 'Policies & Guides',
        'keys' => [
            'school_rules' => 'School Rules',
            'parent_guidelines' => 'Parent Guidelines',
            'communication_policy' => 'Communication Policy',
            'parents_intro' => 'Parents Section Intro',
            'students_intro' => 'Students Section Intro',
            'student_leadership' => 'Student Leadership Intro',
            'student_welfare' => 'Student Welfare Details',
            'student_articles' => 'Student Articles Intro'
        ]
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) { header('Location: settings.php'); exit; }

    if (($_POST['_action']??'')==='settings') {
        foreach ($sections as $section) {
            foreach ($section['keys'] as $k => $lbl) {
                if (isset($_POST[$k])) {
                    $v = clean($_POST[$k]);
                    $pdo->prepare('INSERT INTO site_settings (setting_key,setting_value) VALUES (?,?) ON DUPLICATE KEY UPDATE setting_value=?')->execute([$k,$v,$v]);
                }
            }
        }
        $_SESSION['flash']='Settings saved.';
    } elseif (($_POST['_action']??'')==='password') {
        $cur=$_POST['current']??''; $new=$_POST['new']??''; $conf=$_POST['confirm']??'';
        $adm=current_admin();
        $row=$pdo->prepare('SELECT * FROM admins WHERE id=?'); $row->execute([$adm['id']]); $row=$row->fetch();
        if (!password_verify($cur,$row['password_hash'])) $_SESSION['flash_err']='Current password incorrect.';
        elseif (strlen($new)<8) $_SESSION['flash_err']='New password too short (min 8).';
        elseif ($new!==$conf) $_SESSION['flash_err']='Passwords do not match.';
        else { $pdo->prepare('UPDATE admins SET password_hash=? WHERE id=?')->execute([password_hash($new,PASSWORD_DEFAULT),$adm['id']]); $_SESSION['flash']='Password updated.'; }
    }
    header('Location: settings.php'); exit;
}

$settings=[]; foreach($pdo->query('SELECT setting_key,setting_value FROM site_settings') as $r){ $settings[$r['setting_key']]=$r['setting_value']; }
$flash=$_SESSION['flash']??''; $flashErr=$_SESSION['flash_err']??''; unset($_SESSION['flash'],$_SESSION['flash_err']);
$activeTab = $_GET['tab'] ?? 'general';

$pageTitle='Site Management'; include __DIR__.'/includes/header.php';
?>

<style>
    .settings-layout { display: flex; gap: 20px; }
    .settings-nav { width: 250px; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    .settings-nav a { display: block; padding: 10px 15px; text-decoration: none; color: #555; border-radius: 5px; margin-bottom: 5px; }
    .settings-nav a:hover { background: #f0f4f8; }
    .settings-nav a.active { background: #004a99; color: #fff; }
    .settings-content { flex: 1; }
    .settings-form textarea { width: 100%; min-height: 120px; font-family: inherit; }
</style>

<?php if($flash):?><div class="flash ok"><?=e($flash)?></div><?php endif;?>
<?php if($flashErr):?><div class="flash err"><?=e($flashErr)?></div><?php endif;?>

<div class="settings-layout">
    <aside class="settings-nav">
        <?php foreach($sections as $id => $sec): ?>
            <a href="?tab=<?=$id?>" class="<?=$activeTab===$id?'active':''?>"><?=$sec['title']?></a>
        <?php endforeach; ?>
        <hr>
        <a href="?tab=password" class="<?=$activeTab==='password'?'active':''?>">Security Settings</a>
    </aside>

    <div class="settings-content">
        <?php if($activeTab === 'password'): ?>
            <form class="resource-form" method="post">
                <?=csrf_field()?><input type="hidden" name="_action" value="password">
                <h3>Change Admin Password</h3>
                <div class="form-field"><label>Current Password</label><input type="password" name="current" required></div>
                <div class="form-field"><label>New Password</label><input type="password" name="new" required></div>
                <div class="form-field"><label>Confirm New Password</label><input type="password" name="confirm" required></div>
                <button class="btn-primary">Update Password</button>
            </form>
        <?php elseif(isset($sections[$activeTab])): $sec = $sections[$activeTab]; ?>
            <form class="resource-form settings-form" method="post">
                <?=csrf_field()?><input type="hidden" name="_action" value="settings">
                <h3><?=$sec['title']?></h3>
                <?php foreach($sec['keys'] as $k => $lbl): ?>
                    <div class="form-field">
                        <label><?=e($lbl)?></label>
                        <?php if(strpos($k, 'message')!==false || strpos($k, 'content')!==false || strpos($k, 'history')!==false || strpos($k, 'vision')!==false || strpos($k, 'mission')!==false || strpos($k, 'values')!==false || strpos($k, 'rules')!==false || strpos($k, 'guidelines')!==false || strpos($k, 'policy')!==false || strpos($k, 'anthem')!==false || strpos($k, 'prayer')!==false || strpos($k, 'intro')!==false): ?>
                            <textarea name="<?=$k?>"><?=e($settings[$k]??'')?></textarea>
                        <?php else: ?>
                            <input type="text" name="<?=$k?>" value="<?=e($settings[$k]??'')?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <button class="btn-primary">Save <?=$sec['title']?></button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__.'/includes/footer.php'; ?>
