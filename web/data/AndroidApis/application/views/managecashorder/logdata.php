        <div class="panel panel-info">
              <div class="panel-heading">&nbsp; &nbsp;</div>
              <div class="panel-body">
                 <table class="table table-bordered">
          <tr>
            <th>Sr.no</th>
            <th>Order Status</th>
            <th>Request From</th>
            <th>Date</th>
            
          </tr>
          <?php if(!empty($get_orderlog)) { 
              $sr=1; foreach ($get_orderlog as $orderlog) 
              {     
            ?>
          <tr>
            <td><?= $sr++;?></td>
            <td><?= $orderlog->order_status;?></td>
            <td><?= $orderlog->request_from;?></td>
            <td><?= date('jS M Y H:i',strtotime($orderlog->order_date));?></td>
          </tr>
        <?php } }else { ?>
          <tr>
            <td colspan="3">No order logs</td>
          </tr>

        <?php } ?>
         </table>


              </div>
            </div>