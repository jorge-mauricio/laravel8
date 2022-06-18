{{-- 
@php
@endphp
--}}
<?php
// Admin layout definition.
$masterPageSelect = $_GET['masterPageSelect'];
if (empty($masterPageSelect)) {
    $masterPageSelect = $_POST['masterPageSelect'];
} 
if (empty($masterPageSelect)) {
    $masterPageSelect = 'layout-admin-main';
}
?>

@php
@endphp
