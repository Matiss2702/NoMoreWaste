<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Admins</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Admins</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="product-table">
    <thead>
      <tr>
        <th>id</th>
        <th>mail</th>
        <th>password</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($admins as $admin) : ?>
        <tr>
          <td><?= $admin['id'] ?></td>
          <td><?= $admin['mail'] ?></td>
          <td><?= $admin['password'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_admins('<?= $admin['id'] ?>', '<?= $admin['mail'] ?>', '<?= $admin['password'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $admin['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <script>
    $(document).ready(function() {
      $('#product-table').DataTable();
      $('#product-table_wrapper').addClass("none");
    });
  </script>

  <div class="modal" id="add-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add admin</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" placeholder="id" value="<?= $admin['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-mail" class="form-label">mail</label>
            <input class="form-control" type="mail" id="add-name" name="add-mail" placeholder="mail">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-password" class="form-label">password</label>
            <input class="form-control" type="password" id="add-password" name="add-password" placeholder="password">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_admins('<?php echo csrf_hash() ?>')">ajouter</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modify-modal" data-id="">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modifier admin</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label">id</label>
            <input class="form-control -d none" type="text" id="modify-id" name="modify-id" placeholder="id" value="<?= $company['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-mail" class="form-label">mail</label>
            <input class="form-control" type="mail" id="modify-mail" name="modify-mail" placeholder="mail">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-password" class="form-label">password</label>
            <input class="form-control" type="password" id="modify-password" name="modify-password" placeholder="password">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_admins($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifer</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="delete-modal" data-id="">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">delete admin</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer cette admin ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_admins($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
          <button class="btn btn-danger d-flex mx-auto" data-bs-dismiss="modal">cancel</button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

</div>
<?= $this->endSection() ?>
