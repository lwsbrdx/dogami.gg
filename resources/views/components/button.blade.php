@php
$tag = 'button';
$link = $link ?? '';
$label = $label ?? 'Label';
$disabled = $disabled ?? false;
$attributes = $attributes ?? [];
$attributes_string = '';

foreach ($attributes as $attribute => $value) {
    $attributes_string .= $attribute . ($value ? '=' . $value . ' ' : '');
}
$attributes_string = rtrim($attributes_string);

if ($link) {
    $tag = 'a';
    $attributes_string = "href=$link target=_blank $attributes_string";
}
@endphp

<{{ $tag }}
{{ $disabled ? 'disabled=disabled'  : '' }}
{{ $attributes_string }}
class="disabled:opacity-60 disabled:cursor-not-allowed min-w-32 max-w-64 h-11 px-4 inline-block bg-[#230235] enabled:hover:bg-[#2b0c3d] enabled:active:bg-[#230235] enabled:active:outline-none enabled:active:ring-1 enabled:active:ring-[#4d335c] border border-[#ffffff1a] rounded-md leading-10 transition ease-in-out duration-200">
    {{ $label }}
</{{ $tag }}>

