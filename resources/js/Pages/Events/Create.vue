<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Crear Evento</h1>
    <form @submit.prevent="submitForm" class="space-y-4">
      <div>
        <label class="block font-medium">Título:</label>
        <input v-model="form.title" class="border p-2 w-full" required />
      </div>
      <div>
        <label class="block font-medium">Descripción:</label>
        <textarea v-model="form.description" class="border p-2 w-full"></textarea>
      </div>
      <div>
        <label class="block font-medium">Fecha:</label>
        <input type="date" v-model="form.date" class="border p-2 w-full" required />
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  description: '',
  date: ''
})

function submitForm() {
  form.post('/events')
}
</script>
