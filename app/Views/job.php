<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <label for="lastname" class="form-label">mail</label>
    <input class="form-control" value="<?= $Benevoles['lastname']?>" id="lastname" type="text" name="lastname"  required>
    <input class="form-control" value="<?= $job['id']?>" id="lastname" type="hidden" name="lastname"  required>

    <?php foreach($has_conditions as $has_condition): ?>
        <?php if($job['id'] == $has_condition['id_jobs']): ?>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="check-<?= $condition[$has_condition['id_conditions']] ?>">
                <label class="form-check-label" for="check-<?= $condition['id'] ?>"><?= $condition['Question'] ?></label>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
     <button class="btn btn-primary d-flex mx-auto" onclick="condition('<?php echo csrf_hash() ?>')">Envoyer vos information</button>
</div>
<?= $this->endSection() ?>