<?php
function view(string $filename, array $data = []): void
{
    extract($data);
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}
?>