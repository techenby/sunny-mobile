@props(['withBack' => false, 'title' => 'Title Please'])

<div {{ $attributes->merge(['class' => 'sticky top-0 px-4 pb-4 space-y-4 pt-12 z-50 backdrop-blur-md']) }}>
    <div class="flex items-center">
        @if ($withBack)
        <flux:button :href="$withBack" icon="arrow-left" class="mr-2"/>
        @endif

        <flux:heading level="1" size="xl">{{ $title }}</flux:heading>
    </div>

    {{ $slot }}
</div>
