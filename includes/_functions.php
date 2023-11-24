<?php


// ---------------------
// SECURITY FUNCTIONS
// ---------------------


/**
 * Generate a valid token in $_SESSION
 *
 * @return void
 */
function generateToken()
{
    if (!isset($_SESSION['token']) || time() > $_SESSION['tokenExpire']) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 20 * 60;
    }
}

/**
 * Check for CSRF with referer and token
 * Redirect to the given page in case of error
 *
 * @param string $url The page to redirect
 * @return void
 */
function checkCSRF(string $url): void
{
    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'http://.localhost/accounts/')) {
        $_SESSION['error'] = 'error_referer';
    } else if (
        !isset($_SESSION['token']) || !isset($_REQUEST['token'])
        || $_REQUEST['token'] !== $_SESSION['token']
        || $_SESSION['tokenExpire'] < time()
    ) {
        $_SESSION['error'] = 'error_token';
    }
    if (!isset($_SESSION['error'])) return;

    header('Location: ' . $url);
    exit;
}

/**
 * Check for CSRF with referer and token
 *
 * @param array $data
 * @return void
 */
function checkCSRFAsync(array $data): void
{
    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'http://.localhost/accounts/')) {
        $error = 'error_referer';
    } else if (
        !isset($_SESSION['token']) || !isset($data['token'])
        || $data['token'] !== $_SESSION['token']
        || $_SESSION['tokenExpire'] < time()
    ) {
        $error = 'error_token';
    }
    if (!isset($error)) return;

    echo json_encode([
        'result' => false,
        'error' => $error
    ]);
    exit;
}

/**
 * Apply treatment on given array to prevent XSS fault.
 * 
 * @param array &$array
 */
function checkXSS(array &$array): void
{
    $array = array_map('strip_tags', $array);
    // foreach ($array as $key => $value) {
    //     $array[$key] = strip_tags($value);
    // }
}


// ---------------------
// TASK MANAGEMENT
// ---------------------


/**
 * Add an error to display and stop script
 * 
 * @param string $error
 */
function addErrorAndExit(string $error): void
{
    $_SESSION['error'] = $error;
    header('Location: index.php');
    exit;
}

/**
 * Add a notification to display
 * 
 * @param string $text
 */
function addNotification(string $text): void
{
    $_SESSION['notif'] = $text;
}


function throwAsyncError(string $message): void
{
    echo json_encode([
        'result' => false,
        'error' => $message
    ]);
    exit;
}



// ---------------------
// LAYOUT
// ---------------------


function getNotifHtml(): string
{
    $html = '<ul id="notification-wrapper" class="notif-wrapper">';

    if (isset($_SESSION['notif'])) {
        $html .= '<div class="notification">😀 ' . $_SESSION['notif'] . '</div>';
        unset($_SESSION['notif']);
    }

    if (isset($_SESSION['error'])) {
        $html .= '<div class="error">😨 ' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }

    $html .= '</ul>';

    return $html;
}

/**
 * Return current page 
 *
 * @return string
 */
function getCurrentPage(): string
{
    return   basename($_SERVER['SCRIPT_NAME']);
}
/**
 * Generate HTML link for the given page.
 *
 * @param array $page
 * @return string
 */
function generatePageLink(array $page): string
{
    return '<a href="' . $page['file'] . '" class="main-nav-link' . (getCurrentPage() === $page['file']  ? ' active' : '') . '">' . $page['name'] . '</a>';
}

/**
 * Generate HTML main navigation from pages data.
 *
 * @param array $pages
 * @return string
 */
/**
 * Generate HTML main navigation from pages data.
 *
 * @param array $pages
 * @return string
 */


 function generateHtmlNav(array $pages): string
 {
     $string = '<ul class="nav">
     <li class="nav-item">
         <a href="index.html" class="nav-link link-secondary" aria-current="page">Opérations</a>
     </li>';
     foreach ($pages as $page) {
         $string .= '<li class="nav-item">
         <a href="' . $page['file'] . 'class="nav-link link-body-emphasis"' . $page['name'] . '</a></li>';
     }
     $string .= '</ul>';
 
     // $string = '<nav class="main-nav">' . turnArrayIntoString(array_map('generatePageLink', $pages), 'main-nav-list') . '</nav>';
     return $string;
 }

 
/**
 * Get array from data for current page data
 *
 * @param array $pages
 * @return array
 */
function getCurrentPageData(array $pages): ?array
{
    // foreach($pages as $page){
    //     if($page['file'] === getCurrentPage()){
    //        return $page;
    //     }
    // }
    // return NULL;

    return current(array_filter($pages, fn ($p) => $p['file'] === getCurrentPage()));
}