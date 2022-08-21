<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Task</h1>
<ol class="breadcrumb mb-4">
 <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
 <li class="breadcrumb-item active">Task</li>
</ol>
<div class="row pt-5">
  <div class="pb-2 row">
    <a type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btnadd position-absolute end-50 btn-outline-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  <table id="Task-table">
    <thead>
      <tr>
        <th>id</th>
        <th>start</th>
        <th>end</th>
        <th>place_start</th>
        <th>id_benevoles</th>
        <th>description</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($Tasks as $Task) : ?>
        <tr>
          <td><?= $Task['id'] ?></td>
          <td><?= $Task['start'] ?></td>
          <td><?= $Task['end'] ?></td>
          <td><?= $Task['place_start'] ?></td>
          <?php foreach ($id_benevoles as $id_Benevoles) : ?>
        <?php if ($id_Benevoles['id'] ==$Planning['id_benevoles']):?>
          <td><?= $id_Benevoles['firstname'] ?></td>
          <td><?= $id_Benevoles['lastname'] ?></td>
        <?php endif; ?>
        <?php endforeach; ?>
        <td><?= $Task['description'] ?></td>
          <td><button type="button" class="btn btn-outline-success" onclick="modify_Tasks('<?= $Task['id'] ?>', '<?= $Task['start'] ?>', '<?= $Task['end'] ?>', '<?= $Task['place_start'] ?>', '<?= $Task['id_benevoles'] ?>', '<?= $Task['description'] ?>')" data-bs-toggle="modal" data-bs-target="#modify-modal"><i class="fa-solid fa-pen"></i></button></td>
          <td><button type="button" class="btn btn-outline-success" onclick="delete_modal('<?= $Task['id'] ?>')" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can"></i></button></td>
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
          <h4 class="modal-title">Add Task</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-start" class="form-label">start</label>
            <input class="form-control" type="datetime" id="add-start" name="add-start" placeholder="start">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-end" class="form-label">end</label>
            <input class="form-control" type="datetime" id="add-end" name="add-end" placeholder="end">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-place_start" class="form-label">place_start</label>
            <input class="form-control" type="text" id="add-place_start" name="add-place_start" placeholder="place_start">
          </div>
          <select class="form-select" id="add-id_benevoles" name="add-id_benevoles">
              <?php foreach ($id_benevoles as $id_Benevoles) : ?>
                <option value="<?= $id_Benevoles['id'] ?>"><?= $id_Benevoles['firstname'] ?>
                <?= $id_Benevoles['lastname'] ?></option>
              <?php endforeach; ?>
            </select>
          <div class="mb-3 d-grid text-center form-group">
            <label for="add-description" class="form-label">description</label>
            <input class="form-control" type="text" id="add-description" name="add-description" placeholder="description">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="add_Tasks('<?php echo csrf_hash() ?>')">ajouter</button>
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
          <h4 class="modal-title">Modifier Tasks</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id" class="form-label d-none">id</label>
            <input class="form-control d-none" type="text" id="modify-id" name="modify-id" value="id" value="<?= $Task['id'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-start" class="form-label">start</label>
            <input class="form-control" type="datetime" id="modify-start" name="modify-start" value="<?= $Task['start'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-end" class="form-label">end</label>
            <input class="form-control" type="datetime" id="modify-end" name="modify-end" value="<?= $Task['end'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-place_start" class="form-label">place_start</label>
            <input class="form-control" type="text" id="modify-place_start" name="modify-place_start" value="<?= $Task['place_start'] ?>">
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-id_benevoles" class="form-label">id_benevoles</label>
            <select class="form-select" id="modify-id_benevoles" name="modify-id_benevoles">
            <?php foreach ($id_benevoles as $id_Benevoles) : ?>
                <option value="<?= $id_Benevoles['id'] ?>"><?= $id_Benevoles['firstname'] ?>
                <?= $id_Benevoles['lastname'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 d-grid text-center form-group">
            <label for="modify-description" class="form-label">description</label>
            <input class="form-control" type="text" id="modify-description" name="modify-description" value="<?= $Task['description'] ?>">
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="modify_Tasks($('#modify-modal').data('id'),'<?php echo csrf_hash() ?>')">modifié</button>
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
          <h4 class="modal-title">delete Tasks</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 d-grid text-center form-group">
            êtes vous sûr de vouloir supprimer ce Tasks ?
          </div>
          <button class="btn btn-primary d-flex mx-auto" onclick="delete_Tasks($('#delete-modal').data('id'),'<?php echo csrf_hash() ?>')">delete</button>
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
