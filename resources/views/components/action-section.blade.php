<div {{ $attributes->merge(['class' => 'mb-5 px-5 md:grid md:grid-cols-6 md:gap-12']) }}>
    <!-- <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title> -->

    <div class=" md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
