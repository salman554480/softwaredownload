<?php if(isset($_SESSION['user_email'])){ ?>
<h2>Start Quiz</h2>
      <table class="table table-bordered ">
        <thead>
          <tr>
            <th>ECG</th>
            <th>Title</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
      <?php

        $select_user = "SELECT * FROM user WHERE user_email='".$_SESSION['user_email']."'";
        $run_user = mysqli_query($conn, $select_user);
        $row_user = mysqli_fetch_array($run_user);

        $user_id = $row_user['user_id'];
        $user_token = $row_user['user_token'];

        $select_ecgattempt = "SELECT DISTINCT ecg_id,user_token FROM ecgattempt WHERE user_token != '$user_token' ORDER BY ecg_id ASC";
        $run_ecgattempt =  mysqli_query($conn, $select_ecgattempt);
        while($row_ecgattempt =  mysqli_fetch_array($run_ecgattempt)) {
            $ecg_id = $row_ecgattempt['ecg_id'];
                $select_ecg = "SELECT DISTINCT ecg_id FROM ecg WHERE ecg_id = '$ecg_id'";
                $run_ecg =  mysqli_query($conn, $select_ecg);
                while ($row_ecg =  mysqli_fetch_array($run_ecg)) {
                    $atmecg_id = $row_ecg['ecg_id'];

                    $showecg= "SELECT * FROM ecg WHERE ecg_id = '$atmecg_id'";
                    $run_showecg =  mysqli_query($conn, $showecg);
                    $row_showecg =  mysqli_fetch_array($run_showecg);
                        $non_atmecg_title = $row_showecg['ecg_title'];

           
      ?>
          <tr>
            <td><?php echo $atmecg_id;?></td>
            <td><?php echo $non_atmecg_title;?></td>
            <td><button class="btn btn-primary" disabled>Start QuiZ</button></td>
          <tr>
      <?php }} ?>
        </tbody>
      </table>
<?php } ?>