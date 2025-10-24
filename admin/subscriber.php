<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Subscribers</h1>
    </div>
</section>

<?php if(isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-header with-border"><h3 class="box-title">Subscribers List</h3></div>
                <div class="box-body table-responsive">
                    <table id="subscriberTable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Join Date</th>
                                <th>action</th>
                            </tr>
                        </thead>
                  <tbody>
<?php
$i = 0;
$statement = $pdo->prepare("SELECT * FROM tbl_subscriber ORDER BY subscribed_at DESC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row):
    $i++;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo htmlspecialchars($row['name'] ?? ''); ?></td>
        <td><?php echo htmlspecialchars($row['email'] ?? ''); ?></td>
        <td><?php echo !empty($row['subscribed_at']) ? date('M d, Y h:i A', strtotime($row['subscribed_at'])) : ''; ?></td>
        <td>
            <a href="#" class="btn btn-danger btn-xs" 
               data-href="subscriber-delete.php?id=<?php echo $row['id']; ?>" 
               data-toggle="modal" 
               data-target="#confirm-delete">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this subscriber?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  $('#confirm-delete').on('show.bs.modal', function (e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });
});
</script>


<script>
$(document).ready(function() {
    $('#subscriberTable').DataTable({
        "order": [[3, "desc"]]
    });
});
</script>



<?php require_once('footer.php'); ?>
