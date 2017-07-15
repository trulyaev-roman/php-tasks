<?php
//login
function ses_fname($key)
{
    return __DIR__ . "/sessions/{$key}.txt";
}

function ses_open($save_path, $ses_name)
{
    if (!file_exists($save_path)) {

    }
    return true;
}

function ses_close()
{
    return true;
}

function ses_read($key)
{
    $fname = ses_fname($key);
    if (!file_exists($fname)) {
        $result = '';
    } else {
        $result = @file_get_contents($fname);
    }
    return $result;
}

function ses_write($key, $value)
{

    $fname = ses_fname($key);
    file_put_contents($fname, $value);
    return true;

}

function ses_destroy($key)
{
    return @unlink(ses_fname($key));

}

function ses_gc($maxlifetime)
{
    return true;
}

session_set_save_handler(
    "ses_open", "ses_close",
    "ses_read", "ses_write",
    "ses_destroy", "ses_close"

);

if (!empty($_COOKIE['TestCookieAuth'])) {
    session_id($_COOKIE['TestCookieAuth']);
}

session_start();

?>
<html>
<head><title></title></head>
<body>
<form method="POST" action="">
    <input type="hidden" name="posted" value="true">
    <table border="1">
        <tr>
            <td>Какую оценку по математике получил <b>Альберт Эйнштейн</b>?</td>
            <td>
                <select name='math'>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>F</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Какую оценку по физике получил <b>Альберт Эйнштейн</b>?</td>
            <td>
                <select name='physic'>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>F</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if (!isset($_SESSION['marks'])) {
                    $_SESSION['marks'] = [];
                }

                if (!empty($_POST)) {
                    $_SESSION['marks']['math'][] = $_POST['math'];
                    $_SESSION['marks']['physic'][] = $_POST['physic'];
                }

                var_dump([
                    'session' => $_SESSION,
                    'cookie' => $_COOKIE
                ]);
                ?>
            </td>
            <td>
                <input type="submit" value="Показать оценки">
            </td>
        </tr>
    </table>
</form>
</body>
</html>