<template>
  <v-container>
    <v-card class="pa-4" elevation="2">
      <v-card-title>Oblicz odległość między miastami lub współrzędnymi</v-card-title>

      <v-card-text>
        <!-- Miasto A -->
        <v-select
          v-model="selectedA"
          :items="cities"
          item-title="name"
          label="Wybierz miasto A"
          return-object
          @update:modelValue="setPointA"
        />
        <v-text-field
  v-model="lat1"
  label="Szerokość geograficzna punktu A"
  type="number"
  :min="-90"
  :max="90"
  @input="validateInput($event, 'Szerokość A', 'lat')"
  @keydown="preventInvalidKey"
/>
<v-text-field
  v-model="lon1"
  label="Długość geograficzna punktu A"
  type="number"
  :min="-180"
  :max="180"
  @input="validateInput($event, 'Długość A', 'lon')"
  @keydown="preventInvalidKey"
/>

        <!-- Miasto B -->
        <v-select
          v-model="selectedB"
          :items="cities"
          item-title="name"
          label="Wybierz miasto B"
          return-object
          @update:modelValue="setPointB"
        />
        <v-text-field
  v-model="lat2"
  label="Szerokość geograficzna punktu B"
  type="number"
  :min="-90"
  :max="90"
  @input="validateInput($event, 'Szerokość B', 'lat')"
  @keydown="preventInvalidKey"
/>
<v-text-field
  v-model="lon2"
  label="Długość geograficzna punktu B"
  type="number"
  :min="-180"
  :max="180"
  @input="validateInput($event, 'Długość B', 'lon')"
  @keydown="preventInvalidKey"
/>
      </v-card-text>

      <v-card-actions>
        <v-btn color="primary" @click="calculate">Oblicz</v-btn>
      </v-card-actions>

      <v-alert v-if="result" type="success" class="mt-4">
        Odległość: {{ result.kilometers }} km ({{ result.meters }} m)
      </v-alert>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useToast } from 'vue-toastification'

const toast = useToast()

const cities = ref([])
const selectedA = ref(null)
const selectedB = ref(null)

const lat1 = ref(null)
const lon1 = ref(null)
const lat2 = ref(null)
const lon2 = ref(null)

const result = ref(null)

onMounted(async () => {
  try {
    const res = await fetch('/cities.json')
    cities.value = await res.json()
  } catch (err) {
    toast.error(err.data || 'Błąd ładowania listy miast.')
  }
})

const setPointA = (city) => {
  lat1.value = city.lat
  lon1.value = city.lon
}

const setPointB = (city) => {
  lat2.value = city.lat
  lon2.value = city.lon
}

const preventInvalidKey = (event) => {
  const invalidKeys = ['e', 'E', '+']

  // Pozwalamy na minus tylko na początku wpisywania
  if (event.key === '-' && event.target.selectionStart !== 0) {
    event.preventDefault()
  }

  if (invalidKeys.includes(event.key)) {
    event.preventDefault()
  }
}


const validateInput = (event, label, type) => {
  const value = event.target.value

  // Zamień przecinek na kropkę
  if (value.includes(',')) {
    toast.error(`${label}: użyj kropki zamiast przecinka.`)
    return
  }

  // Sprawdź, czy to liczba
  const number = Number(value)
  if (isNaN(number)) {
    toast.error(`${label} musi być liczbą.`)
    return
  }

  // Zakresy
  if (type === 'lat' && (number < -90 || number > 90)) {
    toast.error(`${label} musi być w zakresie od -90 do 90.`)
    return
  }
  if (type === 'lon' && (number < -180 || number > 180)) {
    toast.error(`${label} musi być w zakresie od -180 do 180.`)
    return
  }
}


const calculate = async () => {
  const coords = [lat1.value, lon1.value, lat2.value, lon2.value]

  if (coords.some((v) => v === null || v === '')) {
    toast.error('Uzupełnij wszystkie współrzędne.')
    return
  }

  const [la1, lo1, la2, lo2] = coords.map(Number)

  if (
    la1 < -90 || la1 > 90 ||
    la2 < -90 || la2 > 90 ||
    lo1 < -180 || lo1 > 180 ||
    lo2 < -180 || lo2 > 180
  ) {
    toast.error('Współrzędne muszą być w poprawnym zakresie.')
    return
  }

  try {
    const res = await fetch(`${import.meta.env.VITE_API_URL}/calculate-distance.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ lat1: la1, lon1: lo1, lat2: la2, lon2: lo2 })
    })
    result.value = await res.json()
  } catch (err) {
    toast.error(err.data || 'Wystąpił błąd podczas obliczania odległości.')
  }
}
</script>
