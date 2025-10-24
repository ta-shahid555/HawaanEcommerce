<?php
// order_tracking.php
session_start();
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: auth.php");
    exit;
}

// Check if user is admin
$is_admin = false;
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    $is_admin = true;
}

// Get search parameter if any
$search_order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Fetch orders for the logged-in user (or all orders if admin)
if ($is_admin && $search_order_id > 0) {
    // Admin searching for specific order
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ? ORDER BY order_date DESC");
    $stmt->execute([$search_order_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($is_admin) {
    // Admin viewing all orders
    $stmt = $pdo->prepare("SELECT * FROM orders ORDER BY order_date DESC");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($search_order_id > 0) {
    // User searching for specific order
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND email = ? ORDER BY order_date DESC");
    $stmt->execute([$search_order_id, $_SESSION['user_email']]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // User viewing their orders
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE email = ? ORDER BY order_date DESC");
    $stmt->execute([$_SESSION['user_email']]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Handle status update if admin
if ($is_admin && isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = $_POST['status'];
    $tracking_number = $_POST['tracking_number'] ?? '';
    $admin_notes = $_POST['admin_notes'] ?? '';
    
    $stmt = $pdo->prepare("UPDATE orders SET status = ?, tracking_number = ?, admin_notes = ? WHERE id = ?");
    $stmt->execute([$new_status, $tracking_number, $admin_notes, $order_id]);
    
    // Refresh page to show updated status
    header("Location: orderDisplay.php?order_id=" . $order_id);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        .tracking-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        
        .search-box {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .order-card {
            transition: transform 0.3s;
            cursor: pointer;
        }
        
        .order-card:hover {
            transform: translateY(-5px);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .status-pending {
            background-color: rgba(246, 194, 62, 0.2);
            color: var(--warning-color);
        }
        
        .status-processing {
            background-color: rgba(78, 115, 223, 0.2);
            color: var(--primary-color);
        }
        
        .status-shipped {
            background-color: rgba(111, 66, 193, 0.2);
            color: var(--secondary-color);
        }
        
        .status-delivered {
            background-color: rgba(28, 200, 138, 0.2);
            color: var(--success-color);
        }
        
        .status-cancelled {
            background-color: rgba(231, 74, 59, 0.2);
            color: var(--danger-color);
        }
        
        .status-completed {
            background-color: rgba(28, 200, 138, 0.2);
            color: var(--success-color);
        }
        
        .status-removed {
            background-color: rgba(231, 74, 59, 0.2);
            color: var(--danger-color);
            text-decoration: line-through;
        }
        
        .tracking-progress {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 30px 0;
            padding: 0 40px;
        }
        
        .tracking-progress::before {
            content: '';
            position: absolute;
            top: 12px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #e3e6f0;
            z-index: 1;
        }
        
        .progress-step {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 80px;
        }
        
        .step-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #e3e6f0;
            color: #b7b9cc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            position: relative;
            z-index: 2;
        }
        
        .step-text {
            font-size: 0.75rem;
            color: #b7b9cc;
            font-weight: 600;
        }
        
        .step-active .step-icon {
            background-color: var(--primary-color);
            color: white;
        }
        
        .step-active .step-text {
            color: var(--primary-color);
        }
        
        .step-completed .step-icon {
            background-color: var(--success-color);
            color: white;
        }
        
        .step-completed .step-text {
            color: var(--success-color);
        }
        
        .order-details-table th {
            background-color: #f8f9fc;
            font-weight: 600;
        }
        
        .admin-controls {
            background-color: #f8f9fc;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .user-info {
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.2);
        }
        #logoutbtn {
            background-color: #ff4d4f; /* Red color */
            color: #fff;               /* White text */
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            margin-left: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        #logoutbtn:hover {
            background-color: #e04344; /* Darker red on hover */
            transform: scale(1.05);
        }

        #logoutbtn:active {
            transform: scale(0.95);
        }

        
        @media (max-width: 768px) {
            .tracking-progress {
                padding: 0 20px;
            }
            
            .progress-step {
                width: 60px;
            }
            
            .step-text {
                font-size: 0.65rem;
            }
        }
    </style>
</head>
<body>>
    <?php 
        include 'header.php';
    ?>
    <!-- Main Content -->
    <div class="container tracking-container">
        <div class="search-box">
            <h2 class="mb-4"><i class="fas fa-search-location me-2"></i>Track Your Order</h2>
            <div class="row">
                <div class="col-md-8">
                    <form method="GET" action="orderDisplay.php" class="input-group">
                        <input type="number" class="form-control" placeholder="Enter your order ID" name="order_id" id="orderSearch" value="<?php echo $search_order_id > 0 ? $search_order_id : ''; ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search me-1"></i> Track Order
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <a href="orderDisplay.php" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-list me-1"></i> View All Orders
                    </a>
                </div>
            </div>
        </div>

        <?php if ($search_order_id > 0 && count($orders) > 0): ?>
        <!-- Order Tracking Details -->
        <?php foreach ($orders as $order): ?>
        <div class="card" id="orderTrackingCard">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order #<?php echo $order['id']; ?> Tracking</span>
                <span class="status-badge status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span>
            </div>
            <div class="card-body">
                <?php
                // Determine progress based on status
                $status_progress = [
                    'pending' => 1,
                    'processing' => 2,
                    'shipped' => 3,
                    'delivered' => 4,
                    'completed' => 5
                ];
                
                $current_progress = isset($status_progress[$order['status']]) ? $status_progress[$order['status']] : 0;
                ?>
                
                <div class="tracking-progress">
                    <div class="progress-step <?php echo $current_progress >= 1 ? 'step-completed' : ($current_progress == 1 ? 'step-active' : ''); ?>">
                        <div class="step-icon"><i class="fas fa-shopping-cart"></i></div>
                        <div class="step-text">Order Placed</div>
                    </div>
                    <div class="progress-step <?php echo $current_progress >= 2 ? 'step-completed' : ($current_progress == 3 ? 'step-active' : ''); ?>">
                        <div class="step-icon"><i class="fas fa-cog"></i></div>
                        <div class="step-text">Processing</div>
                    </div>
                    <div class="progress-step <?php echo $current_progress >= 3 ? 'step-completed' : ($current_progress == 4 ? 'step-active' : ''); ?>">
                        <div class="step-icon"><i class="fas fa-truck"></i></div>
                        <div class="step-text">Shipped</div>
                    </div>
                    <div class="progress-step <?php echo $current_progress >= 4 ? 'step-completed' : ($current_progress == 5 ? 'step-active' : ''); ?>">
                        <div class="step-icon"><i class="fas fa-home"></i></div>
                        <div class="step-text">Delivered</div>
                    </div>
                    <div class="progress-step <?php echo $current_progress >= 5 ? 'step-completed' : ($current_progress == 5 ? 'step-active' : ''); ?>">
                        <div class="step-icon"><i class="fas fa-home"></i></div>
                        <div class="step-text">Completed</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Order Date</th>
                                <td><?php echo date('M d, Y h:i A', strtotime($order['order_date'])); ?></td>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo htmlspecialchars($order['email']); ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo htmlspecialchars($order['mobile']); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Shipping Details</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Shipping Address</th>
                                <td><?php echo htmlspecialchars($order['address'] . ', ' . $order['city'] . ' ' . $order['zip_code']); ?></td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td><?php echo strtoupper($order['payment_method']); ?></td>
                            </tr>
                            <?php if (!empty($order['tracking_number'])): ?>
                            <tr>
                                <th>Tracking Number</th>
                                <td><?php echo htmlspecialchars($order['tracking_number']); ?></td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

                <h5 class="mt-4">Order Items</h5>
                <div class="table-responsive">
                    <table class="table table-bordered order-details-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch order items
                            $items_stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
                            $items_stmt->execute([$order['id']]);
                            $order_items = $items_stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            $subtotal = 0;
                            foreach ($order_items as $item):
                                $item_total = $item['price'] * $item['quantity'];
                                $subtotal += $item_total;
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>$<?php echo number_format($item_total, 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="3" class="text-end">Subtotal:</th>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                            <?php if ($order['discount_amount'] > 0): ?>
                            <tr>
                                <th colspan="3" class="text-end">Discount:</th>
                                <td>-$<?php echo number_format($order['discount_amount'], 2); ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <td>$<?php 
                                $total = $subtotal - $order['discount_amount'];
                                echo number_format($total, 2); 
                                ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php if ($is_admin): ?>
                <!-- Admin Controls (Only visible to admin users) -->
                <div class="admin-controls">
                    <h5><i class="fas fa-user-cog me-2"></i>Admin Controls</h5>
                    <form method="POST" action="orderDisplay.php?order_id=<?php echo $order['id']; ?>">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Update Order Status</label>
                                    <select class="form-select" name="status" id="statusSelect">
                                        <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                        <option value="shipped" <?php echo $order['status'] == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                        <option value="delivered" <?php echo $order['status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                        <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                        <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control" name="tracking_number" value="<?php echo !empty($order['tracking_number']) ? htmlspecialchars($order['tracking_number']) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Admin Notes</label>
                            <textarea class="form-control" name="admin_notes" rows="2"><?php echo !empty($order['admin_notes']) ? htmlspecialchars($order['admin_notes']) : ''; ?></textarea>
                        </div>
                        <button type="submit" name="update_status" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Order
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php elseif ($search_order_id > 0): ?>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i> No order found with ID <?php echo $search_order_id; ?>.
        </div>
        <?php endif; ?>

        <!-- All Orders List -->
        <div class="card" id="allOrdersCard">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i><?php echo $is_admin ? 'All Orders' : 'Your Recent Orders'; ?></h5>
            </div>
            <div class="card-body">
                <?php if (count($orders) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): 
                                // Count items in order
                                $items_count = 0;
                                if (!empty($order['products_quantities'])) {
                                    $quantities = explode(',', $order['products_quantities']);
                                    foreach ($quantities as $qty) {
                                        $items_count += intval(trim($qty));
                                    }
                                }
                            ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                                <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                                <td><?php echo $items_count; ?> items</td>
                                <td>$<?php echo !empty($order['order_total']) ? number_format($order['order_total'], 2) : '0.00'; ?></td>
                                <td><span class="status-badge status-<?php echo $order['status']; ?>"><?php echo ucfirst($order['status']); ?></span></td>
                                <td>
                                    <a href="orderDisplay.php?order_id=<?php echo $order['id']; ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h5>No orders found</h5>
                    <p class="text-muted">You haven't placed any orders yet.</p>
                    <a href="index.php" class="btn btn-primary">Start Shopping</a>
                </div>
                <?php endif; ?>
            </div>
            <form action="logout.php" method='POST'>
                <button type="submit" id="logoutbtn" name="logout" >Logout</button>
            </form>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update progress steps based on status
            function updateProgressSteps(status) {
                const steps = document.querySelectorAll('.progress-step');
                
                // Reset all steps
                steps.forEach(step => {
                    step.classList.remove('step-completed', 'step-active');
                });
                
                // Define status progression
                const statusProgress = {
                    'pending': 1,
                    'processing': 2,
                    'shipped': 3,
                    'delivered': 4,
                    'completed': 5
                };
                
                const currentProgress = statusProgress[status] || 0;
                
                // Update based on status
                for (let i = 0; i < steps.length; i++) {
                    if (i < currentProgress) {
                        steps[i].classList.add('step-completed');
                    } else if (i === currentProgress) {
                        steps[i].classList.add('step-active');
                    }
                }
            }
            
            // Initialize with the current status if we're viewing a specific order
            const statusElement = document.getElementById('statusSelect');
            if (statusElement) {
                const currentStatus = statusElement.value;
                updateProgressSteps(currentStatus);
                
                // Update progress when status changes
                statusElement.addEventListener('change', function() {
                    const status = this.value;
                    updateProgressSteps(status);
                });
            }
        });
    </script>
</body>
</html>

