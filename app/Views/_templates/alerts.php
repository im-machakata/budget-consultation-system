<?php
if (isset($this->data['errors'])) :
    $this->setVar('error', $this->data['errors']);
    echo $this->include('_templates/alerts/errors');
elseif (isset($this->data['success'])) :
    $this->setVar('success', $this->data['success']);
    echo $this->include('_templates/alerts/success');
endif;
