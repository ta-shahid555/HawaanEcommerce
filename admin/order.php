<?php require_once('header.php'); ?>

<?php
// Process status update
if(isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    try {
        if($status == 'removed') {
            // Delete order if status is 'removed'
            $statement = $pdo->prepare("DELETE FROM orders WHERE id=?");
            $statement->execute([$order_id]);
            $_SESSION['success_message'] = 'Order removed successfully!';
        } else {
            // Update status
            $statement = $pdo->prepare("UPDATE orders SET status=? WHERE id=?");
            $statement->execute([$status, $order_id]);
            $_SESSION['success_message'] = 'Order status updated successfully!';
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Error updating order: ' . $e->getMessage();
    }

    // Redirect to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Orders</h1>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Display Messages -->
            <?php if(isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                </div>
            <?php endif; ?>
            
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Customer Details</th>
                                <th>Order Details</th>
                                <th>Products</th>
                                <th>Payment Method</th>
                                <th>Order Total</th>
                                <th>Discount</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM orders ORDER BY order_date DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach ($result as $row) {
                                $i++;
                                $status_class = '';
                                switch($row['status']) {
                                    case 'pending': $status_class = 'bg-warning'; break;
                                    case 'completed': $status_class = 'bg-success'; break;
                                    case 'removed': $status_class = 'bg-danger'; break;
                                }
                                ?>
                                <tr class="<?php echo $status_class; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td>#<?php echo $row['id']; ?></td>
                                    <td>
                                        <b>Name:</b> <?php echo htmlspecialchars($row['full_name']); ?><br>
                                        <b>Email:</b> <?php echo htmlspecialchars($row['email']); ?><br>
                                        <b>Phone:</b> <?php echo htmlspecialchars($row['mobile']); ?>
                                    </td>
                                    <td>
                                        <b>Address:</b> <?php echo htmlspecialchars($row['address']); ?><br>
                                        <b>City:</b> <?php echo htmlspecialchars($row['city']); ?><br>
                                        <b>Zip:</b> <?php echo htmlspecialchars($row['zip_code']); ?><br>
                                        <b>Notes:</b> <?php echo htmlspecialchars($row['order_notes']); ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Fetch order items
                                        $items_stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
                                        $items_stmt->execute([$row['id']]);
                                        $items = $items_stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        if (count($items) > 0) {
                                            foreach ($items as $item) {
                                                echo htmlspecialchars($item['product_name']) . 
                                                     " (Qty: " . $item['quantity'] . 
                                                     ", Price: $" . $item['price'] . ")<br>";
                                            }
                                        } else {
                                            // Fallback to the old format if no items in order_items table
                                            if (!empty($row['products_names'])) {
                                                $products = explode(',', $row['products_names']);
                                                $quantities = explode(',', $row['products_quantities']);
                                                
                                                for ($j = 0; $j < count($products); $j++) {
                                                    echo htmlspecialchars(trim($products[$j])) . 
                                                         " (Qty: " . trim($quantities[$j]) . ")<br>";
                                                }
                                            } else {
                                                echo "No products information available";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo strtoupper(htmlspecialchars($row['payment_method'])); ?></td>
                                    <td>
                                        <?php 
                                        if (!empty($row['order_total'])) {
                                            echo "$" . htmlspecialchars($row['order_total']);
                                        } else {
                                            // Calculate total from order_items if order_total is empty
                                            $total = 0;
                                            if (count($items) > 0) {
                                                foreach ($items as $item) {
                                                    $total += $item['price'] * $item['quantity'];
                                                }
                                                echo "$" . number_format($total, 2);
                                            } else {
                                                echo "N/A";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        if (!empty($row['discount_amount']) && $row['discount_amount'] > 0) {
                                            echo "$" . htmlspecialchars($row['discount_amount']);
                                            if (!empty($row['coupon_code'])) {
                                                echo " (Code: " . htmlspecialchars($row['coupon_code']) . ")";
                                            }
                                        } else {
                                            echo "None";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo date('M d, Y h:i A', strtotime($row['order_date'])); ?></td>
                                    <td>
                                        <form action="" method="post" class="status-form">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                <option value="processing" <?php echo ($row['status'] == 'processing') ? 'selected' : ''; ?>>Processing</option>
                                                <option value="shipped" <?php echo ($row['status'] == 'shipped') ? 'selected' : ''; ?>>Shipped</option>
                                                <option value="delivered" <?php echo ($row['status'] == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                                                <option value="completed" <?php echo ($row['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                                <option value="cancelled" <?php echo ($row['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                                <option value="removed" <?php echo ($row['status'] == 'removed') ? 'selected' : ''; ?>>Remove</option>
                                            </select>
                                            <noscript>
                                                <input type="submit" name="update_status" value="Update" class="btn btn-xs btn-primary mt-2">
                                            </noscript>
                                        </form>
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
                Are you sure you want to permanently delete this order? This action cannot be undone.
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
        "order": [[8, 'desc']], // Sort by order date by default
        "responsive": true,
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);
});
</script>

<?php require_once('footer.php'); ?>