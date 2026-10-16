<?php
declare(strict_types=1);

// Redirect /admin/ directly to leads.php
header('Location: leads.php', true, 302);
exit;
