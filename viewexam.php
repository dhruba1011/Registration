<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>YCTC Student Exam Search</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #837a79;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Segoe UI', sans-serif;
    }

    .phone-frame {
      width: 360px;
      height: 600px;
      background: #000;
      border-radius: 40px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.8);
      padding: 8px;
      box-sizing: border-box;
      position: relative;
    }

    .phone-screen {
      width: 100%;
      height: 100%;
      background: #fff;
      border-radius: 32px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .top-bar {
      height: 40px;
      position: relative;
      background: #f9f9f9;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .camera {
      width: 10px;
      height: 10px;
      background: #000;
      border-radius: 50%;
      position: absolute;
      left: 20px;
    }

    .speaker {
      width: 60px;
      height: 6px;
      background: #333;
      border-radius: 3px;
    }

    .screen-content {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
      box-sizing: border-box;
    }

    .app-icons {
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 8px 0;
      background: #f2f2f2;
      border-top: 1px solid #ddd;
    }

    .app-icon {
      width: 24px;
      height: 24px;
      background: #007bff;
      border-radius: 6px;
    }

    .nav-bar {
      height: 40px;
      background: #f2f2f2;
      border-top: 1px solid #ddd;
      display: flex;
      justify-content: space-around;
      align-items: center;
    }

    .nav-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      opacity: 0.7;
    }

    .nav-btn svg {
      width: 24px;
      height: 24px;
    }

    .home {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 2px solid #000;
    }

    .square {
      width: 16px;
      height: 16px;
      border: 2px solid #000;
    }

    .card {
      border-radius: 10px;
      border: none;
    }

    .card-header {
      padding: 8px;
    }

    .input-group .form-control {
      font-size: 14px;
    }

    .table th {
      width: 45%;
      background-color: #f8f9fa;
      text-align: right;
      font-size: 13px;
      padding-right: 5px;
    }

    .table td {
      font-weight: 500;
      font-size: 13px;
      padding-left: 5px;
    }

    .note {
      text-align: center;
      color: red;
      font-weight: 600;
      font-size: 12px;
      margin-top: 10px;
    }

    .screen-content::-webkit-scrollbar {
      width: 4px;
    }

    .screen-content::-webkit-scrollbar-thumb {
      background: #aaa;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<div class="phone-frame">
  <div class="phone-screen">
    <!-- Top bar -->
    <div class="top-bar">
      <div class="camera"></div>
      <div class="speaker"></div>
    </div>

    <!-- App screen -->
    <div class="screen-content">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center py-2">
          <h6 class="mb-0">Youth Computer Training Centre</h6>
        </div>
        <div class="card-body p-2">
          <form method="get" class="mb-2">
            <div class="input-group input-group-sm">
              <input type="text" name="regno" class="form-control" placeholder="Enter Reg. No." required>
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </form>

          <?php
          if (isset($_GET['regno'])) {
              $regno = $conn->real_escape_string($_GET['regno']);
              $sql = "SELECT * FROM exam WHERE regno LIKE '%$regno%'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $formatted_date = date("d/m/Y", strtotime($row['exam_date']));
                      $formatted_time = date("h:i A", strtotime($row['exam_time']));

                      echo "<div class='table-responsive mb-2'>";
                      echo "<table class='table table-bordered table-sm'>
                              <tr><th>Batch</th><td>{$row['batch']}</td></tr>
                              <tr><th>Reg. No.</th><td>{$row['regno']}</td></tr>
                              <tr><th>Login ID</th><td>{$row['loginid']}</td></tr>
                              <tr><th>Name</th><td>{$row['sname']}</td></tr>
                              <tr><th>Father's Name</th><td>{$row['fname']}</td></tr>
                              <tr><th>Course</th><td>{$row['course']}</td></tr>
                              <tr><th>Exam Date</th><td>{$formatted_date}</td></tr>
                              <tr><th>Exam Time</th><td>{$formatted_time}</td></tr>
                            </table>";
                      echo "<p class='note'>Must bring I-Card and ₹170/- Receipt during Exam.</p>";
                      echo "</div>";
                  }
              } else {
                  echo "<div class='alert alert-warning text-center p-1'>No records found.</div>";
              }
          }
          ?>
        </div>
      </div>
    </div>

    <!-- Bottom nav bar -->
    <div class="nav-bar">
      <div class="nav-btn">
        <!-- Triangular Back -->
        <svg viewBox="0 0 24 24" fill="none">
          <path d="M15 18L9 12L15 6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="nav-btn">
        <div class="home"></div>
      </div>
      <div class="nav-btn">
        <div class="square"></div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>