<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View FAQs</h1>
    </div>
    <div class="content-header-right">
        <a href="faq-add.php" class="btn btn-primary btn-sm">Add New FAQ</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="30">#</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Sort Order</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_faq ORDER BY category, sort_order");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            
                            $category_names = [
                                'orders' => 'Orders & Shipping',
                                'returns' => 'Returns & Exchanges',
                                'account' => 'Account & Payment',
                                'products' => 'Products & Sizing'
                            ];
                            
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $category_names[$row['category']] ?? $row['category']; ?></td>
                                    <td><?php echo htmlspecialchars($row['question']); ?></td>
                                    <td><?php echo $row['sort_order']; ?></td>
                                    <td>
                                        <a href="faq-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="#" class="btn btn-danger btn-xs" 
                                           data-href="faq-delete.php?id=<?php echo $row['id']; ?>" 
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
                <p>Are you sure you want to delete this FAQ?</p>
                <p class="text-danger">This action cannot be undone.</p>
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
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    
    $('#example1').DataTable({
        "order": [[1, 'asc'], [3, 'asc']],
        "columnDefs": [
            { "orderable": false, "targets": [4] }
        ]
    });
});
</script>

<?php require_once('footer.php'); ?>