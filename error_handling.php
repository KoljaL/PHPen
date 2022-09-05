<?php

//
// Error handeling
//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("log_errors", 1);
if (is_file('./error.log')) {
    // unlink('./error.log');
}
ini_set("error_log", "./error.log");



// Fehlerbehandlungsfunktion
function myErrorHandler($fehlercode, $fehlertext, $fehlerdatei, $fehlerzeile)
{
    if (!(error_reporting() & $fehlercode)) {
        // Dieser Fehlercode ist nicht in error_reporting enthalten
        return false;
    }

    // $fehlertext muss möglicherweise maskiert werden:
    $fehlertext = htmlspecialchars($fehlertext);

    switch ($fehlercode) {
        case E_USER_ERROR:
            echo "<b>Mein FEHLER</b> [$fehlercode] $fehlertext<br />\n";
            echo "  Fataler Fehler in Zeile $fehlerzeile in der Datei $fehlerdatei";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Abbruch...<br />\n";
            break;

        case E_USER_WARNING:
            echo "<b style='color:red;'>Meine WARNUNG</b> [$fehlercode] $fehlertext<br />\n";
            break;

        case E_USER_NOTICE:
            echo "<b>Mein HINWEIS</b> [$fehlercode] $fehlertext<br />\n";
            break;

        default:
            echo "Unbekannter Fehlertyp: [$fehlercode] $fehlertext<br />\n";
            break;
    }

    /* Damit die PHP-interne Fehlerbehandlung nicht ausgeführt wird */
    return true;
}

// auf die benutzerdefinierte Fehlerbehandlung umstellen
// $alter_error_handler = set_error_handler("myErrorHandler");

ini_set("highlight.comment", "#008000");
ini_set("highlight.default", "#900");
ini_set("highlight.html", "#808080");
ini_set("highlight.keyword", "#0000BB; font-weight: bold");
ini_set("highlight.string", "#DD0000");


highlight_string('<?php phpinfo(); ?>');



echo "test";