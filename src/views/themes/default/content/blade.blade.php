@php
$php = \Illuminate\Support\Facades\Blade::compileString($content->content);
ob_start();

try {
    eval('?>' . $php);
} catch(\Exception $e) {
    // Todo: create an exception to handle this, and to return a meaningful error.
    ob_get_clean();
    throw $e;
}

$return = ob_get_clean();

echo $return;
@endphp