import { createApp } from 'vue'
import DistanceForm from './components/DistanceForm.vue'
import App from './App.vue'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import 'leaflet/dist/leaflet.css'
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App)
app.use(vuetify)
app.use(Toast)
app.component('DistanceForm', DistanceForm)
app.mount('#app')
