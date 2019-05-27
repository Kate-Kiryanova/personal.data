# personal.data
1C-Bitrix component for update personal data in personal section

#Код вызова компонента:

$APPLICATION->IncludeComponent(
    "flxmd:personal.data",
    "edit_data",
    Array(
        "COMPONENT_TEMPLATE" => "edit_data",
    )
);
