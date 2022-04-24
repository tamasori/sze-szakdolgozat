<?php

return [
    "ewc"                    => [
        "header_title" => [
            "dangerous"     => "Veszélyes hulladék nyílvántartó lap",
            "non_dangerous" => "Hulladék nyílvántartó lap",
        ],
        "normal"       => [
            "table" => [
                "headers" => [
                    "yearly_starter"     => "Áthozat",
                    "date"               => "Dátum",
                    "mass"               => "Keletkezett mennyiség",
                    "pretreatment"       => "Előkészítőnek",
                    "collector"          => "Begyüjtőnek",
                    "disposal"           => "Haszn./Ártal.",
                    "export"             => "Export",
                    "on_site"            => "Telephelyen belüli átadás",
                    "rec_name"           => "Neve",
                    "rec_kuj_number"     => "KUJ száma",
                    "rec_ktj_number"     => "KTJ száma",
                    "rec_treatment_code" => "Kezelés kódja",
                    "sz_ticket_number"   => "SZ kisérőjegy száma",
                    "rolling_mass"       => "Göngyölített mennyiség az üzemi gyüjtőhelyen",
                    "export_masses"      => "Átadott mennyiség",
                    "rec_data"           => "Átvevő adatai",
                ],
                "footer"  => [
                    "starter" => ":year évi nyitó",
                    "mass"    => ":year évi keletkezett mennyiség",
                    "export"  => ":year évi átadott mennyiség",
                    "sum"     => ":year záró mennyiség",
                ],
            ],
        ],
        "160104"       => [
            "table" => [
                "headers" => [
                    "amount_header" => "Bontás során keletkezett mennyiség",
                    "hazardous_sum" => "Veszélyes hulladékok",
                    "160106_amount" => "160106 mennyisége",
                    "storage_mode"  => "Tárolás módja",
                ],
                "body"    => [
                    "storage_on_site"  => "Gyüjtés telephelyen",
                    "warning_subtotal" => "Ezen sorhoz tartozó járműnél elírás lehet: ",
                ],
                "footer"  => [
                    "hazardous_sum" => ":year évi veszélyes hulladék",
                    "160106_amount" => ":year évi 160106 mennyiség",
                ],
            ],
        ],
        "160106"       => [
            "footer" => [
                "r4_disposal"     => "R4 anyag selejtezése",
                "exported_mass"   => ":year évi átadott mennyiség",
                "non_hazardous"   => "Nem veszélyes hulladékok",
                "160106_to_r4"    => "160106-ból R4 anyag",
                "before_2017"     => "2017. előtti átminősítések",
                "extra_sum"       => ":year-ben átvett gépjárművek veszélyes hulladék nélkül(160106)",
                "total_generated" => ":year-ben keletkezett mennyiség 160106 (:mass kg)",
                "total_exported"  => ":year-ben átadott összesen (:mass kg)",
            ],
        ],
        "R4"           => [
            "table" => [
                "body"   => [
                    "checked_quantity" => "Minősített mennyiség",
                ],
                "footer" => [
                    "from_160106" => "160106-ból átminősített",
                    "sold_r4"     => "Eladott R4",
                    "disposal"    => "Selejtezés",
                ],
            ],
        ],
    ],
    "waste_management"       => [
        "table" => [
            "header" => [
                "policy" => "Hulladék tárolóhely üzemeltetési szabály",
                "title"  => "Hulladékgazálkodási Tevékenység Üzemnaplója",
            ],
            "body"   => [
                "car"         => "Gépjármű adatai",
                "export_date" => "Kiszállítás dátuma",
            ],
            "footer" => [
                "date"          => "Dátum",
                "no_entries"    => "Nincs bejegyzés",
                "normal"        => [
                    "description" => "Hatósági ellenörzés leírása",
                    "result"      => "Hatósági ellenörzésre lett",
                ],
                "extraordinary" => [
                    "description" => "Rendkívüli esemény leírása",
                    "result"      => "Rendkívüli eseményre",
                ],
            ],
        ],
    ],
    "waste_storage"          => [
        "table" => [
            "header" => [
                "title"           => "Üzemnapló a hulladéktároló hely működéséhez",
                "technology_name" => "Technológia megnevezése",
            ],
            "body"   => [
                "import_mass" => "Beszállított mennyiség [kg]",
                "export_mass" => "Kiszállított mennyiség [kg]",
            ],
        ],
    ],
    "waste_collection_point" => [
        "table" => [
            "header" => [
                "title"    => "Üzemnapló az üzemi hulladék gyűjtőhely működéséhez",
                "receiver" => "Átvevő",
            ],
        ],
    ],
    "material_balance" => [
        "title" => "Anyagmérleg"
    ]
];
