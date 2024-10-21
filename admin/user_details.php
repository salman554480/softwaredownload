<?php require_once('parts/top.php'); ?>
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
<?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
  <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-receipt"></i> User Detail</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">User Details</a></li>
        </ul>
      </div>
      <?php 
      if (isset($_GET['user_id'])) {
              $user_id = $_GET['user_id'];
              
      $select_user = "SELECT * FROM user WHERE user_id='$user_id'";
      $run_user =  mysqli_query($conn, $select_user);
      $row_user =  mysqli_fetch_array($run_user);
        $tuser_token =  $row_user['user_token'];
        
      //echo date("29-02-2024", strtotime('-7 days'));

      $transaction_alert = "SELECT * FROM transaction WHERE user_token='$tuser_token' AND payment_status='Success' ORDER BY payment_date ASC LIMIT 1";
      $run_transaction_alert =  mysqli_query($conn, $transaction_alert);
      while ($row_transaction_alert =  mysqli_fetch_array($run_transaction_alert)){
        $expiry_date  = $row_transaction_alert['expiry_date'];


          $expiry = strtotime($expiry_date); //Expiry Date.
          $today_date = strtotime(date("d-m-Y")); //Current Date
          if($expiry >= $today_date){

          $timeleft = $expiry-$today_date;
          $remaining_days = round((($timeleft/24)/60)/60); 

            if($remaining_days <= 7){
              echo '<div id="myAlert" class="alert alert-danger" role="alert">
                                    Subscription End in <b>'.$remaining_days.' Days.</b>
                                      </div>
                                
                                      <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                          var myAlert = document.getElementById("myAlert");
                                          myAlert.style.display = "block";
                                
                                          setTimeout(function () {
                                            myAlert.style.display = "none";
                                          }, 20000);
                                        });
                                      </script>';
            }
          }else{

            $timeleft = $expiry-$today_date;
            $remaining_days = round((($timeleft/24)/60)/60);
            echo '<div id="myAlert" class="alert alert-danger" role="alert">
            Reactive Subscription, Ended <b>'.abs($remaining_days).' Days ago.</b>
              </div>
        
              <script>
                document.addEventListener("DOMContentLoaded", function () {
                  var myAlert = document.getElementById("myAlert");
                  myAlert.style.display = "block";
        
                  setTimeout(function () {
                    myAlert.style.display = "none";
                  }, 20000);
                });
              </script>';
          }

      }
      ?>
      <div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="bi bi-globe"></i> Details</h2>
                </div>

              </div>

              <div class="row">
                <div class="col-12 table-responsive ">
                  <table class="table table-bordered ">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Token</th>
                        <th>Image</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Location</th>
                      </tr>
                    </thead>
                    <tbody>
					 <?php
                    
					$select_user = "SELECT * FROM user WHERE user_id='$user_id'";
					$run_user =  mysqli_query($conn, $select_user);
					while ($row_user =  mysqli_fetch_array($run_user)) {

						$user_id =  $row_user['user_id'];
						$user_name =  $row_user['user_name'];
						$user_email =  $row_user['user_email'];
						$user_password =  $row_user['user_password'];
						$user_level =  $row_user['user_level'];
						$user_token =  $row_user['user_token'];
						$user_image =  $row_user['user_image'];
						$user_gender =  $row_user['user_gender'];
						$user_country =  $row_user['user_country'];
						$user_city =  $row_user['user_city'];
						$user_address =  $row_user['user_address'];
						$user_phone =  $row_user['user_phone'];
						$user_location =  $row_user['user_location'];
						
					   
					}
					
					?>
                      <tr>
					  
                        <td><?php echo $user_name; ?></td>
                        <td><?php echo $user_email; ?></td>
                        <td><?php echo MD5($user_password); ?></td>
                        <td><?php echo $user_level; ?></td>
                        <td><?php echo $user_token; ?></td>
                        <td><?php echo $user_image; ?></td>
                        <td><?php echo $user_gender; ?></td>
                        <td><?php echo $user_country; ?></td>
                        <td><?php echo $user_city; ?></td>
                        <td><?php echo $user_address; ?></td>
                        <td><?php echo $user_phone; ?></td>
                        <td><?php echo $user_location; ?></td>
                     
					            </tr>
					<?php }else{echo "<script>window.open('user_view.php','_self');</script>";} ?>
                    </tbody>
                  </table>

