<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'database' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'ub455603_db' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'Gx2WStSQ' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'ub455603.mysql.tools' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'rNd+*00$%O.nJCd}jHObuet/NwKj_r<o,{dfY2T)J7_Ik]<50UYSZ9_COhzcG|Ti' );
define( 'SECURE_AUTH_KEY',  'tFl]]r%A#}pD|$*I29qwr{ag+C*J]#5:#|qDv)tB(sU`/F&<>j.&JgO<Q8Tr8(hp' );
define( 'LOGGED_IN_KEY',    'vqWLOXv3t/2p-#|rGr%/R;Uar0R9 GuVGTKq3w0e.Mt}OZue`{T%Cxxs6+YunU3}' );
define( 'NONCE_KEY',        '_4pu+7 e=+3g&Z^#^M8$baWrJcG[ZWK$A1;R~Z3aRh%%8e&cpy1pMG%?*l)<]`wr' );
define( 'AUTH_SALT',        'N4d/F6.0NQ(Z-W<_*on_!AZ+xkqT+3=X Y(b4v*#?[K3Rt|sdmti5B%$c@jmZC,0' );
define( 'SECURE_AUTH_SALT', '4>=7r-H8wMo0[2nXxluP~G=?-JRWAyk4lmS&5K{yc40n:V| $g^3EUNRV0O[A![D' );
define( 'LOGGED_IN_SALT',   'u-Ew<cPEI,WtqXgg,WP/x=_7GrXfFS@=&_t*&>3&IVA]%FSp$hhuDLH0;c1tT$_<' );
define( 'NONCE_SALT',       'sUkH9Ec@-a2B0d-UpS??>qpTo{Kj4^x;81+d;!0wycFtGn)rZCTmPPdYs-o14:Jc' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
