<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Customers</h1>
    </div>
    <div class="content-header-right">
        <a href="customer-add.php" class="btn btn-primary btn-sm">Add New Customer</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="10">#</th>
                                <th width="180">Name</th>
                                <th width="150">Email Address</th>
                                <th width="150">Join Date</th>
                                <th>Status</th>
                                <th width="100">Change Status</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM users ORDER BY created_at DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach ($result as $row) {
                                $i++;
                                $status_class = ($row['status'] == 1) ? 'bg-g' : 'bg-r';
                                ?>
                                <tr class="<?php echo $status_class; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <?php 
                                        $date = new DateTime($row['created_at']);
                                        echo $date->format('M d, Y h:i A'); 
                                        ?>
                                    </td>
                                    <td><?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                    <td>
                                        <a href="customer-change-status.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-xs">Change Status</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-xs" 
                                           data-href="customer-delete.php?id=<?php echo $row['id']; ?>" 
                                           data-toggle="modal" 
                                           data-target="#confirm-delete">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>                            
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this customer?</p>
                <p class="text-danger">All related data will be permanently removed.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        "order": [[3, 'desc']], // Sort by join date by default
        "columnDefs": [
            { "orderable": false, "targets": [5,6] } // Make action columns non-sortable
        ]
    });
    
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
});
</script>

<?php require_once('footer.php'); ?>