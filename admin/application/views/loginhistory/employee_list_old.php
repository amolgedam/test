<div class="col-md-12">
  <div class="box-body">
    <div class="table-responsive" >
      <table id="table" class="table table-striped table-bordered table-hover">
        <thead style="background-color:#8cb3d9;">
          <tr>
            <th>Sr No</th>
            <th>Date</th>
            <th>Login Time</th>
            <th>Logout Time</th>
            <th>Late Mark</th>             
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($attendenceHistory)) {
          $sr=1; foreach ($attendenceHistory as $key) 
          {
            ?>
            <tr>
              <td><?php echo $sr++; ?></td>
              <td><?php echo $key->date; ?></td>
              <td><?php echo date("g:i a", strtotime($key->in_time)); ?></td>
              <?php if(!empty($key->out_time))
              {
                $outTime=date("g:i a", strtotime($key->out_time));
              }
              else
              {
                $outTime='';
              }
              ?>
              <td><?php echo $outTime;?></td>
              <td><?php echo  $key->late_time;?></td>
            </td>
          </tr>
        <?php }}else {
        ?>
        <tr>
          <td colspan="5">
            <center>No Data available</center>
          </td>
        </tr>

      <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
