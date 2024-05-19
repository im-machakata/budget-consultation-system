<?php if ($this->data['success']) : ?>
    <div class="col-12">
        <div class="border-top border-bottom border-2 border-success p-2 py-3 mb-3 text-center">
            <?= esc($this->data['success']); ?>
        </div>
    </div>
<?php endif;
