<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verify admin is logged in - matches your login.php session structure
if (!isset($_SESSION['user']) || $_SESSION['user']['email'] !== 'admin@example.com') {
    header('Location: login.php');
    exit;
}

// Database connection - adjust path as needed
require_once __DIR__ . '/inc/config.php';

// Handle form submission
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['add_prize'])) {
            $name = strip_tags($_POST['name']);
            $description = strip_tags($_POST['description']);
            $discountType = $_POST['discount_type'];
            $discountValue = (float)$_POST['discount_value'];
            $probability = (int)$_POST['probability'];
            $isActive = isset($_POST['is_active']) ? 1 : 0;
            
            $stmt = $pdo->prepare("INSERT INTO spin_wheel_prizes 
                                  (name, description, discount_type, discount_value, probability, is_active) 
                                  VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $discountType, $discountValue, $probability, $isActive]);
            
            $_SESSION['success'] = 'Prize added successfully';
        } 
        elseif (isset($_POST['update_prize'])) {
            $id = (int)$_POST['id'];
            $name = strip_tags($_POST['name']);
            $description = strip_tags($_POST['description']);
            $discountType = $_POST['discount_type'];
            $discountValue = (float)$_POST['discount_value'];
            $probability = (int)$_POST['probability'];
            $isActive = isset($_POST['is_active']) ? 1 : 0;
            
            $stmt = $pdo->prepare("UPDATE spin_wheel_prizes 
                                  SET name = ?, 
                                      description = ?, 
                                      discount_type = ?, 
                                      discount_value = ?, 
                                      probability = ?, 
                                      is_active = ? 
                                  WHERE id = ?");
            $stmt->execute([$name, $description, $discountType, $discountValue, $probability, $isActive, $id]);
            
            $_SESSION['success'] = 'Prize updated successfully';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }
    
    header('Location: spin.php');
    exit;
}

// Handle delete action
if (isset($_GET['delete'])) {
    try {
        $id = (int)$_GET['delete'];
        
        // First check if prize exists
        $stmt = $pdo->prepare("SELECT id FROM spin_wheel_prizes WHERE id = ?");
        $stmt->execute([$id]);
        $prize = $stmt->fetch();
        
        if ($prize) {
            $stmt = $pdo->prepare("DELETE FROM spin_wheel_prizes WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['success'] = 'Prize deleted successfully';
        } else {
            $_SESSION['error'] = 'Prize not found';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }
    
    header('Location: spin.php');
    exit;
}

// Fetch prizes
try {
    $prizes = $pdo->query("SELECT * FROM spin_wheel_prizes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $prizes = [];
    $_SESSION['error'] = "Failed to load prizes: " . $e->getMessage();
}
// Fetch all prizes
// $prizes = $pdo->query("SELECT * FROM spin_wheel_prizes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Spin Wheel Prizes</title>
    <!-- Your admin CSS and JS includes -->
</head>
<body>
    <div class="container">
        <h1>Spin Wheel Prizes Management</h1>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Add New Prize</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Prize Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Discount Type</label>
                                <select name="discount_type" class="form-control" required>
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Discount Value</label>
                                <input type="number" step="0.01" name="discount_value" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Probability (1-100)</label>
                                <input type="number" min="1" max="100" name="probability" class="form-control" required value="10">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="isActive" checked>
                                <label class="form-check-label" for="isActive">Active</label>
                            </div>
                            <button type="submit" name="add_prize" class="btn btn-primary">Add Prize</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Existing Prizes</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Discount</th>
                                    <th>Probability</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($prizes as $prize): ?>
                                <tr>
                                    <td><?= htmlspecialchars($prize['name']) ?></td>
                                    <td><?= $prize['discount_value'] ?><?= $prize['discount_type'] === 'percentage' ? '%' : '$' ?></td>
                                    <td><?= $prize['probability'] ?>%</td>
                                    <td><?= $prize['is_active'] ? 'Active' : 'Inactive' ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary edit-prize" data-id="<?= $prize['id'] ?>">Edit</a>
                                        <a href="?delete=<?= $prize['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Prize Modal -->
    <div class="modal fade" id="editPrizeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Prize</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group">
                            <label>Prize Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="editDescription" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Discount Type</label>
                            <select name="discount_type" id="editDiscountType" class="form-control" required>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed Amount</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Discount Value</label>
                            <input type="number" step="0.01" name="discount_value" id="editDiscountValue" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Probability (1-100)</label>
                            <input type="number" min="1" max="100" name="probability" id="editProbability" class="form-control" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="is_active" id="editIsActive" class="form-check-input">
                            <label class="form-check-label" for="editIsActive">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_prize" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    $(document).ready(function() {
        $('.edit-prize').click(function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            
            // Fetch prize data via AJAX
            $.get('get-prize.php?id=' + id, function(data) {
                $('#editId').val(data.id);
                $('#editName').val(data.name);
                $('#editDescription').val(data.description);
                $('#editDiscountType').val(data.discount_type);
                $('#editDiscountValue').val(data.discount_value);
                $('#editProbability').val(data.probability);
                $('#editIsActive').prop('checked', data.is_active == 1);
                
                $('#editPrizeModal').modal('show');
            });
        });
    });
    </script>
</body>
</html>