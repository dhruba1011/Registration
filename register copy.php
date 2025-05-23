<?php
include 'connection.php';

// Dropdown values
$session = $courses = $classDays = $classTimes = $gender = $cast = $last_exam = [];

function fetchDistinctValues($conn, $field) {
    $arr = [];
    $res = $conn->query("SELECT DISTINCT $field FROM settings WHERE $field<>''");
    while ($r = $res->fetch_assoc()) {
        $arr[] = $r[$field];
    }
    return $arr;
}

$session    = fetchDistinctValues($conn, 'session');
$courses    = fetchDistinctValues($conn, 'course');
$classDays  = fetchDistinctValues($conn, 'class_days');
$classTimes = fetchDistinctValues($conn, 'class_times');
$gender     = fetchDistinctValues($conn, 'gender');
$cast       = fetchDistinctValues($conn, 'cast');
$last_exam  = fetchDistinctValues($conn, 'last_exam');

// Form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $session    = mysqli_real_escape_string($conn, $_POST['session']);
    $course     = mysqli_real_escape_string($conn, $_POST['course']);
    $batch      = mysqli_real_escape_string($conn, $_POST['batch']);
    $regno      = mysqli_real_escape_string($conn, $_POST['regno']);
    $class_days = mysqli_real_escape_string($conn, $_POST['class_days']);
    $class_times= mysqli_real_escape_string($conn, $_POST['class_times']);
    $sname      = mysqli_real_escape_string($conn, $_POST['sname']);
    $fname      = mysqli_real_escape_string($conn, $_POST['fname']);
    $dob        = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $cast       = mysqli_real_escape_string($conn, $_POST['cast']);
    $phone1     = mysqli_real_escape_string($conn, $_POST['phone1']);
    $phone2     = mysqli_real_escape_string($conn, $_POST['phone2']);
    $last_exam  = mysqli_real_escape_string($conn, $_POST['last_exam']);
    $mp_mark    = $_POST['mp_mark'] !== '' ? intval($_POST['mp_mark']) : "NULL";
    $hs_mark    = $_POST['hs_mark'] !== '' ? intval($_POST['hs_mark']) : "NULL";

    $sql = "INSERT INTO registration
            (session, course, batch, regno, class_days, class_times,
             sname, fname, dob, gender, cast, phone1, phone2, last_exam, mp_mark, hs_mark)
            VALUES
            ('$session','$course','$batch','$regno','$class_days','$class_times',
             '$sname','$fname','$dob','$gender','$cast','$phone1','$phone2','$last_exam',$mp_mark,$hs_mark)";

    if ($conn->query($sql)) {
        session_start();
        $_SESSION['reg_details'] = $_POST;
        header('Location: success.php');
        exit;
    } else {
        $feedback = "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Multi-Step Registration</title>
  <style>
    form {
      width: 100%;
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      box-sizing: border-box;
    }

    @media (max-width: 600px) {
      form { width: 100% !important; margin: 10px !important; padding: 15px !important; }
    }

    .tab { display: none; }
    .step { display:inline-block; width:12px; height:12px; margin:0 4px;
            background:#ccc; border-radius:50%; }
    .step.active { background:#28a745; }
    .step.finish { background:#218838; }

    .button-row { overflow:auto; margin-top:20px; }
    .button-row button {
      padding:10px 20px; border:none; border-radius:4px;
      cursor:pointer; margin:0 5px;
    }
    .button-row .prev { float:left; background:#aaa; color:#fff; }
    .button-row .next { float:right; background:#28a745; color:#fff; }

    input, select {
      width: 100%;
      padding: 12px;
      margin-top: 6px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }

    .success { text-align:center; color:green; margin:10px 0; }
    .error   { text-align:center; color:red;   margin:10px 0; }
  </style>
</head>
<body>

  <h2>Student Registration</h2>
  <?php if (!empty($feedback)) echo $feedback; ?>

  <form id="regForm" method="post">
    <!-- Tab 1 -->
    <div class="tab">
      <h3>Course Info:</h3>
      <label>Session</label>
      <select name="session" required>
        <option value="">— Select Session —</option>
        <?php foreach ($session as $val): ?>
          <option><?= htmlspecialchars($val) ?></option>
        <?php endforeach; ?>
      </select>
      <label>Course</label>
      <select name="course" required>
        <option value="">— Select Course —</option>
        <?php foreach ($courses as $val): ?>
          <option><?= htmlspecialchars($val) ?></option>
        <?php endforeach; ?>
      </select>
      <label>Batch (optional)</label>
      <input type="text" name="batch">
      <label>Registration No</label>
      <input type="text" name="regno" required>
      <label>Class Days</label>
      <select name="class_days" required>
        <option value="">— Select Days —</option>
        <?php foreach ($classDays as $val): ?>
          <option><?= htmlspecialchars($val) ?></option>
        <?php endforeach; ?>
      </select>
      <label>Class Time</label>
      <select name="class_times" required>
        <option value="">— Select Time —</option>
        <?php foreach ($classTimes as $val): ?>
          <option><?= htmlspecialchars($val) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Tab 2 -->
    <div class="tab">
      <h3>Personal Info:</h3>
      <label>Student Name</label>
      <input type="text" name="sname" required>
      <label>Father’s Name</label>
      <input type="text" name="fname" required>
      <label>Date of Birth</label>
      <input type="date" name="dob" required>
      <label>Gender</label>
      <select name="gender" required>
        <option value="">— Select Gender —</option>
        <?php foreach ($gender as $val): ?>
          <option><?= htmlspecialchars($val) ?></option>
        <?php endforeach; ?>
      </select>
      <label>Cast</label>
      <select name="cast" required>
        <option value="">— Select Cast —</option>
        <?php foreach ($cast as $val): ?>
          <option><?= htmlspecialchars($val) ?></option>
        <?php endforeach; ?>
      </select>
      <label>Phone 1</label>
      <input type="text" name="phone1" required>
      <label>Phone 2</label>
      <input type="text" name="phone2">
    </div>

    <!-- Tab 3 -->
    <div class="tab">
      <h3>Education Info:</h3>
      <label>Last Exam</label>
      <select name="last_exam" required>
        <option value="">— Select Last Exam —</option>
        <?php foreach ($last_exam as $val): ?>
          <option><?= htmlspecialchars($val) ?></option>
        <?php endforeach; ?>
      </select>
      <label>MP Mark</label>
      <input type="number" name="mp_mark" min="0">
      <label>HS Mark</label>
      <input type="number" name="hs_mark" min="0">
    </div>

    <div class="button-row">
      <button type="button" class="prev" onclick="nextPrev(-1)">Previous</button>
      <button type="button" class="next" onclick="nextPrev(1)">Next</button>
    </div>

    <div style="text-align:center;margin-top:30px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
  </form>

<script>
let currentTab = 0;
showTab(currentTab);

function showTab(n) {
  const x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  document.querySelector(".prev").style.display = n === 0 ? "none" : "inline";
  document.querySelector(".next").innerText = n === (x.length - 1) ? "Register" : "Next";
  fixStepIndicator(n);
}

function nextPrev(n) {
  const x = document.getElementsByClassName("tab");
  if (n === 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab += n;
  if (currentTab >= x.length) {
    document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {
  const x = document.getElementsByClassName("tab")[currentTab];
  const inputs = x.querySelectorAll("input[required], select[required]");
  let valid = true;
  inputs.forEach(input => {
    if (!input.value.trim()) {
      input.style.border = "2px solid red";
      valid = false;
    } else {
      input.style.border = "";
    }
  });
  if (valid) document.getElementsByClassName("step")[currentTab].classList.add("finish");
  return valid;
}

function fixStepIndicator(n) {
  const steps = document.getElementsByClassName("step");
  for (let i = 0; i < steps.length; i++) steps[i].classList.remove("active");
  steps[n].classList.add("active");
}
</script>
</body>
</html>
