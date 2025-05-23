<?php
include 'connection.php';

$session = $course = $gender = $cast = $class_days = $class_times =
$cita = $dita = $adita = $cdta = $ddta = $cfas = $dfas =
$adfas = $cdtp = $ddtp = $last_exam = "";

// Insert/update on POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Safely grab POST or default to empty
    $session      = trim($_POST['session']      ?? '');
    $course       = trim($_POST['course']       ?? '');
    $gender       = trim($_POST['gender']       ?? '');
    $cast         = trim($_POST['cast']         ?? '');
    $class_days   = trim($_POST['class_days']   ?? '');
    $class_times  = trim($_POST['class_times']  ?? '');
    $cita         = trim($_POST['cita']         ?? '');
    $dita         = trim($_POST['dita']         ?? '');
    $adita        = trim($_POST['adita']        ?? '');
    $cdta         = trim($_POST['cdta']         ?? '');
    $ddta         = trim($_POST['ddta']         ?? '');
    $cfas         = trim($_POST['cfas']         ?? '');
    $dfas         = trim($_POST['dfas']         ?? '');
    $adfas        = trim($_POST['adfas']        ?? '');
    $cdtp         = trim($_POST['cdtp']         ?? '');
    $ddtp         = trim($_POST['ddtp']         ?? '');
    $last_exam    = trim($_POST['last_exam']    ?? '');

    // Delete old
    $conn->query("DELETE FROM settings");

    // Split into arrays
    $sessions       = array_map('trim', explode(',', $session));
    $courses        = array_map('trim', explode(',', $course));
    $genders        = array_map('trim', explode(',', $gender));
    $casts          = array_map('trim', explode(',', $cast));
    $class_days_list= array_map('trim', explode(',', $class_days));
    $class_times_list= array_map('trim', explode(',', $class_times));
    $cita_list      = array_map('trim', explode(',', $cita));
    $dita_list      = array_map('trim', explode(',', $dita));
    $adita_list     = array_map('trim', explode(',', $adita));
    $cdta_list      = array_map('trim', explode(',', $cdta));
    $ddta_list      = array_map('trim', explode(',', $ddta));
    $cfas_list      = array_map('trim', explode(',', $cfas));
    $dfas_list      = array_map('trim', explode(',', $dfas));
    $adfas_list     = array_map('trim', explode(',', $adfas));
    $cdtp_list      = array_map('trim', explode(',', $cdtp));
    $ddtp_list      = array_map('trim', explode(',', $ddtp));
    $last_exam_list = array_map('trim', explode(',', $last_exam));

    // Determine how many rows
    $max_count = max(
        count($sessions), count($courses), count($genders), count($casts),
        count($class_days_list), count($class_times_list),
        count($cita_list), count($dita_list), count($adita_list),
        count($cdta_list), count($ddta_list),
        count($cfas_list), count($dfas_list), count($adfas_list),
        count($cdtp_list), count($ddtp_list), count($last_exam_list)
    );

    // Insert each row
    for ($i = 0; $i < $max_count; $i++) {
        $sql = "INSERT INTO settings
            (session, course, gender, cast, class_days, class_times,
             cita, dita, adita, cdta, ddta, cfas, dfas, adfas, cdtp, ddtp, last_exam)
          VALUES (
            '" . ($sessions[$i]       ?? '') . "',
            '" . ($courses[$i]        ?? '') . "',
            '" . ($genders[$i]        ?? '') . "',
            '" . ($casts[$i]          ?? '') . "',
            '" . ($class_days_list[$i]?? '') . "',
            '" . ($class_times_list[$i]?? '') . "',
            '" . ($cita_list[$i]      ?? '') . "',
            '" . ($dita_list[$i]      ?? '') . "',
            '" . ($adita_list[$i]     ?? '') . "',
            '" . ($cdta_list[$i]      ?? '') . "',
            '" . ($ddta_list[$i]      ?? '') . "',
            '" . ($cfas_list[$i]      ?? '') . "',
            '" . ($dfas_list[$i]      ?? '') . "',
            '" . ($adfas_list[$i]     ?? '') . "',
            '" . ($cdtp_list[$i]      ?? '') . "',
            '" . ($ddtp_list[$i]      ?? '') . "',
            '" . ($last_exam_list[$i] ?? '') . "'
          )";
        $conn->query($sql);
    }

    echo "<p class='success'>Records saved successfully!</p>";
}

