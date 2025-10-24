<?php require_once('header.php'); ?>

<?php
// Define FAQ categories
$categories = [
    'orders' => 'Orders & Shipping',
    'returns' => 'Returns & Exchanges',
    'account' => 'Account & Payment',
    'products' => 'Products & Sizing'
];

if(isset($_POST['form1'])) {
    $valid = 1;

    if(empty($_POST['question'])) {
        $valid = 0;
        $error_message .= 'Title cannot be empty<br>';
    }

    if(empty($_POST['answer'])) {
        $valid = 0;
        $error_message .= 'Content cannot be empty<br>';
    }

    if(empty($_POST['category'])) {
        $valid = 0;
        $error_message .= 'Category must be selected<br>';
    }

    if($valid == 1) {
        $statement = $pdo->prepare("INSERT INTO tbl_faq (question, answer, category, sort_order) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $_POST['question'],
            $_POST['answer'],
            $_POST['category'],
            $_POST['sort_order']
        ]);
            
        $success_message = 'FAQ added successfully!';
        
        // Clear form
        unset($_POST['question']);
        unset($_POST['answer']);
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add FAQ</h1>
    </div>
    <div class="content-header-right">
        <a href="faq.php" class="btn btn-primary btn-sm">View All FAQs</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if($error_message): ?>
            <div class="callout callout-danger">
                <p><?php echo $error_message; ?></p>
            </div>
            <?php endif; ?>

            <?php if($success_message): ?>
            <div class="callout callout-success">
                <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Category <span>*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" name="category" required>
                                    <option value="">Select Category</option>
                                    <?php foreach($categories as $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php echo (isset($_POST['category']) && $_POST['category'] == $key) ? 'selected' : ''; ?>>
                                        <?php echo $value; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="question" value="<?php echo isset($_POST['question']) ? htmlspecialchars($_POST['question']) : ''; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Content <span>*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="answer" id="editor1" style="height:200px;" required><?php echo isset($_POST['answer']) ? htmlspecialchars($_POST['answer']) : ''; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Sort Order</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="sort_order" value="<?php echo isset($_POST['sort_order']) ? $_POST['sort_order'] : 0; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>