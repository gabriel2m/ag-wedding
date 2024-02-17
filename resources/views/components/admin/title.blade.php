@props(['text'])

<h3 {{ $attributes->class(['leading-none']) }}>
    @lang($text)
</h3>
