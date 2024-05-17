<?php

namespace App\Validation;

use App\ThirdParty\CommentsModerator;
use Exception;

class CommentClean
{
    public function comment_safe($value, ?string &$error = null): bool
    {
        try {
            $commentStatus = CommentsModerator::check($value);
            if (!$commentStatus->safe) $error = $commentStatus->error_message;
            return $commentStatus->safe;
        } catch (Exception $e) {
            return true;
        }
    }
}