// Load and rebuild comma-separated values
$result = $conn->query("SELECT * FROM settings");
if ($result->num_rows > 0) {
    $sessions = $courses = $genders = $casts =
    $class_days_list = $class_times_list =
    $cita_list = $dita_list = $adita_list =
    $cdta_list = $ddta_list = $cfas_list =
    $dfas_list = $adfas_list = $cdtp_list =
    $ddtp_list = $last_exam_list = [];

    while ($row = $result->fetch_assoc()) {
        $sessions[]       = trim($row['session']     ?? '');
        $courses[]        = trim($row['course']      ?? '');
        $genders[]        = trim($row['gender']      ?? '');
        $casts[]          = trim($row['cast']        ?? '');
        $class_days_list[]= trim($row['class_days']  ?? '');
        $class_times_list[]= trim($row['class_times'] ?? '');
        $cita_list[]      = trim($row['cita']        ?? '');
        $dita_list[]      = trim($row['dita']        ?? '');
        $adita_list[]     = trim($row['adita']       ?? '');
        $cdta_list[]      = trim($row['cdta']        ?? '');
        $ddta_list[]      = trim($row['ddta']        ?? '');
        $cfas_list[]      = trim($row['cfas']        ?? '');
        $dfas_list[]      = trim($row['dfas']        ?? '');
        $adfas_list[]     = trim($row['adfas']       ?? '');
        $cdtp_list[]      = trim($row['cdtp']        ?? '');
        $ddtp_list[]      = trim($row['ddtp']        ?? '');
        $last_exam_list[] = trim($row['last_exam']   ?? '');
    }

    $session     = implode(',', array_filter($sessions));
    $course      = implode(',', array_filter($courses));
    $gender      = implode(',', array_filter($genders));
    $cast        = implode(',', array_filter($casts));
    $class_days  = implode(',', array_filter($class_days_list));
    $class_times = implode(',', array_filter($class_times_list));
    $cita        = implode(',', array_filter($cita_list));
    $dita        = implode(',', array_filter($dita_list));
    $adita       = implode(',', array_filter($adita_list));
    $cdta        = implode(',', array_filter($cdta_list));
    $ddta        = implode(',', array_filter($ddta_list));
    $cfas        = implode(',', array_filter($cfas_list));
    $dfas        = implode(',', array_filter($dfas_list));
    $adfas       = implode(',', array_filter($adfas_list));
    $cdtp        = implode(',', array_filter($cdtp_list));
    $ddtp        = implode(',', array_filter($ddtp_list));
    $last_exam   = implode(',', array_filter($last_exam_list));
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Insert Settings</title>
    <link rel="stylesheet" href="style.css">
    <style>
      /* basic feedback styling */
      .success { color: green; font-weight: bold; margin: 10px 0; }
      /* rest of styling lives in style.css */
    </style>
</head>
<body>

  <h2 align="center">Insert Settings Record</h2>

  <form method="post" action="">
    <label>Session</label>
    <input type="text" name="session" value="<?php echo htmlspecialchars($session); ?>">

    <label>Course</label>
    <input type="text" name="course" value="<?php echo htmlspecialchars($course); ?>">

    <label>Gender</label>
    <input type="text" name="gender" value="<?php echo htmlspecialchars($gender); ?>">

    <label>Cast</label>
    <input type="text" name="cast" value="<?php echo htmlspecialchars($cast); ?>">

    <label>Class Days</label>
    <input type="text" name="class_days" value="<?php echo htmlspecialchars($class_days); ?>">

    <label>Class Times</label>
    <input type="text" name="class_times" value="<?php echo htmlspecialchars($class_times); ?>">

    <label>CITA</label>
    <input type="text" name="cita" value="<?php echo htmlspecialchars($cita); ?>">

    <label>DITA</label>
    <input type="text" name="dita" value="<?php echo htmlspecialchars($dita); ?>">

    <label>ADITA</label>
    <input type="text" name="adita" value="<?php echo htmlspecialchars($adita); ?>">

    <label>CDTA</label>
    <input type="text" name="cdta" value="<?php echo htmlspecialchars($cdta); ?>">

    <label>DDTA</label>
    <input type="text" name="ddta" value="<?php echo htmlspecialchars($ddta); ?>">

    <label>CFAS</label>
    <input type="text" name="cfas" value="<?php echo htmlspecialchars($cfas); ?>">

    <label>DFAS</label>
    <input type="text" name="dfas" value="<?php echo htmlspecialchars($dfas); ?>">

    <label>ADFAS</label>
    <input type="text" name="adfas" value="<?php echo htmlspecialchars($adfas); ?>">

    <label>CDTP</label>
    <input type="text" name="cdtp" value="<?php echo htmlspecialchars($cdtp); ?>">

    <label>DDTP</label>
    <input type="text" name="ddtp" value="<?php echo htmlspecialchars($ddtp); ?>">

    <label>Last Exam</label>
    <input type="text" name="last_exam" value="<?php echo htmlspecialchars($last_exam); ?>">

    <input type="submit" value="Save Settings">
  </form>
</body>
</html>