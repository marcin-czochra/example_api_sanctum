Zadanie rekrutacyjne na stanowisko
Backend Developer (Laravel)

Przygotować projekt oparty o framework Laravel (najnowsza wersja) oraz silnikiem
bazy danych MySQL

Przygotować strukturę bazodanową umożliwiająca przechowywanie produktów wraz
z cenami (jeden produkt może być dostępny w wielu cenach), a każdy produkt
posiada swój opis.

Przygotować endpointy, które umożliwią wylistowanie produktów, a także
przedstawienie informacji szczegółowych o wybranym produkcie. Dodatkowo dla
użytkownika zalogowanego możliwe będzie zarządzanie produktami
(dodawanie,edycja, usuwanie). Lista produktów powinna umożliwiać sortowanie i
filtrowanie.

Dodatkowo mile widziane jest pokrycie aplikacji testami.

1. Stworzenie migracji, kontrolerów oraz modeli dla prices, products, categories
2. Utworzenie Resources do kontroli wyświetlanych wyników
3. Pełny REST API index, show, store, update, destroy dla prices, products, categories
4. Wersjonowanie API - localhost/api/v1/products
5. Użycie Laravel Sanctum do autentyfikacji użytkownika - personal_access_tokens
6. Metody store, update, destroy - dostępne tylko dla uwierzytelnionych użutkowników
7. Utworzenie fabryk i seederów dla prices, categories, products
8. Stworzenie testów dla kontrolera products dla metod index i store
