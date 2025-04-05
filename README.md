# 🌍 Geo Distance App

Aplikacja webowa do obliczania odległości pomiędzy dwoma punktami geograficznymi.  
Umożliwia wybór punktów ręcznie (współrzędne), z listy miast lub poprzez kliknięcie na mapie.

---

## 📦 Tech Stack

- **Frontend:** Vue 3, Vite, Vuetify 3, Leaflet
- **Backend:** PHP
- **Testy:** Vitest (unit), Cypress (e2e)
- **Linting:** ESLint, Oxlint
- **Formatowanie:** Prettier

## 📁 Struktura projektu

geo-distance-app/
├── frontend/ # Aplikacja Vue 3 │
├── src/ # Komponenty, logika │
├── public/ # Assets, np. cities.json │
├── dist/ # Build produkcyjny (ignorowany przez git) │
└── package.json # Skrypty i zależności
├── backend/ │
└── calculate-distance.php # PHP API

## 🚀 Uruchomienie lokalne

### 1. Klonuj repozytorium

```bash
git clone https://github.com/TWOJ_LOGIN/geo-distance-app.git
cd geo-distance-app
```
