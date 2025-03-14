<?php

define("CSV_FILE", "urenregistratie.csv");

function vragen_stellen() {
    echo "Voer de datum in (YYYY-MM-DD): ";
    $datum = trim(fgets(STDIN));

    echo "Voer je naam in: ";
    $naam = trim(fgets(STDIN));

    echo "Aantal gewerkte uren: ";
    $uren = trim(fgets(STDIN));

    echo "Korte omschrijving van het werk: ";
    $omschrijving = trim(fgets(STDIN));

    return [$datum, $naam, $uren, $omschrijving];
}

function opslaan_in_csv($data) {
    $bestand_bestaat = file_exists(CSV_FILE);
    $file = fopen(CSV_FILE, "a");

    if (!$bestand_bestaat) {
        fputcsv($file, ["Datum", "Naam", "Uren", "Omschrijving"]);
    }

    fputcsv($file, $data);
    fclose($file);
}

function main() {
    echo "💼 Urenregistratie Systeem (PHP CLI)\n";

    while (true) {
        $invoer = vragen_stellen();
        opslaan_in_csv($invoer);
        echo "✅ Gegevens opgeslagen!\n\n";

        echo "Wil je nog een invoer doen? (ja/nee): ";
        $verder = trim(fgets(STDIN));

        if (strtolower($verder) !== "ja") {
            break;
        }
    }
}

main();
