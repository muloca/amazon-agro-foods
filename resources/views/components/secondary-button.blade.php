<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-amazon-verde-300 dark:border-amazon-verde-500 rounded-md font-semibold text-xs text-amazon-verde-700 dark:text-amazon-verde-300 uppercase tracking-widest shadow-sm hover:bg-amazon-verde-50 dark:hover:bg-amazon-verde-700 focus:outline-none focus:ring-2 focus:ring-amazon-verde-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