<h2>ECG Results</h2>
<table class="table table-bordered ">
  <thead>
    <tr>
      <th>ECG</th>
      <th>Sections</th>
      <th>Answers</th>
      <th>Correct</th>
      <th>Wrong</th>
      <th>Accuracy</th>
    </tr>
  </thead>
  <tbody>
<?php
  
$selection_answers = "SELECT DISTINCT ecg_id FROM sectionselected WHERE user_token='$user_token'";
$run_selection_answers =  mysqli_query($conn, $selection_answers);
while ($row_selection_answers =  mysqli_fetch_array($run_selection_answers)) {

    $num_corrects = 0;
    $ecg_id = $row_selection_answers['ecg_id'];
    $select_all = "SELECT * FROM sectionselected WHERE ecg_id='$ecg_id'AND user_token='$user_token'";
    $run_all =  mysqli_query($conn, $select_all);
    $num_q_answers =  mysqli_num_rows($run_all);
      while($row_all = mysqli_fetch_array($run_all)){
        $sectionselected_id  =  $row_all['sectionselected_id'];
        $user_token =  $row_all['user_token'];
        $ecg_ids =  $row_all['ecg_id'];
        $sectionoption_id =  $row_all['sectionoption_id'];

        $select_ecg = "SELECT * FROM ecg WHERE ecg_id='$ecg_ids'";
        $run_ecg =  mysqli_query($conn, $select_ecg);
        $row_ecg =  mysqli_fetch_array($run_ecg);
        $secg_title = $row_ecg['ecg_title'];

        $total_q =  13;
        

        $selection_correct = "SELECT * FROM sectionanswers WHERE ecg_id='$ecg_ids' AND sectionoption_id='$sectionoption_id'";
        $run_scorrect =  mysqli_query($conn, $selection_correct);
        if(mysqli_num_rows($run_scorrect) > 0){
        $row_scorrect =  mysqli_fetch_array($run_scorrect);
        $asectionoption_id = $row_scorrect['sectionoption_id'];
        }else{
          $asectionoption_id = false;
        }
        if($sectionoption_id==$asectionoption_id){
          $num_corrects = $num_corrects +1;
        }

        $snum_wrong =  $num_q_answers - $num_corrects;
        if($total_q == $num_q_answers){
          if($snum_wrong > $num_q_answers || $snum_wrong == $num_q_answers){
            $accuracy= "Fail";
          }else{
             $wrong = $snum_wrong;
            if($wrong == 0){
              $saccuracy =  '100%';
            }else{
              $saccuracy =  round(($num_corrects / $num_q_answers) * 100, 2).'%';
            }
          }
        }else{
          $saccuracy = "Quiz Pending";
        }

      }


?>
    <tr>
      <td><?php echo $secg_title;?></td>
      <td><?php echo $total_q;?></td>
      <td><?php echo $num_q_answers;?></td>
      <td><?php echo $num_corrects;?></td>
      <td><?php echo $snum_wrong;?></td>
      <td><?php echo $saccuracy;?></td>
    <tr>
<?php } ?>
  </tbody>
</table>

<h2>ECG Questions Results</h2>
<table class="table table-bordered ">
  <thead>
    <tr>
      <th>ECG</th>
      <th>Total Q</th>
      <th>Answers</th>
      <th>Correct</th>
      <th>Wrong</th>
      <th>Accuracy</th>
    </tr>
  </thead>
  <tbody>
