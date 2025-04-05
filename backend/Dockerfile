# Użyj oficjalnego obrazu PHP z wbudowanym serwerem
FROM php:8.2-cli

# Ustaw katalog roboczy
WORKDIR /app

# Skopiuj pliki backendu
COPY . .

# Expose port 10000 (Render wystawia na nim Web Service)
EXPOSE 10000

# Uruchom wbudowany serwer PHP
CMD ["php", "-S", "0.0.0.0:10000"]
