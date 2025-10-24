<?php require_once('header.php'); ?>
<?php require_once('../config.php'); // adjust this path as needed ?>

<section class="content-header">
  <div class="content-header-left">
    <h1>View Blogs</h1>
  </div>
  <div class="content-header-right">
    <a href="blog-add.php" class="btn btn-primary btn-sm">Add Blog</a>
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
                <th>#</th>
                <th>Blog Image</th>
                <th>Heading</th>
                <th>Category</th>
                <th>Author</th>
                <th>Date</th>
                <th>Status</th>
                <th width="140">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 0;
              $stmt = $pdo->prepare("SELECT * FROM blogs ORDER BY date DESC");
              $stmt->execute();
              $blogs = $stmt->fetchAll();
              foreach ($blogs as $blog) {
                $i++;
              ?>
                <tr>
                  <td><?= $i ?></td>
                  <td style="width:120px;">
                    <img src="../<?= htmlspecialchars($blog['blog_img']) ?>" alt="Blog Image" style="width:100px;" />
                  </td>
                  <td><?= htmlspecialchars($blog['heading']) ?></td>
                  <td><?= htmlspecialchars($blog['blog_name']) ?></td>
                  <td>
                    <img src="../<?= htmlspecialchars($blog['auther_img']) ?>" alt="Author Image" class="img-circle" style="width:30px; height:30px; object-fit:cover;">
                    <?= htmlspecialchars($blog['auther_name']) ?>
                  </td>
                  <td><?= date('F j, Y', strtotime($blog['date'])) ?></td>
                  <td>Active</td>
                  <td>
                    <a href="blog-edit.php?id=<?= $blog['id'] ?>" class="btn btn-primary btn-xs">Edit</a>
                    <a href="#" class="btn btn-danger btn-xs" data-href="blog-delete.php?id=<?= $blog['id'] ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this blog?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>

<?php require_once('footer.php'); ?>
