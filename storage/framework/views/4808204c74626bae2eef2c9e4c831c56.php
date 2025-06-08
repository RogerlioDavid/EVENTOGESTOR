<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Panel del Organizador</h1>

    
    <button onclick="openCreateEventModal()" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Crear nuevo evento</button>

    
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nombre</th>
                <th class="py-2 px-4 border-b">Fecha</th>
                <th class="py-2 px-4 border-b">Imagen</th>
                <th class="py-2 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo e($evento->nombre); ?></td>
                    <td class="border px-4 py-2"><?php echo e($evento->fecha); ?></td>
                    <td class="border px-4 py-2">
                        <?php if($evento->imagen): ?>
                            <img src="<?php echo e(asset('storage/' . $evento->imagen)); ?>" alt="Imagen" class="h-16">
                        <?php endif; ?>
                    </td>
                    <td class="border px-4 py-2">
                        <button onclick="toggleTareas(<?php echo e($evento->id); ?>)" class="bg-green-500 text-white px-2 py-1 rounded">Ver tareas</button>
                        <button onclick="openAddTareaModal(<?php echo e($evento->id); ?>)" class="bg-yellow-500 text-white px-2 py-1 rounded">Agregar tarea</button>
                    </td>
                </tr>
                
                <tr id="tareas-<?php echo e($evento->id); ?>" class="hidden">
                    <td colspan="4" class="bg-gray-100">
                        <ul>
                            <?php $__currentLoopData = $evento->tareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>- <?php echo e($tarea->titulo); ?> (<?php echo e($tarea->estado); ?>)</li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>


<div id="createEventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Crear Evento</h2>
        <form action="<?php echo e(route('eventos.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="text" name="nombre" placeholder="Nombre del evento" class="w-full border p-2 mb-2" required>
            <input type="date" name="fecha" class="w-full border p-2 mb-2" required>
            <input type="file" name="imagen" class="w-full border p-2 mb-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
            <button type="button" onclick="closeCreateEventModal()" class="ml-2 text-red-500">Cancelar</button>
        </form>
    </div>
</div>


<div id="addTareaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Agregar Tarea</h2>
        <form id="addTareaForm" method="POST">
            <?php echo csrf_field(); ?>
            <input type="text" name="titulo" placeholder="Título de la tarea" class="w-full border p-2 mb-2" required>
            <select name="estado" class="w-full border p-2 mb-2">
                <option value="Pendiente">Pendiente</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Completado">Completado</option>
            </select>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Agregar</button>
            <button type="button" onclick="closeAddTareaModal()" class="ml-2 text-red-500">Cancelar</button>
        </form>
    </div>
</div>

<script>
    function toggleTareas(eventoId) {
        const row = document.getElementById('tareas-' + eventoId);
        row.classList.toggle('hidden');
    }

    function openCreateEventModal() {
        document.getElementById('createEventModal').classList.remove('hidden');
    }

    function closeCreateEventModal() {
        document.getElementById('createEventModal').classList.add('hidden');
    }

    function openAddTareaModal(eventoId) {
        const form = document.getElementById('addTareaForm');
        form.action = '/eventos/' + eventoId + '/tareas';
        document.getElementById('addTareaModal').classList.remove('hidden');
    }

    function closeAddTareaModal() {
        document.getElementById('addTareaModal').classList.add('hidden');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\Laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>