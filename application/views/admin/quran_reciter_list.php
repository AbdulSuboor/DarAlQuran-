<link href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
<main role="main" class="container">
  <div class="alert alert-dark table_header">
    <h5>List Of Reciters In Quran</h5>
    <ul class="nav justify-content-end">
        <li class="nav-item">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Add
        </button>
        </li>
    </ul>
  </div>
  <!--Table-->
  <div class="table-responsive">
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Reciter Name</th>
                <th>Date Added</th>
                <th>Status</th>
                <th>Update </th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        foreach ($reciters as $row)
        {
        ?>
            <tr id="<?php echo $row->id.'_'.$row->reciter_name.'_'.$row->status;?>">
                <td><?php echo $i;?></td>
                <td><?php echo $row->reciter_name;?></td>
                <td><?php echo $row->date_time;?></td>
                <td><?php if($row->status) echo 'Active'; else echo 'In-Active'?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm editRow" data-toggle="modal" data-target="#exampleModalCenter1">
                        Edit
                    </button>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Reciter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputAuthorName">Enter Reciter Name</label>
            <input type="text" class="form-control" id="reciterName" placeholder="Reciter Name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="addToDB">Add</button>
      </div>
    </div>
  </div>
</div>
<!-- update Model -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Reciter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="rowId">
        <div class="form-group">
            <label for="exampleInputAuthorName">Reciter Name</label>
            <input type="text" class="form-control" id="editReciterName" placeholder="Reciter Name">
        </div>
        <div class="form-group">
            <label for="exampleInputStatus">Status</label>
            <br>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="customRadio" name="status" value="1">
                <label class="custom-control-label" for="customRadio">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="customRadio2" name="status" value="0">
                <label class="custom-control-label" for="customRadio2">In Active</label>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="updateToDB">Update</button>
      </div>
    </div>
  </div>
</div>
</main><!-- /.container -->
<script>
$(document).ready(function() {
    var baseURL = '<?php echo base_url(''); ?>';
    $('#example').DataTable();
    $('#addToDB').on('click',function() {
        var reciterName = $('#reciterName').val();
        $.post(baseURL+'/admin/quranreciters/addReciter', {"reciterName":reciterName}, function(data) {
            if(data) {
                alert('Reciter Added Sucessfully');
                location.reload();
            }
        })
    });
    $('.editRow').on('click',function() {
        var reciterDetails = $(this).parents('tr').attr('id');
        var res = reciterDetails.split('_');
        $('#rowId').val(res[0]);
        $('#editReciterName').val(res[1]);
        if(res[2] == '1')
            $("#customRadio").prop("checked", true);
        else
            $("#customRadio2").prop("checked", true);
    });
    $('#updateToDB').on('click',function() {
        var reciterId = $('#rowId').val();
        var reciterName = $('#editReciterName').val();
        var status = $("input[name='status']:checked").val();
        $.post(baseURL+'/admin/quranreciters/updateReciter', {"reciterId":reciterId,'reciterName':reciterName,'status':status}, function(data) {
            if(data) {
                alert('Reciter Details Updated Sucessfully');
                location.reload();
            }
        })
    });
} );
</script>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js"');?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.bootstrap4.min.js');?>"></script>
