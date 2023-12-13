<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

Wymagania do Projektu Ankiety
Założenia ogólne
## Panel Administratora:

- Możliwość dodania nowej ankiety.
- Definiowanie widoczności ankiety dla użytkowników (status opublikowany / nieopublikowany).
- Definiowanie otwartej / zamkniętej ankiety.
- Zdefiniowanie URL Slug dostępnego dla ankiety do wypełnienia.
- Dodawanie dowolnej liczby pytań.
- Usuwanie oraz edycja pytań.
- Zmienianie kolejności pytań.
- Wybór rodzaju odpowiedzi do danego pytania (tekstowe, wybór odpowiedzi A/B/C/D, Tak/Nie, wybór wielokrotny - multicheckbox).
- 'Blokowanie' możliwości wypełnienia pytań w razie zaznaczenia odpowiedzi Tak/Nie (np. odpowiedź na pytanie 1. Tak blokuje pytania 2. oraz 3.).
- Lista Ankiet z Paginacją:

## Widoczna lista dodanych ankiet.
- Zastosowanie paginacji (maksymalnie 10 wpisów na stronie).
- Po kliknięciu we wpis - ogólne podsumowanie / statystyki na podstawie odpowiedzi wszystkich użytkowników.
- Lista Ostatnich Wypełnionych Ankiet z Paginacją:

## Lista ostatnich wypełnionych ankiet z zastosowaniem paginacji (maksymalnie 10 wpisów na stronie).
- Przy wpisie odnośnik do modyfikacji szablonu ankiety (punkt 1.) wraz z nazwą główną i datą wypełnienia.
- Możliwość modyfikacji odpowiedzi oraz usuwania całego wpisu.
## Widok Użytkownika:
a) Lista otwartych, opublikowanych ankiet z odnośnikiem do ich wypełnienia.
b) Możliwość dostania się na zamkniętą ankietę (znając odpowiedni URL).

##Sprawy Ogólne:
a) Obsługa wszelkich błędów i niezgodności użytkownika, administratora bądź całego systemu.
b) Logowanie operacji tworzenia / modyfikacji / usuwania szablonu ankiety.
c) Blokowanie możliwości wypełnienia przez użytkownika ankiety wcześniej przez niego uzupełnionej (przez 15 minut od czasu przesłania).

Techniczne Wymagania
## Logika Aplikacji:

- Zastosowanie Laravel do obsługi backendu.
- Frontend zbudowany w oparciu o Vue.js.
- Obsługa operacji CRUD dla ankiet i pytań.
- Bezpieczeństwo:

- Autoryzacja użytkowników, różnicowanie dostępu administratora i zwykłego użytkownika.
- Bezpieczne zarządzanie sesją i ciasteczkami.

## Baza Danych:

- Używanie bazy danych, np. MySQL.
- Struktura bazy danych odpowiadająca modelom danych (ankiety, pytania).
## Paginacja:

- Implementacja paginacji na frontendzie.
- Interfejs Użytkownika:

- Przejrzysty i responsywny interfejs użytkownika.
- Zastosowanie Bootstrap lub innego narzędzia do stylizacji.
