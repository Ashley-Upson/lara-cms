@php
$php = \Illuminate\Support\Facades\Blade::compileString($content->content);

$bannedFunctions = [
    'env',
    'app',
    'config'
];

foreach($bannedFunctions as $function) {
    $php = str_replace('e(' . $function, 'e(e', $php);
}

try {
    ob_start();
    eval('?>' . $php);
    $return = ob_get_clean();
    echo $return;
} catch(\Exception $e) {
    // Todo: create an exception to handle this, and to return a meaningful error.
    ob_get_clean();
    throw $e;
}

@endphp