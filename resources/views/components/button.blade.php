@php
$tag = 'button';
$link = $link ?? '';
$label = $label ?? 'Label';
$attributes = $attributes ?? [];
$attributes_string = '';

foreach ($attributes as $attribute => $value) {
    $attributes_string .= $attribute . ($value ? '=' . $value . ' ' : '');
}
$attributes_string = rtrim($attributes_string);

if ($link) {
    $tag = 'a';
    $attributes_string = "href='$link' target='_blank' " . $attributes_string;
}

@endphp

<{{ $tag }}
{{ $attributes_string }}
class="@formatclasses("
    min-w-32 h-11
    px-4
    inline-block
    bg-[#230235] hover:bg-[#2b0c3d] active:bg-[#230235]
    active:outline-none active:ring-1 active:ring-[#4d335c]
    border border-[#ffffff1a] rounded-md
    leading-10
    transition ease-in-out duration-200
")">
    {{ $label }}

</{{ $tag }}>

