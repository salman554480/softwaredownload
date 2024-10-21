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
    if(isset($_SESSION['user_email'])){
        $user_email = $_SESSION['user_email'];
    $select_user = "SELECT * FROM user WHERE user_email='$user_email' ORDER BY user_id DESC";
    $run_user =  mysqli_query($conn, $select_user);
    while ($row_user =  mysqli_fetch_array($run_user)) {

      $user_id =  $row_user['user_id'];
      $user_token =  $row_user['user_token'];
      $user_email =  preg_replace("/(^...|........$)(*SKIP)(*F)|(.)/","*",$row_user['user_email']);
               
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
        <?php } }}else{

    $select_user = "SELECT * FROM user ORDER BY user_id ASC";
    $run_user =  mysqli_query($conn, $select_user);
    while ($row_user =  mysqli_fetch_array($run_user)) {

      $user_id =  $row_user['user_id'];
      $user_token =  $row_user['user_token'];
      $user_email =  preg_replace("/(^...|........$)(*SKIP)(*F)|(.)/","*",$row_user['user_email']);
               
      $select_transaction = "SELECT * FROM transaction WHERE user_token='$user_token' ORDER BY payment_date DESC LIMIT 8";
      
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
        <?php } }}?>

        </tbody>
      </table>