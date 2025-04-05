<template>
  <v-container>
    <v-card class="pa-4 mb-4" elevation="2" max-width="600" style="margin: auto;">
      <v-card-title>Mapa wyboru punktów</v-card-title>
      <v-card-subtitle>Zaznacz dwa punkty na mapie aby sprawdzić odległość</v-card-subtitle>
      <v-card-text>
        <l-map
          style="height: 400px; width: 100%; border-radius: 8px; overflow: hidden"
          :zoom="zoom"
          :center="center"
          @click="onMapClick"
        >
          <l-tile-layer :url="tileLayerUrl" :attribution="attribution" />
          <l-marker v-if="pointA" :lat-lng="pointA" />
          <l-marker v-if="pointB" :lat-lng="pointB" />
        </l-map>
      </v-card-text>
    </v-card>

    <v-card
      v-if="distance"
      ref="resultSection"
      class="pa-4"
      elevation="2"
      max-width="600"
      style="margin: auto;"
    >
      <v-card-title>Wynik</v-card-title>
      <v-card-text>
        <p>Odległość: <strong>{{ distance.toFixed(2) }}</strong> m</p>
        <p>To około <strong>{{ (distance / 1000).toFixed(2) }}</strong> km</p>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, watch, nextTick } from 'vue'
import { LMap, LTileLayer, LMarker } from '@vue-leaflet/vue-leaflet'
import 'leaflet/dist/leaflet.css'
import L from 'leaflet'

// Fix dla ikon markerów
delete L.Icon.Default.prototype._getIconUrl
L.Icon.Default.mergeOptions({
  iconRetinaUrl: new URL('leaflet/dist/images/marker-icon-2x.png', import.meta.url).href,
  iconUrl: new URL('leaflet/dist/images/marker-icon.png', import.meta.url).href,
  shadowUrl: new URL('leaflet/dist/images/marker-shadow.png', import.meta.url).href,
})

const zoom = ref(5)
const center = ref([52.2297, 21.0122]) // Warszawa
const tileLayerUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
const attribution = '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'

const pointA = ref(null)
const pointB = ref(null)
const distance = ref(null)
const resultSection = ref(null)

const onMapClick = (e) => {
  if (!pointA.value) {
    pointA.value = e.latlng
  } else if (!pointB.value) {
    pointB.value = e.latlng
  } else {
    pointA.value = e.latlng
    pointB.value = null
    distance.value = null
  }
}

const fetchDistanceFromBackend = async (pointA, pointB) => {
  try {
    const response = await fetch('http://localhost:8000/calculate-distance.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        lat1: pointA.lat,
        lon1: pointA.lng,
        lat2: pointB.lat,
        lon2: pointB.lng
      })
    })

    if (!response.ok) {
      throw new Error('Błąd podczas obliczania odległości na backendzie')
    }

    const data = await response.json()
    return data
  } catch (error) {
    console.error(error)
    return null
  }
}

watch([pointA, pointB], async ([a, b]) => {
  if (a && b) {
    const result = await fetchDistanceFromBackend(a, b)
    if (result) {
      distance.value = result.meters
      await nextTick() 
      resultSection.value?.$el?.scrollIntoView({ behavior: 'smooth' })
    }
  }
})
</script>
