<link rel="stylesheet" href="assets/css/custom.css" />
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="javascript:void(0);">Dashboard</a>
    </li>
    
  </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format($question); ?></h3>

              <p>Questions</p>
            </div>
            <div class="icon">
              <i class="fa fa-file  "></i>
            </div>
            <a href="<?php echo base_url('QuestionsAsked');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo number_format($consultations); ?></h3>

              <p>Consultations</p>
            </div>
            <div class="icon">
              <i class="fa fa-phone"></i>
            </div>
            <a href="<?php echo base_url('ConsultationRequests');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo number_format($users); ?></h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('UserManagement');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo number_format($lawyers); ?></h3>

              <p>Lawyers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?php echo base_url('LawyerManagement');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      </div>
 <div class="row">
  <div class="col-md-6">
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Answers</h3>

            <!-- <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>Question</th>
                  <!-- <th>Lawyer</th> -->
                  <th>Status</th>
                  <th>Last Post</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($answers as $answer) {?>
                <tr>
                  <td><?php echo  substr($answer['subject'],0,25).'...';?></td>
                 <!--  <td><?php echo $answer['lawyer_stripped_name']; ?></td> -->
                  <td>
                    
                   <?php  if($answer['status'] == "RESPONSE_RECEIVED") {
                            echo '<span class="label label-success">Response Received</span>';
                          } else if($answer['status'] == "EXPIRED") {
                             echo '<span class="label label-warning">Expired</span>';
                          } else if($answer['status'] == "DECLINED") {
                             echo '<span class="label label-danger">Declined</span>';
                          } else if($answer['status'] == "WAITING_FOR_LAWYER") {
                             echo '<span class="label label-info">Waiting for lawyer</span>';
                          } ?>
                  </span></td>
                  <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo date('d M Y',strtotime($answer['answered_at']));?></div>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
           <a href="<?php echo base_url('QuestionsAnswered');?>" class="btn btn-sm btn-default btn-flat pull-right">View All Answers</a>
          </div>
          <!-- /.box-footer -->
      </div>
  </div>
    <div class="col-md-6">
      <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Phone Consultations</h3>

           <!--  <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div> -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>Lawyer</th>
                  <th>Last Post</th>
                  <th>Feedback</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach($crequest as $consultation) {
             ?>
                <tr>
                  <td><?php echo $consultation['lawyer_name'];?></td>
                  
                  <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo date('d M Y',strtotime($consultation['created_at']));?></div>
                  </td>
                  <td> <?php
                    if($consultation['advice_provided'] == 5) {
                        echo '<span class="label label-success">Excellent</span>';
                    }elseif ($consultation['advice_provided'] == 4) {
                        echo '<span class="label label-success">Good</span>';
                    } elseif ($consultation['advice_provided'] == 3) {
                        echo '<span class="label label-warning">Average</span>';
                    } elseif ($consultation['advice_provided'] == 2) {
                       echo '<span class="label label-danger">Poor</span>';
                    } else if($consultation['advice_provided'] == 1){
                        echo '<span class="label label-danger">Terrible</span>';
                    }else{
                        echo '-';
                    }
                    ?></td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
           <a href="<?php echo base_url('ConsultationRequests');?>" class="btn btn-sm btn-default btn-flat pull-right">View All Consultations</a>
          </div>
          <!-- /.box-footer -->
      </div>
  </div>
</div>