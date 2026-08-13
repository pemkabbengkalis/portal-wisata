<?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    
    

    <?php
        // Feather icon SVG paths
        $fi = [
            'download' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line>',
            'upload' => '<polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>',
            'folder' => '<path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>',
            'trash' => '<polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line>',
            'hard-drive' => '<line x1="22" y1="12" x2="2" y2="12"></line><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path><line x1="6" y1="16" x2="6.01" y2="16"></line><line x1="10" y1="16" x2="10.01" y2="16"></line>',
            'loader' => '<line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>',
        ];

        // Helper closure: render feather SVG
        $icon = fn(string $name, string $cls = 'h-2.5 w-2.5') =>
            '<svg xmlns="http://www.w3.org/2000/svg"
                                class="feather ' . $cls . '"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">'
            . $fi[$name] .
            '</svg>';
    ?>


    
    <div class="mb-4 rounded-md border border-cyan-200 bg-cyan-50 px-3 py-2 text-xs text-gray-700">
        <p class="leading-5">
            Backup akan diekspor sebagai file <strong>.zip</strong> berisi file SQL
            (Smart SQL) dan media <strong>storage/</strong> ter-embed.
            Import akan mengekstrak file ZIP dan merestore data secara statis
            (menggunakan ID asli).
        </p>

        <p class="mt-0.5 text-[11px] text-gray-500">
            <strong>Host:</strong> <?php echo e(config('app.url')); ?>

        </p>
    </div>


    
    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">


        
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">

            <h2 class="mb-3 flex items-center gap-1.5 text-sm font-semibold text-gray-800">
                <?php echo $icon('download', 'h-2.5 w-2.5 text-gray-600'); ?>

                Export
            </h2>


            
            <label class="mb-3 flex cursor-pointer select-none items-center gap-1.5 text-xs text-gray-700">
                <input type="checkbox" wire:model="includeUsers"
                    class="h-3.5 w-3.5 rounded border-gray-300 text-blue-600 focus:ring-1 focus:ring-blue-500">

                <span>
                    Include tabel
                    <strong class="ml-0.5 text-blue-600">users</strong>
                </span>
            </label>


            
            <button type="button" wire:click="runExport" wire:loading.attr="disabled" wire:target="runExport" class="inline-flex items-center gap-1.5 rounded-md bg-blue-600 px-3 py-1.5 text-xs font-semibold
                       text-white shadow-sm transition hover:bg-blue-700 active:bg-blue-800 disabled:opacity-60">

                
                <span wire:loading.remove wire:target="runExport">
                    <?php echo $icon('upload', 'h-2.5 w-2.5'); ?>

                </span>

                
                <span wire:loading wire:target="runExport">
                    <?php echo str_replace(
    'class="feather',
    'class="feather animate-spin',
    $icon('loader', 'h-2.5 w-2.5')
); ?>

                </span>

                <span wire:loading.remove wire:target="runExport">
                    Proses Export
                </span>

                <span wire:loading wire:target="runExport">
                    Memproses…
                </span>

            </button>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($exportStatus): ?>
                <p class="mt-1.5 text-[11px] italic text-gray-500">
                    <?php echo e($exportStatus); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>


        
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">

            <h2 class="mb-3 flex items-center gap-1.5 text-sm font-semibold text-gray-800">
                <?php echo $icon('upload', 'h-2.5 w-2.5 text-gray-600'); ?>

                Import
            </h2>


            
            <p class="mb-1.5 text-xs text-gray-600">
                File Backup (.zip)
            </p>


            <label class="relative mb-3 inline-flex cursor-pointer items-center gap-1.5 rounded-md
                       border border-blue-300 bg-white px-3 py-1.5 text-xs font-medium
                       text-blue-600 shadow-sm transition hover:bg-blue-50">
                <?php echo $icon('folder', 'h-2.5 w-2.5'); ?>


                <span class="max-w-[220px] truncate">
                    <?php echo e($uploadedBackup
    ? $uploadedBackup->getClientOriginalName()
    : 'Pilih / Upload Media'); ?>

                </span>

                <input type="file" wire:model="uploadedBackup" accept=".zip" class="sr-only">
            </label>


            
            <div class="mb-3 space-y-1.5">

                <label class="flex cursor-pointer select-none items-center gap-1.5 text-xs text-gray-700">
                    <input type="checkbox" wire:model="replaceScope"
                        class="h-3.5 w-3.5 rounded border-gray-300 text-blue-600 focus:ring-1 focus:ring-blue-500">

                    Replace data scope ini sebelum import
                </label>


                <label class="flex cursor-pointer select-none items-center gap-1.5 text-xs text-gray-700">
                    <input type="checkbox" wire:model="replaceAllTable"
                        class="h-3.5 w-3.5 rounded border-gray-300 text-blue-600 focus:ring-1 focus:ring-blue-500">

                    Replace seluruh table non-tenant
                    <span class="text-[10px] text-red-500">(semua data hilang)</span>
                </label>


                <label class="flex cursor-pointer select-none items-center gap-1.5 text-xs text-gray-700">
                    <input type="checkbox" wire:model="replaceUsers"
                        class="h-3.5 w-3.5 rounded border-gray-300 text-blue-600 focus:ring-1 focus:ring-blue-500">

                    Timpa data Users dengan yang ada di backup
                </label>

            </div>


            
            <button type="button" wire:click="runImport" wire:loading.attr="disabled"
                wire:target="runImport,uploadedBackup" class="inline-flex items-center gap-1.5 rounded-md bg-teal-600 px-3 py-1.5 text-xs font-semibold
                       text-white shadow-sm transition hover:bg-teal-700 active:bg-teal-800 disabled:opacity-60">

                <span wire:loading.remove wire:target="runImport">
                    <?php echo $icon('download', 'h-2.5 w-2.5'); ?>

                </span>

                <span wire:loading wire:target="runImport">
                    <?php echo str_replace(
    'class="feather',
    'class="feather animate-spin',
    $icon('loader', 'h-2.5 w-2.5')
); ?>

                </span>

                <span wire:loading.remove wire:target="runImport">
                    Jalankan Import
                </span>

                <span wire:loading wire:target="runImport">
                    Memproses…
                </span>

            </button>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($importStatus): ?>
                <p class="mt-1.5 text-[11px] italic text-gray-500">
                    <?php echo e($importStatus); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>


        
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">

            <h2 class="mb-3 flex items-center gap-1.5 text-sm font-semibold text-gray-800">
                <?php echo $icon('folder', 'h-2.5 w-2.5 text-gray-600'); ?>

                Daftar Backup Lokal
            </h2>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($localBackups)): ?>

                <p class="text-xs italic text-gray-400">
                    Belum ada file backup.
                </p>

            <?php else: ?>

                <div class="overflow-x-auto">

                    <table class="w-full text-xs">

                        <thead>
                            <tr class="border-b border-gray-100">

                                <th class="py-1.5 pr-2 text-left font-semibold text-gray-700">
                                    Nama File
                                </th>

                                <th class="py-1.5 pr-2 text-left font-semibold text-gray-700">
                                    Ukuran
                                </th>

                                <th class="py-1.5 pr-2 text-left font-semibold text-gray-700">
                                    Tanggal
                                </th>

                                <th class="py-1.5 text-left font-semibold text-gray-700">
                                    Aksi
                                </th>

                            </tr>
                        </thead>


                        <tbody class="divide-y divide-gray-50">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $localBackups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                                <tr class="transition hover:bg-gray-50">

                                    <td class="py-1.5 pr-2 font-mono text-[11px] text-gray-700">
                                        <?php echo e($backup['name']); ?>

                                    </td>

                                    <td class="py-1.5 pr-2 text-[11px] text-gray-500">
                                        <?php echo e($backup['size']); ?>

                                    </td>

                                    <td class="py-1.5 pr-2 text-[11px] text-gray-500">
                                        <?php echo e($backup['date']); ?>

                                    </td>

                                    <td class="py-1.5">

                                        <div class="flex items-center gap-1">

                                            
                                            <button type="button" wire:click="downloadBackup('<?php echo e($backup['name']); ?>')" class="inline-flex h-7 w-7 items-center justify-center rounded
                                                                       bg-blue-600 text-white transition hover:bg-blue-700"
                                                title="Download">
                                                <?php echo $icon('download', 'h-2.5 w-2.5'); ?>

                                            </button>


                                            
                                            <button type="button" wire:click="deleteBackup('<?php echo e($backup['name']); ?>')"
                                                wire:confirm="Yakin hapus file backup ini?" class="inline-flex h-7 w-7 items-center justify-center rounded
                                                                       bg-red-100 text-red-600 transition hover:bg-red-200"
                                                title="Hapus">
                                                <?php echo $icon('trash', 'h-2.5 w-2.5'); ?>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        </tbody>

                    </table>

                </div>


                <p class="mt-2 text-[10px] italic text-gray-400">
                    Backup lokal otomatis dibersihkan setiap 1 hari.
                </p>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>


        
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">

            <h2 class="mb-3 flex items-center gap-1.5 text-sm font-semibold text-gray-800">
                <?php echo $icon('hard-drive', 'h-2.5 w-2.5 text-gray-600'); ?>

                Daftar Backup Google Drive
            </h2>


            <div class="rounded-md border border-yellow-200 bg-yellow-50 px-3 py-2 text-xs text-gray-700">

                Google Drive belum dikonfigurasi.
                Silakan konfigurasi melalui menu

                <strong class="text-yellow-700">
                    Setting → Website
                </strong>

                pada tab Google Drive.

            </div>

        </div>

    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\portal-wisata\resources\views/filament/admin/pages/backup-restore.blade.php ENDPATH**/ ?>