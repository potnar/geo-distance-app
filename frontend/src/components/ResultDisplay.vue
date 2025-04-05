<template>
    <div class="result-box">
      <h2>Wynik</h2>
      <p>{{ result.meters }} metrów</p>
      <p>{{ result.kilometers }} kilometrów</p>
    </div>
  </template>
  
  <script setup>
  defineProps(['result'])
  </script>
  
  <style scoped>
  .result-box {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ccc;
  }
  </style>
  