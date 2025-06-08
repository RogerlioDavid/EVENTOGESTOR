<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Lista de Eventos</h1>
    <a href="/events/create" class="text-blue-600 underline">Crear nuevo evento</a>
    <ul class="mt-4">
      <li v-for="event in events" :key="event.id" class="mb-2">
        {{ event.title }} - {{ event.date }}
      </li>
    </ul>
  </div>
</template>

<script setup>
defineProps({ events: Array })
</script>
