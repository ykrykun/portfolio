=== Shipping for Nova Poshta ===
Contributors: bandido, olegkovalyov
Tags: woocommerce, Shipping for Nova Poshta, нова пошта, новая почта, ecommerce
Requires at least: 5.0
Tested up to: 6.0
Requires PHP: 7.0
Stable tag: 1.13.6
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Плагін 2-в-1: спосіб доставки та генерація накладних Нова Пошта. Автоматизуйте щоденні завдання.

== Description ==

Плагін додає спосіб доставки Нова Пошта до вашого магазину на WooCommerce та можливість створювати накладні з замовлень. Плагін працює по АРІ 2.0 і з’єднується напряму з сервером Нової Пошти, персональні дані більше нікуди не передаються. Плагін допомагає автоматизувати процес відправки ваших замовлень через Нову Пошту. На сторінці замовлення можна згенерувати експрес накладну із даних, які вносив покупець при оформленні.


== Video ==
https://youtu.be/u7oGTA9S_U8


== Інструкція ==

1. Встановіть і активуйте плагін.

2. На сторінці налаштувань плагіна, введіть ключ АРІ Нової Пошти

3. Введіть ПІП та номер телефона відправника

4. Введіть відділення, з якого будете проводити відправку (дані повинні підвантажитися з бази, якщо в поле "Відділення" написати просто "1" - накладні створюватися не будуть.

5. Натисніть на кнопку 'Зберегти зміни' на вкладці 'Налаштування'.


== Підтримка ==

Якщо виникла помилка при встановленні чи використанні плагіна - пишіть на support@morkva.co.ua або в Фейсбук месенджер https://m.me/morkvasite
Робочі години з 10:00 до 19:00 ПН-ПТ, 10:00 - 14:00 СБ. Ми відповімо вам протягом доби в робочий час. Всі звернення опрацьовуються по черзі.



== Frequently Asked Questions ==

= В якому форматі вводити номер телефону одержувача? =

Вводьте в форматі 380ХХХХХХХ

= Якщо клієнти вводять +3 8067 або +3(80) 67 як мені бути? =

В плагіна є скрипт, який повинен прибрати з номера телефону зайві символи. Якщо він не працює - напишіть нам. А тим часом просто підкоректуйте номер телефону покупця на сторінці редагування замовлення.

= Чи підтримуються зони доставки? =

Так, зони доставки підтримуються. Для клієнтів з інших країн Нова Пошта не буде видима взагалі.

= Чи потрібно мені вводити дані отримувача кожного разу? =

Ні, плагін використовує дані з форми замовлення.

= Чи можна створити накладну для замовлень доданих адміністратором вручну? =

Так, починаючи з версії 1.7.45 це можливо.

= Чи рахує плагін вартість доставки? =

У безкоштовній версії можна встановити фіксовану вартість доставки або 0грн. Вартість доставки додається до вартості замовлення. У Про версії вартість розраховуєтсья, але її можна не додавати до замовлення на ваш вибір.

= Чи зберігається номер накладної? =

Так, номер накладної зберігається в примітках.

= Чи можна змінити платника? =

Така можливість (як і багато інших) вже є у Pro версії.

= Чи можна змінити оголошену вартість? =

Така можливість (як і багато інших) вже є у Pro версії.

= Чи можна відправити покупцю смс чи емейл з номером накладної? =

Така можливість (як і багато інших) вже є у Pro версії. Для емейлів є шаблон листа, а для смс радимо плагіни WooSMS та TurboSMS які підхоплюють номери ТТН з нашого плагіна.

= Чи можна створювати ТТН автоматично повністю? =

Така можливість (як і багато інших) вже є у Pro версії.


== Screenshots ==

1. Сторінка створення накладної. Просто допишіть опис. ПІП отримувача повинно бути КИРИЛИЦЕЮ (вимога АРІ Нової Пошти)
2. Після створення накладної, можна роздрукувати її або стікер. Також можна буде відправити клієнту на емейл
3. На сторінці замовлень легко розпізнати, для яких клієнтів ви вже сформували накладні
4. Сторінка налаштувань плагіна
5. Якщо поставили чекбокс "Використовувати зони доставки", спосіб доставки Нова Пошта додається як само, як усі інші
6. Можна не розраховувати вартість доставки на етапі створення замовлення. Просто пропишіть фіксовану вартість "0грн"
7. Пошук міст тепер швидший та точніший
8. На сторінці оформлення можна використовувати лише 2 поля: пошук міста та відділення. Плагін сам приховає зайві стандартні поля

== Що нового? ==

= 1.13.6 =
* [fix] змінена формула розрахунку об'ємної ваги

= 1.13.5 =
* [new] в переліку міст області першим стоїть обласний центр

= 1.13.3 =
* [new] розпочато перехід до одного налаштування Область + Місто + Відділення

= 1.13.2 =
* [new] доданий переклад для сповіщень Select2 українською та російською мовами
* [new] доданий спінер при пошуку міст і відділень в Checkout
* [new] можливість обирати колір спінера в налаштуваннях плагіну

= 1.13.1 =
* [new] створення таблиць БД плагіну при активації плагіну, якщо на цей момент вони відсутні
* [new] на вкладку Налаштування додана кнопка Оновити для ручного оновлення таблиць БД плагіну
* [fix] оновлення таблиць БД плагіну можливо тепер і без API-ключа і коли API-ключ став застарілим
* [fix] прибране дублювання підзаголовку Базові налаштування

= 1.12.8 =
* [new] змінений інтервал автооновлення таблиць БД плагіну до щоденного в зв'язку з воєнним станом в Україні
* [new] прибране сповіщення з кнопкою Оновити базу; додане нове сповіщення про відсутність даних в таблицях
* [fix] виправлена помилка відсутності поля billing_country в Checkout

= 1.12.7 =
* [new] поле Опис відправлення заповнюється згідно відповідного налаштування
* [fix] виправлені деякі помилки

= 1.12.6 =
* [new] доданий загальний стиль для поля Область в Checkout

= 1.12.5 =
* [new] доданий новий спосіб доставки виключно для поштоматів
* [new] додане сповіщення про необхідність отримати ключ API і ввімкнути Зони доставки
* [fix] прибране застаріле налаштування, яке викликало фатальну помилку в деяких випадках

= 1.12.4 =
* [fix] додані стандартні поля Woocommerce до Самовивозу та інш. на сторінці Checkout

= 1.12.3 =
* [fix] прибрано додавання зайвих полів на сторінку Checkout для інших способів доставки

= 1.11.8 =
* [new] плейсхолдер Виберіть область перекладено російською (Checkout)

= 1.11.7 =
* [new] додані підказки select2 та плейсхолдери російською мовою в Checkout

= 1.11.6 =
* [new] додані кастомні поля ref-area та ref-city до Замовлення

= 1.11.5 =
* [new] перевірена сумісність з WooCommerce 5.4

= 1.11.4 =
* [fix] покращена підтримка одиниць виміру ваги WooCommerce

= 1.11.3 =
* [fix] виправлені помилки при першому встановленні плагіну

= 1.11.2 =
* [fix] виправлена помилка створення ТТН на поштомат

= 1.11.1 =
* [ux] Зони доставки тепер працюватимуть по замовчуванню. Щоб додати спосіб доставки, потрібно перейти на WooCommerce - Налаштування - Доставка і додати Нову Пошту в зону доставки Україна;
* [new] на сторінці Thankyou додано напис для номеру накладної при автоматичному створенні 'Нова Пошта ТТН: {номер_накладної};
* [fix] виправлено визначення Ref-адреси Одержувача;
* [fix] виправлено помилку відправки E-mail з номером ТТН.

= 1.11 =
* [fix] в Checkout змінені плейсхолдери на 'Оберіть область', 'Оберіть місто', 'Оберіть відділення' в усіх трьох налаштуваннях 'Поля при оформленні замовлення';
* [fix] виправлено роботу плагіна, якщо на сайті товари без розмірів, без ваги, без об'ємної ваги. Використовуються мінімальні значення 10х10х10 см, 0.5 кг, 0.001 м3;
* [fix] відновлена функція автостворення накладних для відправлень на Відділення (поки не на Поштомати);
* [dev] отримання $order_id змінено з `$_SESSION` на `$_GET['post']`

= 1.10.1 =
* [update] підтримка WordPress 5.6

= 1.10 =
* [new] оновлений алгоритм розрахунку вартості доставки на Поштомат
* [new] перероблений спосіб доставки на адресу

= 1.9.7 =
* [fix] core update

= 1.9.6 =
* [new] додане поле 'Телефон' для доставки на іншу адресу

= 1.9.5 =
* [fix] відновлено відображення номерів накладних на сторінці 'Замовлення'

= 1.9.4 =
* [fix] виправлено помилку зон доставки

= 1.9.3 =
* [fix] виправлено помилку підрахунку об'єму товарів у кошику

= 1.9.2 =
* [fix] виправлені дрібні помилки

= 1.9.1 =
* [new] перероблена сторінка плагіну 'Налаштування'
* [fix] виправлені дрібні помилки

= 1.9.0 =
* [new] повністю перероблений алгоритм розрахунку вартості доставки; враховано забирання з адреси і з відділення
* [new] Мінімальна сума для безкоштовної доставки - при досягненні певної суми, назва способу доставки може змінитися, наприклад, на "БЕЗКОШТОВНА доставко до відділення"
* [fix] виправили помилку, при якій адреса відправки не змінювалася
* [fix] виправили розрахунок вартості доставки
* [fix] виправили помилку при якій не враховувалася фіксована вартість доставки
* [fix] виправили створення накладної при заборі з адреси
* [fix] виправили автоматичне створення накладної при заборі з адреси

= 1.8.3 =
* [new] доданий новий варіант selectDB налаштування полів Місто та Склад
* [fix] відновлена функція автоматичного створення накладних

= 1.8.2 =
* [new] додана можливість вказувати номер паковання на сторінці Створити Накладну

= 1.8.1 =
* [fix] виправлена помилка на сторінці Створити Накладну

= 1.8 =
* [new] додана можливість створення накладних для середньої комірки Поштоматів
* [new] з'явились повідомлення API Нової Пошти про помилки при створенні накладної

= 1.7.54 =
* [fix] виправлено показ вартості доставки

= 1.7.50 =
* [fix] налаштування "Додати розрахунок вартості доставки до замовлення" працює для адресної доставки

= 1.7.49 =
* [fix] відновлено створення накладних

= 1.7.48 =
* [new] додана валідація телефону в накладних
* [fix] прибрані виклики функції session_start()

= 1.7.47 =
* [fix] виправлення щодо інформації в метабоксі Накладна

= 1.7.46 =
* [new] додані підказки про автокомпліт до полів вибору області, міста і відділення

= 1.7.45 =
* [new] додали автозаповнення міста і відділення при створенні замовлення вручну

= 1.7.44 =
* [fix] виправлений виклик implode()

= 1.7.43 =
* [fix] виправлені помилки при доставці за іншою адресою

= 1.7.42 =
* [new] додано розрахунок вартості адресної доставки.

= 1.7.39 =
* [fix] оновлення згідно з оновленим форматом баз відділень НП.

= 1.7.38 =
* [pro] оновлено алгоритм вибору міста отримувача при автоматичній генерації ттн
* [fix] інші виправлення

= 1.7.37 =
* [fix] виправлення помилок пов'язаних з пошуком результатів у списку населених пунктів.


= 1.7.36 =
* [pro] В списку замовлень пошук по замовленням
* [pro] В налаштуваннях плагіну опція "Опис відправлення" додати в перелік тільки артикул+кількість, без назви товари - дуже зручно опрацьовувати замовлення, коли в маркуванні є артикул і кількість
* [new] При оформленні замовлення назва полю "Регіон" замінено на "Область"

= 1.7.34 - 1.7.35 =
* [fix] виправлення помилок.

= 1.7.33 =
* [fix] зменшено кількість запитів до серверів нової пошти при створенні накладної. Використання implode() приведено до стандарту PHP 7.4

= 1.7.32 =
* [pro] оновлення логіки автостворення накладних для адресної доставки.

= 1.7.31 =
* [pro] оновлення логіку контролю дати відправки.

= 1.7.30 =
* [pro] оновлення логіки розрахунку вартості замовлення.

= 1.7.29 =
* [pro] додано автоматизацію по сум замовлення для автоматично створених накладних.

= 1.7.27 - 1.7.28 =
* [fix] виправлення пов'язані із сторіною checkout'.

= 1.7.22 - 1.7.26 =
* [fix] виправлення пов'язані з адресною доставкою.

= 1.7.22 - 1.7.26 =
* [fix] виправлення пов'язані з адресною доставкою.

= 1.7.21 =
* [fix] автооновлення баз винесено у окрему настройку, вимкнену за промовчанням.
період оновлення з 1 дня замінено на 7 днів(якщо увімкнено автооновлення).
* [new] додається deliveryprice мета поле для замовлення
* [new] настройка "Створювати накладні для усіх варіантів доставок"

= 1.7.20 =
* [fix] автооновлення баз винесено у окрему настройку, вимкнену за промовчанням.
період оновлення з 1 дня замінено на 7 днів(якщо увімкнено автооновлення).

= 1.7.17, 1.7.18, 1.7.19 =
* [fix] виправлення щодо адресної доставки
* [fix] автостворення накладних всіх типів відправлень (відділення-відділення, відділення - адреса, адреса- адреса,  адреса-відділення)

= 1.7.16 =
* [fix] виправлення щодо адресної доставки

= 1.7.15 =
* [fix] виправлення помилок

= 1.7.14 =
* [new] фонове оновлення бази при потребі

= 1.7.13 =
* [pro] шорткод посилання у листі працює  для листів, відправлених з середини замовлення
* [pro] ТТН без замовлення у списку всіх ТТН

= 1.7.12 =
* [fix] css виправлення щодо ширини select2
* [pro] php виправлення в коді з планувальником cron
* [new] попередження в адмінпанелі про необхідність синхронізації бази відділень

= 1.7.11 =
* [new] На  сторінці "Про плагін" показується інформація про список відділень та міст у бізі відділень плагіну
* [new] виправлення помилок
* [new] створення відправлення з адреси
* [pro] якщо увімкнена автоматизація від суми в кошику  і сума в кошику більше за вказану в настройці то ціна не показується
* [fix] пункт прийому видачі сприймається російською мовою також

= 1.7.10 =
* [pro] шорткод {LINK] в листі + посилання на сторінці списку замовлень
* [fix] shipping fields доставка за другою адресою select2 працює уже без проблем

= 1.7.9 =
* [new] виправлення помилок

= 1.7.8 =
* [new] створення накладної не для замовлення
* [new] оновлення скриптів для якіснішої роботи при оформенні замовлення

= 1.7 =
Синхронізація індексу версій з PRO версією

= 1.4.3 =
* [new] підтримка зон доставки
* [new] дані отримувача можна коригувати при формуванні замовлення
* [update] оновили механізм пошуку міста та відділення (на сторінці чекаут)
* [update] можна використовувати 2 або 3 поля на сторінці чекаут (місто-відділення або регіон-місто-відділення)
* [fix] покращили інтерфейс плагіна
* [fix] виправлено дрібні помилки
* перевірили сумісність з WooCommerce 3.8.x Та Wordpress 5.3

= 1.1.2 =
* [fix] виправлено помилки

= 1.1.1 =
* [fix] виправлено помилки

= 1.1 =
* [new] підтримка WooCommerce 3.7, плагін тепер включає і способи доставки і створення накладних.
Лише 2 поля на сторінці оформлення (checkout): вибір міста (з пошуком) і вибір відділення (з пошуком)

= 1.0.19 =
* [new] оновлення бічного меню та сторінки створення накладної

= 1.0.18 =
* [fix] виправлено не повну сумісність з woocommerce WooCommerce 3.6.4

= 1.0.17 =
* [fix] Оголошена вартість відправки встановлюється правильно

= 1.0.16 =
* [fix] Користувачу з правами shop manager також тепер можна створювати накладну

= 1.0.15 =
* [fix] виправлено баги
* [new] додано ряд перевірок логіки при створенні накладної
* [new] при неправильному введенні даних в форму, відображається і код і роз'яснення помилки

= 1.0.14 =
* [new] перехід від bootstrap дизайну до wp core дизайну
* [new] додано валідацію ПІБ на кирилицю
* [new] Оптимізація коду

= 1.0.13 =
* [new] додано freemius tracking

= 1.0.12 =
* [new] додано валідацію ПІБ
* [fix] дані отримувача беруться з полів billing

= 1.0.11 =
* [fix] на деяких сайтах місто одержувача завжди створювало як "Авангард"

= 1.0.10 =
* [fix] неправильно створювалася адреса відділення відправника
* [fix] різні дрібні правки
* [new] Налаштування Області, Міста, Відділення тепер повністю беруться з плагіна Shipping for Shipping for Nova Poshta
* Формуємо ранній список бажаючих на Pro версію


= 1.0.8 =
* [fix] неправильно створювалася адреса відділення отримувача
* [new] Номер створеної накладної тепер записується у Нотатки на сторінці редагування замовлення


= 1.0.7 =
* [fix] більше не впливає на роботу стилів всього сайту

= 1.0.5 =
* [fix] не зберігався ключ АРІ
* інші дрібні виправлення
