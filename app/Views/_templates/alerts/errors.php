<?php if ($this->data['error']) : ?>
    <div class="col-12">
        <div class="border-bottom border-top border-danger border-2 text-center text-danger p-2 py-3 mb-3">
            <?php
            $errors = $this->data['error'];
            if (is_array($errors)) {
                $errorIds = array_keys($errors);
                $error = $errors[$errorIds[0]];
            } else if (is_string($errors)) {
                $error = $errors;
            }
            // print just the first error message
            echo esc($error); ?>
        </div>
    </div>
<?php endif;
