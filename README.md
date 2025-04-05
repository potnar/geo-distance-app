# 🌍 Geo Distance App

Aplikacja webowa do obliczania odległości pomiędzy dwoma punktami geograficznymi.  
Umożliwia wybór punktów ręcznie (współrzędne), z listy miast lub poprzez kliknięcie na mapie.

---

## 📦 Tech Stack

- **Frontend:** Vue 3, Vite, Vuetify 3, Leaflet
- **Backend:** PHP
- **Testy:** Vitest (unit), Cypress (e2e)
- **Linting:** ESLint
- **Formatowanie:** Prettier

---

## 📁 Struktura projektu

```
geo-distance-app/
├── frontend/               # Aplikacja frontendowa
│   ├── src/                # Komponenty, logika aplikacji
│   ├── public/             # Statyczne zasoby (np. cities.json)
│   ├── dist/               # Build produkcyjny (ignorowany przez git)
│   └── package.json        # Skrypty i zależności frontendowe
├── backend/                # Backend aplikacji
│   └── calculate-distance.php # API do obliczania odległości
└── README.md               # Dokumentacja projektu
```

---

## 🚀 Uruchomienie lokalne

### 1. Klonowanie repozytorium

```bash
git clone https://github.com/TWOJ_LOGIN/geo-distance-app.git
cd geo-distance-app
```

### 2. Uruchomienie backendu (PHP)

Przejdź do katalogu `backend` i uruchom wbudowany serwer PHP:

```bash
cd backend
php -S localhost:8000
```

Backend będzie dostępny pod adresem:  
`http://localhost:8000/calculate-distance.php`

### 3. Uruchomienie frontendu (Vue 3)

Przejdź do katalogu `frontend`, zainstaluj zależności i uruchom serwer deweloperski:

```bash
cd frontend
npm install
npm run dev
```

Frontend będzie dostępny pod adresem:  
`http://localhost:5173`

---

## 🧪 Testowanie

### Testy jednostkowe (Vitest)

Aby uruchomić testy jednostkowe, wykonaj:

```bash
cd frontend
npm run test:unit
```

### Testy end-to-end (Cypress)

Aby uruchomić testy e2e, wykonaj:

```bash
cd frontend
npm run test:e2e
```

---

## 🌟 Funkcjonalności

- **Wybór punktów na mapie**: Kliknij na mapie, aby wybrać dwa punkty.
- **Lista miast**: Wybierz miasta z predefiniowanej listy.
- **Ręczne wprowadzanie współrzędnych**: Podaj współrzędne geograficzne punktów.
- **Obliczanie odległości**: Backend oblicza odległość między punktami za pomocą wzoru Haversine.
- **Responsywny interfejs**: Aplikacja działa na urządzeniach mobilnych i desktopowych.

---

## 🛠️ Konfiguracja środowiska

### Zmienne środowiskowe (Frontend)

W katalogu `frontend` utwórz plik `.env` i skonfiguruj zmienne środowiskowe:

```
VITE_API_URL=http://localhost:8000
```

---

## 🖼️ Zrzuty ekranu

### Widok główny

![Widok główny](https://via.placeholder.com/800x400?text=Zrzut+ekranu+widoku+głównego)

### Wynik obliczeń

![Wynik obliczeń](https://via.placeholder.com/800x400?text=Zrzut+ekranu+wyniku+obliczeń)

---

## 📝 Licencja

Projekt jest dostępny na licencji MIT. Szczegóły znajdziesz w pliku [LICENSE](LICENSE).

---

## 👨‍💻 Autorzy

- **Twoje Imię i Nazwisko** - [Twój GitHub](https://github.com/TWOJ_LOGIN)
