<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary btn']) }}>
    {{ $slot }}
</button>
