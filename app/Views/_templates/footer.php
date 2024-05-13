<?php
helper('filesystem');
if (!function_exists('get_file_date')) {
    function get_file_date($file): int
    {
        return get_file_info(APPPATH . '../public/' . $file, 'date')['date'];
    }
} ?>
</body>
<script src="/static/js/bootstrap.bundle.min.js?version=5.3.3" defer></script>
<script src="/static/js/app.js?cache=<?= get_file_date('static/js/app.js') ?>" defer async></script>
</html>