<?php
  
$select_answers = "SELECT DISTINCT ecg_id FROM answer WHERE user_token='$user_token'";
$run_answers =  mysqli_query($conn, $select_answers);
while ($row_answers =  mysqli_fetch_array($run_answers)) {
  
  $num_correct = 0;
  $ecg_id = $row_answers['ecg_id'];
  $select_all = "SELECT * FROM answer WHERE ecg_id='$ecg_id'AND user_token='$user_token'";
  $run_all =  mysqli_query($conn, $select_all);
  $num_answers =  mysqli_num_rows($run_all);
    while($row_all = mysqli_fetch_array($run_all)){
      $answer_id =  $row_all['answer_id'];
      $user_token =  $row_all['user_token'];
      $ecg_ids =  $row_all['ecg_id'];
      $question_no =  $row_all['question_no'];
      $user_answer =  $row_all['user_answer'];
      $right_answer =  $row_all['right_answer'];
    

  $select_ecg = "SELECT * FROM ecg WHERE ecg_id='$ecg_ids'";
  $run_ecg =  mysqli_query($conn, $select_ecg);
  $row_ecg =  mysqli_fetch_array($run_ecg);
  $ecg_title = $row_ecg['ecg_title'];


  $select_total = "SELECT * FROM question WHERE ecg_id='$ecg_ids'";
  $run_total =  mysqli_query($conn, $select_total);
  $num_total =  mysqli_num_rows($run_total);

  if($user_answer==$right_answer){
    $num_correct = $num_correct +1;
  }

  
  }
  $num_wrong =  $num_answers - $num_correct;
  
    if($num_total == $num_answers){
      if($num_wrong > $num_answers || $num_wrong == $num_answers){
        $accuracy= "Fail";
      }else{
         $wrong = $num_wrong;
        if($wrong == 0){
          $accuracy =  '100%';
        }else{
          $accuracy =  round(($num_correct / $num_answers) * 100, 2).'%';
          $accuracy;
        }
      }
    }else{
      $accuracy = "Quiz Pending";
    }
?>
    <tr>
      <td><?php echo $ecg_title;?></td>
      <td><?php echo $num_total;?></td>
      <td><?php echo $num_answers;?></td>
      <td><?php echo $num_correct;?></td>
      <td><?php echo $num_wrong;?></td>
      <td><?php echo $accuracy;?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>


<h2>Transaction Record</h2>
      <table class="table table-bordered ">
        <thead>
          <tr>
            <th>Payment Date</th>
            <th>User</th>
            <th>Transaction ID</th>
            <th>Source</th>
            <th>Status</th>
            <th>Expiry Date</th>
          </tr>
        </thead>
        <tbody>
      <?php
      $select_transaction = "SELECT * FROM transaction WHERE user_token='$user_token' ORDER BY payment_date ASC";
      $run_transaction =  mysqli_query($conn, $select_transaction);
      while ($row_transaction =  mysqli_fetch_array($run_transaction)) {
        $transaction_id  = $row_transaction['transaction_id'];
        $user_token  = $row_transaction['user_token'];
        $payment_status  = $row_transaction['payment_status'];
        $payment_source  = $row_transaction['payment_source'];
        $payment_date  = $row_transaction['payment_date'];
        $expiry_date  = $row_transaction['expiry_date'];
        
       

      ?>
          <tr>
            <td><?php echo $payment_date;?></td>
            <td><?php echo $user_email;?></td>
            <td><?php echo $transaction_id;?></td>
            <td><?php echo $payment_source;?></td>
            <td><?php echo $payment_status;?></td>
            <td><?php echo $expiry_date;?></td>
          </tr>
        <?php } ?>

        </tbody>
      </table>
                </div>
                
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-end"><a class="btn btn-primary" href="javascript:window.print();"><i class="bi bi-printer me-2"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
<?php require_once('parts/footer.php'); ?>