@php $iconVariant = $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@props([
    'iconVariant' => 'solid',
    'initials' => null,
    'tooltip' => null,
    'circle' => null,
    'color' => null,
    'badge' => null,
    'name' => null,
    'icon' => null,
    'size' => 'md',
    'src' => null,
    'href' => null,
    'alt' => null,
    'as' => 'div',
])

@php
if ($name && ! $initials) {
    $parts = explode(' ', trim($name));
    if ($attributes->pluck('initials:single')) {
        $initials = strtoupper(mb_substr($parts[0], 0, 1));
    } else {
        $parts = collect($parts)->filter()->values()->all();
        if (count($parts) > 1) {
            $initials = strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[1], 0, 1));
        } else if (count($parts) === 1) {
            $initials = strtoupper(mb_substr($parts[0], 0, 1)) . strtolower(mb_substr($parts[0], 1, 1));
        }
    }
}

if ($name && $tooltip === true) $tooltip = $name;

$hasTextContent = $icon ?? $initials ?? $slot->isNotEmpty();
if (! $hasTextContent) {
    $icon = 'user';
    $hasTextContent = true;
}

$colors = ['red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'];

if ($hasTextContent && $color === 'auto') {
    $colorSeed = $attributes->pluck('color:seed') ?? $name ?? $icon ?? $initials ?? $slot;
    $hash = crc32((string) $colorSeed);
    $color = $colors[$hash % count($colors)];
}

$classes = Flux::classes()
    ->add(match($size) {
        'xl' => '[:where(&)]:size-16 [:where(&)]:text-base',
        'lg' => '[:where(&)]:size-12 [:where(&)]:text-base',
        default => '[:where(&)]:size-10 [:where(&)]:text-sm',
        'sm' => '[:where(&)]:size-8 [:where(&)]:text-sm',
        'xs' => '[:where(&)]:size-6 [:where(&)]:text-xs',
    })
    ->add($circle ? '[--avatar-radius:calc(infinity*1px)]' : match($size) {
        'xl' => '[--avatar-radius:var(--radius-xl)]',
        'lg' => '[--avatar-radius:var(--radius-lg)]',
        default => '[--avatar-radius:var(--radius-lg)]',
        'sm' => '[--avatar-radius:var(--radius-md)]',
        'xs' => '[--avatar-radius:var(--radius-sm)]',
    })
    ->add('relative flex-none isolate flex items-center justify-center')
    ->add('[:where(&)]:font-medium rounded-[var(--avatar-radius)]')
    ->add($hasTextContent ? '[:where(&)]:bg-zinc-200 [:where(&)]:dark:bg-zinc-600 [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white' : '')
    ->add(match($color) {
        'red' => 'bg-red-200 text-red-800',
        'orange' => 'bg-orange-200 text-orange-800',
        'amber' => 'bg-amber-200 text-amber-800',
        'yellow' => 'bg-yellow-200 text-yellow-800',
        'lime' => 'bg-lime-200 text-lime-800',
        'green' => 'bg-green-200 text-green-800',
        'emerald' => 'bg-emerald-200 text-emerald-800',
        'teal' => 'bg-teal-200 text-teal-800',
        'cyan' => 'bg-cyan-200 text-cyan-800',
        'sky' => 'bg-sky-200 text-sky-800',
        'blue' => 'bg-blue-200 text-blue-800',
        'indigo' => 'bg-indigo-200 text-indigo-800',
        'violet' => 'bg-violet-200 text-violet-800',
        'purple' => 'bg-purple-200 text-purple-800',
        'fuchsia' => 'bg-fuchsia-200 text-fuchsia-800',
        'pink' => 'bg-pink-200 text-pink-800',
        'rose' => 'bg-rose-200 text-rose-800',
        default => '',
    });
@endphp

<flux:with-tooltip :$tooltip :$attributes>
    <flux:button-or-link :attributes="$attributes->class($classes)" :$as :$href>
        @if ($src)
            <img src="{{ $src }}" alt="{{ $alt ?? $name }}" class="rounded-[var(--avatar-radius)]">
        @elseif ($icon)
            <flux:icon :name="$icon" :variant="$iconVariant" class="opacity-75" />
        @elseif ($hasTextContent)
            <span class="select-none">{{ $initials ?? $slot }}</span>
        @endif
    </flux:button-or-link>
</flux:with-tooltip>